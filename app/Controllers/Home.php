<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'To-do List'
        ];
        return view('to-do/index', $data);
    }
}
