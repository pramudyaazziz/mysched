<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Activity extends BaseController
{
    public function newActivity()
    {
        $data = [
            'title' => 'New Activity'
        ];
        return view('activity/new-activity', $data);
    }

    public function routine()
    {
        $data = [
            'title' => 'My Routines'
        ];
        return view('activity/routines', $data);
    }
}
