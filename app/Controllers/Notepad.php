<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Note;

class Notepad extends BaseController
{

    function __construct()
    {
        $this->note = new Note();
    }

    public function index()
    {
        $data = [
            'title' => 'Notepad',
            'notes' => $this->note->getNotes()
        ];
        return view('notepad/index', $data);
    }

    public function create()
    {
        $data = [
            'user_id' => session()->get('id'),
            'note_title' => $this->request->getPost('note_title'),
            'note_content' => $this->request->getPost('note_content')
        ];

        $this->note->insert($data);
        return redirect()->route('notepad')->with('success', 'Note saved successfully');
    }

    public function detail($id = null)
    {
        $data = [
            'title' => 'Notepad',
            'note'  => $this->note->find($id)
        ];
        return view('notepad/detail', $data);
    }

    public function update($id = null)
    {
        $data = [
            'note_title' => $this->request->getPost('note_title'),
            'note_content' => $this->request->getPost('note_content')
        ];
        $this->note->update($id, $data);
        return redirect()->to('/notepad/detail/' . $id)->with('success', 'Note updated successfully');
    }

    public function delete($id = null)
    {
        $this->note->delete($id);
        return redirect()->route('notepad');
    }
}
