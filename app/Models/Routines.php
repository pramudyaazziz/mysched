<?php

namespace App\Models;

use CodeIgniter\Model;

class Routines extends Model
{
    protected $table            = 'routines';
    protected $primaryKey       = 'routine_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'user_id',
        'title',
        'description',
        'time'
    ];

    function getRoutines()
    {
        $id = session()->get('id');
        $builder = $this->db->table('routines')
            ->join('users', 'users.user_id = routines.user_id')
            ->where('routines.user_id', $id)
            ->get();
        return $builder->getResult();
    }
}
