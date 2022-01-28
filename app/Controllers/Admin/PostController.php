<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        return view('dashboard/posts/index');
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
