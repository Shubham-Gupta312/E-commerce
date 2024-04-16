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
                    <h1>Products Details</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary ml-2" title="Add Detail" id="add_detail"><i
                            class="fas fa-plus"></i> Add Product Detail</button>
                </div>
                <!-- </div> -->
                <!-- Column -->
            </div>
            <!-- Product Form -->
            <div class="category-from">
                <div class="category_container" style="display: none;">
                    <form id="productsDetailsForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label><span class="text-danger">*</span>
                                    <select class="form-control" name="prod_name" id="prod_name">
                                        <option value="" selected="selceted">Please select product</option>
                                        <?php foreach ($product as $option): ?>
                                            <option value="<?php echo $option['id']; ?>">
                                                <?= $option['ptitle']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="prosize">Product Size</label><span class="text-danger">*</span>
                                    <!-- <input type="" class="form-control" name="product_size" multiple
                                        id="product_size"> -->
                                    <select class="form-control" name="product_size" id="product_size">
                                        <option value="" selected="selected">Please Choose Product Size</option>
                                        <?php foreach ($size as $option): ?>
                                            <option value="<?php echo $option['s_id']; ?>">
                                                <?= $option['sname']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="mrp">MRP (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="mrp" id="mrp"
                                    placeholder="Enter MRP">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="sp">Selling Price (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="sp" id="sp"
                                    placeholder="Enter Selling Price">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-6">
                                <label for="prstck">Product Stock</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="product_stock" id="product_stock"
                                    placeholder="Enter Product Stock">
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
                <table class="table table-bordered" id="productDetailTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product MRP</th>
                        <th>Product Selling Price</th>
                        <th>Product Stock</th>
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

        $('body').on('keyup', ".onlynum", function (event) {
            this.value = this.value.replace(/[^[0-9]]*/gi, '');
        });

        $('#add_detail').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $(".category_container").show();
        });

        jQuery(document).ready(function (e) {
            $('#productsDetailsForm').bootstrapValidator({
                fields: {
                    'prod_name': {
                        validators: {
                            notEmpty: {
                                message: "Please Select Product Name"
                            },
                        }
                    },
                    'product_size': {
                        validators: {
                            notEmpty: {
                                message: "Please Choose Product Size"
                            },
                        }
                    },
                    'mrp': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter MRP"
                            },
                        }
                    },
                    'sp': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter Selling Price"
                            },
                        }
                    },
                    'product_stock': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter Product Stock"
                            },
                        }
                    },
                }
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                // var formData = new FormData($form[0]);
                var formData = $form.serialize();
                // console.log(formData);
                $.ajax({
                    url: "<?= base_url('admin/productDetail') ?>",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'success') {
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


        var table = $('#productDetailTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            order: [[1, 'desc']],
            "fnCreatedRow": function (row, data, index) {
                var pageInfo = table.page.info();
                var currentPage = pageInfo.page;
                var pageLength = pageInfo.length;
                var rowNumber = index + 1 + (currentPage * pageLength);
                $('td', row).eq(0).html(rowNumber);
            },
            // columnDefs: [
            //     { targets: [0, 5, 10, 11, 12], orderable: false }
            // ],
            ajax: {
                url: "<?= base_url('admin/fetchproductDetail') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            }
        });

      

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