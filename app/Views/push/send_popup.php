<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/5/2020
 * Time: 11:27 PM
 */
?>

<div class="modal fade in" id="send_modal" tabindex="-1" aria-hidden="true" style="display: none; padding-right: 16px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?=t('notification')?></h4>
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
            <div class="modal-body">
                <form id="send_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="center_align_title_td"><?=t('title')?></td>
                                    <td class="fields_td">
                                        <input type="text" class="form-control" id="title" name="title" placeholder=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center_align_title_td"><?=t('content')?></td>
                                    <td class="fields_td">
                                            <textarea type="text" class="form-control" id="content" name="content"
                                                      placeholder="" rows="5" style="resize: none;"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?=t('send_100')?></td>
                                    <td class="fields_td">
                                        <input type='checkbox' id="cb_check_all"/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" id="uid" name="uid"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align: center; border-top: none;">
                <button type="button" class="btn btn-primary" id="btn_save" onclick="SendPushPopup.onSend()">&nbsp;&nbsp;<?=t('add')?>&nbsp;&nbsp;
                </button>
                <button type="button" class="btn btn-secondary btn-outline" id="btn_cancel" data-dismiss="modal">&nbsp;&nbsp;<?=t('close')?>&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<script>
    // Class Definition
    var SendPushPopup = function () {
        var modal;
        var element;
        var form;

        var initView = function () {
            element = document.getElementById('send_modal');
            form = element.querySelector('#send_modal_form');
            modal = new bootstrap.Modal(element);
        };

        var initHandler = function () {
            const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
            closeButton.addEventListener('click', function (e) {
                e.preventDefault();

                modal.hide();
            });
            const  cancelButton = element.querySelector('#btn_cancel');
            cancelButton.addEventListener('click', function (e) {
                e.preventDefault();

                modal.hide();
            });
        };

        var ajaxSendPush = function () {
            const rootObj = $(element);

            var title = rootObj.find('#title').val();
            var content = rootObj.find('#content').val();
            var once_100 = rootObj.find('#cb_check_all').checked;

            if (title == '' || content == '') {
                showNotification( "<?=t('msg_input_all')?>");
                return;
            }

            $.ajax({
                url: '<?= site_url("admin/push/ajax_send_push") ?>',
                type: 'POST',
                data: {
                    title: title,
                    content: content,
                    once_100: once_100,
                },
                dataType: 'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        modal.hide();
                        PushList.redraw();
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
            onSend: function () {
                ajaxSendPush();
            },
            show: function () {
                const rootObj = $(element);
                rootObj.find('.modal-title').html('<?= t('notification')?>');
                rootObj.find('#title').val('');
                rootObj.find('#content').val('');
                rootObj.find('#btn_save').html('&nbsp;&nbsp;<?= t('add')?>&nbsp;&nbsp;');

                modal.show();
            }
        };
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            SendPushPopup.init();
        });
    });
</script>
