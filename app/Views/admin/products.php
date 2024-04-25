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
                    <!-- <button class="btn btn-outline-warning ml-2" title="Add Image" id="add_image"><i
                            class="fas fa-plus"></i> Add Image</button> -->
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
                                    <label for="product_name">Product Title</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control onlychars" name="product_name"
                                        id="product_name" placeholder="Enter Product Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="cat_name">Category Name</label><span class="text-danger">*</span>
                                    <select name="cat_name" class="form-control" id="cat_name" style="width: 100%;">
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
                                <select class="form-control" name="sub_cat" id="sub_cat" style="width: 100%;">
                                    <option value="" selected="selected">Please choose an option</option>

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <label for="sub-sub-cat">Sub Sub-Category</label><span class="text-danger">*</span>
                                <select class="form-control" name="ssct" id="ssct" style="width: 100%;">
                                    <option value="" selected="selected">Please choose an option</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="prcode">Product Code</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlyalphanum" name="product_code"
                                    id="product_code" placeholder="Enter Product Code (Eg. GHEE9389)">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="Brand">Brand Name</label><span class="text-danger">*</span>
                                <select class="form-control" name="brand" id="brand" style="width: 100%;">
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
                                <label for="orderno">Order Number</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="orderno" id="orderno"
                                    placeholder="Enter Product Order number">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="tax">Tax %</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="tax" id="tax"
                                    placeholder="Enter Tax">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-6">
                                <label for="desc">Product Description</label><span class="text-danger">*</span>
                                <textarea name="desc" class="form-control" id="desc" cols="50"></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="desc">Product Specification</label>
                                <textarea name="specs" class="form-control" id="specs" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-12 text-right">
                                <button type="button" class="btn btn-outline-info" id="add_size">Add Size</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-3 col-md-4">
                                <label for="Sizes">Sizes</label><span class="text-danger">*</span>
                                <select class="form-control" name="product_size[]" id="product_size">
                                    <option value="" selected="selected">Please choose an option</option>
                                    <?php foreach ($unit as $option): ?>
                                        <option value="<?php echo $option['s_id']; ?>">
                                            <?= $option['sname']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <label for="mrp">MRP (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="mrp[]" id="mrp"
                                    placeholder="Enter MRP (Eg. 1000)">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <label for="sp">Selling Price (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="sp[]" id="sp"
                                    placeholder="Enter Selling Price (Eg. 1000)">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <label for="prstck">Product Stock</label>
                                <input type="text" class="form-control onlynum" name="product_stock[]"
                                    id="product_stock" placeholder="Enter Product Stock (Eg. 10)">
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="primg">Product Image</label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" name="product_image[]" id="product_image"
                                        accept=".jpg, .png, .jpeg">
                                </div>
                                <div class="note_form">
                                    <small>Less than or equal to 1Mb </small>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mt-2"> -->
                        <div id="additionalSize"></div>
                        <!-- </div> -->

                        <!-- <div class="row mt-2">
                            <div class="col-lg-12 col-md-12 text-right">
                                <button type="button" class="btn btn-outline-warning" id="add_image">Add Image</button>
                            </div>
                        </div> -->
                        <!-- <div class="row mt-2">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="primg">Product Image</label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" name="product_image[]" id="product_image"
                                        accept=".jpg, .png, .jpeg">
                                </div>
                                <div class="note_form">
                                    <small>Less than or equal to 1Mb </small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="youtube">You-Tube Link</label>
                                <input type="url" name="ylink" id="ylink" class="form-control"
                                    placeholder="Eg : https://www.youtube.com/watch?v=y0D1cluPbsQ">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div id="additionalImages"></div>
                            </div>
                        </div> -->
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-6">
                                <label for="meta_title">Meta Title </label><small class="text-danger">(Maximum 60
                                    characters
                                    are allowed)</small>
                                <textarea name="meta_title" id="meta_title" class="form-control onlyalphanumhyp"
                                    cols="30" placeholder="Enter Meta Title" data-bv-stringlength="true"
                                    data-bv-stringlength-max="60"
                                    data-bv-stringlength-message="The meta title must be less than or equal to 60 characters"></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="meta_desc">Meta Description </label><small class="text-danger">(Maximum 160
                                    characters
                                    are allowed)</small>
                                <textarea name="meta_desc" id="meta_desc" class="form-control onlyalphanumhyp" cols="30"
                                    placeholder="Enter Meta Description" data-bv-stringlength="true"
                                    data-bv-stringlength-max="160"
                                    data-bv-stringlength-message="The meta description must be less than or equal to 160 characters"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-6">
                                <label for="meta_keywords">Meta KeyWords </label>
                                <textarea name="meta_keywrds" id="meta_keywrds" class="form-control" cols="30"
                                    placeholder="Enter Meta Keywords Eg:apples,orange"></textarea>
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
            <!-- End Categories Form -->
            <!-- Edit Product Form  -->
            <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="ProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ProductModalLabel">Edit Product Form Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editCategoryForm" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="id" id="productId" val="">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">Product Title</label><span
                                                class="text-danger">*</span>
                                            <input type="text" class="form-control onlychars" name="eproduct_name"
                                                id="eproduct_name" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="cat_name">Category Name</label><span
                                                class="text-danger">*</span>
                                            <select name="ecat_name" class="form-control" id="ecat_name">
                                                <option value="" selected="selected">Please choose an option</option>
                                                <?php foreach ($category as $option): ?>
                                                    <option value="<?php echo $option['id']; ?>">
                                                        <?php echo $option['cname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label for="sub_cat">Sub-Category</label><span class="text-danger">*</span>
                                        <select class="form-control" name="esub_cat" id="esub_cat">
                                            <option value="" selected="selected">Please choose an option</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <label for="sub_sub_cat">Sub Sub-Category</label><span
                                            class="text-danger">*</span>
                                        <select class="form-control" name="ess_cat" id="ess_cat">
                                            <option value="" selected="selected">Please choose an option</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label for="prcode">Product Code</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlyalphanum" name="eproduct_code"
                                            id="eproduct_code" placeholder="Enter Product Code (Eg. GHEE9389)">
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label for="Brand">Brand Name</label><span class="text-danger">*</span>
                                        <select class="form-control" name="ebrand" id="ebrand">
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
                                        <label for="tax">Tax %</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlynum" name="etax" id="etax"
                                            placeholder="Enter Tax">
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label for="orderno">Order Number</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlynum" name="eorderno" id="eorderno"
                                            placeholder="Enter Product Order number">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="desc">Product Description</label><span class="text-danger">*</span>
                                        <textarea name="edesc" class="form-control" id="edesc" cols="50"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="desc">Product Specification</label>
                                        <textarea name="especs" class="form-control" id="especs" cols="50"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 text-right">
                                        <button type="button" class="btn btn-outline-info" id="eadd_size">Add
                                            Size</button>
                                    </div>
                                </div>
                                <div id="sizesContainer"></div>
                                <div id="eadditionalSize"></div>
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
            <!-- Edit Product Form  End -->
            <div class="table-responsive">
                <table class="table table-bordered" id="productTable" style="width: 1100px;">
                    <thead>
                        <th>Sl. no.</th>
                        <!-- <th>Order Number</th> -->
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Product Code</th>
                        <th>Brand Name</th>
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
        $('#cat_name, #sub_cat, #ssct, #brand').select2();

        $('body').on('keyup', ".onlychars", function (event) {
            this.value = this.value.replace(/[^[A-Za-z ]]*/gi, '');
        });
        $('body').on('keyup', ".onlynum", function (event) {
            this.value = this.value.replace(/[^[0-9]]*/gi, '');
        });
        $('body').on('keyup', ".onlyalphanum", function (event) {
            this.value = this.value.replace(/[^[A-Za-z0-9]]*/gi, '');
        });
        $('body').on('keyup', ".onlyalphanumhyp", function (event) {
            this.value = this.value.replace(/[^a-zA-Z0-9,\-]/g, '');
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
        ClassicEditor
            .create(document.querySelector('#edesc'))
            .then(editor => {
                // var overviewData = response.data.product.overview;
                // editor.setData(overviewData);
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#specs'))
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

        $('#sub_cat').change(function () {
            var catID = $(this).val();
            if (catID != '') {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('admin/fetchsubSububCategoryData') ?>",
                    data: {
                        'id': catID
                    },
                    success: function (res) {
                        console.log(res);
                        if (res.status == 'success') {
                            var options = '<option value="">Please choose an option</option>';
                            $.each(res.message, function (index, value) {
                                options += '<option value="' + value.id + '">' + value.ssname + '</option>';
                            });
                            $('#ssct').html(options);
                        } else {
                            $('#ssct').html('<option value="">No variants found</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching subcategories:", error);
                        $('#ssct').html('<option value="">Error fetching subcategories</option>');
                    }
                });
            } else {
                $.notify("Please choose a category first", "error");
                $('#sub_cat').html('<option value="">Please choose a category first</option>');
            }
        });

        var maxSizes = 5;
        var countSize = 0;

        $('#add_size').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            if (countSize < maxSizes) {
                var newSize = '<div class="row mt-2">' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="Size">Size</label>' +
                    '<select class="form-control" name="product_size[]" id="product_size">' +
                    '<option value="" selected="selected">Please choose an option</option>' +
                    '<?php foreach ($unit as $option): ?>' +
                        '<option value="<?php echo $option['s_id']; ?>">' +
                        '<?php echo $option['sname']; ?>' +
                        '</option>' +
                        '<?php endforeach; ?>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="mrp">MRP (In Rs)</label>' +
                    '<input type="text" class="form-control onlynum" name="mrp[]" id="mrp" placeholder="Enter MRP (Eg. 1000)">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="sp">Selling Price</label>' +
                    '<input type="text" class="form-control onlynum" name="sp[]" id="sp" placeholder="Enter Selling Price (Eg. 1000)">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="prstck">Product Stock</label>' +
                    '<input type="text" class="form-control onlynum" name="product_stock[]" id="product_stock" placeholder="Enter Product Stock (Eg. 10)">' +
                    '</div>' +
                    '</div>' +
                    ' <div class="col-lg-6 col-md-6 mt-2">' +
                    '<div class="form-group">' +
                    ' <label for="primg">Product Image</label>' +
                    '<input type="file" class="form-control" name="product_image[]" id="product_image" accept=".jpg, .png, .jpeg">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 mt-4">' +
                    '<button type="button" class="btn btn-outline-danger btn-sm remove-size"><i class="fa-solid fa-xmark"></i></button>' +
                    '</div>' +
                    '</div>';
                $('#additionalSize').append(newSize);
                countSize++;
            } else {
                $.notify('Maximum ' + maxSizes + ' additional sizes allowed.');
            }
        });

        $('#additionalSize').on('click', '.remove-size', function () {
            $(this).closest('.row').remove();
            countSize--;
            // console.log('click');
        });

        $('#eadd_size').click(function (e) {
            e.preventDefault();
            if (countSize < maxSizes) {
                var newSize = '<div class="row mt-2">' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="Size">Size</label>' +
                    '<select class="form-control" name="eproduct_size[]" id="eproduct_size">' +
                    '<option value="" selected="selected">Please choose an option</option>' +
                    '<?php foreach ($unit as $option): ?>' +
                        '<option value="<?php echo $option['s_id']; ?>">' +
                        '<?php echo $option['sname']; ?>' +
                        '</option>' +
                        '<?php endforeach; ?>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="mrp">MRP (In Rs)</label>' +
                    '<input type="text" class="form-control onlynum" name="emrp[]" id="emrp" placeholder="Enter MRP (Eg. 1000)">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="sp">Selling Price</label>' +
                    '<input type="text" class="form-control onlynum" name="esp[]" id="esp" placeholder="Enter Selling Price (Eg. 1000)">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="prstck">Product Stock</label>' +
                    '<input type="text" class="form-control onlynum" name="eproduct_stock[]" id="eproduct_stock" placeholder="Enter Product Stock (Eg. 10)">' +
                    '</div>' +
                    '</div>' +
                    ' <div class="col-lg-6 col-md-6 mt-2">' +
                    '<div class="form-group">' +
                    ' <label for="primg">Product Image</label>' +
                    '<input type="file" class="form-control" name="eproduct_image[]" id="eproduct_image" accept=".jpg, .png, .jpeg">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 mt-4">' +
                    '<button type="button" class="btn btn-outline-danger btn-sm eremove-size"><i class="fa-solid fa-xmark"></i></button>' +
                    '</div>' +
                    '</div>';
                $('#eadditionalSize').append(newSize);
                countSize++;
            } else {
                $.notify('Maximum ' + maxSizes + ' additional sizes allowed.');
            }
        })

        $('#eadditionalSize').on('click', '.eremove-size', function () {
            $(this).closest('.row').remove();
            countSize--;
            // console.log('click');
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
                                message: "Please Enter Product Title"
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
                    'ssct': {
                        validators: {
                            notEmpty: {
                                message: 'Please select Sub Sub-Category'
                            }
                        }
                    },
                    'product_code': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Product Code'
                            },
                            remote: {
                                message: 'Product Code is Existing!',
                                url: '<?= base_url('admin/validateProductCode'); ?>'
                            },
                        }
                    },
                    'brand': {
                        validators: {
                            notEmpty: {
                                message: "Please select Brand Name"
                            }
                        }
                    },
                    'orderno': {
                        validators: {
                            notEmpty: {
                                message: 'Please enter product Order Number'
                            }
                        }
                    },
                    'desc': {
                        validators: {
                            notEmpty: {
                                message: 'Please Enter Product Description',
                            }
                        }
                    },
                    'product_size[]': {
                        validators: {
                            notEmpty: {
                                message: "Please choose size"
                            }
                        }
                    },
                    'mrp[]': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter MRP of the Product"
                            }
                        }
                    },
                    'sp[]': {
                        validators: {
                            notEmpty: {
                                message: "Please Enter Selling Price"
                            }
                        }
                    },
                    'tax': {
                        validators: {
                            notEmpty: {
                                message: 'Please Enter Tax'
                            }
                        }
                    },
                    'product_image[]': {
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
                            // $('input, select').val('');
                            $form[0].reset();
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

        var table = $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            order: [[2, 'desc']],
            "fnCreatedRow": function (row, data, index) {
                var pageInfo = table.page.info();
                var currentPage = pageInfo.page;
                var pageLength = pageInfo.length;
                var rowNumber = index + 1 + (currentPage * pageLength);
                $('td', row).eq(0).html(rowNumber);
            },
            columnDefs: [
                { targets: [0, 1, 7, 8], orderable: false }
            ],
            ajax: {
                url: "<?= base_url('admin/fetchproducts') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            }
        });


        $(document).on('click', '#statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var prdId = data[0];
            var status = $(this).data('status');
            var dataID = $(this).data('id');
            // console.log(prdId, dataID, status);
            $.ajax({
                method: 'POST',
                url: "<?= base_url('admin/productToggleStatus') ?>",
                data: {
                    'id': prdId,
                    'sts': status,
                    'dataId': dataID
                },
                success: function (res) {
                    // console.log(res);
                    if (res.status === 1) {
                        button.data('status', 'active').text('Active');
                        button.removeClass('btn-outline-danger').addClass('btn-outline-success');
                    } else {
                        button.data('status', 'inactive').text('In-Active');
                        button.removeClass('btn-outline-success').addClass('btn-outline-danger');
                    }
                }
            });
        });

        $(document).on('click', '#editProd', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var prId = data[0];
            // console.log(prId);
            $('#productId').val(prId);
            $.ajax({
                method: 'POST',
                url: "<?= base_url('admin/editProductData') ?>",
                data: {
                    'id': prId
                },
                success: function (response) {
                    // console.log(response);

                    if (response.status == 'success') {

                        var sc = response.data.product.cat_id;
                        $.ajax({
                            method: 'POST',
                            url: "<?= base_url('admin/sub_cat_retrive') ?>",
                            data: {
                                'id': sc,
                            },
                            success: function (res) {
                                // console.log(res);
                                $('#esub_cat').empty();
                                $.each(res.message, function (index, subcat) {
                                    $('#esub_cat').append($('<option>', {
                                        value: subcat.id,
                                        text: subcat.sname
                                    }));
                                });
                                $('#esub_cat').val(response.data.product.subcat_id);
                            }
                        });

                        var ssc = response.data.product.subcat_id;
                        $.ajax({
                            method: 'POST',
                            url: "<?= base_url('admin/sub_sub_cat_retrive') ?>",
                            data: {
                                'id': ssc,
                            },
                            success: function (res) {
                                // console.log(res);
                                $('#ess_cat').empty();
                                $.each(res.message, function (index, ssubcat) {
                                    $('#ess_cat').append($('<option>', {
                                        value: ssubcat.id,
                                        text: ssubcat.ssname
                                    }));
                                });
                                $('#ess_cat').val(response.data.product.sub_sub_id);
                            }
                        });



                        $('#eproduct_name').val(response.data.product.ptitle);
                        $('#ecat_name').val(response.data.product.cat_id);
                        $('#eproduct_code').val(response.data.product.pcode);
                        $('#ebrand').val(response.data.product.brand_id);
                        $('#etax').val(response.data.product.tax);
                        $('#eorderno').val(response.data.product.orderno);
                        $('#edesc').val(response.data.product.overview);
                        $('#especs').val(response.data.product.pspec);

                        $('#sizesContainer').html('');

                        response.data.sizes.forEach(function (size, index) {
                            var sizeHtml = `
                            <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <label for="Sizes">Size</label><span class="text-danger">*</span>
                                <select class="form-control" name="eproduct_size[]" id="eproduct_size_${index}">
                                    <option value="">Please choose an option</option>`;

                            response.data.sizeMaster.forEach(function (sizeMaster) {
                                sizeHtml += `<option value="${sizeMaster.s_id}" ${size.sid == sizeMaster.s_id ? 'selected' : ''}>${sizeMaster.sname}</option>`;
                            });

                            sizeHtml += `
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <label for="mrp">MRP (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="emrp[]" id="emrp_${index}" value="${size.mrp}">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <label for="sp">Selling Price (In Rs)</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynum" name="esp[]" id="esp_${index}" value="${size.selling_price}">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <label for="prstck">Product Stock</label>
                                <input type="text" class="form-control onlynum" name="eproduct_stock[]" id="eproduct_stock_${index}" value="${size.stock}">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label for="primg">Product Image</label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" name="eproduct_image[]" id="eproduct_image" accept=".jpg, .png, .jpeg">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="image">
                                <img src="<?= base_url('../assets/uploads/product/') ?>${response.data.images[index].p_image}" id="eproduct_image_${index}" style="height: 100px; width: 100px; padding: 10px;"/>            
                                </div>
                            </div>
                            </div> 
                              `;

                            $('#sizesContainer').append(sizeHtml);
                        });

                    } else {
                        $.notify(response.message, "error");
                    }
                }
            });
        });

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

        $(document).on('click', '#deleteCat', function () {
            // console.log('clicked');
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var prId = data[0];
            // console.log(prId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteProduct') ?>",
                data: {
                    'id': prId
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

        $.ajax({
            method: "GET",
            url: "<?= base_url('admin/fetchProductVariant') ?>",
            success: function (response) {
                // console.log(response);
                var productIds = response.product_ids;
                var counts = response.message;
                for (var pid in counts) {
                    if (productIds.includes(pid)) {
                        // console.log('Matching data:', pid, counts[pid]);
                        $('.badge').each(function (index) {
                            var pid = productIds[index];
                            var countsForPid = counts[pid];

                            if (countsForPid > 1) {
                                $('#badge_' + pid).text(countsForPid + " Variants").css('color', '#fff');
                            } else {
                                $('#badge_' + pid).hide();
                            }
                        });
                    }
                }
            }
        });

    });
</script>

<?= $this->endSection() ?>