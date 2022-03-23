<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/3/2020
 * Time: 5:27 PM
 */
?>

<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder"><?= t('add_user') ?></h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                              height="2" rx="1"
                                                                              transform="rotate(-45 6 17.3137)"
                                                                              fill="black"/>
																		<rect x="7.41422" y="6" width="16" height="2"
                                                                              rx="1" transform="rotate(45 7.41422 6)"
                                                                              fill="black"/>
																	</svg>
																</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                         data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                         data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="d-block fw-bold fs-6 mb-5">Avatar</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                                 style="background-image: url('<?= base_url() ?>/assets/admin/img/img_photo_default.png')">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                       title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="uploadfile"/>
                                    <input type="hidden" name="avatar_remove"/>
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                      data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                      title="Cancel avatar">
																				<i class="bi bi-x fs-2"></i>
																			</span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                      data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                      title="Remove avatar">
																				<i class="bi bi-x fs-2"></i>
																			</span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2"><?= t('id') ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" name="id" id="id" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="<?= t('input_id') ?>" value=""/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2"><?= t('name') ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="<?= t('input_name') ?>" value=""/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6 title-flex">
                                <label class="center_align_title_td"><?= t('pwd') ?></label>
                                <input type="password" class="form-control form-control-solid mb-3 mb-lg-0" id="pwd" name="pwd"
                                       placeholder="<?= t('input_password') ?>"/>
                            </div>
                            <div class="col-md-6 title-flex">
                                <label class="center_align_title_td"><?= t('status') ?></label>
                                <select  class="form-control form-control-solid mb-3 mb-lg-0" id="status" name="status">
                                    <option value="<?= STATUS_NORMAL ?>"><?= t('normal') ?></option>
                                    <option value="<?= USER_STATUS_PAUSE ?>"><?= t('pause') ?></option>
                                    <option value="<?= USER_STATUS_EXIT ?>"><?= t('exit') ?></option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="user_uid" name="user_uid"/>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel"><?= t('close') ?>
                        </button>
                        <button type="button" class="btn btn-primary" data-kt-users-modal-action="submit" onclick="UserEditPopup.onModify()">
                            <span class="indicator-label"><?= t('add') ?></span>
                            <span class="indicator-progress">Please wait...
																		<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->

<script>
    // Class Definition
    var UserEditPopup = function () {
        var _URL = window.URL || window.webkitURL;

        var editModal;
        var rootObj;
        var form;
        var selectedPhoto;

        var initView = function () {
            editModal = new bootstrap.Modal(document.getElementById('kt_modal_add_user'), {
                keyboard: false
            });
            rootObj = $('#kt_modal_add_user');
            form = document.getElementById('kt_modal_add_user').querySelector('#kt_modal_add_user_form');
        };

        var initHandler = function () {
            rootObj.find('#uploadfile').change(function () {
                if ((selectedPhoto = this.files[0]) != null) {
                    var img = new Image();
                    img.onload = function () {
                        if (this.width > 0 && this.width != this.height) {
                            showNotification('<?= t("msg_select_profile_img_size") ?>');
                            selectedPhoto = null;
                            return false;
                        }

                        readURL(rootObj.find('#profile_img'), rootObj.find('#uploadfile')[0]);
                        rootObj.find("#profile_img").show();
                    };
                    img.onerror = function () {
                        //alert( "not a valid file: " + file.type);
                    };
                    img.src = _URL.createObjectURL(selectedPhoto);
                }
            });

            rootObj.find('[data-kt-users-modal-action="close"]').click(function () {
                editModal.hide();
            });
        };

        var ajaxModify = function () {
            var id = rootObj.find('#id').val();
            var name = rootObj.find('#name').val();
            var pwd = rootObj.find('#pwd').val();

            if (id === '') {
                showNotification("<?=t('msg_input_email')?>");
                rootObj.find('#id').focus();
                return;
            }
            if (validateEmail(id) === false) {
                showNotification("<?=t('msg_input_valid_email')?>");
                return;
            }

            if (name === '') {
                showNotification("<?=t('msg_input_name')?>");
                rootObj.find('#name').focus();
                return;
            }

            if (pwd === '') {
                showNotification("<?=t('msg_input_pwd')?>");
                rootObj.find('#pwd').focus();
                return;
            }

            if (selectedPhoto == null) {
                showNotification("<?=t('select_photo')?>");
                return;
            }

            var data = new FormData();
            //Form data
            var form_data = $(form).serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            if (selectedPhoto != null) {
                data.append("uploadfile", selectedPhoto);
            }

            $.ajax({
                url: '<?= site_url("admin/user/ajax_save") ?>',
                type: 'POST',
                processData: false,
                contentType: false,
                data: data,
                dataType: "json",
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        editModal.hide();
                        UserList.redraw();
                    } else if (response.result == '<?=AJAX_RESULT_DUP?>') {
                        showNotification("<?=t('error_email_duplicated')?>");
                    } else {
                        showNotification("<?=t('msg_error_request')?>");
                    }
                },
                error: function (a, b, c) {
                    showAlertError('<?=t('msg_error_server')?>');
                }
            });
        };

        return {
            init: function () {
                initView();
                initHandler();
            },
            onModify: function () {
                ajaxModify();
            },
            show: function (userInfo = null) {
                if (userInfo == null) {
                    rootObj.find('.modal-title').html('<?= t('add_user')?>');
                    rootObj.find('.modal-title').html('<?= t('add_user')?>');
                    rootObj.find('#id').val('');
                    rootObj.find('#name').val('');
                    rootObj.find('#pwd').val('');
                    rootObj.find('#status').val('<?=STATUS_NORMAL?>');
                    rootObj.find("#profile_img").hide();
                    rootObj.find('#user_uid').val('');
                    rootObj.find('#btn_save').html('&nbsp;&nbsp;<?= t('add')?>&nbsp;&nbsp;');

                    editModal.show();
                } else {
                    rootObj.find('.modal-title').html('<?= t('modify')?>');
                    rootObj.find('#id').val(userInfo['id']);
                    rootObj.find('#name').val(userInfo['name']);
                    rootObj.find('#pwd').val(userInfo['pwd']);
                    rootObj.find('#status').val(userInfo['status']);
                    selectedPhoto = userInfo['profile_url'];
                    if (empty(userInfo['profile_url'])) {
                        rootObj.find("#image-input-wrapper").css('background-image', '');
                    } else {
                        rootObj.find("#image-input-wrapper").css('background-image', 'url('+userInfo['profile_url']+')');
                    }
                    rootObj.find('#user_uid').val(userInfo['uid']);
                    rootObj.find('#btn_save').html('&nbsp;&nbsp;<?= t('modify')?>&nbsp;&nbsp;');

                    editModal.show();
                }
            },
        }
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            UserEditPopup.init();
        });
    });
</script>