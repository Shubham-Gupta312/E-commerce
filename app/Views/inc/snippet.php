<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sri Krishna Ghee</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/" />
    <link href="<?= ASSET_URL ?>public/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= ASSET_URL ?>public/dist/js/pages/chartist/chartist-init.css" rel="stylesheet">
    <link href="<?= ASSET_URL ?>public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="<?= ASSET_URL ?>public/assets/libs/c3/c3.min.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?= ASSET_URL ?>public/assets/libs/jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= ASSET_URL ?>public/dist/css/style.min.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- ============================================================== -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <!-- ============================================================== -->

    <style>
        /* #main-wrapper[data-layout="vertical"][data-sidebartype="full"] .page-wrapper {
            margin-left: 0;
        } */

        .page-wrapper {
            /* margin-left: 15rem; */
            margin-top: 2rem;
        }

        .category_container {
            border: 1px solid #333;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            background-color: #fff;
        }

        #CategoryTable_wrapper {
            margin-top: 15px;
        }

        .help-block {
            color: #cc0000;
        }

        .note_form {
            margin-top: -12px;
            overflow: hidden;
        }

        .float-end {
            float: right;
        }
    </style>

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <?= $this->include('inc/header') ?>
    <?= $this->renderSection('content') ?>


    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- <script src="<?= ASSET_URL ?>public/assets/libs/jquery/dist/jquery.min.js"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= ASSET_URL ?>public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= ASSET_URL ?>public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?= ASSET_URL ?>public/dist/js/app.min.js"></script>
    <script src="<?= ASSET_URL ?>public/dist/js/app.init.js"></script>
    <script src="<?= ASSET_URL ?>public/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= ASSET_URL ?>public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= ASSET_URL ?>public/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?= ASSET_URL ?>public/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= ASSET_URL ?>public/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= ASSET_URL ?>public/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- chartist chart -->
    <script src="<?= ASSET_URL ?>public/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?= ASSET_URL ?>public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="<?= ASSET_URL ?>public/assets/libs/d3/dist/d3.min.js"></script>
    <script src="<?= ASSET_URL ?>public/assets/libs/c3/c3.min.js"></script>
    <!-- Vector map JavaScript -->
    <script src="<?= ASSET_URL ?>public/assets/libs/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="<?= ASSET_URL ?>public/assets/extra-libs/jvector/jquery-jvectormap-us-aea-en.js"></script>
    <!-- Chart JS -->
    <script src="<?= ASSET_URL ?>public/dist/js/pages/dashboards/dashboard2.js"></script>
</body>

</html>