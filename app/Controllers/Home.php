<?php

namespace App\Controllers;

use App\Models\Activitys;
use App\Models\Routines;

class Home extends BaseController
{
    function __construct()
    {
        $this->activity = new Activitys();
        $this->routine = new Routines();
    }
    public function index()
    {
        $data = [
            'title' => 'Home',
            'header' => 'To-do list',
            'today' => $this->activity->getToday(session('id')),
            'routines' => $this->routine->getRoutines(),
        ];
        return view('to-do/index', $data);
    }
}
