<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserPostController extends BaseController
{
    public function index()
    {
        return view('app/posts/index');
    }

    public function create()
    {
        return view('app/posts/create');
    }

    public function posts()
    {
        return view('app/posts');
    }
}
