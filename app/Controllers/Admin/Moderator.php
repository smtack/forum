<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Moderator extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = model(UserModel::class);
    }

    public function makeModerator(int $user_id)
    {
        if (!$this->userModel->where('user_id', $user_id)->set('user_level', 1)->update()) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('admin/users')->with('success', 'User updated');
    }

    public function removeModerator(int $user_id)
    {
        if (!$this->userModel->where('user_id', $user_id)->set('user_level', 2)->update()) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('admin/users')->with('success', 'User updated');
    }
}
