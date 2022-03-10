<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Post;
use CodeIgniter\Files\File;

class UserPostController extends BaseController
{
    function __construct()
    {
        $this->postModel = new Post();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $per_page = 10;
        $search = $this->request->getVar('search');
        $deleted = $this->request->getVar('deleted');
        $order_by = $this->request->getVar('order_by') ? $this->request->getVar('order_by') : 'created_at';
        $email_verified = $this->request->getVar('email_verified');

        $posts = $this->postModel
                        ->withDeleted()
                        // ->emailVerified($email_verified)
                        // ->deleted($deleted)
                        // ->search($search)
                        // ->orderBy($order_by, 'ASC')
                        ->paginate($per_page);

        $total_records = $this->postModel
                                ->withDeleted()
                                // ->emailVerified($email_verified)
                                // ->deleted($deleted)
                                // ->search($search)
                                ->countAllResults();

        $data = array(
            'posts' => $posts,
            'pager' => $this->postModel->pager,
            'showing_records' => count($posts),
            'total_records' => $total_records,
            // 'active_types' => $this->postModel->getUserActiveTypes(),
            // 'status_types' => $this->postModel->getUserStatusTypes(),
            // 'order_by_types' => $this->postModel->getOrderByTypes(),
        );

        return view('app/posts/index', $data);
    }

    public function create()
    {
        $data = array(
            'validation' => $this->validation,
            'categories' => $this->categoryModel->findAll()
        );
        return view('app/posts/create', $data);
    }

    public function store()
    {
        $rules = array(
            'id_category' => 'required',
            'title' => 'required|min_length[20]',
            'mini_title' => 'required|min_length[40]',
            'header_image' => 'uploaded[header_image]|max_dims[header_image,1920,1080],mime_in[header_image,image/png,image/jpg],ext_in[header_image,png,jpg,gif],is_image[header_image]',
            'post_content' => 'required|min_length[200]',
        );

                // '|max_size[userfile,100]'

        $messages = array(
            'id_category' => array(
                'required' => 'Please select a category.'
            ),
            'mini_title' => array(
                'required' => 'Mini title field is required.',
                'min_length' => 'The mini title field must be at least 40 characters in length.'
            ),
            'header_image' => array(
                'uploaded' => 'Please upload valid image file.',
            ),
            'post_content' => array(
                'required' => 'Please add some post content.',
                'min_length' => 'The post content field must be at least 200 characters in length.'
            )
        );

        if (!$this->validate($rules, $messages)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        }

        $img = $this->request->getFile('header_image');
        $newName = $img->getRandomName();
        $img->move('uploads', $newName);

        $requestData = $this->request->getPost();
        $requestData['header_image'] = 'uploads/'.$newName;
        $requestData['mini_title'] = $this->request->getPost('mini_title');
        $requestData['slug'] = slug($this->request->getPost('mini_title'));
        $requestData['id_user'] = session('id');

        $result = $this->postModel->insert($requestData);

        if ($result) {
            return redirect()->to('posts')->with("success", "Post has been added successfully");
        }
        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function show($id)
    {
        dd($id);
    }

    public function edit($id)
    {
        $user = $this->postModel->find($id);
        $validation = $this->validation;
        return view('dashboard/users/edit', compact('user', 'validation'));
    }

    public function update($id)
    {
        $rules = array(
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'phone' => 'required|exact_length[10]|max_length[10]',
        );

        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[password]';
        }

        $messages = array(
            'confirm_password' => array(
                'matches' => 'The confirm password field does not match the password field.'
            )
        );

        if (!$this->validate($rules, $messages)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        }

        $requestData = $this->request->getPost();
        $result = $this->postModel->update($id, $requestData);

        if ($result) {
            return redirect()->to('dashboard/users')->with("success", "User details has been updated.");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function delete()
    {

        $type = $this->request->getPost('type');
        $id = $this->request->getPost('id');

        $purge = false;
        $message = "User has been soft deleted successfully";
        if ($type == 'permanent') {
            $purge = true;
            $message = "User has been deleted permanently";
        }
        $this->postModel->delete($id, $purge);
        return redirect()->back()->with("success", $message);
    }

    public function saveImage()
    {
        dd('hi');
    }

}
