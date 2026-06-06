<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Topic extends ResourcePresenter
{
    protected $modelName = 'App\Models\TopicModel';

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
        $topic = $this->model->find($id);

        $postModel = model(PostModel::class);

        $posts = $postModel->where('post_topic', $id)->getPostsWithUser();

        return view('topic/show', [
            'topic' => $topic,
            'posts' => $posts
        ]);
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        if (!session()->has('loggedIn')) {
            return redirect()->to('/login');
        }

        $categoryModel = model(CategoryModel::class);

        $categories = $categoryModel->findAll();

        return view('topic/new', ['categories' => $categories]);
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
        
        $postModel = model(PostModel::class);

        $db = \Config\Database::connect();

        $db->transStart();

        $topicData = [
            'topic_title' => $this->request->getPost('topic_title'),
            'topic_category' => $this->request->getPost('topic_category'),
            'topic_user' => session()->get('user_id'),
        ];

        $this->model->insert($topicData);

        $newTopicId = $this->model->getInsertID();

        $postData = [
            'post_text' => $this->request->getPost('post_text'),
            'post_topic' => $newTopicId,
            'post_user' => session()->get('user_id'),
        ];

        $postModel->insert($postData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Failed to create topic');
        }

        return redirect()->to("/topic/show/$newTopicId");
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
        //
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
        //
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
        //
    }
}
