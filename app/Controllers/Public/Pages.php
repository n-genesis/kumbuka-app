<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Pages extends BaseController
{
    public function support()
    {
        return $this->renderView('pages/support',[
            'appTitle' => setting('App.appName').' | Technical Support',
        ]);
    }

    public function privacy_policy() {
        return $this->renderView('pages/privacy_policy',[
            'appTitle' => setting('App.appName').' | Privacy Policy',
        ]);
    }

    public function terms_of_service() {
        return $this->renderView('pages/terms_of_service',[
            'appTitle' => setting('App.appName').' | Terms Of Use',
        ]);
    }
    public function about_kumbuka() {
        return $this->renderView('pages/about_kumbuka',[
            'appTitle' => setting('App.appName').' | Terms Of Use',
        ]);
    }
}
