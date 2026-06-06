<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\TopicModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome');
    }

    public function home(): string
    {
        $categoryModel = model(CategoryModel::class);

        $categories = $categoryModel->getCategoriesWithLastTopic();

        return view('home', [
            'categories' => $categories,
        ]);
    }

    public function search(): string
    {
        $topicModel = model(TopicModel::class);

        $keywords = $this->request->getGet('s');

        if ($keywords) {
            $results = $topicModel->search($keywords)->getTopicsWithCategory();
        } else {
            $results = [];
        }

        return view('search', ['results' => $results]);
    }
}
