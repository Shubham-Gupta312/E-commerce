<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function updateStatus($id, $ns)
    {
        return $this->set(['status' => $ns])->where('id', $id)->update();
    }


    public function updateBrand($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteBrand($id)
    {
        return $this->where('id', $id)->delete();
    }

}