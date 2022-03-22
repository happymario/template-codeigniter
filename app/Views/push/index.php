<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 3:46 PM
 */
?>

<!--begin::SearchForm-->
<div class="card card-custom">
    <div class="card-body">
        <!--begin: Search Form-->
        <form id="frm_search" role="form">
            <div class="col-md-12">
                <div class="col-md-12" style="background: white;">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td width="20%" class="center_align_title_td"><?= t('search_word') ?></td>
                                    <td width="80%" class="padding_1">
                                        <input class="form-control" id="search_keyword"
                                               placeholder="<?= t('title') ?>, <?= t('content') ?>">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" align="center" style="margin-top: 16px;">
                    <a class="btn btn-primary" onclick="onSearch()">&nbsp;&nbsp;<?= t('search') ?>&nbsp;&nbsp;</a>
                    <a class="btn btn-secondary btn-outline" onclick="onInit()">&nbsp;&nbsp;<?= t('initialize') ?>
                        &nbsp;&nbsp;</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!--end::SearchForm-->
<!--begin::Card-->
<div class="card card-custom" style="margin-top: 20px;">
    <div class="card-header">
        <div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
            <h3 class="card-label">Alarm Table</h3>
        </div>
        <div class="card-toolbar">
            <div class="col-md-12" style="display: flex;">
                <a class="btn btn-primary" onclick="onResendAll()">&nbsp;&nbsp;<?= t('resend') ?>&nbsp;&nbsp;</a>
                <div style="text-align: right; flex: 1; margin-left: 10px;">
                    <a class="btn btn-secondary" onclick="onSend()">&nbsp;&nbsp;<?= t('send') ?>&nbsp;&nbsp;</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="tbl_datatable" class="table table-bordered" style="width: 100%">
            <thead class="th_custom_color">
            <th class="no-sort"><input type='checkbox' id="cb_check_all"/></th>
            <th><?= t('number') ?></th>
            <th><?= t('sender') ?></th>
            <th><?= t('receiver') ?></th>
            <th><?= t('title') ?></th>
            <th><?= t('content') ?></th>
            <th><?= t('date_time') ?></th>
            <th><?= t('manage') ?></th>
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
            searching: false,
            responsive:true,
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
                "url": "<?=site_url('admin/push/ajax_datatable')?>", // ajax URL
                "type": "POST",
                "data": function (data) {
                    onSetSearchParams(data);
                },
            },
            columnDefs: [
                {targets: '_all', orderable: false},
                {
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-trash"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link" onclick="onDelete(' + full['uid'] + ')"><i class="nav-icon la la-edit"></i><span class="nav-text"><?= t('yes')?></span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text"><?= t('no')?></span></a></li>\
									</ul>\
							  	</div>\
							</div>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="onResend(' + full['uid'] + ')">\
								<i class="la la-edit"></i>\
							</a>\
						';
                    },
                }
            ],
            order: [],
            createdRow: function (row, data, dataIndex) {
                $('td:eq(0)', row).html("<input name='check-cell' type='checkbox' value='" + data['uid'] + "' />");
            },

            // pagination control
            lengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100], // change per page values here
            ],
            // set the initial value
            pageLength: 10
        });

        $('input[numberonly]').on('input', function (e) {
            $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
        });

        $("#cb_check_all").change(function () {
            var checked = $("#cb_check_all").is(":checked");
            $('input:checkbox[name="check-cell"]').each(function () {
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

        if (arrUid.length == 0) {
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
                    showNotification("<?=t('success')?>", "<?=t('msg_success_done')?>", "success");
                    oTable.draw(true);
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_request')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>", "<?=t('msg_error_server')?>", "error");
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
                    showNotification("<?=t('success')?>", "<?=t('msg_success_done')?>", "success");
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_request')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>", "<?=t('msg_error_server')?>", "error");
            }
        });
    }


</script>

