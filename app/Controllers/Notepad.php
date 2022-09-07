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
            'header' => 'Notepad'
        ];
        return view('notepad/index', $data);
    }

    public function getNotes()
    {
        $data['notes'] = $this->note->getNotes();

        if (count($data['notes']) == 0) {
            $content = '<h4 class="text-center mt-3">You dont have a notes</h4>';
        } else {
            $i = 0;
            $content = '<thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th style="width: 250px">Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>';

            foreach ($data['notes'] as $key => $value) {
                $i++;
                $content .= '<tr>
                            <td>' . $i . '</td>
							<td>' . $value->note_title . '</td>
                            <td>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <button onclick="detail_note(' . $value->note_id . ')" class="btn btn-success btn-block"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                    <div class="col-xl-6">
                                        <button onclick="delete_note(' . $value->note_id . ')" class="btn btn-danger btn-block"><i class="fa-solid fa-close"></i></button>
                                    </div>
                                </div>
                            </td>
						</tr>';
            }
        }
        $data_json = array(
            'content' => $content,
        );

        echo json_encode($data_json);
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
        $note = $this->note->find($id);
        $content = '<div class="card">
                        <div class="card-header note">
                            <h5 class="notes-header my-auto">Note Detail</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="" class=""><strong>' . $note['note_title'] . '</strong></label>
                            </div>
                            <hr>
                            <div>
                             ' . $note['note_content'] . '
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="' . site_url('/notepad/edit/' . $note['note_id']) . '" class="btn btn-warning btn-block"><i class="fas fa-pencil mr-2"></i>Edit</a>
                        </div>
                    </div>';
        echo json_encode($content);
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Notepad',
            'header' => 'Notepad',
            'note'  => $this->note->find($id)
        ];
        return view('notepad/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'note_title' => $this->request->getPost('note_title'),
            'note_content' => $this->request->getPost('note_content')
        ];
        $this->note->update($id, $data);
        return redirect()->to('/notepad/edit/' . $id)->with('success', 'Note updated successfully');
    }

    public function delete($id = null)
    {
        $this->note->delete($id);
        $data = [
            'result' => "Note deleted successfully"
        ];

        echo json_encode($data);
    }
}
