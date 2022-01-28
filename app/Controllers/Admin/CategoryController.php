<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use CodeIgniter\API\ResponseTrait;

class CategoryController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('dashboard/categories/index');
    }

    public function get()
    {
        $model = new Category();

        $result = array(
            'draw' => '',
            'recordsTotal' => 5,
            'recordsFiltered' => 5,
            'data' => $model->findAll(),
            // 'error' => 'Error loading data'
        );

        echo json_encode($result);
    }

    public function create()
    {
        return view('dashboard/categories/create');
    }

    public function save()
    {
        dd($this->request->getPost());
    }

    public function show($id)
    {
        dd($id);
    }

    public function edit($id)
    {
        return view('dashboard/categories/edit', compact('user'));
    }

    public function update($id)
    {
        dd($this->request->getPost());
    }

    public function delete($id)
    {
        dd($id);
    }
}
