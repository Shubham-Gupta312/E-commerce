<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitMasterModel extends Model
{
  protected $table = 'sizes';
  protected $primaryKey = 's_id';
  protected $protectFields = [];

  public function updateStatus($id, $status)
  {
    return $this->set(['status' => $status])->where('s_id', $id)->update();
  }
  public function updateCategorization($id, $data)
  {
    return $this->update($id, $data);
  }
  public function deleteCategorization($id)
  {
    return $this->where('s_id', $id)->delete();
  }

}