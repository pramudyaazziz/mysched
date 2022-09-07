<?php

namespace App\Controllers\Activity;

use App\Controllers\BaseController;

class Activity extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'My Activity',
            'header' => 'My Activity'
        ];
        return view('activity/new-activity', $data);
    }
}
