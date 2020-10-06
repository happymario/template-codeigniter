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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?=t('notification')?></h4>
            </div>
            <div class="modal-body">
                <form id="frm_edit"  method="post" enctype="multipart/form-data">
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
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" id="uid" name="uid"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align: center; border-top: none;">
                <button type="button" class="btn dark" id="btn_save">&nbsp;&nbsp;<?=t('add')?>&nbsp;&nbsp;
                </button>
                <button type="button" class="btn dark btn-outline" id="btn_cancel" data-dismiss="modal">&nbsp;&nbsp;<?=t('close')?>&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<script>
    const rootEditModelID = "#send_modal";
    $(function () {
        $(getId_1('#btn_save')).click(function () {
            if ($(getId_1('#title')).val() == '' || $(getId_1('#content')).val() == '') {
                showNotification("<?=t('error')?>", "<?=t('msg_input_all')?>", "warning");
                $(getId_1('#id')).focus();
                return;
            }

            $.ajax({
                url: '<?= site_url("push/ajax_send_gotify") ?>',
                type: 'POST',
                data: {
                    title: $(getId_1('#title')).val(),
                    content: $(getId_1('#content')).val()
                },
                beforeSend: function () {
                    showLoading();
                },
                success: function (result) {
                    hideLoading();
                    if (result == '<?=AJAX_RESULT_SUCCESS?>') {
                        $(rootEditModelID).modal('hide');
                        onInit();
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

    function showSendPopup() {
        $(getId_1('.modal-title')).html('<?= t('notification')?>');
        $(getId_1('#title')).val('');
        $(getId_1('#content')).val('');
        $(getId_1('#btn_save')).html('&nbsp;&nbsp;<?= t('add')?>&nbsp;&nbsp;');

        $(rootEditModelID).modal();
    }
</script>
