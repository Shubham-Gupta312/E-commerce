<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
  protected $table = 'category';
  protected $primaryKey = 'id';
  protected $protectFields = [];

  public function updateStatus($id, $ns)
  {
    return $this->set(['status' => $ns])->where('id', $id)->update();
  }


  public function updateCategory($id, $data)
  {
    return $this->update($id, $data);
  }
  public function deleteCategory($id)
  {
    return $this->where('id', $id)->delete();
  }

}