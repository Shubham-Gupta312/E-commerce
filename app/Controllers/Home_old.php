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

    public function brand()
    {
        if ($this->request->getMethod() == 'get') {
            return view('admin/brand');
        } elseif ($this->request->getMethod() == 'post') {

            $bn = $this->request->getPost('bname');
            $bi = $this->request->getFile('image');

            if ($bi->isValid() && !$bi->hasMoved()) {
                $newImageName = $bi->getRandomName();
                $bi->move("../public/assets/uploads/brand/", $newImageName);

                $data = [
                    'name' => ucwords(esc($bn)),
                    'brand_img' => esc($newImageName)
                ];

                $catModel = new \App\Models\BrandModel();
                try {
                    $query = $catModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'success', 'message' => 'Brand Added Successfully!'];
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
    public function fetchBrand()
    {
        try {
            $fetchBrand = new \App\Models\BrandModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchBrand->orderBy($orderColumnName, $orderDir);

            if (!empty($searchValue)) {
                $fetchBrand->groupStart();
                $fetchBrand->orLike('name', $searchValue);
                $fetchBrand->groupEnd();
            }

            $data['cat'] = $fetchBrand->findAll($length, $start);
            $totalRecords = $fetchBrand->countAll();
            $totalFilterRecords = (!empty($searchValue)) ? $fetchBrand->where('name', $searchValue)->countAllResults() : $totalRecords;
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
                    1 => ucfirst($row['name']),
                    2 => '<img src="../assets/uploads/brand/' . $row['brand_img'] . '" height="100px" width="100px">',
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

    public function brandStatus()
    {
        try {
            $md = new \App\Models\BrandModel();
            $id = $this->request->getPost('id');
            $st = $this->request->getPost('status');
            $dId = $this->request->getPost('dataId');

            if ($dId == 1 && $st == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }

            $result = $md->updateStatus(esc($id), $status);
            // print_r($result);
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

    public function editBrand()
    {
        $id = $this->request->getPost('id');

        $editCat = new \App\Models\BrandModel();
        $ed = $editCat->find(esc($id));

        if ($ed) {
            $response = ['status' => 'true', 'message' => $ed];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateBrand()
    {
        $updateBrnd = new \App\Models\BrandModel();
        $id = $this->request->getPost('id');
        $ebn = $this->request->getPost('editbname');
        $ebi = $this->request->getFile('eimage');

        $data = [
            'name' => ucwords(esc($ebn)),
        ];

        if ($ebi && $ebi->isValid() && !$ebi->hasMoved()) {
            $newName = $ebi->getRandomName();
            $uploadPath = '../public/assets/uploads/brand/';
            $ebi->move($uploadPath, $newName);

            $data['brand_img'] = $newName;
        } else {
            unset($data['brand_img']);
        }

        $query = $updateBrnd->updateBrand(esc($id), $data);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Data Updated Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Updated!'];
        }
        return $this->response->setJSON($response);
    }

    public function deleteBrand()
    {
        $id = $this->request->getPost('id');

        $dct = new \App\Models\BrandModel();
        $query = $dct->deleteBrand(esc($id));
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Brand Deleted Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }
    public function categories()
    {
        if ($this->request->getMethod() == 'get') {
            return view('admin/categories');
        } elseif ($this->request->getMethod() == 'post') {
            $catName = $this->request->getPost('catname');
            $catImg = $this->request->getFile('image');
            $order = $this->request->getPost('orderno');
            // echo $catName, $order;
            if ($catImg->isValid() && !$catImg->hasMoved()) {
                $newImageName = $catImg->getRandomName();
                $catImg->move("../public/assets/uploads/category/", $newImageName);
                $data = [
                    'cname' => ucwords(esc($catName)),
                    'image' => esc($newImageName),
                    'orderno' => esc($order),
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
                    1 => $row['orderno'],
                    2 => ucfirst($row['cname']),
                    3 => '<img src="../assets/uploads/category/' . $row['image'] . '" height="100px" width="100px">',
                    4 => '<button class="btn ' . $buttonCSSClass . '" id="statusBtn" data-id="' . $status . '" data-status="active">' . $buttonName . '</button>',
                    5 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
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
        $on = $this->request->getPost('eorderno');

        $data = [
            'cname' => ucwords(esc($cn)),
            'orderno' => esc($on),
        ];

        if ($ci && $ci->isValid() && !$ci->hasMoved()) {
            $newName = $ci->getRandomName();
            $uploadPath = '../public/assets/uploads/category/';
            $ci->move($uploadPath, $newName);

            $data['image'] = $newName;
        } else {
            unset($data['image']);
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
            $si = $this->request->getFile('image');

            if ($si->isValid() && !$si->hasMoved()) {
                $newImageName = $si->getRandomName();
                $si->move("../public/assets/uploads/sub_category/", $newImageName);
                $data = [
                    'cat_id' => esc($ct),
                    'sub_img' => esc($newImageName),
                    'sname' => ucwords(esc($sct)),
                ];

                $catModel = new \App\Models\SubCatModel();
                try {
                    $query = $catModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'success', 'message' => 'Sub-Category Added Successfully!'];
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

            $fetchSubCat->select('subcategory.*, category.cname');
            $fetchSubCat->join('category', 'category.id = subcategory.cat_id');

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
                    1 => ucfirst($row['cname']),
                    2 => ucfirst($row['sname']),
                    3 => '<img src="../assets/uploads/sub_category/' . $row['sub_img'] . '" height="100px" width="100px">',
                    4 => '<button class="btn ' . $buttonCSSClass . '" id="statusBtn" data-id="' . $status . '" data-status="active">' . $buttonName . '</button>',
                    5 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
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

    public function subCatStatus()
    {
        try {
            $id = $this->request->getPost('id');
            $st = $this->request->getPost('status');
            $dId = $this->request->getPost('dataId');

            $md = new \App\Models\SubCatModel();

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

    public function editSubCategory()
    {
        $id = $this->request->getPost('id');

        $editCat = new \App\Models\SubCatModel();
        $ed = $editCat->find($id);

        if ($ed) {
            $response = ['status' => 'true', 'message' => $ed];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateSubCategory()
    {
        $updateCat = new \App\Models\SubCatModel();
        $id = $this->request->getPost('id');
        $edc = $this->request->getPost('edit_cat');
        $edsc = $this->request->getPost('edit_sub_cat');
        $edsi = $this->request->getFile('eimage');

        $data = [
            'cat_id' => esc($edc),
            'sname' => ucwords(esc($edsc)),
        ];

        if ($edsi && $edsi->isValid() && !$edsi->hasMoved()) {
            $newName = $edsi->getRandomName();
            $uploadPath = '../public/assets/uploads/sub_category/';
            $edsi->move($uploadPath, $newName);

            $data['sub_img'] = $newName;
        } else {
            unset($data['sub_img']);
        }
        // print_r($data);
        $query = $updateCat->updateSubCategory(esc($id), $data);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Data Updated Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Updated!'];
        }
        return $this->response->setJSON($response);
    }

    public function deleteSubCategory()
    {
        $id = $this->request->getPost('id');

        $dct = new \App\Models\SubCatModel();
        $query = $dct->deleteSubCategory($id);
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Sub-Category Deleted Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }
    public function unitMaster()
    {
        if ($this->request->getMethod() == 'get') {
            return view('admin/unitMaster');
        } elseif ($this->request->getMethod() == 'post') {
            $un = $this->request->getPost('unit');

            $data = [
                'sname' => ucwords(esc($un)),
            ];

            // print_r($data);
            $untModel = new \App\Models\UnitMasterModel();
            try {
                $query = $untModel->insert($data);

                if ($query) {
                    $response = ['status' => 'success', 'message' => 'Size Added Successfully!'];
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
                $fetchUnit->orLike('sname', $searchValue);
                // $fetchUnit->groupEnd();
            }

            $data['unit'] = $fetchUnit->findAll($length, $start);
            $totalRecords = $fetchUnit->countAll();
            $totalFilterRecords = (!empty($searchValue)) ? $fetchUnit->where('sname', $searchValue)->countAllResults() : $totalRecords;
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
                    0 => $row['s_id'],
                    1 => ucfirst($row['sname']),
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
            'sname' => ucwords(esc($un)),
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
        $query = $dct->deleteCategorization(esc($id));
        if ($query) {
            $response = ['status' => 'success', 'message' => 'Category Deleted Successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }

    public function fetchSubCategoryData()
    {
        $id = $this->request->getPost('id');

        $cl = new \App\Models\SubCatModel();
        $vr = $cl->where('cat_id', esc($id))->findAll();
        // print_r($vr);
        if ($vr) {
            $response = ['status' => 'success', 'message' => $vr];
        } else {
            $response = ['status' => 'error', 'message' => 'Please choose a correct Category'];
        }
        return $this->response->setJSON($response);
    }
    public function Products()
    {
        if ($this->request->getMethod() == 'get') {
            $ct = new \App\Models\CategoryModel();
            $br = new \App\Models\BrandModel();
            $ut = new \App\Models\UnitMasterModel();

            $data['category'] = $ct->where('status', 1)->findAll();
            $data['brand'] = $br->where('status', 1)->findAll();
            $data['unit'] = $ut->where('status', 1)->findAll();
            return view('admin/products', $data);
        } elseif ($this->request->getMethod() == 'post') {
            $cn = $this->request->getPost('cat_name');
            $pn = $this->request->getPost('product_name');
            $sc = $this->request->getPost('sub_cat');
            $pc = $this->request->getPost('product_code');
            $br = $this->request->getPost('brand');
            $tax = $this->request->getPost('tax');
            $on = $this->request->getPost('orderno');
            $ds = $this->request->getPost('desc');

            $data = [
                'cat_id' => esc($cn),
                'subcat_id' => esc($sc),
                'brand_id' => esc($br),
                'ptitle' => ucwords(esc($pn)),
                'pcode' => strtoupper(esc($pc)),
                'overview' => esc($ds),
                'title' => ucwords(esc($pn)),
                'tax' => esc($tax),
                'orderno' => esc($on),
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

    function validate_ProductCode()
    {
        $pc = trim($this->request->getGet("product_code"));
        $prdModel = new \App\Models\ProductModel();
        $isExist = $prdModel->where('pcode', esc($pc))->first();
        $retVal = $isExist ? false : true;

        return $this->response->setJSON(['valid' => $retVal]);
    }

    public function fetchproducts()
    {
        try {
            $fetchProduct = new \App\Models\ProductModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchProduct->select('products.*, category.cname');
            $fetchProduct->join('category', 'category.id = products.cat_id');

            $fetchProduct->select('products.*, subcategory.sname');
            $fetchProduct->join('subcategory', 'subcategory.id = products.subcat_id');

            $fetchProduct->select('products.*, brand.name');
            $fetchProduct->join('brand', 'brand.id = products.brand_id');

            $fetchProduct->orderBy($orderColumnName, $orderDir);

            // if (!empty($searchValue)) {
            //     $fetchProduct->groupStart();
            //     $fetchProduct->orLike('cat_name', $searchValue);
            //     $fetchProduct->groupEnd();
            // }

            $data['product'] = $fetchProduct->findAll($length, $start);
            $totalRecords = $fetchProduct->countAll();
            // $totalFilterRecords = (!empty($searchValue)) ? $fetchProduct->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
            $totalFilterRecords = $totalRecords;
            $associativeArray = [];

            foreach ($data['product'] as $row) {
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
                    1 => $row['orderno'],
                    2 => ucfirst($row['ptitle']),
                    3 => ucfirst($row['cname']),
                    4 => ucfirst($row['sname']),
                    5 => $row['pcode'],
                    6 => ucfirst($row['name']),
                    7 => $row['tax'] . "%",
                    8 => html_entity_decode($row['overview']),
                    9 => '<button class="btn ' . $buttonCSSClass . '" id="statusBtn" data-id="' . $status . '" data-status="active">' . $buttonName . '</button>',
                    10 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['product'])) {
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

    // public function productStatus()
    // {
    //     $id = $this->request->getPost('id');
    //     $sts = $this->request->getPost('sts');
    //     $dId = $this->request->getPost('dataId');

    //     $stmdl = $new
    // }

    public function productDetail()
    {
        if ($this->request->getMethod() == 'get') {
            $pr = new \App\Models\ProductModel();
            $ps = new \App\Models\UnitMasterModel();

            $data['product'] = $pr->where('status', 1)->findAll();
            $data['size'] = $ps->where('status', 1)->findAll();
            return view('admin/productDetail', $data);
        } elseif ($this->request->getMethod() == 'post') {
            $prn = $this->request->getPost('prod_name');
            $prs = $this->request->getPost('product_size');
            $mrp = $this->request->getPost('mrp');
            $sp = $this->request->getPost('sp');
            $prst = $this->request->getPost('product_stock');

            $data = [
                'pid' => esc($prn),
                'sid' => esc($prs),
                'mrp' => esc($mrp),
                'selling_price' => esc($sp),
                'stock' => esc($prst)
            ];

            $prd = new \App\Models\ProductDetailModel();
            try {
                $query = $prd->insert($data);

                if ($query) {
                    $response = ['status' => 'success', 'message' => 'Product Details Added Successfully!'];
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

    public function fetchproductDetail()
    {
        try {
            $fetchProduct = new \App\Models\ProductDetailModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchProduct->select('product_size.*, products.ptitle');
            $fetchProduct->join('products', 'products.id = product_size.pid');

            $fetchProduct->select('product_size.*, sizes.sname');
            $fetchProduct->join('sizes', 'sizes.s_id = product_size.sid');


            $fetchProduct->orderBy($orderColumnName, $orderDir);

            // if (!empty($searchValue)) {
            //     $fetchProduct->groupStart();
            //     $fetchProduct->orLike('cat_name', $searchValue);
            //     $fetchProduct->groupEnd();
            // }

            $data['product'] = $fetchProduct->findAll($length, $start);
            $totalRecords = $fetchProduct->countAll();
            // $totalFilterRecords = (!empty($searchValue)) ? $fetchProduct->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
            $totalFilterRecords = $totalRecords;
            $associativeArray = [];

            foreach ($data['product'] as $row) {

                $associativeArray[] = array(
                    0 => $row['pro_size'],
                    1 => ucfirst($row['ptitle']),
                    2 => ucfirst($row['sname']),
                    3 => ucfirst($row['mrp']),
                    4 => ucfirst($row['selling_price']),
                    5 => $row['stock'],
                    6 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['product'])) {
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
    public function productImage()
    {
        if ($this->request->getMethod() == 'get') {
            $prm = new \App\Models\ProductModel();

            $data['products'] = $prm->where('status', 1)->findAll();
            return view('admin/productImage', $data);
        } elseif ($this->request->getMethod() == 'post') {
            $pn = $this->request->getPost('prod_name');
            $pi = $this->request->getFile('product_image');

            if ($pi->isValid() && !$pi->hasMoved()) {
                $newImageName = $pi->getRandomName();
                $pi->move("../public/assets/uploads/product/", $newImageName);

                $data = [
                    'pid' => esc($pn),
                    'p_image' => esc($newImageName),
                ];

                $catModel = new \App\Models\ProductImageModel();
                try {
                    $query = $catModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'success', 'message' => 'Product Image Added Successfully!'];
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

    public function fetchproductImage()
    {
        try {
            $fetchProduct = new \App\Models\ProductImageModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchProduct->select('product_images.*, products.ptitle');
            $fetchProduct->join('products', 'products.id = product_images.pid');


            $fetchProduct->orderBy($orderColumnName, $orderDir);

            // if (!empty($searchValue)) {
            //     $fetchProduct->groupStart();
            //     $fetchProduct->orLike('cat_name', $searchValue);
            //     $fetchProduct->groupEnd();
            // }

            $data['product'] = $fetchProduct->findAll($length, $start);
            $totalRecords = $fetchProduct->countAll();
            // $totalFilterRecords = (!empty($searchValue)) ? $fetchProduct->where('cat_name', $searchValue)->countAllResults() : $totalRecords;
            $totalFilterRecords = $totalRecords;
            $associativeArray = [];

            foreach ($data['product'] as $row) {

                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => ucfirst($row['ptitle']),
                    2 => '<img src="../assets/uploads/product/' . $row['p_image'] . '" height="100px" width="100px">',
                    3 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['product'])) {
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
            log_message('error', 'Error in fetch_Product Image: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

}
