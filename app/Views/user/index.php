<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Pages</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="<?= base_url() ?>/admin/home"
                       class="text-muted text-hover-primary"><?= t('menu_home') ?></a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark"><?= $page_title ?? '' ?></li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
												<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                      fill="black"/>
											</svg>
										</span>
                    <!--end::Svg Icon-->Filter</a>
                <!--end::Menu toggle-->
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                     id="kt_menu_6220ed708463f">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->
                    <!--begin::Form-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Status:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <select class="form-select form-select-solid" data-kt-select2="true"
                                        data-placeholder="Select option"
                                        data-dropdown-parent="#kt_menu_6220ed708463f"
                                        data-allow-clear="true">
                                    <option></option>
                                    <option value="1">Approved</option>
                                    <option value="2">Pending</option>
                                    <option value="2">In Process</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Member Type:</label>
                            <!--end::Label-->
                            <!--begin::Options-->
                            <div class="d-flex">
                                <!--begin::Options-->
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" value="1"/>
                                    <span class="form-check-label">Author</span>
                                </label>
                                <!--end::Options-->
                                <!--begin::Options-->
                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="2"
                                           checked="checked"/>
                                    <span class="form-check-label">Customer</span>
                                </label>
                                <!--end::Options-->
                            </div>
                            <!--end::Options-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Notifications:</label>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value=""
                                       name="notifications" checked="checked"/>
                                <label class="form-check-label">Enabled</label>
                            </div>
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset"
                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->
            <!--begin::Secondary button-->
            <!--end::Secondary button-->
            <!--begin::Primary button-->
            <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal"
               data-bs-target="#kt_modal_create_app">Create</a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->

<!--begin::List-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <div class="card card-flush container-list">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                              height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                              fill="black"/>
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                              fill="black"/>
													</svg>
												</span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-ecommerce-product-filter="search"
                               class="form-control form-control-solid w-250px ps-14" placeholder="<?= t('name') ?>"
                               id="search_keyword"/>
                    </div>
                    <!--end::Search-->

                    <!--begin::Search-->
                    <a onclick="UserList.onSearch()" class="btn btn-primary"
                       style="margin-left: 10px;"><?= t('search') ?></a>
                    <!--end::Search-->
                    <!--begin::Init-->
                    <a onclick="UserList.onInit()" class="btn btn-primary"
                       style="margin-left: 10px;"><?= t('initialize') ?></a>
                    <!--end::Init-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <div class="w-100 mw-150px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                            <option></option>
                            <option value="all">All</option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <!--begin::Add-->
                    <a class="btn btn-primary font-weight-bolder" onclick="UserList.onUserReg()">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                  fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span><?= t('add_user') ?>
                    </a>
                    <!--end::Add-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin: Datatable-->
                <table id="tbl_user" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead class="th_custom_color">
                    <th class="min-w-50px"><?= t('number') ?></th>
                    <th class="text-end min-w-70px"><?= t('email') ?></th>
                    <th class="text-end min-w-70px"><?= t('name') ?></th>
                    <th class="text-end min-w-70px"><?= t('photo') ?></th>
                    <th class="text-end min-w-70px"><?= t('status') ?></th>
                    <th class="text-end min-w-70px">Backup</th>
                    <th class="text-end min-w-70px"><?= t('manage') ?></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::List-->


<?php
require dirname(__FILE__) . "/edit_popup.php";
?>

<script>
    "use strict";

    // Class definition
    var UserList = function () {
        var oTable;

        var initView = function () {
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
                    "url": "<?=site_url('admin/user/ajax_datatable')?>", // ajax URL
                    "type": "POST",
                    "data": function (data) {
                        data['search_keyword'] = $("#search_keyword").val();
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
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="onUserDetail(' + data['uid'] + ')" >\
								<i class="la la-edit"></i>\
							</a>\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-trash"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link"  onclick="onDelete(' + data['uid'] + ')"><i class="nav-icon la la-edit"></i><span class="nav-text">' + "<?= t('yes')?>" + '</span></a></li>\
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
        };

        // Handle form
        var initEvent = function () {
            $('input[numberonly]').on('input', function (e) {
                $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
            });
        };

        var ajaxDetail = function (user_uid) {
            $.ajax({
                url: '<?= site_url("admin/user/ajax_detail/") ?>' + user_uid,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (result) {
                    hideLoading();

                    const response = JSON.parse(result);
                    showEditPopup(response.data);
                },
                error: function (a, b, c) {
                    hideLoading();
                    showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                }
            });
        };

        var ajaxDelete = function (user_uid) {
            $.ajax({
                url: '<?= site_url("admin/user/ajax_delete") ?>',
                type: 'post',
                data: 'user_uid=' + user_uid,
                beforeSend: function () {
                    showLoading();
                },
                success: function (result) {
                    hideLoading();
                    const response = JSON.parse(result);
                    if (response['result'] == '<?=AJAX_RESULT_SUCCESS?>') {
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
        };

        return {
            init: function () {
                initView();
                initEvent();
            },
            onSearch: function () {
                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onInit: function () {
                $("#search_keyword").text('');

                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onUserReg: function () {
                showEditPopup(null);
            },
            onUserDel: function (id) {
                ajaxDelete(id);
            },
            onUserModify: function (id) {
                ajaxDetail(id)
            }
        }
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            UserList.init();
        });
    });
</script>
