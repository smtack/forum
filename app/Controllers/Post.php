<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Post extends ResourcePresenter
{
    protected $modelName = 'App\Models\PostModel';

    public function __construct()
    {
        helper('form');
    }
    
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Present a view to present a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        if (!session()->has('loggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'post_text' => $this->request->getPost('post_text'),
            'post_topic' => $this->request->getPost('post_topic'),
            'post_user' => session()->get('user_id'),
        ];

        if (!$this->model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->back();
    }

    /**
     * Present a view to edit the properties of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        if (!session()->has('loggedIn')) {
            return redirect()->to('/login');
        }

        if (!$post = $this->model->find($id)) {
            throw new PageNotFoundException('Could not find post');
        }

        return view('post/edit', ['post' => $post]);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        if (!session()->has('loggedIn')) {
            return redirect()->to('/login');
        }

        $post_topic = $this->model->where('post_id', $id)->get()->getRow()->post_topic;

        $data = [
            'post_text' => $this->request->getPost('post_text'),
        ];

        if (!$this->model->where('post_id', $id)->set($data)->update()) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('/topic/show/' . $post_topic)->with('success', 'Post updated');
    }

    /**
     * Present a view to confirm the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if (!session()->has('loggedIn')) {
            return redirect()->to('/login');
        }

        $post_topic = $this->model->where('post_id', $id)->get()->getRow()->post_topic;

        $this->model->delete($id);

        return redirect()->to('/topic/show/' . $post_topic)->with('success', 'Post deleted');
    }
}
