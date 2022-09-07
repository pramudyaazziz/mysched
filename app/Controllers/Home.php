<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'header' => 'To-do list'
        ];
        return view('to-do/index', $data);
    }
}
