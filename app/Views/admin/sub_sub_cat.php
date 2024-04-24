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
                    <h1>Sub-Sub-Category</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add SSCategory" id="add_sscategory"><i
                            class="fas fa-plus"></i> Add Sub-Sub-Category</button>
                </div>
                <!-- </div> -->
                <!-- Column -->
            </div>
            <!-- sub-sub-Categories Form -->
            <div class="category-from">
                <div class="category_container" style="display: none;">
                    <form id="ssubCategoryForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="Sub-Category">Sub-Ctaegory Name</label><span
                                        class="text-danger">*</span>
                                    <select class="form-control" name="scat" id="scat" style="width: 100%;">
                                        <option value="" selected="selected">Please Choose one option</option>
                                        <?php foreach ($scategory as $option): ?>
                                            <option value="<?php echo $option['id']; ?>"><?= $option['sname'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="Sub-Sub-Category">Sub-Sub-Ctaegory Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control onlychars" id="ssub_cat" name="ssub_cat"
                                        placeholder="Enter sub-Sub-Category Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="Category Image">Sub Sub-Ctaegory Image</label><span
                                        class="text-danger">*</span>
                                    <input type="file" class="form-control" id="sscimage" name="sscimage"
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
            <!-- End sub-sub-Categories Form -->
            <!-- Edit sub-Sub-Categories Form  -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Sub Sub-Categories Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editSubSubCategoryForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <input type="hidden" name="id" id="sscatId">
                                        <div class="form-group">
                                            <label for="Sub-Category">Sub-Ctaegory Name</label><span
                                                class="text-danger">*</span>
                                            <select class="form-control" name="escat" id="escat">
                                                <option value="" selected="selected">Please Choose one option</option>
                                                <?php foreach ($scategory as $option): ?>
                                                    <option value="<?php echo $option['id']; ?>"><?= $option['sname'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Sub-Sub-Category">Sub-Sub-Ctaegory Name</label><span
                                                class="text-danger">*</span>
                                            <input type="text" class="form-control onlychars" id="essub_cat"
                                                name="essub_cat" placeholder="Enter sub-Sub-Category Name">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Category Image">Sub Sub-Ctaegory Image</label><span
                                                class="text-danger">*</span>
                                            <input type="file" class="form-control" id="esscimage" name="esscimage"
                                                accept=".jpg, .png, .jpeg">
                                        </div>
                                        <div class="note_form">
                                            <small>Less than or equal to 1Mb </small>
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
            <!-- Edit sub-Sub-Categories Form  End -->
            <div class="table-responsive">
                <table class="table table-bordered" id="sSubCategoryTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <th>Sub-Category Name</th>
                        <th>Sub Sub-Category Name</th>
                        <th>Sub Sub-Category Image</th>
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
        $('#scat').select2();

        $('body').on('keyup', ".onlychars", function (event) {
            this.value = this.value.replace(/[^[A-Za-z ]]*/gi, '');
        });

        $('#add_sscategory').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $(".category_container").show();
        });

        jQuery(document).ready(function (e) {
            $('#ssubCategoryForm').bootstrapValidator({
                fields: {
                    'cat': {
                        validators: {
                            notEmpty: {
                                message: "Please Select Category"
                            },
                        }
                    },
                    'scat': {
                        validators: {
                            notEmpty: {
                                message: "Please Select Sub-Category Name"
                            },
                        }
                    },
                    'ssub_cat': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter Sub-Category Name"
                            },
                        }
                    },
                    'sscimage': {
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
                // console.log(formData); 
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('admin/subsubCategory') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
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

        var table = $('#sSubCategoryTable').DataTable({
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
                { targets: [0, 3, 4], orderable: false }
            ],
            ajax: {
                url: "<?= base_url('admin/fetchSubScat') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            }
        });

        var table = $('#sSubCategoryTable').DataTable();
        $(document).on('click', '#statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var sscatId = data[0];
            var status = $(this).data('status');
            var dataID = $(this).data('id');
            console.log(sscatId, status, dataID);
            $.ajax({
                url: "<?= base_url('admin/subsubcatToggleStatus') ?>",
                type: 'POST',
                data: {
                    'id': sscatId,
                    'sts': status,
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
            var sscatId = data[0];
            // console.log(sscatId);
            $('#sscatId').val(sscatId);
            $.ajax({
                method: 'POST',
                url: "<?= base_url('admin/editSubSubCategory') ?>",
                data: {
                    'id': sscatId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        $('#escat').val(response.message.sub_id);
                        $('#essub_cat').val(response.message.ssname);
                    } else {
                        $.notify(response.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '#updatebtn', function () {
            var $form = $('#editSubSubCategoryForm');
            $form.bootstrapValidator({
                fields: {
                    'escat': {
                        validators: {
                            notEmpty: {
                                message: 'Please Select Sub-Category Name'
                            },
                        }
                    },
                    'essub_cat': {
                        validators: {
                            notEmpty: {
                                message: 'Please Enter Sub Sub-Category Name'
                            }
                        }
                    },
                    'esscimage': {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 1024 * 1024, 
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
                    url: "<?= base_url('admin/updatesubSubCategory') ?>",
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
            var sscatId = data[0];
            // console.log(sscatId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteSubSubCategory') ?>",
                data: {
                    'id': sscatId
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