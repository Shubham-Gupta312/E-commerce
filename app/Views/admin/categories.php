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
                    <h1>Categories</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add Category" id="add_category"><i
                            class="fas fa-plus"></i> Add Categories</button>
                </div>
                <!-- </div> -->
                <!-- Column -->
            </div>
            <!-- Categories Form -->
            <div class="category-from">
                <div class="category_container" style="display: none;">
                    <form id="CategoryForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="cat name">Category Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlychars" id="catname" name="catname"
                                    placeholder="Enter Category Name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="Category Image">Ctaegory Image</label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept=".jpg, .png, jpeg">
                                </div>
                                <div class="note_form">
                                    <small>Less than or equal to 1Mb </small>
                                    <small class="float-end">Supported format: Jpeg,Jpg, Png</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
            <!-- End Categories Form -->
            <!-- Edit Categories Form  -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
            </div>
            <!-- Edit Categories Form  End -->
            <div class="table-responsive">
                <table class="table table-bordered" id="CategoryTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
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

        $('#add_category').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $(".category_container").show();
        });

        jQuery(document).ready(function (e) {
            $('#CategoryForm').bootstrapValidator({
                fields: {
                    'catname': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Order Number"
                            },
                        }
                    },
                    'image': {
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
                },
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var formData = new FormData($form[0]);
                // console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('admin/categories') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'success') {
                            $('input').val('');
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

        var table = $('#CategoryTable').DataTable({
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
            columnDefs: [
                { targets: [0, 2, 3, 4], orderable: false }
            ],
            ajax: {
                url: "<?= base_url('admin/fetchdata') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            }
        });

        function setButtonStyles(button, newStatus) {
            if (newStatus === 0) {
                button.removeClass('btn-outline-success').addClass('btn-outline-danger').text('In-Active');
            } else if (newStatus === 1) {
                button.removeClass('btn-outline-danger').addClass('btn-outline-success').text('Active');
            }
        }
        var table = $('#CategoryTable').DataTable();
        $(document).on('click', '#statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var catId = data[0];
            var status = $(this).data('status');
            var dataID = $(this).data('id');
            // console.log(catId, status, dataID);
            // Send AJAX request to the controller
            $.ajax({
                url: "<?= base_url('admin/catStatus') ?>",
                type: 'POST',
                data: {
                    'id': catId,
                    'status': status,
                    'dataId': dataID
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status === 1) {
                        button.data('status', 'active').text('Active');
                        button.removeClass('btn-outline-danger').addClass('btn-outline-success');
                    } else {
                        button.data('status', 'inactive').text('In-Active');
                        button.removeClass('btn-outline-success').addClass('btn-outline-danger');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                }
            });
        });

        $(document).on('click', '#editCat', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var catId = data[0];
            // console.log(catId);
            $('#catId').val(catId);
            $.ajax({
                method: 'POST',
                url: "<?= base_url('admin/editCategory') ?>",
                data: {
                    'id': catId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        $('#editcat').val(response.message.cat_name);
                    } else {
                        $.notify(response.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '#updatebtn', function () {
            var $form = $('#editCategoryForm');
            $form.bootstrapValidator({
                fields: {
                    'editcat': {
                        validators: {
                            notEmpty: {
                                message: 'The category name is required'
                            },
                        }
                    },
                    'editimage': {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 1024 * 1024, // 1 MB in bytes
                                message: 'The selected file is not valid or exceeds 1 MB in size',
                            },
                        }
                    },
                },
            });
            $form.bootstrapValidator('validate');
            if ($form.data('bootstrapValidator').isValid()) {
                var formData = new FormData($form[0]);
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('admin/updateCategory') ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == 'success') {
                            $.notify(response.message, "success");
                            table.ajax.reload();
                            $('#exampleModal').modal('hide');
                        } else {
                            $.notify(response.message, "error");
                        }
                    }
                });
            }
        });

        $(document).on('click', '#deleteCat', function () {
            // console.log('clicked');
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var catId = data[0];
            // console.log(catId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteCategory') ?>",
                data: {
                    'id': catId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'success') {
                        $.notify(response.message, "success");
                        table.ajax.reload();
                    } else {
                        $.notify(response.message, "error");
                    }
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>