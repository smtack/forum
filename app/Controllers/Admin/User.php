<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
        $userModel = model(UserModel::class);

        $users = $userModel->findAll();

        return view('admin/users', ['users' => $users]);
    }
}
