<!--begin::SearchForm-->
<div class="card card-custom">
    <div class="card-body">
        <!--begin: Search Form-->
        <form id="frm_search" role="form">
            <div class="form-group row md-12" style="justify-content: center;">
                <label class="col-1 col-form-label"><?= t('search_word') ?></label>
                <div class="col-4">
                    <input class="form-control" type="text" value="" id="search_keyword" placeholder="<?= t('name') ?>">
                </div>
            </div>

            <div class="row md-12" style="justify-content: center;">
                <button class="btn btn-primary btn-primary--icon" id="kt_search" onclick="onSearch()">
													<span>
														<i class="la la-search"></i>
														<span>&nbsp;<?= t('search') ?></span>
													</span>
                </button>&#160;&#160;
                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset" onclick="onInit()">
													<span>
														<i class="la la-close"></i>
														<span><?= t('initialize') ?></span>
													</span>
                </button>
            </div>
        </form>
    </div>
</div>
<!--end::SearchForm-->

<!--begin: Datatable-->
<!--begin::Card-->
<div class="card card-custom" style="margin-top: 20px;">
    <div class="card-header">
        <div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
            <h3 class="card-label">User Table</h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="svg-icon svg-icon-md">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
													<svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"/>
															<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                                  fill="#000000" opacity="0.3"/>
															<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                                  fill="#000000"/>
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>Export
                </button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose
                            an option:
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-print"></i>
																</span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-copy"></i>
																</span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-excel-o"></i>
																</span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-pdf-o"></i>
																</span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->

            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder" onclick="onUserReg()">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<circle fill="#000000" cx="9" cy="15" r="6"/>
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                              fill="#000000" opacity="0.3"/>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span><?= t('add_user') ?></a>
            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table id="tbl_user" class="table table-bordered" style="width: 100%">
            <thead class="th_custom_color">
            <th><?= t('number') ?></th>
            <th><?= t('email') ?></th>
            <th><?= t('name') ?></th>
            <th><?= t('photo') ?></th>
            <th><?= t('status') ?></th>
            <th>Backup</th>
            <th><?= t('manage') ?></th>
            </thead>
            <tbody>

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end: Datatable-->
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
            searching: false,
            responsive: true,
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
                "url": "<?=site_url('admin/user/ajax_table')?>", // ajax URL
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
                if (empty(data['profile_url']) == false) {
                    $('td:eq(3)', row).html('<img style="width: 80px;height:80px;" class="img image-popup-no-margins" src="' + data['profile_url'] + '"/>');
                } else {
                    $('td:eq(3)', row).html('<?= t('no_data_1')?>');
                }

                $('td:eq(4)', row).html('<?= t('normal')?>');
                if (data['status'] == '<?=STATUS_NORMAL?>') {
                    $('td:eq(4)', row).html('<?= t('normal')?>');
                }
                if (data['status'] == '<?=STATUS_DELETE?>') {
                    $('td:eq(4)', row).html('<?= t('delete')?>');
                }
                if (data['status'] == '<?=USER_STATUS_PAUSE?>') {
                    $('td:eq(4)', row).html('<?= t('normal')?>');
                }
                if (data['status'] == '<?=USER_STATUS_EXIT?>') {
                    $('td:eq(4)', row).html('<?= t('exit')?>');
                }
                if (data['backup_url'] == null || data['backup_url'] == "") {
                    $('td:eq(5)', row).html('<?= t('no_data_1')?>');
                } else {
                    $('td:eq(5)', row).html('<a href="' + data['backup_url'] + '">' + data['backup_url'] + "</a>");
                }

                const lastHtml = '\
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="onUserDetail('+ data['uid'] + ')" >\
								<i class="la la-edit"></i>\
							</a>\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-trash"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link"  onclick="onDelete('+ data['uid'] + ')"><i class="nav-icon la la-edit"></i><span class="nav-text">' + "<?= t('yes')?>" + '</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">' + "<?= t('no')?>" + '</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
						';

                $('td:last', row).html(lastHtml);
            },
            //// pagination control
            lengthMenu: [10, 20, 50, 100],
            // set the initial value
            pageLength: 10,
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
            url: '<?= site_url("admin/user/ajax_detail/") ?>' + user_uid,
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
            url: '<?= site_url("admin/user/ajax_delete") ?>',
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
                showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
            }
        });
    }
</script>
