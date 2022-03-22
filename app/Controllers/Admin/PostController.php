<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Post;
use CodeIgniter\API\ResponseTrait;

class PostController extends BaseController
{
    use ResponseTrait;
    
    function __construct()
    {
        $this->postModel = new Post();
    }
    public function index()
    {
        return view('dashboard/posts/index');
    }

    public function get()
    {
        // odd('hi');
        $draw = $this->request->getPost('draw');
        $search = $this->request->getPost('search');
        $length = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $orderBy = $this->request->getPost('order');

        $columns = array(
            '0' => 'id',
            '1' => 'title'
        );

        if ($search['value']) {
            $records = $this->postModel
                            ->like('name', $search['value'])
                            ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                            ->findAll($length, $start);

            $showingRecords = count($records);
            $totalRecords = $this->postModel
                                ->like('name', $search['value'])
                                ->countAll();
        } else {
            $records = $this->postModel
                            ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                            ->findAll($length, $start);

            $showingRecords = count($records);
            $totalRecords = $this->postModel->countAll();
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
        return view('dashboard/posts/create');
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
        return view('dashboard/posts/edit', compact('user'));
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
