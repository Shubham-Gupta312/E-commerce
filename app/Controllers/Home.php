<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        $this->gM = Model("GeneralModel");
    }
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }
    public function categories()
    {
        if ($this->request->getMethod() == 'get') {
            return view('admin/categories');
        } elseif ($this->request->getMethod() == 'post') {
            $catName = $this->request->getPost('catname');
            $catImg = $this->request->getFile('image');

            if ($catImg->isValid() && !$catImg->hasMoved()) {
                $newImageName = $catImg->getRandomName();
                $catImg->move("../public/assets/uploads/", $newImageName);
                $data = [
                    'cat_name' => esc($catName),
                    'cat_image' => esc($newImageName)
                ];

                $catModel = new \App\Models\CategoryModel();
                try {
                    $query = $catModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'success', 'message' => 'Category Added Successfully!'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Something went wrong!'];
                    }
                    return $this->response->setJSON($response);
                } catch (\Exception $e) {
                    $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                    return $this->response->setStatusCode(500)->setJSON($response);
                }
            }
        }
    }

    // public function fetchCategories()
    // {
    //     try {
    //         $fetchCat = new \App\Models\CategoryModel();

    //         $draw = $_GET['draw'];
    //         $start = $_GET['start'];
    //         $length = $_GET['length'];
    //         $searchValue = $_GET['search']['value'];

    //         $fetchCat->orderBy('id', 'DESC');

    //         if (!empty($searchValue)) {
    //             $fetchCat->groupStart();
    //             $fetchCat->orLike('cat_name', $searchValue);
    //             $fetchCat->groupEnd();
    //         }

    //         $data['cat'] = $fetchCat->findAll($length, $start);
    //         $totalRecords = $fetchCat->countAll();
    //         $totalFilterRecords = (!empty($searchValue)) ? $fetchCat->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
    //         $associativeArray = [];

    //         foreach ($data['cat'] as $row) {
    //             $status = $row['status'];

    //             if ($status == 0) {
    //                 $buttonCSSClass = 'btn-outline-danger';
    //                 $buttonName = 'In-Active';
    //             } elseif ($status == 1) {
    //                 $buttonCSSClass = 'btn-outline-success';
    //                 $buttonName = 'Active';
    //             }
    //             $associativeArray[] = array(
    //                 0 => $row['id'],
    //                 1 => ucfirst($row['cat_name']),
    //                 2 => '<img src="../assets/uploads/' . $row['cat_image'] . '" height="100px" width="100px">',
    //                 3 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
    //                 4 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
    //                 <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
    //             );
    //         }


    //         if (empty($data['cat'])) {
    //             $output = array(
    //                 'draw' => intval($draw),
    //                 'recordsTotal' => 0,
    //                 'recordsFiltered' => 0,
    //                 'data' => []
    //             );
    //         } else {
    //             $output = array(
    //                 'draw' => intval($draw),
    //                 'recordsTotal' => $totalRecords,
    //                 'recordsFiltered' => $totalFilterRecords,
    //                 'data' => $associativeArray
    //             );
    //         }
    //         return $this->response->setJSON($output);
    //     } catch (\Exception $e) {
    //         // Log the caught exception
    //         log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
    //         // Return an error response
    //         return $this->response->setJSON(['error' => 'Internal Server Error']);
    //     }
    // }

    public function fetchCategories()
    {
        try {
            $fetchCat = new \App\Models\CategoryModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchCat->orderBy($orderColumnName, $orderDir);

            if (!empty($searchValue)) {
                $fetchCat->groupStart();
                $fetchCat->orLike('cat_name', $searchValue);
                $fetchCat->groupEnd();
            }

            $data['cat'] = $fetchCat->findAll($length, $start);
            $totalRecords = $fetchCat->countAll();
            $totalFilterRecords = (!empty($searchValue)) ? $fetchCat->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
            $associativeArray = [];

            foreach ($data['cat'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => ucfirst($row['cat_name']),
                    2 => '<img src="../assets/uploads/' . $row['cat_image'] . '" height="100px" width="100px">',
                    3 => '<button class="btn ' . $buttonCSSClass . '" id="statusBtn" data-id="' . $status . '" data-status="active">' . $buttonName . '</button>',
                    4 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['cat'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalFilterRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }
    public function CatStatus()
    {
        try {
            $md = new \App\Models\CategoryModel();
            $id = $this->request->getPost('id');
            $st = $this->request->getPost('status');
            $dId = $this->request->getPost('dataId');

            if ($dId == 1 && $st == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }

            $result = $md->updateStatus(esc($id), $status);

            if ($result) {
                return $this->response->setJSON(['status' => $status]);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update status']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in toggle_status: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }


    public function editCategory()
    {
        $id = $this->request->getPost('id');

        $editCat = new \App\Models\CategoryModel();
        $ed = $editCat->find(esc($id));

        if ($ed) {
            $response = ['status' => 'true', 'message' => $ed];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateCategory()
    {
        $updateCat = new \App\Models\CategoryModel();
        $id = $this->request->getPost('id');
        $cn = $this->request->getPost('editcat');
        $ci = $this->request->getFile('editimage');

        $data = [
            'cat_name' => esc($cn),
        ];

        if ($ci && $ci->isValid() && !$ci->hasMoved()) {
            $newName = $ci->getRandomName();
            $uploadPath = '../public/assets/uploads';
            $ci->move($uploadPath, $newName);

            $data['cat_image'] = $newName;
        } else {
            unset($data['cat_image']);
        }

        $query = $updateCat->updateCategory(esc($id), $data);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Data Updated Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Updated!'];
        }
        return $this->response->setJSON($response);
    }

    public function deleteCategory()
    {
        $id = $this->request->getPost('id');

        $dct = new \App\Models\CategoryModel();
        $query = $dct->deleteCategory($id);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Category Deleted Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }

    public function subCategory()
    {
        if ($this->request->getMethod() == 'get') {
            $ctm = new \App\Models\CategoryModel();
            $data['category'] = $ctm->where('status', 1)->findAll();
            return view('admin/subcategory', $data);
        } else if ($this->request->getMethod() == 'post') {
            $ct = $this->request->getPost('cat');
            $sct = $this->request->getPost('sub_cat');

            $data = [
                'cat_name_id' => esc($ct),
                'sub_cat' => esc($sct),
            ];

            $smdl = new \App\Models\SubCatModel();
            $q = $smdl->insert($data);
            if ($q) {
                $response = ['status' => 'success', 'message' => 'Sub-Category Added Successfully!'];
            } else {
                $response = ['status' => 'error', 'message' => 'Something went wrong!'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function fetchSubCategory()
    {
        try {
            $fetchSubCat = new \App\Models\SubCatModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchSubCat->select('sub_category.*, category.cat_name');
            $fetchSubCat->join('category', 'category.id = sub_category.cat_name_id');

            $fetchSubCat->orderBy($orderColumnName, $orderDir);

            if (!empty($searchValue)) {
                // $fetchSubCat->groupStart();
                $fetchSubCat->Like('sub_cat', $searchValue);
                $fetchSubCat->orLike('cat_name', $searchValue);
                // $fetchSubCat->groupEnd();
            }

            $data['subcat'] = $fetchSubCat->findAll($length, $start);
            $totalRecords = $fetchSubCat->countAll();
            // $totalFilterRecords = (!empty($searchValue)) ? $fetchSubCat->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
            $totalFilterRecords = $totalRecords;
            $associativeArray = [];

            foreach ($data['subcat'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => ucfirst($row['cat_name']),
                    2 => ucfirst($row['sub_cat']),
                    3 => '<button class="btn ' . $buttonCSSClass . '" id="toggle-status" data-id="' . $status . '" data-status="active">' . $buttonName . '</button>',
                    4 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['subcat'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalFilterRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function unitMaster()
    {
        if ($this->request->getMethod() == 'get') {
            return view('admin/unitMaster');
        } elseif ($this->request->getMethod() == 'post') {
            $un = $this->request->getPost('unit');

            $data = [
                'unit_name' => esc($un),
            ];

            // print_r($data);
            $untModel = new \App\Models\UnitMasterModel();
            try {
                $query = $untModel->insert($data);

                if ($query) {
                    $response = ['status' => 'success', 'message' => 'Categorization Added Successfully!'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($response);
            }
        }
    }

    public function fetchUnitMaster()
    {
        try {
            $fetchUnit = new \App\Models\UnitMasterModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchUnit->orderBy($orderColumnName, $orderDir);

            if (!empty($searchValue)) {
                // $fetchUnit->groupStart();
                $fetchUnit->orLike('unit_name', $searchValue);
                // $fetchUnit->groupEnd();
            }

            $data['unit'] = $fetchUnit->findAll($length, $start);
            $totalRecords = $fetchUnit->countAll();
            $totalFilterRecords = (!empty($searchValue)) ? $fetchUnit->where('unit_name', $searchValue)->countAllResults() : $totalRecords;
            // $totalFilterRecords = $totalRecords;
            $associativeArray = [];

            foreach ($data['unit'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => ucfirst($row['unit_name']),
                    2 => '<button class="btn ' . $buttonCSSClass . '" id="toggle-status" data-id="' . $status . '" data-status="active">' . $buttonName . '</button>',
                    3 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['unit'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalFilterRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) { 
            log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function toggle_status()
    {
        try {
            $md = new \App\Models\UnitMasterModel();
            $id = $this->request->getPost('id');
            $st = $this->request->getPost('status');
            $dId = $this->request->getPost('dataId');

            if ($dId == 1 && $st == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }

            $result = $md->updateStatus(esc($id), $status);

            if ($result) {
                return $this->response->setJSON(['status' => $status]);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update status']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in toggle_status: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }




    public function editUnitMaster()
    {
        $id = $this->request->getPost('id');

        $editCat = new \App\Models\UnitMasterModel();
        $ed = $editCat->find($id);

        if ($ed) {
            $response = ['status' => 'true', 'message' => $ed];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateUnitMaster()
    {
        $updateCat = new \App\Models\UnitMasterModel();
        $id = $this->request->getPost('id');
        $un = $this->request->getPost('edit_unit_name');

        $data = [
            'unit_name' => esc($un),
        ];
        // print_r($data);
        $query = $updateCat->updateCategorization(esc($id), $data);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Data Updated Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Updated!'];
        }
        return $this->response->setJSON($response);
    }

    public function deleteUnitMaster()
    {
        $id = $this->request->getPost('id');

        $dct = new \App\Models\UnitMasterModel();
        $query = $dct->deleteCategorization($id);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Category Deleted Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }

    public function Products()
    {
        if ($this->request->getMethod() == 'get') {
            $ct = new \App\Models\CategoryModel();
            $data['category'] = $ct->where('status', 1)->findAll();
            return view('admin/products', $data);
        } elseif ($this->request->getMethod() == 'post') {
            $cn = $this->request->getPost('cat_name');
            $pn = $this->request->getPost('product_name');
            $cvi = $this->request->getPost('cat_var');
            $qt = $this->request->getPost('qty');
            $pc = $this->request->getPost('product_code');
            $pi = $this->request->getFile('product_image');
            $igst = $this->request->getPost('igst');
            $cgst = $this->request->getPost('cgst');
            $sgst = $this->request->getPost('sgst');
            $pp = $this->request->getPost('purchase_prc');
            $mrp = $this->request->getPost('mrp');
            $sp = $this->request->getPost('sp');
            $ps = $this->request->getPost('product_stock');
            $ds = $this->request->getPost('desc');

            if ($pi->isValid() && !$pi->hasMoved()) {
                $newImageName = $pi->getRandomName();
                $pi->move("../public/assets/uploads/product/", $newImageName);

                $data = [
                    'cat_name_id' => esc($cn),
                    'product_name' => esc($pn),
                    'cat_var_id' => esc($cvi),
                    'qty' => esc($qt),
                    'product_code' => esc($pc),
                    'product_image' => esc($newImageName),
                    'igst' => esc($igst),
                    'cgst' => esc($cgst),
                    'sgst' => esc($sgst),
                    'purchase_prc' => esc($pp),
                    'mrp' => esc($mrp),
                    'sell_p' => esc($sp),
                    'product_stock' => esc($ps),
                    'pr_desc' => esc($ds),
                ];

                $catModel = new \App\Models\ProductModel();
                try {
                    $query = $catModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'success', 'message' => 'Product Added Successfully!'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Something went wrong!'];
                    }
                    return $this->response->setJSON($response);
                } catch (\Exception $e) {
                    $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                    return $this->response->setStatusCode(500)->setJSON($response);
                }
            }

        }
    }

    public function fetchcatvariant()
    {
        $id = $this->request->getPost('id');

        $cl = new \App\Models\CategorizationModel();
        $vr = $cl->where('cat_id', esc($id))->findAll();
        // print_r($vr);
        if ($vr) {
            $response = ['status' => 'success', 'message' => $vr];
        } else {
            $response = ['status' => 'error', 'message' => 'Please choose a correct Category'];
        }
        return $this->response->setJSON($response);
    }

    // public function fetchproducts()
    // {
    //     try {
    //         $fetchProduct = new \App\Models\ProductModel();

    //         $draw = $_GET['draw'];
    //         $start = $_GET['start'];
    //         $length = $_GET['length'];
    //         $searchValue = $_GET['search']['value'];
    //         $orderColumnIndex = $_GET['order'][0]['column'];
    //         $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
    //         $orderDir = $_GET['order'][0]['dir'];

    //         $fetchProduct->select('products.*, category.cat_name');
    //         $fetchProduct->join('category', 'category.id = products.cat_name_id');

    //         $fetchProduct->select('products.*, categorization.cat_variant');
    //         $fetchProduct->join('categorization', 'categorization.id = products.cat_var_id');

    //         $fetchProduct->orderBy($orderColumnName, $orderDir);

    //         // if (!empty($searchValue)) {
    //         //     $fetchProduct->groupStart();
    //         //     $fetchProduct->orLike('cat_name', $searchValue);
    //         //     $fetchProduct->groupEnd();
    //         // }

    //         $data['product'] = $fetchProduct->findAll($length, $start);
    //         $totalRecords = $fetchProduct->countAll();
    //         // $totalFilterRecords = (!empty($searchValue)) ? $fetchProduct->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
    //         $totalFilterRecords = $totalRecords;
    //         $associativeArray = [];

    //         foreach ($data['product'] as $row) {
    //             $status = $row['status'];

    //             if ($status == 0) {
    //                 $buttonCSSClass = 'btn-outline-danger';
    //                 $buttonName = 'In-Active';
    //             } elseif ($status == 1) {
    //                 $buttonCSSClass = 'btn-outline-success';
    //                 $buttonName = 'Active';
    //             }
    //             $associativeArray[] = array(
    //                 0 => $row['id'],
    //                 1 => ucfirst($row['product_name']),
    //                 2 => $row['cat_name'],
    //                 3 => $row['qty'] . ' ' . $row['cat_variant'],
    //                 4 => $row['product_code'],
    //                 5 => '<img src="../assets/uploads/product/' . $row['product_image'] . '" height="100px" width="100px">',
    //                 6 => $row['purchase_prc'],
    //                 7 => $row['mrp'],
    //                 8 => $row['sell_p'],
    //                 9 => $row['product_stock'],
    //                 10 => html_entity_decode($row['pr_desc']),
    //                 11 => '<button class="btn btn-outline-success" id="statusBtn" data-id="1" data-status="active">Active</button>',
    //                 12 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
    //                 <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
    //             );
    //         }


    //         if (empty($data['product'])) {
    //             $output = array(
    //                 'draw' => intval($draw),
    //                 'recordsTotal' => 0,
    //                 'recordsFiltered' => 0,
    //                 'data' => []
    //             );
    //         } else {
    //             $output = array(
    //                 'draw' => intval($draw),
    //                 'recordsTotal' => $totalRecords,
    //                 'recordsFiltered' => $totalFilterRecords,
    //                 'data' => $associativeArray
    //             );
    //         }
    //         return $this->response->setJSON($output);
    //     } catch (\Exception $e) {
    //         // Log the caught exception
    //         log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
    //         // Return an error response
    //         return $this->response->setJSON(['error' => 'Internal Server Error']);
    //     }
    // }

}
