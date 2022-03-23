<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use CodeIgniter\API\ResponseTrait;

class CategoryController extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->category = new Category();
    }

    public function index()
    {
        return view('dashboard/categories/index');
    }

    public function get()
    {
        $draw = $this->request->getPost('draw');
        $search = $this->request->getPost('search');
        $length = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $orderBy = $this->request->getPost('order');

        $columns = array(
            '0' => 'id',
            '1' => 'name'
        );

        if ($search['value']) {
            $records = $this->category
                            ->like('name', $search['value'])
                            ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                            ->findAll($length, $start);

            $showingRecords = count($records);
            $totalRecords = $this->category
                                ->like('name', $search['value'])
                                ->countAllResults();
        } else {
            $records = $this->category
                            ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                            ->findAll($length, $start);

            $showingRecords = count($records);
            $totalRecords = $this->category->countAllResults();
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $showingRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $records,
            // 'error' => 'Error loading data',
        );

        return $this->respond($result);
    }

    public function create()
    {
        // return view('dashboard/categories/create');
    }

    public function store()
    {
        $rules = array(
            'name' => 'required|min_length[3]|is_unique[categories.name]',
        );

		if (!$this->validate($rules)) {
			$data = array(
				'errors' => $this->validator->getErrors()
			);
			return $this->failValidationErrors($data, 422, 'Validation failed');
		}

		$requestData = $this->request->getPost();
        unset($requestData['csrf_token']);

		$this->category->insert($requestData);

		$response = [
            'status' => 201,
            'error' => null,
            'messages' => "Category added successfully",
        ];

		return $this->respond($response);
    }

    public function show($id)
    {
        return $this->respond(array('data' => $this->category->find($id)));
    }

    public function edit($id)
    {
        return view('dashboard/categories/edit', compact('user'));
    }

    public function update($id)
    {
        $rules = array(
            'name' => 'required|min_length[3]|is_unique[categories.name,id,'.$id.']',
        );

		if (!$this->validate($rules)) {
			$data = array(
				'errors' => $this->validator->getErrors()
			);
			return $this->failValidationErrors($data, 422, 'Validation failed');
		}

		$requestData = $this->request->getPost();
        unset($requestData['csrf_token']);
        unset($requestData['_method']);

		$this->category->update($id, $requestData);

		$response = [
            'status' => 200,
            'error' => null,
            'messages' => "Category updated successfully",
        ];

		return $this->respond($response);
    }

    public function delete($id)
    {
        $this->category->delete($id);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Category has been Deleted",
        ];

        return $this->respondDeleted($response);
    }

    // return $this->respondDeleted($response);
    // return $this->failNotFound('No User Found with id ' . $id);
    // return $this->respondUpdated($response);
    // return $this->fail('There is not data to update');
    // return $this->respond($response);
}
