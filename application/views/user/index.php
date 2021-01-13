<div class="row" style="margin-top: 20px;">
    <form id="frm_search" role="form">
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="20%" class="center_align_title_td"><?=t('search_word')?></td>
                        <td width="80%" class="padding_1">
                            <input class="form-control" id="search_keyword" placeholder="<?=t('name')?>">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12" align="center">
                <a class="btn dark" onclick="onSearch()">&nbsp;<?=t('search')?></a>
                <a class="btn dark btn-outline" onclick="onInit()">&nbsp;&nbsp;<?=t('initialize')?>&nbsp;&nbsp;</a>
            </div>

            <div class="col-md-12" align="right">
                <a class="btn blue" onclick="onUserReg()">&nbsp;&nbsp;<?=t('add_user')?>&nbsp;&nbsp;</a>
            </div>
        </div>
    </form>

    <div class="col-md-12" style="margin-top: 20px;">
        <table id="tbl_user" class="table table-bordered table-primary" style="width: 100%">
            <thead class="th_custom_color">
            <th><?=t('number')?></th>
            <th><?=t('email')?></th>
            <th><?=t('name')?></th>
            <th><?=t('photo')?></th>
            <th><?=t('status')?></th>
            <th>Backup</th>
            <th><?=t('manage')?></th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<?php
require dirname(__FILE__) . "/edit_popup.php";
?>

<script>
    var oTable;
    $(function () {
        oTable = $('#tbl_user').DataTable({
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
                "url": "<?=site_url('User/ajax_table')?>", // ajax URL
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
                if(empty(data['profile_url']) == false) {
                    $('td:eq(3)', row).html('<img style="width: 80px;height:80px;" class="img image-popup-no-margins" src="' + data['profile_url'] + '"/>');
                }
                else {
                    $('td:eq(3)', row).html('<?= t('no_data_1')?>');
                }

                $('td:eq(4)', row).html('<?= t('normal')?>');
                if(data['status'] == '<?=STATUS_NORMAL?>'){
                    $('td:eq(4)', row).html('<?= t('normal')?>');
                }
                if(data['status'] == '<?=STATUS_DELETE?>'){
                    $('td:eq(4)', row).html('<?= t('delete')?>');
                }
                if(data['status'] == '<?=USER_STATUS_PAUSE?>'){
                    $('td:eq(4)', row).html('<?= t('normal')?>');
                }
                if(data['status'] == '<?=USER_STATUS_EXIT?>'){
                    $('td:eq(4)', row).html('<?= t('exit')?>');
                }
                if(data['backup_url']  == null || data['backup_url'] == "") {
                    $('td:eq(5)', row).html('<?= t('no_data_1')?>');
                }
                else {
                    $('td:eq(5)', row).html('<a href="' + data['backup_url'] + '">'+ data['backup_url'] + "</a>");
                }
                $('td:last', row).html("<a class='btn-edit' onclick='onUserDetail(" + data['uid'] + ")'><?= t('modify')?></a>&nbsp;&nbsp;" +
                    "<a class='btn-delete' data-value='" + data['uid'] + "'><?= t('delete')?></a>");
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

    function onUserReg() {
        showEditPopup(null);
    }

    function onUserDetail(user_uid) {
        $.ajax({
            url: '<?= site_url("user/ajax_detail/") ?>' + user_uid,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                showEditPopup(result);
            }
        });
    }

    function onDelete(user_uid) {
        $.ajax({
            url: '<?= site_url("user/ajax_delete") ?>',
            type: 'post',
            data: 'user_uid=' + user_uid,
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == "<?=AJAX_RESULT_SUCCESS?>") {
                    showNotification("<?=t('success')?>", "<?=t('msg_success_oper')?>", "success");
                    oTable.draw(true);
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>","<?=t('msg_error_occured')?>","error");
            }
        });
    }
</script>
