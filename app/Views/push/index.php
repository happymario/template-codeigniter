<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 3:46 PM
 */
?>

<div class="row" style="margin-top: 20px;">
    <form id="frm_search" role="form">
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="20%" class="center_align_title_td"><?=t('search_word')?></td>
                        <td width="80%" class="padding_1">
                            <input class="form-control" id="search_keyword" placeholder="<?=t('title')?>, <?=t('content')?>">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12" align="center">
                <a class="btn dark" onclick="onSearch()">&nbsp;<?=t('search')?></a>
                <a class="btn dark btn-outline" onclick="onInit()">&nbsp;&nbsp;<?=t('initialize')?>&nbsp;&nbsp;</a>
            </div>

            <div class="col-md-12" style="display: flex;">
                <a class="btn blue" onclick="onResendAll()">&nbsp;&nbsp;<?=t('resend')?>&nbsp;&nbsp;</a>
                <div style="text-align: right; flex: 1;">
                <a class="btn blue" onclick="onSend()">&nbsp;&nbsp;<?=t('send')?>&nbsp;&nbsp;</a>
                </div>
            </div>
        </div>
    </form>

    <div class="col-md-12" style="margin-top: 20px;">
        <table id="tbl_datatable" class="table table-bordered table-primary" style="width: 100%">
            <thead class="th_custom_color">
                <th class="no-sort"><input type='checkbox' id="cb_check_all"/></th>
                <th><?=t('number')?></th>
                <th><?=t('sender')?></th>
                <th><?=t('receiver')?></th>
                <th><?=t('title')?></th>
                <th><?=t('content')?></th>
                <th><?=t('date_time')?></th>
                <th><?=t('manage')?></th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<?php
require dirname(__FILE__) . "/send_popup.php";
?>

<script>
    var oTable;
    $(function () {
        oTable = $('#tbl_datatable').DataTable({
            stateSave: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            language: {
                "emptyTable": '<?=t('no_data')?>',
                "info": "<span style='font-weight: 700'><?= t('all')?></span> <span style='font-weight: 700;' class='color_white_blue'>_TOTAL_</span>",
                "infoEmpty": "",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ ",
                "search": "Search:",
                "zeroRecords": '<?= t('no_data')?>'
            },
            ajax: { // define ajax settings
                "url": "<?=site_url('admin/push/ajax_table')?>", // ajax URL
                "type": "POST",
                "data": function (data) {
                    onSetSearchParams(data);
                },
            },
            columnDefs: [
                {targets: '_all', orderable: false}
            ],
            order: [],
            createdRow: function (row, data, dataIndex) {
                $('td:eq(0)', row).html("<input name='check-cell' type='checkbox' value='"+ data['uid'] +"' />");
                $('td:last', row).html("<a class='btn-edit' onclick='onResend(" + data['uid'] + ")'><?= t('resend')?></a>&nbsp;&nbsp;"
                    + "<a class='btn-delete' data-value='" + data['uid'] + "'><?= t('delete')?></a>");
            },

            // pagination control
            lengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100], // change per page values here
            ],
            // set the initial value
            pageLength: 10,
            pagingType: 'bootstrap_full_number', // pagination type
            "dom": "<'row'<'col-md-6 col-sm-12'i><'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-3 col-sm-12'><'col-md-6 col-sm-12'p>>",
            fnDrawCallback: function (oSettings) {
                $('.btn-delete').confirmation({
                    title: '<?= t('msg_ask_delete')?>',
                    onConfirm: function () {
                        onDelete($(this).data("value"));
                    },
                    onCancel: $.noop,
                    btnOkClass: 'btn-sm btn-primary',
                    btnOkLabel: '&nbsp;&nbsp;<?= t('yes')?>&nbsp;&nbsp;&nbsp;',
                    btnCancelClass: 'btn-sm btn-danger',
                    btnCancelLabel: '<?= t('no')?>',
                });
            }
        });

        $('input[numberonly]').on('input', function (e) {
            $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
        });

        $("#cb_check_all").change(function () {
            var checked = $("#cb_check_all").is(":checked");
            $('input:checkbox[name="check-cell"]').each(function() {
                this.checked = checked;
            });
        });
    });

    function onSetSearchParams(data) {
        data['search_keyword'] = $("#search_keyword").val();
    }

    function onSearch() {
        if (oTable != null) {
            oTable.draw(true);
        }
    }

    function onInit() {
        $('#frm_search').trigger('reset');
        onSearch();
    }

    function onSend() {
        showSendPopup(null);
    }

    function onResendAll() {
        var arrUid = [];
        $("input[name='check-cell']").each(function (idx) {
            var chk = $(this).is(":checked");
            if (chk == true) {
                arrUid.push($(this).val());
            }
        });

        if(arrUid.length == 0) {
            showNotification("<?=t('error')?>", "<?=t('msg_select_list')?>", "warning");
            return;
        }

        reqSendPush(arrUid);
    }

    function onResend(uid) {
        var arrId = [uid];
        reqSendPush(arrId);
    }

    function onDelete(uid) {
        $.ajax({
            url: '<?= site_url("admin/push/ajax_push_delete") ?>',
            type: 'post',
            data: 'uid=' + uid,
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == '<?=AJAX_RESULT_SUCCESS?>') {
                    showNotification("<?=t('success')?>", "<?=t('msg_success_oper')?>", "success");
                    oTable.draw(true);
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_fix')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
            }
        });
    }

    function reqSendPush(arrUid) {
        $.ajax({
            url: '<?= site_url("admin/push/ajax_resend_gotify") ?>',
            type: 'POST',
            data: {
                uids: arrUid
            },
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == '<?=AJAX_RESULT_SUCCESS?>') {
                    showNotification("<?=t('success')?>", "<?=t('msg_success_oper')?>", "success");
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_fix')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
            }
        });
    }


</script>

