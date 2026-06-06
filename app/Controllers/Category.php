<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\TopicModel;
use CodeIgniter\HTTP\ResponseInterface;

class Category extends BaseController
{
    public function index($id = null)
    {
        $categoryModel = model(CategoryModel::class);
        $topicModel = model(TopicModel::class);

        if (!$category = $categoryModel->where('category_id', $id)->first()) {
            throw new PageNotFoundException('Could not find category');
        }

        $page_title = $category['category_name'];

        $topics = $topicModel->where('topic_category', $category['category_id'])->findAll();

        return view('category/category', [
            'category' => $category,
            'page_title' => $page_title,
            'topics' => $topics,
        ]);
    }
}
