<!DOCTYPE html>

<html lang="en">
    <!--begin::Head-->
    <head>
        <meta charset="utf-8"/>
        <title>CI-Metronic-Template</title>

        <meta name="description" content="Login page example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Custom Styles(used by this page)-->
        <link href="<?= base_url() ?>/assets/metronic/css/pages/login/classic/login-5.css" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>/assets/metronic/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>/assets/metronic/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="<?= base_url() ?>/assets/admin/img/ic_logo.png"/>

        <!--begin:: Admin JS-->
        <link href="<?= base_url() ?>/assets/admin/css/login.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>/assets/common/js/jquery.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>/assets/common/js/jquery.form.js" type="text/javascript"></script>
        <!--end:: Admin JS-->
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background: #1B112A">
                    <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                        <!--begin::Login Header-->
                        <div class="d-flex flex-center mb-15">
                            <a href="#">
                                <img src="<?= base_url() ?>/assets/admin/img/ic_logo.png" class="max-h-75px" alt="" />
                            </a>
                        </div>
                        <!--end::Login Header-->
                        <!--begin::Login Sign in form-->
                        <div class="login-signin">
                            <div class="mb-20">
                                <h3 class="opacity-40 font-weight-normal"><?= t('login_title') ?></h3>
                                <p class="opacity-40">Enter your details to login to your account:</p>
                            </div>
                            <form class="form" id="kt_login_signin_form">
                                <div class="form-group">
                                    <input class="form-control h-auto text-white bg-white-o-30 rounded-pill border-0 py-4 px-8" type="text" placeholder="<?= t('id') ?>" name="id" id="id" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control h-auto text-white bg-white-o-30 rounded-pill border-0 py-4 px-8" type="password" placeholder="<?= t('pwd') ?>" name="pwd" id="pwd"/>
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                            <input type="checkbox" name="remember" />
                                            <span></span>Remember me</label>
                                    </div>
                                    <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forget Password ?</a>
                                </div>
                                <div class="form-group text-center mt-10">
                                    <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3"><?= t('login') ?></button>
                                </div>
                            </form>
                            <div class="mt-10">
                                <span class="opacity-40 mr-4">Don't have an account yet?</span>
                                <a href="javascript:;" id="kt_login_signup" class="text-white opacity-30 font-weight-normal">Sign Up</a>
                            </div>
                        </div>
                        <!--end::Login Sign in form-->
                        <!--begin::Login Sign up form-->
                        <div class="login-signup">
                            <div class="mb-20">
                                <h3 class="opacity-40 font-weight-normal">Sign Up</h3>
                                <p class="opacity-40">Enter your details to create your account</p>
                            </div>
                            <form class="form text-center" id="kt_login_signup_form">
                                <div class="form-group">
                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Fullname" name="fullname" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Confirm Password" name="cpassword" />
                                </div>
                                <div class="form-group text-left px-8">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-white opacity-60 text-white m-0">
                                            <input type="checkbox" name="agree" />
                                            <span></span>I Agree the
                                            <a href="#" class="text-white font-weight-bold ml-1">terms and conditions</a>.</label>
                                    </div>
                                    <div class="form-text text-muted text-center"></div>
                                </div>
                                <div class="form-group">
                                    <button id="kt_login_signup_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Sign Up</button>
                                    <button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!--end::Login Sign up form-->
                        <!--begin::Login forgot password form-->
                        <div class="login-forgot">
                            <div class="mb-20">
                                <h3 class="opacity-40 font-weight-normal">Forgotten Password ?</h3>
                                <p class="opacity-40">Enter your email to reset your password</p>
                            </div>
                            <form class="form" id="kt_login_forgot_form">
                                <div class="form-group mb-10">
                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <button id="kt_login_forgot_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Request</button>
                                    <button id="kt_login_forgot_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!--end::Login forgot password form-->
                    </div>
                </div>
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->

        <script>
            var KTLogin = function() {
                var _login;

                var _showForm = function(form) {
                    var cls = 'login-' + form + '-on';
                    var form = 'kt_login_' + form + '_form';

                    _login.removeClass('login-forgot-on');
                    _login.removeClass('login-signin-on');
                    _login.removeClass('login-signup-on');

                    _login.addClass(cls);

                    KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
                }

                var _handleSignInForm = function() {
                    var validation;

                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                    validation = FormValidation.formValidation(
                        KTUtil.getById('kt_login_signin_form'),
                        {
                            fields: {
                                id: {
                                    validators: {
                                        notEmpty: {
                                            message: "<?=t('msg_input_id')?>"
                                        }
                                    }
                                },
                                pwd: {
                                    validators: {
                                        notEmpty: {
                                            message:'<?= t('msg_input_pwd')?>'
                                        }
                                    }
                                }
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                submitButton: new FormValidation.plugins.SubmitButton(),
                                //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                                bootstrap: new FormValidation.plugins.Bootstrap()
                            }
                        }
                    );

                    $('#kt_login_signin_submit').on('click', function (e) {
                        e.preventDefault();

                        validation.validate().then(function(status) {
                            if (status == 'Valid') {
                                ajaxLogin();
                            } else {
                                swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function() {
                                    KTUtil.scrollTop();
                                });
                            }
                        });
                    });

                    // Handle forgot button
                    $('#kt_login_forgot').on('click', function (e) {
                        e.preventDefault();
                        _showForm('forgot');
                    });

                    // Handle signup
                    $('#kt_login_signup').on('click', function (e) {
                        e.preventDefault();
                        _showForm('signup');
                    });
                }

                // Public Functions
                return {
                    // public functions
                    init: function() {
                        _login = $('#kt_login');

                        _handleSignInForm();
                    }
                };
            }();

            $(function () {
                KTLogin.init();
            });

            function ajaxLogin() {
                var formId = "#kt_login_signin_form";
                $.ajax({
                    type: 'post',
                    url: '<?=site_url("Admin/Login/ajax_login")?>',
                    data: 'id=' + $('#id').val() + '&pwd=' + $('#pwd').val(),
                    beforeSend: function () {
                        KTApp.block(formId, {
                            overlayColor: 'red',
                            opacity: 0.1,
                            state: 'primary' // a bootstrap color
                        });
                    },
                    success: function (data) {
                        KTApp.unblock(formId);
                        const response = JSON.parse(data);
                        if (response['result'] == '<?=AJAX_RESULT_SUCCESS?>') {
                            location.href = "<?=site_url('Admin/Home')?>";
                        } else {
                            showSweetAlert("<?=t('msg_error_not_matching_user')?>", "btn-danger");
                        }
                    },
                    error: function (a, b, c) {
                        KTApp.unblock(formId);
                        showSweetAlert("<?=t('error_server')?>", "btn-danger");
                    }
                })
            }
        </script>

        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.js"></script>
        <script src="<?= base_url() ?>/assets/metronic/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="<?= base_url() ?>/assets/metronic/js/scripts.bundle.js"></script>
        <script src="<?= base_url() ?>/assets/metronic/js/pages/features/miscellaneous/blockui.js"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
<!--        <script src="--><?//= base_url() ?><!--/assets/metronic/js/pages/custom/login/login-general.js"></script>-->
        <!--end::Page Scripts-->

        <!--begin::Admin Scripts-->
        <script src="<?= base_url() ?>/assets/admin/js/common.js" type="text/javascript"></script>
        <!--end::Admin Scripts-->
    </body>
    <!--end::Body-->
</html>