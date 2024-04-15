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
                    <h1>Unit Master</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add Category" id="add_category"><i
                            class="fas fa-plus"></i> Add Unit</button>
                </div>
                <!-- </div> -->
                <!-- Column -->
            </div>
            <!-- Categories Form -->
            <div class="category-from">
                <div class="category_container" style="display: none;">
                    <form id="categorizationForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="cat_name">Unit Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlychars" name="unit" id="unit"
                                    placeholder="Enter Size (kg, gms)">
                                <!-- <select name="unit" class="form-control" id="unit">
                                    <option value="" selected="selected">Please Choose one</option>
                                    <option value="kg">Kg</option>
                                    <option value="grm">Grm</option>
                                    <option value="ltr">Ltr</option>
                                    <option value="pcs">Peice</option>
                                    <option value="pck">Packet</option>
                                    <option value="mltr">Mililitre</option>
                                    <option value="bx">Box</option>
                                </select> -->
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
                                        <label for="unit name">Unit Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlychars" name="edit_unit_name" id="edit_unit_name"
                                            placeholder="Enter Size (kg, gms)">
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
                <table class="table table-bordered" id="CategorizationTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <th>Size Name</th>
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
            this.value = this.value.replace(/[^[A-Za-z]]*/gi, '');
        });

        $('#add_category').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $(".category_container").show();
        });



        jQuery(document).ready(function (e) {
            $('#categorizationForm').bootstrapValidator({
                fields: {
                    'unit': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter Size"
                            },
                        }
                    },
                },
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var formData = $form.serialize();
                // console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('admin/unitMaster') ?>",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'success') {
                            $('select').val('');
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

        var table = $('#CategorizationTable').DataTable({
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
                { targets: [0, 2, 3], orderable: false }
            ],
            ajax: {
                url: "<?= base_url('admin/fetchUnitMaster') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            },
        });


        $(document).on('click', '#toggle-status', function () {
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var catId = data[0];
            var status = $(this).data('status');
            var dataID = $(this).data('id');
            // console.log(catId, status, dataID);
            // Send AJAX request to the controller
            $.ajax({
                url: "<?= base_url('admin/toggle_status') ?>",
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
                url: "<?= base_url('admin/editUnitMaster') ?>",
                data: {
                    'id': catId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        $('#edit_unit_name').val(response.message.sname);
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
                    'edit_unit_name': {
                        validators: {
                            notEmpty: {
                                message: 'Please Enter Unit Name'
                            },
                        }
                    },
                },
            });
            $form.bootstrapValidator('validate');
            if ($form.data('bootstrapValidator').isValid()) {
                var formData = $form.serialize();
                // console.log(formData);
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('admin/updateUnitMaster') ?>",
                    data: formData,
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
                url: "<?= base_url('admin/deleteUnitMaster') ?>",
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