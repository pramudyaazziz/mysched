<?php

namespace App\Models;

use CodeIgniter\Model;

class Note extends Model
{
    protected $table            = 'notes';
    protected $primaryKey       = 'note_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'user_id',
        'note_title',
        'note_content',
    ];

    function getNotes()
    {
        $id = session()->get('id');
        $builder = $this->db->table('notes');
        $builder->select('note_id, note_title, note_content');
        $builder->join('users', 'users.user_id = notes.user_id');
        $builder->where('notes.user_id', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
