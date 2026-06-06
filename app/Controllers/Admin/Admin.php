<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index(): string
    {
        return view('admin/welcome');
    }

    public function home(): string
    {
        return view('admin/home');
    }
}
