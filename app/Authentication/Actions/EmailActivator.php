<?php
/**
 * EmailActivator Class
 * 
 */
namespace App\Authentication\Actions;

use CodeIgniter\Shield\Authentication\Actions\ActionInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RedirectResponse;
use \CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Traits\Viewable;

class EmailActivator implements ActionInterface
{
    use Viewable;

    // Local memory placeholder to safeguard unactivated user objects
    protected ?User $user = null;

    /**
     * Setter method called by your custom registerAction controller
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Shield's internal pipeline automatically looks for or passes 
     * the user to the execute() method during startUpAction().
     */
    public function execute(User $user)
    {
        // Capture the injected user object into your class instance memory
        $this->user = $user;

        // Generate a random token code
        $token = bin2hex(random_bytes(16));
        $users = auth()->getProvider();

        $identity = $user->getIdentity('email_activate');

        if ($identity === null) {
            $user->createIdentity([
                'type'   => 'email_activate',
                'secret' => $token,
                'extra'  => date('Y-m-d H:i:s'),
            ]);
        } else {
            $identity->secret = $token;
            $identity->extra  = date('Y-m-d H:i:s');
            $users->saveIdentity($identity);
        }

        // Must return the modified user entity back to the Shield pipeline
        return $user;
    }

    /**
     * 2. This runs when the user lands on the /auth/a/show route.
     * It sends the email and returns your custom HTML view.
     */
    public function show(): string|RedirectResponse
    {
        // Clean retrieval of the pipeline user!
        $user = $this->user ?? auth()->user();

        // Safe session fallback if global helpers filter out unactivated accounts
        if ($user === null && session()->has('user_id')) {
            $user = auth()->getProvider()->findById(session('user_id'));
        }

        // if ($user === null) {
        //     return redirect()->route('login')->with('error', 'Session expired.');
        // }

        echo '<pre>';
        var_dump($user);
        echo '</pre>';
        exit;

        // Fetch the secret token we just generated in createIdentity()
        $identity = $user->getIdentity('email_activate');
        
        if (! $identity) {
            return redirect()->route('login')->with('error', 'Invalid activation state.');
        }

        // Build the validation link pointing to 'auth-action-verify'
        $activationLink = url_to('auth-action-verify') . '?token=' . $identity->secret;
        
        helper('email');
        $email = emailer(['mailType' => 'html'])
            ->setFrom(setting('Email.fromEmail'), setting('Email.fromName') ?? '');
        $email->setTo($user->email);
        $email->setSubject(lang('Auth.emailActivateSubject'));
        // Pass the link to an email body template
        $email->setMessage("Hi " . esc($user->username) . ",\n\nPlease click the following link to activate your account:\n" . $activationLink);
        
        if ($email->send(false) === false) {
            // Optional: Log errors if your SMTP config fails
            log_message('error', 'Activation email failed to send to: ' . $user->email);
            return redirect()->route('login')->with('error', 'Failed to send activation email. Please try again later.');
        }

        // Clear the email
        $email->clear();

        // Render your custom view (from the previous step)
        return $this->view('auth/email_sent_notice');
    }


    public function handle(IncomingRequest $request): RedirectResponse
    {
        // This method is not used in this implementation, but required by the interface.
        return redirect()->to(config('Auth')->registerRedirect());
    }

     /**
     * 3. This runs when the user clicks the activation link in their inbox.
     */
    public function verify(IncomingRequest $request): RedirectResponse
    {
        $token = request()->getGet('token');

        if (empty($token)) {
            return redirect()->route('login')->with('error', 'Invalid or missing activation token.');
        }

        // Find the identity record that matches this token string
        $db = \Config\Database::connect();
        $identityRecord = $db->table('auth_identities')
                             ->where('type', 'email_activate')
                             ->where('secret', $token)
                             ->get()
                             ->getRowArray();

        if (! $identityRecord) {
            return redirect()->route('login')->with('error', 'The activation link is invalid or has expired.');
        }

        // Load the associated user account
        $userModel = model('UserModel');
        $user      = $userModel->find($identityRecord['user_id']);

        if (! $user) {
            return redirect()->route('login')->with('error', 'User account not found.');
        }

        // Activate the user account
        $user->activate();

        // Clean up and delete the activation token identity record
        $user->deleteIdentitiesByType('email_activate');

        // Log the user in directly and send them to the register redirect target
        auth()->login($user);

        return redirect()->to(config('Auth')->registerRedirect())
                         ->with('message', 'Your account has been successfully verified!');
    }

    /**
     * 1. This runs automatically during $authenticator->loginById().
     * It generates and stores the token before redirecting.
     */
    public function createIdentity(User $user): string
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        // Generate a random 32-character hex token
        $token = bin2hex(random_bytes(16));
        $generator = static fn (): string => $token;
        // Delete any old activation tokens for safety
        $identityModel->deleteIdentitiesByType($user, 'email_activate');

        // Store the new token securely inside Shield's native identities system
        return $identityModel->createCodeIdentity(
            $user,
            [
            'type'   => 'email_activate',
            'secret' => $token,
            'name'   => 'activation_token',
        ], $generator,
        );
        
    }

    public function getType(): string
    {
        return 'email_activate';
    }
}
