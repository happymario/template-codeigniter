<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>CI-Metronic-Template</title>
    <link href="<?= base_url() ?>assets/admin/img/logo.png" rel="icon">
    <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= base_url() ?>assets/metronic/global/css/components.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?= base_url() ?>assets/metronic/pages/css/login.css" rel="stylesheet" type="text/css"/>
    <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
    <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet"
          type="text/css"/>
    <script src="<?= base_url() ?>assets/common/js/jquery.form.js" type="text/javascript"></script>
    <link href="<?= base_url() ?>assets/metronic/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>

<body>
<div class="logo">
</div>

<div class="content" style="margin-top: 200px;">
    <!-- BEGIN LOGIN FORM -->
    <form class="" action="" method="post"
          style="padding: 0px;width:400px;margin-top:200px;background-color:white;margin: auto" id="login_form">
        <div class="form-actions"
             style="height: 50px;background-color:#92d050;text-align: center;padding-top: 10px;padding-bottom: 10px;">
            <label style="color:white;font-weight: 700;font-size: 22px;"><?=t('login_title')?></label>
        </div>

        <div class="row" style="padding: 30px;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 14px;line-height: 42px;"><?=t('id')?></span>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" style="background-color: white;height: 38px;" name="id" id="id">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <span style="font-size: 14px;line-height: 42px;"><?=t('pwd')?></span>
                    </div>
                    <div class="col-md-9">
                        <input type="password" class="form-control" style="background-color: white;height: 38px;"
                               name="pwd" id="pwd">
                    </div>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <button type="submit" class="btn btn-success" style="width: 200px;background: #92d050;"><?=t('login')?></button>
            </div>
        </div>

    </form>
</div>

<script>
    var validator;
    var error1;
    $(function () {
        var login_form = $('#login_form');

        validator = login_form.validate({
            doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            messages: {
                id: {
                    required: "<?=t('msg_input_id')?>"
                },
                pwd: {
                    required: '<?= t('msg_input_pwd')?>'
                }
            },
            rules: {
                id: {
                    required: true
                },
                pwd: {
                    required: true
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            beforeSubmit: function () {
                console.log("before Submit");
            },
            submitHandler: function (form) {
                onLogin();
            }
        });
    })

    function onLogin() {
        $.ajax({
            type: 'post',
            url: '<?=site_url("login/login")?>',
            data: 'id=' + $('#id').val() + '&pwd=' + $('#pwd').val(),
            beforeSend: function () {
                App.blockUI({
                    animate: true,
                    target: '#login_form',
                    boxed: false
                });
            },
            success: function (data) {
                App.unblockUI('#login_form');
                if (data == "no_exist") {
                    showSweetAlert("<?=t('msg_error_not_matching_user')?>", "btn-danger");
                } else {
                    location.href = "<?=site_url('Home')?>";
                }
            },
            error: function (a, b, c) {
                App.unblockUI('#login_form');
                showSweetAlert("<?=t('error_server')?>", "btn-danger");
            }
        })
    }

</script>
<script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>

<script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/js/bootstrap.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-sweetalert/sweetalert.min.js"
        type="text/javascript"></script>
<script src="<?= base_url() ?>assets/admin/js/common.js" type="text/javascript"></script>

</body>
</html>