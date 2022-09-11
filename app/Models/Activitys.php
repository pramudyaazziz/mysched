<?php

namespace App\Models;

use CodeIgniter\Model;

class Activitys extends Model
{
    protected $table            = 'activitys';
    protected $primaryKey       = 'activity_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'user_id',
        'title',
        'description',
        'date_activity',
        'status',
        'completed_date'
    ];

    function getToday($id)
    {
        $date = date('Y-m-d');
        return $this->db->table('activitys')
            ->join('users', 'users.user_id = activitys.user_id')
            ->where('activitys.user_id', $id)
            ->where('DATE(date_activity) =', $date)
            ->orderBy('date_activity', 'ASC')
            ->get()
            ->getResult();
    }

    function getUpcomming($id)
    {
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));
        return $this->db->table('activitys')
            ->join('users', 'users.user_id = activitys.user_id')
            ->where('activitys.user_id', $id)
            ->where('DATE(date_activity) >=', $tomorrow)
            ->orderBy('date_activity', 'ASC')
            ->get()
            ->getResult();
    }

    function getPrevious($id)
    {
        $yesterday = date('Y-m-d', strtotime('yesterday'));
        $days_ago = date('Y-m-d', strtotime('-2 days', strtotime('yesterday')));
        return $this->db->table('activitys')
            ->join('users', 'users.user_id = activitys.user_id')
            ->where('activitys.user_id', $id)
            ->where('DATE(date_activity) <=', $yesterday)
            ->where('DATE(date_activity) >=', $days_ago)
            ->orderBy('date_activity', 'ASC')
            ->get()
            ->getResult();
    }
}
