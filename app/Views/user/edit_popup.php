<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/3/2020
 * Time: 5:27 PM
 */

?>

<div class="modal fade in" id="edit_modal" tabindex="-1" aria-hidden="true"
     style="display: none; padding-right: 16px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?=t('add_user')?></h4>
            </div>
            <div class="modal-body">
                <form id="frm_edit">
                    <div class="row">
                        <div class="col-md-6 title-flex">
                            <label class="center_align_title_td"><?= t('id') ?></label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="<?=t('input_id')?>"/>
                        </div>
                        <div class="col-md-6 title-flex">
                            <label class="center_align_title_td"><?= t('name') ?></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?=t('input_name')?>"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 title-flex">
                            <label class="center_align_title_td"><?= t('pwd') ?></label>
                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="<?=t('input_password')?>"/>
                        </div>
                        <div class="col-md-6 title-flex">
                            <label class="center_align_title_td"><?= t('status') ?></label>
                            <select class="form-control" id="status" name="status">
                                <option value="<?=STATUS_NORMAL?>"><?=t('normal')?></option>
                                <option value="<?=USER_STATUS_PAUSE?>""><?=t('pause')?></option>
                                <option value="<?=USER_STATUS_EXIT?>"><?=t('exit')?></option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="padding: 10px 20px;">
                            <div class="profile" style="display:inline;">
                                <img src="<?= base_url() ?>/assets/admin/img/img_photo_default.png" alt="" class="bg"/>
                                <img id="profile_img" name="profile_img" class="img image-popup-no-margins"/>
                                <img src="<?= base_url() ?>/assets/admin/img/ic_close_black.png" alt="" style="" id="img_del" class="del"/>
                                <input type="file" id="uploadfile" name="uploadfile" style="display: none;">
                            </div>
                            <a class="btn btn-default" style="vertical-align: bottom; margin-left: 110px;" id="btn_upload_photo"><?= t('file_select') ?></a>
                        </div>
                    </div>
                    <input type="hidden" id="user_uid" name="user_uid"/>
                </form>
            </div>
            <div class="modal-footer" style="text-align: center; border-top: none; margin-top: 30px;">
                <button type="button" class="btn btn-primary" id="btn_save">&nbsp;&nbsp;<?=t('add')?>&nbsp;&nbsp;
                </button>
                <button type="button" class="btn dark btn-secondary" id="btn_cancel" data-dismiss="modal">&nbsp;&nbsp;<?=t('close')?>&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script>
    const rootEditModelID = "#edit_modal";
    var _URL = window.URL || window.webkitURL;
    $(function () {
        $(getId_1('#btn_upload_photo')).click(function () {
            $(getId_1('#uploadfile')).click();
        });
        $(getId_1('#uploadfile')).change(function () {
            if ((file = this.files[0])) {
                var img = new Image();
                img.onload = function() {
                    if(this.width > 0 && this.width != this.height) {
                        showNotification("<?=t('error')?>", '<?= t("msg_select_profile_img_size") ?>', "warning");
                        return false;
                    }

                    readURL(getId_1('#profile_img'), $(getId_1('#uploadfile'))[0]);
                    $(getId_1("#profile_img")).show();
                };
                img.onerror = function() {
                    //alert( "not a valid file: " + file.type);
                };
                img.src = _URL.createObjectURL(file);
            }
        });
        $(getId_1("#img_del")).click(function () {
            $(getId_1("#profile_img")).hide();
            $(getId_1('#uploadfile')).val('');
        });

        $(getId_1('#btn_save')).click(function () {
            if ($(getId_1('#id')).val() == '') {
                showNotification("<?=t('error')?>", "<?=t('msg_input_id')?>", "warning");
                $(getId_1('#id')).focus();
                return;
            }

            if(validateEmail($(getId_1('#id')).val()) == false) {
                showNotification("<?=t('error')?>", "<?=t('msg_input_email')?>", "warning");
                return;
            }

            if ($(getId_1('#name')).val() == '') {
                showNotification("<?=t('error')?>", "<?=t('msg_input_name')?>", "warning");
                $(getId_1('#name')).focus();
                return;
            }

            if ($(getId_1('#pwd')).val() == '') {
                showNotification("<?=t('error')?>", "<?=t('msg_input_pwd')?>", "warning");
                $(getId_1('#pwd')).focus();
                return;
            }

            if ($(getId_1("#profile_img")).css("display") == "none") {
                showNotification("<?=t('error')?>", "<?=t('select_photo')?>", "warning");
                return;
            }

            var data = new FormData();
            //Form data
            var form_data = $(getId_1('#frm_edit')).serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            //File data
            var file_data = $(getId_1('#uploadfile'))[0].files;
            if(file_data.length > 0) {
                data.append("uploadfile", file_data[0]);
            }

            $.ajax({
                url: '<?= site_url("admin/user/ajax_save") ?>',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    showLoading();
                },
                success: function (result) {
                    hideLoading();
                    if (result == '<?=AJAX_RESULT_SUCCESS?>') {
                        $('#edit_modal').modal('hide');
                        oTable.draw(true);
                    } else if (result == '<?=AJAX_RESULT_DUP?>') {
                        showNotification("<?=t('error')?>", "<?=t('error_email_duplicated')?>", "error");
                    } else {
                        showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                    }
                }
            });
        });
    });

    function getId_1(css_identifier) {
        return rootEditModelID + " " + css_identifier;
    }

    function showEditPopup(userInfo) {
        if(userInfo == null) {
            $(getId_1('.modal-title')).html('<?= t('add_user')?>');
            $(getId_1('#id')).val('');
            $(getId_1('#name')).val('');
            $(getId_1('#pwd')).val('');
            $(getId_1('#status')).val('<?=STATUS_NORMAL?>');
            $(getId_1("#profile_img")).hide();
            $(getId_1('#user_uid')).val('');
            $(getId_1('#btn_save')).html('&nbsp;&nbsp;<?= t('add')?>&nbsp;&nbsp;');

            $(rootEditModelID).modal();
        }
        else {
            $(getId_1('.modal-title')).html('<?= t('modify')?>');
            $(getId_1('#id')).val(userInfo['id']);
            $(getId_1('#name')).val(userInfo['name']);
            $(getId_1('#pwd')).val(userInfo['pwd']);
            $(getId_1('#status')).val(userInfo['status']);
            if(empty(userInfo['profile_url'])) {
                $(getId_1("#profile_img")).hide();
            }
            else {
                $(getId_1("#profile_img")).attr('src', userInfo['profile_url']);
                $(getId_1("#profile_img")).show();
            }
            $(getId_1('#user_uid')).val(userInfo['uid']);
            $(getId_1('#btn_save')).html('&nbsp;&nbsp;<?= t('modify')?>&nbsp;&nbsp;');

            $(rootEditModelID).modal();
        }
    }
</script>