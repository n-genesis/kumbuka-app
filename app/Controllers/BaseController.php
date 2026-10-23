<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\UserSettings as userConfig;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $userConfig;
    protected $userId; // Store the ID of the currently logged-in user
    protected $username; // Store the username of the currently logged-in user
    protected $userFullName; // Store the full name of the currently logged-in user
    protected $userEntity; // Store the User Model of the currently logged-in user
    protected $userDetailsModel;
    protected $userDetails;
    protected $userAvatar;
    protected $globalData;

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');

        // Get Config values or store settings
        $this->globalData = (object) [
            'appName' => service('settings')->get('App.appName'),
            'appLogo' => service('settings')->get('App.appLogo'),
            'appTitle' => service('settings')->get('App.appTitle'),
            'appEmail' => service('settings')->get('App.appEmail'),
            'appAuthor' => service('settings')->get('App.appAuthor'),
            'appAuthWebsite' => service('settings')->get('App.appAuthWebsite'),
            // TODO Rethink where the configs for Deafault User valuse should be stored
            'appDesc' => service('settings')->get('App.appDesc'),
            'appDefaultuserFullName' => service('settings')->get('App.appDefaultuserFullName'),
            'appDefaultUserEmail' => service('settings')->get('App.appDefaultUserEmail'),
            
        ];

        $view = service('renderer');
        // Add Global Data to View $data array
        $view->setData((array) $this->globalData);

        // Get Default User Configs
        $this->userConfig = config(UserConfig::class);

        // Check if the User is logged in & get credentials
        if (auth()->loggedIn()) {
            $this->userEntity = auth()->user(); // User Entity
            $this->userId = auth()->id();// Get User ID
            $this->username = auth()->user()->username;
        }

    }
    /**
     * Render a view with optional breadcrumb links.
     *
     * @param string $viewName The name of the view to render.
     * @param array $data Optional data to pass to the view.
     * @return string Rendered view content.
     */
    public function renderView(string $viewName, array $data = [])
    {
        $breadcrumbLinks = $data['breadcrumbLinks'] ?? $data['breadCrumbLinks'] ?? [];

        if (!isset($data['breadcrumbHtml']) && !empty($breadcrumbLinks)) {
            $data['breadcrumbHtml'] = $this->buildBreadcrumbHtml($breadcrumbLinks);
        }

        return view($viewName, $data);
    }

    /**
     * Helper to build breadcrumb HTML from an array of links
     * 
     * @param array $breadcrumbLinks Array of breadcrumb links, each containing 'label' and 'url'
     * @return string HTML string for the breadcrumb navigation
     */
    protected function buildBreadcrumbHtml(array $breadcrumbLinks = []): string
    {
        if (empty($breadcrumbLinks)) {
            return '';
        }

        $html = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
        $lastIndex = count($breadcrumbLinks) - 1;

        foreach ($breadcrumbLinks as $index => $link) {
            $label = $link['label'] ?? 'Item';
            $url = $link['url'] ?? '';
            $isLast = $index === $lastIndex;

            if ($isLast || empty($url)) {
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') . '</li>';
                continue;
            }

            $html .= '<li class="breadcrumb-item"><a href="' . htmlspecialchars((string) $url, ENT_QUOTES, 'UTF-8') . '">'
                . htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') . '</a></li>';
        }

        $html .= '</ol></nav>';

        return $html;
    }

}
