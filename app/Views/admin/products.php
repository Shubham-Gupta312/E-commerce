<?= $this->extend('inc/snippet.php'); ?>
<?= $this->section('content'); ?>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper-rmvd">
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-lg-3 col-md-6"> -->
                <div class="col-lg-6">
                    <h1>Products</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add Category" id="add_category"><i
                            class="fas fa-plus"></i> Add Products</button>
                </div>
                <!-- </div> -->
                <!-- Column -->
            </div>
            <!-- Product Form -->
            <div class="category-from">
                <div class="category_container" style="display: none;">
                    <form id="productsForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control onlychars" name="product_name"
                                        id="product_name" placeholder="Enter Product Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="cat_name">Category Name</label><span class="text-danger">*</span>
                                    <select name="cat_name" class="form-control" id="cat_name">
                                        <option value="" selected="selected">Please choose an option</option>
                                        <?php foreach ($category as $option): ?>
                                            <option value="<?php echo $option['id']; ?>"><?php echo $option['cname']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="sub_cat">Sub-Category</label><span class="text-danger">*</span>
                                <select class="form-control" name="sub_cat" id="sub_cat">
                                    <option value="" selected="selected">Please choose an option</option>

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="unit_type">Weight / Size</label>
                                            <input type="text" class="form-control onlynum" id="unit_type"
                                                name="unit_type" placeholder="Enter Weight / Size">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <select class="form-control" name="unit" id="unit">
                                                <option value="" selected="selected">Please choose an option</option>
                                                <?php foreach ($unit as $option): ?>
                                                    <option value="<?php echo $option['s_id']; ?>">
                                                        <?= $option['sname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="prcode">Product Code</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlyalphanum" name="product_code"
                                    id="product_code" placeholder="Enter Product Code">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="Brand">Brand Name</label><span class="text-danger">*</span>
                                <select class="form-control" name="brand" id="brand">
                                    <option value="" selected="selected">Please choose an option</option>
                                    <?php foreach ($brand as $option): ?>
                                        <option value="<?php echo $option['id']; ?>">
                                            <?= $option['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-6">
                                <label for="tax">Tax %</label>
                                <input type="text" class="form-control onlynum" name="tax" id="tax"
                                    placeholder="Enter Tax">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="primg">Product Image</label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" name="product_image" multiple id="product_image"
                                        accept=".jpg, ,.png, .jpeg">
                                </div>
                                <div class="note_form">
                                    <small>Less than or equal to 1Mb </small>
                                </div>
                            </div>
                            <!-- <div class="col-lg-4 col-md-6">
                                <label for="cgst">cGST %</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="cgst" id="cgst"
                                    placeholder="Enter cGST">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="sgst">sGST %</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="sgst" id="sgst"
                                    placeholder="Enter sGST">
                            </div> -->
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-6">
                                <label for="prchseprc">Purchase Price (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="purchase_prc" id="purchase_prc"
                                    placeholder="Enter Purchase Price">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="mrp">MRP (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="mrp" id="mrp"
                                    placeholder="Enter MRP">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="sp">Selling Price (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="sp" id="sp"
                                    placeholder="Enter Selling Price">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-6">
                                <label for="prstck">Product Stock</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="product_stock" id="product_stock"
                                    placeholder="Enter Product Stock">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-6">
                                <label for="desc">Product Description</label>
                                <!-- <span class="text-danger">*</span> -->
                                <textarea name="desc" class="form-control" id="desc" cols="50"></textarea>
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
            <!-- End Categories Form -->
            <!-- Edit Categories Form  -->
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Categories Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editCategoryForm" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="id" id="catId" val="">
                                    <div class="col-lg-12 col-md-6">
                                        <label for="title">Category Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlychars" required id="editcat"
                                            name="editcat" placeholder="Enter Category Name">
                                    </div>
                                    <div class="col-lg-12 col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="Category Image">Category Image</label><span
                                                class="text-danger">*</span>
                                            <input type="file" class="form-control" id="editimage" name="editimage"
                                                accept=".jpg, .png, jpeg">
                                        </div>
                                        <div class="note_form">
                                            <small>Less than or equal to 1Mb </small>
                                            <small class="float-end">Supported format: Jpeg,Jpg, Png</small>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" name="updatebtn" id="updatebtn">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Edit Categories Form  End -->
            <div class="table-responsive">
                <table class="table table-bordered" id="productTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Product Qty</th>
                        <th>Product Code</th>
                        <th>Product Image</th>
                        <th>Product Purchase Price</th>
                        <th>Product MRP</th>
                        <th>Product Selling Price</th>
                        <th>Product Stock</th>
                        <th>Product Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2024 All Rights Reserved Sri Krishna Ghee
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
</div>

<script>
    $(document).ready(function () {
        $('body').on('keyup', ".onlychars", function (event) {
            this.value = this.value.replace(/[^[A-Za-z ]]*/gi, '');
        });
        $('body').on('keyup', ".onlynum", function (event) {
            this.value = this.value.replace(/[^[0-9]]*/gi, '');
        });
        $('body').on('keyup', ".onlyalphanum", function (event) {
            this.value = this.value.replace(/[^[A-Za-z0-9]]*/gi, '');
        });

        $('#add_category').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $(".category_container").show();
        });

        ClassicEditor
            .create(document.querySelector('#desc'))
            .catch(error => {
                console.error(error);
            });

        $('#cat_name').change(function () {
            var catID = $(this).val();
            if (catID != '') {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('admin/fetchSubCategoryData') ?>",
                    data: {
                        'id': catID
                    },
                    success: function (res) {
                        if (res.status == 'success') {
                            var options = '<option value="">Please choose an option</option>';
                            $.each(res.message, function (index, value) {
                                options += '<option value="' + value.id + '">' + value.sname + '</option>';
                            });
                            $('#sub_cat').html(options);
                        } else {
                            $('#sub_cat').html('<option value="">No variants found</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching subcategories:", error);
                        $('#sub_cat').html('<option value="">Error fetching subcategories</option>');
                    }
                });
            } else {
                $.notify("Please choose a category first", "error");
                $('#sub_cat').html('<option value="">Please choose a category first</option>');
            }
        });

        jQuery(document).ready(function (e) {
            $('#productsForm').bootstrapValidator({
                fields: {
                    'cat_name': {
                        validators: {
                            notEmpty: {
                                message: "Please choose Category of product"
                            },
                        }
                    },
                    'product_name': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter Product Name"
                            },
                        }
                    },
                    'sub_cat': {
                        validators: {
                            notEmpty: {
                                message: 'Please select Sub-Category'
                            }
                        }
                    },
                    'qty': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Quantity'
                            }
                        }
                    },
                    'product_code': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Product Code'
                            }
                        }
                    },
                    'product_image': {
                        validators: {
                            notEmpty: {
                                message: "Please Choose Image File"
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 1024 * 1024,
                                message: 'The selected file is not valid or exceeds 1 MB in size',
                            },
                        }
                    },
                    'cgst': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter CGST'
                            }
                        }
                    },
                    'sgst': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter SGST'
                            }
                        }
                    },
                    'purchase_prc': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Purchase Price'
                            }
                        }
                    },
                    'mrp': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter MRP'
                            }
                        }
                    },
                    'sp': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Selling Price'
                            }
                        }
                    },
                    'product_stock': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Product Stock'
                            }
                        }
                    },
                },
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var formData = new FormData($form[0]);
                // console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('admin/products') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'success') {
                            // ClassicEditor.instances.desc.setData('');
                            $('input, select').val('');
                            $('.category_container').hide();
                            $.notify(response.message, "success");
                            table.ajax.reload(null, false);
                        } else {
                            $.notify(response.message, "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });
        });

        // var table = $('#productTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     paging: true,
        //     order: [[1, 'desc']],
        //     "fnCreatedRow": function (row, data, index) {
        //         var pageInfo = table.page.info();
        //         var currentPage = pageInfo.page;
        //         var pageLength = pageInfo.length;
        //         var rowNumber = index + 1 + (currentPage * pageLength);
        //         $('td', row).eq(0).html(rowNumber);
        //     },
        //     columnDefs: [
        //         { targets: [0, 5, 10, 11, 12], orderable: false }
        //     ],
        //     ajax: {
        //         url: "<?= base_url('admin/fetchproducts') ?>",
        //         type: "GET",
        //         error: function (xhr, error, thrown) {
        //             // console.log("AJAX error:", xhr, error, thrown);
        //         }
        //     },
        //     drawCallback: function (settings) {
        //         // console.log('Table redrawn:', settings);
        //     }
        // });

        // function setButtonStyles(button, newStatus) {
        //     if (newStatus === 0) {
        //         button.removeClass('btn-outline-success').addClass('btn-outline-danger').text('In-Active');
        //     } else if (newStatus === 1) {
        //         button.removeClass('btn-outline-danger').addClass('btn-outline-success').text('Active');
        //     }
        // }
        // var table = $('#CategoryTable').DataTable();
        // $(document).on('click', '.statusBtn', function (e) {
        //     e.preventDefault();
        //     var button = $(this);
        //     var data = table.row(button.closest('tr')).data();
        //     var catId = data[0];
        //     // console.log(catId);
        //     $.ajax({
        //         method: "POST",
        //         url: "<?= base_url('admin/catStatus') ?>",
        //         data: {
        //             'id': catId
        //         },
        //         success: function (response) {
        //             console.log(response);
        //             if (response.status === 'true') {
        //                 var newStatus = response.newStatus;
        //                 setButtonStyles(button, newStatus);
        //             }
        //         }
        //     });
        // });

        // $(document).on('click', '#editCat', function (e) {
        //     e.preventDefault();
        //     var button = $(this);
        //     var data = table.row(button.closest('tr')).data();
        //     var catId = data[0];
        //     // console.log(catId);
        //     $('#catId').val(catId);
        //     $.ajax({
        //         method: 'POST',
        //         url: "<?= base_url('admin/editCategory') ?>",
        //         data: {
        //             'id': catId
        //         },
        //         success: function (response) {
        //             // console.log(response);
        //             if (response.status == 'true') {
        //                 $('#editcat').val(response.message.cat_name);
        //             } else {
        //                 $.notify(response.message, "error");
        //             }
        //         }
        //     });
        // });

        // $(document).on('click', '#updatebtn', function () {
        //     var $form = $('#editCategoryForm');
        //     $form.bootstrapValidator({
        //         fields: {
        //             'editcat': {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'The category name is required'
        //                     },
        //                 }
        //             },
        //             'editimage': {
        //                 validators: {
        //                     file: {
        //                         extension: 'jpeg,jpg,png',
        //                         type: 'image/jpeg,image/png',
        //                         maxSize: 1024 * 1024, // 1 MB in bytes
        //                         message: 'The selected file is not valid or exceeds 1 MB in size',
        //                     },
        //                 }
        //             },
        //         },
        //     });
        //     $form.bootstrapValidator('validate');
        //     if ($form.data('bootstrapValidator').isValid()) {
        //         var formData = new FormData($form[0]);
        //         $.ajax({
        //             method: "POST",
        //             url: "<?= base_url('admin/updateCategory') ?>",
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function (response) {
        //                 // console.log(response);
        //                 if (response.status == 'success') {
        //                     $.notify(response.message, "success");
        //                     table.ajax.reload();
        //                     $('#exampleModal').modal('hide');
        //                 } else {
        //                     $.notify(response.message, "error");
        //                 }
        //             }
        //         });
        //     }
        // });

        // $(document).on('click', '#deleteCat', function () {
        //     // console.log('clicked');
        //     var button = $(this);
        //     var data = table.row(button.closest('tr')).data();
        //     var catId = data[0];
        //     // console.log(catId);
        //     $.ajax({
        //         method: "POST",
        //         url: "<?= base_url('admin/deleteCategory') ?>",
        //         data: {
        //             'id': catId
        //         },
        //         success: function (response) {
        //             // console.log(response);
        //             if (response.status == 'success') {
        //                 $.notify(response.message, "success");
        //                 table.ajax.reload();
        //             } else {
        //                 $.notify(response.message, "error");
        //             }
        //         }
        //     });
        // });

    });
</script>

<?= $this->endSection() ?>