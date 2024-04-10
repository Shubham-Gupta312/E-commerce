<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sri Krishna Ghee</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .has-error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url(../assets/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
            <div class="auth-box p-4 bg-white rounded">
                <div>
                    <div class="logo">
                        <h3 class="box-title mb-3">Sign In</h3>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 form-material" id="loginform">
                                <div class="form-group mb-3 ">
                                    <div class="col-xs-12">
                                        <input class="form-control onlyalpnm" type="text" name="username" id="username"
                                            required="" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group mb-3 ">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password"
                                            id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group text-center mb-3">
                                    <div class="col-xs-12">
                                        <button
                                            class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                            name="submit" id="submit" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="error-msg">
                                    <span class="error"></span>
                                </div>
                                <!-- <div class="form-group mb-0 mt-2 ">
                                    <div class="col-sm-12 justify-content-center d-flex">
                                        <p>Don't have an account? <a href="<?= base_url('register') ?>"
                                                class="text-info font-weight-normal ml-1">Sign Up</a></p>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <!-- <script src="../assets/libs/jquery/dist/jquery.min.js "></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <script>

    </script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jquery Validation Plugin -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <!-- ============================================================== -->
    <script>
        $(document).ready(function () {
            jQuery(document).ready(function (e) {

                $('body').on('keyup', ".onlyalpnm", function (event) {
                    this.value = this.value.replace(/[^[A-Za-z0-9]]*/gi, '');
                });

                $('#loginform').bootstrapValidator({
                    fields: {
                        'username': {
                            validators: {
                                notEmpty: {
                                    message: "Please enter username."
                                },
                            }
                        },
                        'password': {
                            validators: {
                                notEmpty: {
                                    message: "Please enter password."
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]*$/,
                                    message: 'Password can only contain alphabets, numbers, and special characters.'
                                },
                                stringLength: {
                                    min: 6,
                                    message: 'Password must be at least 6 characters long'
                                }
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
                        url: "<?= base_url('admin/login') ?>",
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            // console.log(response);
                            if (response.status === 'success') {
                                $.notify(response.message, "success");
                                setTimeout(function () {
                                    window.location.href = "<?= base_url('admin/dashboard') ?>";
                                }, 300);
                                // alert('You are Logged in!');
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
        });
    </script>
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip "]').tooltip();
        $(".preloader ").fadeOut();
    </script>
</body>

</html>