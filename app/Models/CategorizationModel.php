<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorizationModel extends Model
{
  protected $table = 'categorization';
  protected $primaryKey = 'id';
  protected $protectFields = [];

  public function updateStatus($id, $status)
  {
    return $this->set(['status' => $status])->where('id', $id)->update();
  }
  public function updateCategorization($id, $data)
  {
    return $this->update($id, $data);
  }
  public function deleteCategorization($id)
  {
    return $this->where('id', $id)->delete();
  }

}