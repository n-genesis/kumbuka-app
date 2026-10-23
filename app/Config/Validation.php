<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    //--------------------------------------------------------------------
    // Rules For Registration
    //--------------------------------------------------------------------
    public $registration = [
        'first_name' => [
            'label' => 'First Name',
            'rules' => 'required|alpha_numeric_space|min_length[2]|max_length[50]',
            'errors' => [
                'required' => 'Please provide your first name.',
                'alpha_numeric_space' => 'First name can only contain letters, numbers, and spaces.',
                'min_length' => 'First name must be at least 2 characters long.',
                'max_length' => 'First name cannot exceed 50 characters.'
            ]
        ],
        'last_name' => [
            'label' => 'Last Name',
            'rules' => 'required|alpha_numeric_punct|min_length[2]|max_length[50]',
            'errors' => [
                'required' => 'Please provide your last name.',
                'alpha_numeric_punct' => 'Last name can only contain letters, spaces, hyphens, or apostrophes.',
                'min_length' => 'Last name must be at least 2 characters long.',
                'max_length' => 'Last name cannot exceed 50 characters.'
            ]
        ],
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => 'required|max_byte[72]|strong_password[]',
            'errors' => [
                'max_byte' => 'Auth.errorPasswordTooLongBytes'
            ]
        ],
    ];

    public array $nameRules = [
        'first_name' => [
            'label' => 'First Name',
            'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
        ],
        'last_name' => [
            'label' => 'Last Name',
            'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
        ],
        'bio' => [
            'label' => 'Bio',
            'rules' => 'permit_empty|min_length[25]|max_length[700]',
            'errors' => [
                'max_length' => 'The {field} cannot be longer than {param} characters.'
            ]
        ],
    ];

    public array $contactRules = [
        'website_link' => [
            'lable' => 'Website',
            'rules' => 'permit_empty|valid_url_strict',
            'errors' => [
                'regex_match' => 'Please enter a valid website address (e.g., https://example.com).'
            ]
        ],
        'social_link' => [
            'lable' => 'Social Media Link',
            'rules' => 'permit_empty|valid_url_strict',
            'errors' => [
                'regex_match' => 'Please enter a valid website address (e.g., https://example.com).'
            ]
        ]
    ];

    public array $noteRules = [
        'title' => [
            'label' => 'Title',
            'rules' => 'required|max_length[255]|min_length[5]',
            'errors' => [
                'required' => '{field} is required.',
                'min_length' => 'can be no less then 5 characters.'
            ]
        ],
        'content' => [
            'label' => 'Note Content',
            'rules' => 'required|min_length[10]',
            'errors' => [
                'min_length' => '{field} can be no less then 10 characters.',
            ]
        ],
        'color' => [
            'label' => 'Priority',
            'rules' => 'required|regex_match[/^#?([a-fA-F0-9]{3,4}|[a-fA-F0-9]{6}|[a-fA-F0-9]{8})$/]',
            'errors' => [
                'regex_match' => 'The theme color must be a valid CSS hexadecimal color code (e.g. #FF5733).'
            ]
        ],
        'visibility' => [
            'label' => 'Visibility',
            'rules' => 'required|in_list[private,public]',
            'errors' => [
                'required' => 'A {field} must be selected.'
            ]
        ],
        'notebook_id' => [
            'label' => 'Notebook',
            'rules' => 'required|is_not_unique[notebooks.id]',
            'errors' => [
                'required' => 'Notebook Note Found',
            ]
        ]
    ];

    public array $imagesRules = [
        'note_images' => [
            'label' => 'Featured Image',
            'rules' => [
                'uploaded[note_images]',
                'is_image[note_images]',
                'max_size[note_images,4096]', // 4MB maximum
                'mime_in[note_images,image/jpg,image/jpeg,image/png,image/webp]',
                'ext_in[note_images,jpg,jpeg,png,webp]',
                'max_dims[note_images,3840,2160]' // Keeps ultra-high res files out
            ],
            'errors' => [
                'uploaded' => 'Please select a featured image to upload.',
                'is_image' => 'The file must be a valid image format.',
                'max_size' => 'The image is too heavy. Maximum size allowed is 4MB.',
                'mime_in' => 'Only JPG, JPEG, PNG, and WebP images are allowed.',
                'ext_in' => 'The file extension does not match the image type.',
                'max_dims' => 'The image dimensions are too large (Max: 4K resolution).'
            ]
        ]
    ];

    public array $notebookRules = [
        'name' => [
            'label' => 'Name',
            'rules' => 'required|max_length[145]|min_length[5]',
            'errors' => [
                'required' => '{field} is required.',
                'min_length' => 'can be no less then 5 characters.'
            ]
        ],
        'metadata' => [
            'label' => 'Keywords List',
            'rules' => 'permit_empty|regex_match[/^[a-zA-Z0-9 ]+(?:\s*,\s*[a-zA-Z0-9 ]+)*$/]',
            'errors' => [
                'regex_match' => 'The {field} must be a comma-separated list of alphanumeric keywords.'
            ]
        ],
        'description' => [
            'label' => 'Description',
            'rules' => 'permit_empty|max_length[500]|min_length[10]',
            'errors' => [
                'min_length' => '{field} can be no less then 10 characters.',
            ]
        ],
        'theme_color' => [
            'label' => 'Theme Color',
            'rules' => 'required|in_list[primary,success,warning,danger]',
            'errors' => [
                'in_list' => 'Please select a valid {field} from the options provided.'
            ]
        ],
        'visibility' => [
            'label' => 'Visibility',
            'rules' => 'required|in_list[private,public]',
            'errors' => [
                'required' => 'A {field} must be selected.'
            ]
        ],
        'notebook-image' => [
            'label' => 'Notebook Image',
            'rules' => [
                'permit_empty',
                'uploaded[notebook-image]', // Ensures a file was actually sent
                'is_image[notebook-image]', // Blocks malicious scripts disguised as images
                'mime_in[notebook-image,image/jpg,image/jpeg,image/png,image/webp]', // Safe format whitelist
                'max_size[notebook-image,5120]', // Limit to 5MB (phone photos can be large)
            ],
        ],
    ];
}
