<?php
/**
 * ROOT Home Page
 * 
 * This is the ROOT Controller
 * 
 * @package    App\Controllers
 * @author     Andrew Nite <ngendesign@email.com.com>
 * @copyright  2026 N-Gen Design <https://ngendesign.com>
 * @license    https://opensource.org MIT License
 * @link       https://github.com/n-genesis/ngen-kumbuka-ci
 */
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return $this->renderView('welcome_message', [
            'appTitle' => setting('App.appName') . ' | CodeIgniter 4 Portfolio Project',
        ]);
        
    }
    
}