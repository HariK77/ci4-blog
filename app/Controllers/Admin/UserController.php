<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('dashboard/users/index');
    }

    public function create()
    {
        return view('dashboard/users/create');
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
        return view('dashboard/users/edit', compact('user'));
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
