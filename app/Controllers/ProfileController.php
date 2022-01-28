<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        return view('app/profile/index');
    }

    public function profile()
    {
        
    }

    public function posts()
    {
        return view('app/posts');
    }
}
