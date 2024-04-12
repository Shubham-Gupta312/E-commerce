<?php

namespace App\Controllers;

class Home extends BaseController
{
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
                    3 =>  '<button class="btn '.$buttonCSSClass.'" id="statusBtn" data-id="' . $status . '" data-status="active">'. $buttonName .'</button>',
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
    
            $result = $md->updateStatus($id, $status);
    
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
        $ed = $editCat->find($id);

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

    public function Classification()
    {
        if ($this->request->getMethod() == 'get') {
            $cls = new \App\Models\CategoryModel();
            $data['category'] = $cls->findAll();
            // print_r($data);
            return view('admin/classification', $data);
        } elseif ($this->request->getMethod() == 'post') {
            $cn = $this->request->getPost('cat_name');
            $cv = $this->request->getPost('cat_var');

            $data = [
                'cat_id' => esc($cn),
                'cat_variant' => esc($cv)
            ];

            // print_r($data);
            $catModel = new \App\Models\CategorizationModel();
            try {
                $query = $catModel->insert($data);

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

    // public function fetchClassification()
    // {
    //     try {
    //         $fetchCat = new \App\Models\CategorizationModel();

    //         $draw = $_GET['draw'];
    //         $start = $_GET['start'];
    //         $length = $_GET['length'];
    //         $searchValue = $_GET['search']['value'];
    //         $orderColumnIndex = $_GET['order'][0]['column'];
    //         $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
    //         $orderDir = $_GET['order'][0]['dir'];

    //         $fetchCat->select('categorization.*, category.cat_name');
    //         $fetchCat->join('category', 'category.id = categorization.cat_id');




    //         if (!empty($searchValue)) {
    //             // $fetchCat->groupStart();
    //             $fetchCat->orLike('category.cat_name', $searchValue);
    //             $fetchCat->orLike('categorization.cat_variant', $searchValue);
    //             // $fetchCat->groupEnd();
    //         }

    //         $fetchCat->orderBy($orderColumnName, $orderDir );

    //         $data['classification'] = $fetchCat->findAll($length, $start);
    //         $totalRecords = $fetchCat->countAll();
    //         $totalFilterRecords = (!empty($searchValue)) ? $fetchCat->where('category.cat_name', $searchValue)->countAllResults() : $totalRecords;
    //         // $totalFilterRecords = $totalRecords;
    //         $associativeArray = [];

    //         foreach ($data['classification'] as $row) {
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
    //                 2 => ucfirst($row['cat_variant']),
    //                 3 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
    //                 4 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
    //                 <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
    //             );
    //         }


    //         if (empty($data['classification'])) {
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
    //     } catch (\Exception $e) { // Log the caught exception
    //         log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
    //         // Return an error response
    //         return $this->response->setJSON(['error' => 'Internal Server Error']);
    //     }
    // }

    public function fetchClassification()
    {
        try {
            $fetchCat = new \App\Models\CategorizationModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];
            $orderColumnIndex = $_GET['order'][0]['column'];
            $orderColumnName = $_GET['columns'][$orderColumnIndex]['data'];
            $orderDir = $_GET['order'][0]['dir'];

            $fetchCat->select('categorization.*, category.cat_name');
            $fetchCat->join('category', 'category.id = categorization.cat_id');


            if (!empty($searchValue)) {
                // $fetchCat->groupStart();
                $fetchCat->orLike('category.cat_name', $searchValue);
                $fetchCat->orLike('categorization.cat_variant', $searchValue);
                // $fetchCat->groupEnd();
            }

            $fetchCat->orderBy($orderColumnName, $orderDir);

            $data['classification'] = $fetchCat->findAll($length, $start);
            $totalRecords = $fetchCat->countAll();
            // $totalFilterRecords = (!empty($searchValue)) ? $fetchCat->countAllResults() : $totalRecords;
            $totalFilterRecords =
                // $totalFilterRecords = $totalRecords;
                $associativeArray = [];

            foreach ($data['classification'] as $row) {
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
                    2 => ucfirst($row['cat_variant']),
                    3 => '<button class="btn '.$buttonCSSClass.'" id="toggle-status" data-id="' . $status . '" data-status="active">'. $buttonName .'</button>',
                    4 => '<button class="btn btn-outline-warning" id="editCat" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteCat"><i class="fas fa-trash"></i></button>',
                );
            }


            if (empty($data['classification'])) {
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
        } catch (\Exception $e) { // Log the caught exception
            log_message('error', 'Error in fetch_Category: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function toggle_status()
    {
        try {
            $md = new \App\Models\CategorizationModel();
            $id = $this->request->getPost('id');
            $st = $this->request->getPost('status');
            $dId = $this->request->getPost('dataId');
    
            if ($dId == 1 && $st == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
    
            $result = $md->updateStatus($id, $status);
    
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
    



    public function editCategorization()
    {
        $id = $this->request->getPost('id');

        $editCat = new \App\Models\CategorizationModel();
        $ed = $editCat->find($id);

        if ($ed) {
            $response = ['status' => 'true', 'message' => $ed];
        } else {
            $response = ['status' => 'error', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateCategorization()
    {
        $updateCat = new \App\Models\CategorizationModel();
        $id = $this->request->getPost('id');
        $cn = $this->request->getPost('edit_cat_name');
        $cv = $this->request->getPost('edit_cat_var');

        $data = [
            'cat_id' => esc($cn),
            'cat_variant' => esc($cv)
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

    public function deleteCategorization()
    {
        $id = $this->request->getPost('id');

        $dct = new \App\Models\CategorizationModel();
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
        $ct = new \App\Models\CategoryModel();
        $data['category'] = $ct->findAll();
        return view('admin/products', $data);
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


}
