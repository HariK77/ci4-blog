<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class ProfileController extends BaseController
{
    function __construct() {
        $this->userModel = new User();
    }

    public function index()
    {
        $data = array(
            'validation' => $this->validation,
            'user' => $this->userModel->find(session('id'))
        );
        return view('app/profile/index', $data);
    }

    public function saveProfile()
    {
        $id = session('id');
        $rules = array(
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'phone' => 'required|exact_length[10]|max_length[10]',
        );

        if (!$this->validate($rules)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        }

        $requestData = $this->request->getPost();
        $result = $this->userModel->update($id, $requestData);

        if ($result) {
            session()->set(array(
                'name' => $requestData['name'],
                'email' => $requestData['email']
            ));
            return redirect()->back()->with("success", "Your details has been updated.");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function changePasswordView()
    {
        return view('app/profile/change_password', array('validation' => $this->validation));
    }

    public function changePassword()
    {
        $id = session('id');
        $rules = array(
            'current_password' => 'required|min_length[6]|check_current_password[current_password]',
            'password' => 'required|min_length[6]|same_current_password[password]',
            'confirm_password' => 'required|min_length[6]|matches[password]',
        );
        $messages = array(
            'current_password' => array(
                'check_current_password' => 'Please enter correct current password.'
            ),
            'confirm_password' => array(
                'matches' => 'The confirm password field does not match the password field.'
            ),
            'password' => array(
                'same_current_password' => 'New password cannot be same as current password.'
            ),
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
            return redirect()->back()->with("success", "Password changed successfully");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function posts()
    {
        return view('app/posts');
    }
}
