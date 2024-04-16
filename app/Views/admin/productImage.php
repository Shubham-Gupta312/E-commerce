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
                    <h1>Products Image</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-warning ml-2" title="Add Image" id="add_image"><i
                            class="fas fa-plus"></i> Add Image</button>
                </div>
                <!-- </div> -->
                <!-- Column -->
            </div>
            <!-- Product Form -->
            <div class="category-from">
                <div class="category_container" style="display: none;">
                    <form id="productsImageForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label><span class="text-danger">*</span>
                                    <select class="form-control" name="prod_name" id="prod_name">
                                        <option value="" selected="selected">Please select product</option>
                                        <?php foreach ($products as $option): ?>
                                            <option value="<?php echo $option['id']; ?>">
                                                <?= $option['ptitle']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="primg">Product Image</label><span class="text-danger">*</span>
                                    <!-- <input type="file" class="form-control" name="product_image[]" multiple
                                        id="product_image" accept=".jpg, .png, .jpeg"> -->
                                    <input type="file" class="form-control" name="product_image" multiple
                                        id="product_image" accept=".jpg, .png, .jpeg">
                                </div>
                                <div class="note_form">
                                    <small>Less than or equal to 1Mb </small>
                                </div>
                            </div>
                        </div>
                        <div id="additionalImages"></div>
                        <!-- <button type="button" id="add_more" name="add_more" class="btn btn-outline-info mt-2">Add More
                            Image</button> -->
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
                <table class="table table-bordered" id="productImageTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
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

        $('#add_image').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $(".category_container").show();
        });


        // var maxImages = 5;
        // var count = 0; 

        // $('#add_more').click(function () {
        //     if (count < maxImages) {
        //         var newInput = '<div class="form-group">' +
        //             '<div class="row">' +
        //             '<div class="col-md-6">' +
        //             '<label for="primg">Product Image</label><span class="text-danger">*</span>' +
        //             '<input type="file" class="form-control product-image" name="product_image[]" multiple accept=".jpg, .png, .jpeg">' +
        //             '</div>' +
        //             '<div class="col-md-2 mt-4">' +
        //             '<button type="button" class="btn btn-outline-danger btn-sm remove-image"><i class="fa-solid fa-xmark"></i></button>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>';
        //         $('#additionalImages').append(newInput);
        //         $('#additionalImages .form-group:last-child input[type="file"]').change(function () {
        //             var file = this.files[0];
        //             if (file) {
        //                 var fileSize = file.size / 1024 / 1024;
        //                 if (fileSize > 1) {
        //                     $.notify('File size exceeds 1MB limit.');
        //                     $(this).val('');
        //                 }
        //             }
        //         });
        //         count++;
        //     } else {
        //         // alert('Maximum ' + maxImages + ' additional images allowed.');
        //         $.notify('Maximum ' + maxImages + ' additional images allowed.');
        //     }
        // });

        // $('#additionalImages').on('click', '.remove-image', function () {
        //     $(this).closest('.form-group').remove();
        //     // console.log('click');
        // });
        

        jQuery(document).ready(function (e) {
            $('#productsImageForm').bootstrapValidator({
                fields: {
                    'prod_name': {
                        validators: {
                            notEmpty: {
                                message: "Please Select Product Name"
                            },
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
                }
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var formData = new FormData($form[0]);
                // var formData = $form.serialize();
                // console.log(formData);
                $.ajax({
                    url: "<?= base_url('admin/productImage') ?>",
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


        var table = $('#productImageTable').DataTable({
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
                url: "<?= base_url('admin/fetchproductImage') ?>",
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