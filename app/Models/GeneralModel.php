<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    protected $db;
	
    public function __construct() {
        $this->db = db_connect();
    }

    // function getRow($table,$where,$columns="*"){
	// 	$where	 = esc($where);
	// 	$builder = $this->db->table($table);
	// 	$builder->select($columns);
	// 	$builder->where($where);
		
	// 	$query   = $builder->get();
		
	// 	return $query->getRow();
	// }

	// function getData($table, $where, $columns){}
}