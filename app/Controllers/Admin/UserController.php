<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $per_page = 10;
        $users = $this->userModel->where('type', DEFAULT_USER_TYPE)->paginate($per_page);
        $data = array(
            'users' => $users,
            'pager' => $this->userModel->pager,
            'total_records' => $this->userModel->where('type', DEFAULT_USER_TYPE)->countAll(),
            'per_page' => $per_page
        );

        return view('dashboard/users/index', $data);
    }

    public function create()
    {
        $data = array(
            'validation' => $this->validation
        );
        return view('dashboard/users/create', $data);
    }

    public function store()
    {
        $rules = array(
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|exact_length[10]|max_length[10]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        );

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
        $requestData['email_verified'] = 1;

        $this->userModel->insert($requestData);

        $data = array(
            'data' => $requestData,
            'email' => $this->request->getPost('email'),
            'subject' => 'Account created for ' . getenv('app.name'),
            'view' => 'emails/account_created.php',
        );

        $status = sendEmail($data);

        if ($status) {
            return redirect()->to('dashboard/users')->with("success", "User has been added, credentials are sent via email");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function show($id)
    {
        dd($id);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
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
        $result = $this->userModel->update($id, $requestData);

        if ($result) {
            return redirect()->to('dashboard/users')->with("success", "User details has been updated.");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function delete()
    {
        $this->userModel->delete($this->request->getPost('id'));
        return redirect()->back()->with("success", "User has been soft deleted successfully");
    }
}
