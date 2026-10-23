<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class UserController extends BaseController
{
    protected $userId;

    protected $userAvatar;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $view = service('renderer');

        // Use Default avatart image in User Config file is avatar's not set
        $this->userId = auth()->user()->id ?? 0;
        $this->userAvatar ??= $this->userConfig->defaultAvatar;
        $view->setVar('userAvatar', $this->userAvatar);


    }
}
