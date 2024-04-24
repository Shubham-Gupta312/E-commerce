<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'id';
  protected $protectFields = [];

  public function updateStatus($id, $status)
  {
    return $this->set(['status' => $status])->where('id', $id)->update();
  }
  public function deleteProductData($id)
  {
    return $this->where('id', $id)->delete();
  }
}