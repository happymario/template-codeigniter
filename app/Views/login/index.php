<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>CI-Metronic-Template</title>

    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="canonical" href="https://keenthemes.com/metronic"/>
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/metronic/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!--begin:: Admin JS-->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/admin/img/ic_logo.png"/>
    <link href="<?= base_url() ?>/assets/admin/css/login.css" rel="stylesheet" type="text/css"/>
    <script src="<?= base_url() ?>/assets/common/js/jquery.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/jquery.form.js" type="text/javascript"></script>
    <!--end:: Admin JS-->
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="bg-dark">

<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="<?=base_url()?>" class="mb-12">
                <img alt="Logo" src="<?=base_url()?>/assets/admin/img/ic_logo.png" class="h-40px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="<?=base_url()?>/Admin/Home" action="#">
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark"><?=t('id')?></label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0"><?=t('pwd')?></label>
                            <!--end::Label-->
                            <!--begin::Link-->
<!--                            <a href="../../demo1/dist/authentication/layouts/dark/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>-->
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label"><?=t('login')?></span>
                            <span class="indicator-progress"><?=t('msg_waiting')?>
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                        <!--begin::Separator-->
<!--                        <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>-->
                        <!--end::Separator-->
                        <!--begin::Google link-->
<!--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">-->
<!--                            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Continue with Google</a>-->
                        <!--end::Google link-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
<!--            <div class="d-flex align-items-center fw-bold fs-6">-->
<!--                <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>-->
<!--                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>-->
<!--                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>-->
<!--            </div>-->
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->

<!--begin::Javascript-->
<script>
    "use strict";

    // Class definition
    var LoginGeneral = function() {
        // Elements
        var form;
        var submitButton;
        var validator;

        // Handle form
        var handleForm = function(e) {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'email': {
                            validators: {
                                notEmpty: {
                                    message: '<?=t('msg_input_email')?>'
                                },
                                //emailAddress: {
                                //    message:  '<?//=t('msg_input_valid_email')?>//'
                                //}
                            }
                        },
                        'password': {
                            validators: {
                                notEmpty: {
                                    message: '<?=t('msg_input_pwd')?>'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row'
                        })
                    }
                }
            );

            // Handle form submit
            submitButton.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();

                // Validate form
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        ajaxLogin();

                        // Simulate ajax request
                        // setTimeout(function() {
                        //
                        // }, 2000);
                    } else {
                        // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        showAlert('<?=t('msg_input_all')?>');
                    }
                });
            });
        };

        var ajaxLogin = function () {
            $.ajax({
                type: 'post',
                url: '<?=site_url("Admin/Login/ajax_login")?>',
                data: 'id=' + $('[name="email"]').val() + '&pwd=' + $('[name="password"]').val(),
                dataType: 'json',
                beforeSend: function () {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;
                },
                success: function (response) {

                    // Hide loading indication
                    submitButton.removeAttribute('data-kt-indicator');

                    // Enable button
                    submitButton.disabled = false;

                    if (response['result'] == '<?=AJAX_RESULT_SUCCESS?>') {
                        showAlert('<?=t('msg_success_done')?>', '<?=t('confirm')?>', null, true, function (result) {
                            form.querySelector('[name="email"]').value = "";
                            form.querySelector('[name="password"]').value = "";

                            //form.submit(); // submit form
                            var redirectUrl = form.getAttribute('data-kt-redirect-url');
                            if (redirectUrl) {
                                location.href = redirectUrl;
                            }
                        });
                    }
                    else {
                        showAlertError('<?=t('msg_error_not_matching_user')?>');
                    }
                },
                error: function (a, b, c) {
                    // Hide loading indication
                    submitButton.removeAttribute('data-kt-indicator');

                    // Enable button
                    submitButton.disabled = false;

                    showAlertError('<?=t('error_server')?>');
                }
            })
        };

        // Public functions
        return {
            // Initialization
            init: function() {
                form = document.querySelector('#kt_sign_in_form');
                submitButton = document.querySelector('#kt_sign_in_submit');

                handleForm();
            }
        };
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            LoginGeneral.init();
        });
    });
</script>

<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url() ?>/assets/metronic/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="<?= base_url() ?>/assets/admin/js/common.js" type="text/javascript"></script>
<!--end::Page Custom Javascript-->

<!--end::Javascript-->

</body>
<!--end::Body-->
</html>