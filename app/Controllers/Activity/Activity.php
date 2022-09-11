<?php

namespace App\Controllers\Activity;

use App\Controllers\BaseController;
use App\Models\Activitys;

class Activity extends BaseController
{
    function __construct()
    {
        $this->activity = new Activitys();
    }
    public function index()
    {
        helper(['form']);
        $data = [
            'title' => 'My Activity',
            'header' => 'New Activity',
            'today' => $this->activity->getToday(session('id')),
            'upcomming' => $this->activity->getUpcomming(session('id')),
            'previous' => $this->activity->getPrevious(session('id'))
        ];
        return view('activity/activity', $data);
    }

    public function create()
    {
        helper(['form']);
        $rules = $this->validate([
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Activity cannot be empty'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description cannot be empty'
                ]
            ],
            'date_activity' => [
                'rules' => 'required|future_date',
                'errors' => [
                    'required' => 'Date activity cannot be empty',
                    'future_date' => 'Date activity must be future from current date'
                ]
            ]
        ]);
        if (!$rules) {
            $data = [
                'title' => 'My Activity',
                'header' => 'New Activity',
                'today' => $this->activity->getToday(session('id')),
                'upcomming' => $this->activity->getUpcomming(session('id')),
                'previous' => $this->activity->getPrevious(session('id')),
                'validation' =>  $this->validator
            ];
            return view('activity/activity', $data);
        } else {
            $data = [
                'user_id' => session()->get('id'),
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'date_activity' => $this->request->getPost('date_activity'),
                'status' => '0'
            ];
            $this->activity->insert($data);
            return redirect()->route('activity')->with('success', 'Successfully added new activity');
        }
    }

    public function edit($id)
    {
        helper(['form']);
        $data = [
            'title' => 'Edit Activity',
            'header' => 'Edit Activity',
            'activity' => $this->activity->find($id)
        ];
        return view('activity/activity-edit', $data);
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date_activity' => $this->request->getPost('date_activity'),
        ];
        $this->activity->update($id, $data);
        return redirect()->to('/activity/edit/' . $id)->with('success', 'Activity updated successfully');
    }

    public function detail($id)
    {
        $activity = $this->activity->find($id);
        $date = date('Y-m-d h:i a', strtotime($activity['date_activity']));
        $status = $activity['status'] == 0 ? "In Progress" : "Completed";
        if ($activity['completed_date']) {
            $completed = date('Y-m-d h:i a', strtotime($activity['completed_date']));
            $content = '<ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Name Activity</strong>
                                <small class="text-right pl-5">
                                    <strong class="text-dark">' . $activity['title'] . '</strong>
                                </small>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Description</strong>
                                <small class="text-right pl-5">
                                    <strong class="text-dark">' . $activity['description'] . '</strong>
                                </small>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Date Activity</strong>
                                <small class="text-right pl-5">
                                    <strong class="text-dark">' . $date . '</strong>
                                </small>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Status</strong>
                                <span class="text-right pl-5">
                                    <span class="badge badge-success">' . $status . '</span>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Completed at</strong>
                                <small class="text-right pl-5">
                                    <strong class="text-dark">' . $completed . '</strong>
                                </small>
                            </li>
                        </ul>';
        } else {
            $content = '<ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <strong>Name Activity</strong>
                <small class="text-right pl-5">
                    <strong class="text-dark">' . $activity['title'] . '</strong>
                </small>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Description</strong>
                <small class="text-right pl-5">
                    <strong class="text-dark">' . $activity['description'] . '</strong>
                </small>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Date Activity</strong>
                <small class="text-right pl-5">
                    <strong class="text-dark">' . $date . '</strong>
                </small>
            </li>
        </ul>';
        }
        echo json_encode($content);
    }

    public function mark($id)
    {
        $data = [
            'status' => '1',
            'completed_date' => date('Y-m-d H:i a')
        ];
        $this->activity->update($id, $data);
        return redirect()->route('home')->with('success', 'Successfully mark as done activity');
    }

    public function delete($id)
    {
        $this->activity->delete($id);
        return redirect()->route('activity')->with('delete', 'Successfully delete activity');
    }

    public function prevDetail($id)
    {
        $activity = $this->activity->find($id);
        $date = date('Y-m-d h:i a', strtotime($activity['date_activity']));
        $status = $activity['status'] == 0 ? "Unfinished" : "Completed";
        $class = $status == "Completed" ? "badge-success" : "badge-danger";
        $completed = "";
        if ($activity['completed_date']) {
            $date_completed = date('Y-m-d h:i a', strtotime($activity['completed_date']));
            $completed = $date_completed;
        } else {
            $completed = "-";
        }
        $content = '<ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Name Activity</strong>
                            <small class="text-right pl-5">
                                <strong class="text-dark">' . $activity['title'] . '</strong>
                            </small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Description</strong>
                            <small class="text-right pl-5">
                                <strong class="text-dark">' . $activity['description'] . '</strong>
                            </small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Date Activity</strong>
                            <small class="text-right pl-5">
                                <strong class="text-dark">' . $date . '</strong>
                            </small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Status</strong>
                            <span class="text-right pl-5">
                                <span class="badge ' . $class . '">' . $status . '</span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Completed at</strong>
                            <small class="text-right pl-5">
                                <strong class="text-dark">' . $completed . '</strong>
                            </small>
                        </li>
                    </ul>';
        echo json_encode($content);
    }
}
