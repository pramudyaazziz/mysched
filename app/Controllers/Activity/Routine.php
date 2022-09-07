<?php

namespace App\Controllers\Activity;

use App\Controllers\BaseController;
use App\Models\Routines;

class Routine extends BaseController
{
    function __construct()
    {
        $this->routine = new Routines;
    }
    public function index()
    {
        helper(['form']);
        $data = [
            'title' => 'My Routines',
            'header' => 'New Routine',
            'routines' => $this->routine->getRoutines(),
        ];
        return view('activity/routines', $data);
    }

    public function create()
    {
        helper(['form']);
        $rules = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'time' => 'required',
        ]);

        if ($rules) {
            $data = [
                'user_id' => session()->get('id'),
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'time' => $this->request->getPost('time'),
            ];
            $this->routine->insert($data);
            return redirect()->route('routine');
        } else {
            $data = [
                'validation' =>  $this->validator,
                'title' => 'My Routines',
                'header' => 'New Routine',
                'routines' => $this->routine->getRoutines(),
            ];
            return view('activity/routines', $data);
        }
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'My Routines',
            'header' => 'Edit Activity',
            'routines' => $this->routine->find($id)
        ];

        return view('activity/routines-edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'time' => $this->request->getPost('time'),
        ];
        $this->routine->update($id, $data);
        return redirect()->to('/routines/edit/' . $id)->with('success', 'Activity updated successfully');
    }

    public function delete($id = null)
    {
        $this->routine->delete($id);
        return redirect()->to('/routines');
    }
}
