<?php

namespace App\Controllers\Admin;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Category extends ResourcePresenter
{
    protected $modelName = 'App\Models\CategoryModel';

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
        $categories = $this->model->orderBy('category_id', 'DESC')->findAll();

        return view('admin/category/index', ['categories' => $categories]);
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
        // $category = $this->model->find($id);

        // return view('category/category', ['category' => $category]);
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('admin/category/new');
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'category_description' => $this->request->getPost('category_description'),
        ];

        if (!$this->model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('admin/category')->with('success', 'Category created');
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
        if (!$category = $this->model->find($id)) {
            throw new PageNotFoundException('Could not find category');
        }

        return view('admin/category/edit', ['category' => $category]);
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
        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'category_description' => $this->request->getPost('category_description'),
        ];

        if (!$this->model->where('category_id', $id)->set($data)->update()) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('admin/category')->with('success', 'Category updated');
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
        $this->model->delete($id);

        return redirect()->to('admin/category')->with('success', 'Category deleted');
    }
}
