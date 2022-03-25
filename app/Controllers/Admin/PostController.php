<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Post;
use CodeIgniter\API\ResponseTrait;

class PostController extends BaseController
{
    use ResponseTrait;
    
    function __construct()
    {
        $this->postModel = new Post();
        $this->categoryModel = new Category();
    }
    public function index()
    {
        $categories = $this->categoryModel->findAll();
        return view('dashboard/posts/index', ['categories' => $categories]);
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
            '0' => 'posts.id',
            '1' => 'users.name',
            '2' => 'categories.name',
            '3' => 'posts.title',
            '4' => 'posts.sub_title',
            '5' => 'posts.slug',
            '6' => 'posts.post_content',
            '8' => 'posts.created_at',
            '9' => 'posts.updated_at'
        );

        if ($search['value']) {
            $records = $this->postModel
                            ->withDeleted()
                            ->withUserAndCategory()
                            ->withSearch($search['value'])
                            ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                            ->findAll($length, $start);

            $showingRecords = count($records);
            $totalRecords = $this->postModel
                                ->withDeleted()
                                ->withUserAndCategory()
                                ->withSearch($search['value'])
                                ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                                ->countAllResults();
        } else {
            $records = $this->postModel
                            ->withDeleted()
                            ->withUserAndCategory()
                            ->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir'])
                            ->findAll($length, $start);
            // odd($this->postModel->getLastQuery()->getQuery());

            $showingRecords = count($records);
            $totalRecords = $this->postModel->withDeleted()->countAllResults();
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

    public function delete()
    {
        // odd($this->request->getPost());
        $type = $this->request->getPost('type');
        $id = $this->request->getPost('id');

        $purge = false;
        $message = "Post has been soft deleted successfully";
        if ($type == 'permanent') {
            $purge = true;
            $message = "Post has been deleted permanently";
        }
        $result = $this->postModel->delete($id, $purge);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => $message
            ];
            return $this->respondDeleted($response);
        }

        $response = [
            'status' => 'error',
            'message' => 'Unable to delete post'
        ];

        return $this->respondDeleted($response);
    }

    public function undoDelete()
    {
        $id = $this->request->getPost('id');
        $post = $this->postModel->withdeleted()->find($id);

        $result = $this->postModel->update($id, array('deleted_at' => null));

        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Post restored successfully'
            ];
            return $this->respondDeleted($response);
        }

        $response = [
            'status' => 'error',
            'message' => 'Unable to restore post'
        ];

        return $this->respond($response);
    }
}
