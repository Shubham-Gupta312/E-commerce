<?php

namespace App\Models;

use CodeIgniter\Model;

class Sub_SCatModel extends Model
{
  protected $table = 'subsubcategory';
  protected $primaryKey = 'id';
  protected $protectFields = [];

//   public function updateStatus($id, $st)
//   {
//     return $this->set(['status' => $st])->where('id', $id)->update();
//   }
//   public function updateSubCategory($id, $data)
//   {
//     return $this->update($id, $data);
//   }
//   public function deleteSubCategory($id)
//   {
//     return $this->where('id', $id)->delete();
//   }

}