<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorizationModel extends Model
{
  protected $table = 'categorization';
  protected $primaryKey = 'id';
  protected $protectFields = [];

//   public function getStatus($id)
//   {
//     $query = $this->table('category');
//     $query->where('id', $id);
//     $result = $query->get()->getRow();
//     if ($result) {
//       $status = $result->status;
//       return $status;
//     } else {
//       return null;
//     }
//   }

//   public function updateStatus($id, $ns)
//   {
//     return $this->set(['status' => $ns])->where('id', $id)->update();
//   }


  public function updateCategorization($id, $data)
  {
    return $this->update($id, $data);
  }
  public function deleteCategorization($id)
  {
    return $this->where('id', $id)->delete();
  }

}