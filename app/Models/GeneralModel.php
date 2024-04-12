<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    // function fetchCatName($table, $catName)
    // {
    //     $this->table
    // }
}