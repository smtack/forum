<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TopicModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = model(UserModel::class);
    }

    public function index(int $id)
    {
        if (!$user = $this->userModel->find($id)) {
            throw new PageNotFoundException('User not found');
        }

        $topicModel = model(TopicModel::class);

        $users_topics = $topicModel->where('topic_user', $user['user_id'])->getTopicsWithCategory();

        return view('profile', [
            'user' => $user,
            'users_topics' => $users_topics,
        ]);
    }

    public function update()
    {
        $user = $this->userModel->find(session()->get('user_id'));

        return view('update-profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $data = [
            'user_email' => $this->request->getPost('user_email'),
        ];

        if (!$this->userModel->where('user_id', session()->get('user_id'))->set($data)->update()) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->back()->with('success', 'Profile Updated');
    }

    public function updateAvatar()
    {
        $file = $this->request->getFile('avatar');

        if ($file->isValid() && !$file->hasMoved()) {
            $file_name = $file->getRandomName();

            $file->move(WRITEPATH . 'uploads/avatars', $file_name);

            if ($this->userModel->where('user_id', session()->get('user_id'))->set('user_avatar', $file_name)->update()) {
                return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
            }
        } else {
            return redirect()->back()->with('error', 'Unable to upload avatar. Try again later.');
        }

        return redirect()->back()->with('success', 'Avatar Updated');
    }

    public function updatePassword()
    {
        $new_password = $this->request->getPost('new_password');

        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        if (!$this->userModel->where('user_id', session()->get('user_id'))->set('user_password', $hashed_password)->update()) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->back()->with('success', 'Password Updated');
    }

    public function deleteProfile()
    {
        $this->userModel->delete(session()->get('user_id'));

        session()->regenerate(true);

        session()->destroy();

        return redirect()->to('/')->with('success', 'Your profile has been deleted');
    }
}
