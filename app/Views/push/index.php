<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 3:46 PM
 */
?>

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
            <!--begin::Primary button-->
            <a class="btn btn-sm btn-primary" onclick="PushList.onSend()">
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
                 </span><?= t('send') ?>
            </a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card Search-->
        <div class="card card-flush">
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
                            <a class="btn btn-primary" onclick="PushList.onSearch()">&nbsp;&nbsp;<?= t('search') ?>&nbsp;&nbsp;</a>
                            <a class="btn btn-secondary btn-outline" onclick="PushList.onInit()">&nbsp;&nbsp;<?= t('initialize') ?>
                                &nbsp;&nbsp;</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Card Search-->

        <!--begin::Card List-->
        <div class="card card-flush container-list" style="margin-top: 20px;">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
                        <h3 class="card-label"><?=$page_title?></h3>
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Export-->
                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                            <span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
														<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
														<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
													</svg>
												</span>
                            <!--end::Svg Icon-->Export
                        </button>
                        <!--end::Export-->
                    </div>
                    <!--end::Toolbar-->

                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected"><?= t('delete') ?></button>
                        <a class="btn btn-primary" onclick="PushList.onResendAll()" style="margin-left: 10px;">&nbsp;&nbsp;<?= t('resend') ?>&nbsp;&nbsp;</a>
                    </div>
                    <!--end::Group actions-->

                    <!--begin::Modal - Export -->
                    <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">Export Users</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
																		<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
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
                                    <form id="kt_modal_export_users_form" class="form" action="#">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="role" data-control="select2" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                                <option></option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Analyst">Analyst</option>
                                                <option value="Developer">Developer</option>
                                                <option value="Support">Support</option>
                                                <option value="Trial">Trial</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-bold form-label mb-2">Select Export Format:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bolder">
                                                <option></option>
                                                <option value="excel">Excel</option>
                                                <option value="pdf">PDF</option>
                                                <option value="cvs">CVS</option>
                                                <option value="zip">ZIP</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="text-center">
                                            <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                            <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                                <span class="indicator-label">Submit</span>
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
                    <!--end::Modal - Export-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin: Datatable-->
                <table id="tbl_datatable" class="table align-middle table-row-dashed min-h-400px fs-6 gy-5">
                    <thead class="th_custom_color">
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#tbl_datatable .form-check-input" value="0" />
                            </div>
                        </th>
                        <th class="min-w-50px"><?= t('number') ?></th>
                        <th class="min-w-125px"><?= t('sender') ?></th>
                        <th class="min-w-125px"><?= t('receiver') ?></th>
                        <th class="min-w-125px"><?= t('title') ?></th>
                        <th class="min-w-125px"><?= t('content') ?></th>
                        <th class="min-w-125px"><?= t('date_time') ?></th>
                    </tr>
                    </thead>

                    <tbody class="text-gray-600 fw-bold">

                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card List-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

<?php
require dirname(__FILE__) . "/send_popup.php";
?>

<script>

    "use strict";

    // Class definition
    var PushList = function () {

        // toolbars
        var toolbarBase;
        var toolbarSelected;
        var selectedCount;
        // table
        var oTable;
        // Shared variables
        var exportElement = null;
        var exportForm = null;
        var exportModal = null;

        var initView = function () {
            initToggleToolbar();
            initExport();
            initDataTable();
        };

        // Init toggle toolbar
        var initToggleToolbar = () => {
            // Toggle selected action toolbar
            // Select all checkboxes
            var table = document.getElementById('tbl_datatable');
            const checkboxes = table.querySelectorAll('[type="checkbox"]');

            // Select elements
            toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
            toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
            selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');
            const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function () {
                    setTimeout(function () {
                        toggleToolbars();
                    }, 50);
                });
            });

            // Deleted selected rows
            deleteSelected.addEventListener('click', function () {
                const arrUid = getAllCheckedValues();

                if (arrUid.length === 0) {
                    showNotification("<?=t('msg_select_list')?>");
                    return;
                }

                showAlert('<?=t('msg_ask_delete')?>', '<?=t('yes')?>', '<?=t('no')?>', false, function (result) {
                    if (result.value) {
                        ajaxDeletePush(arrUid);
                    }
                    else if (result.dismiss === 'cancel') {

                    }
                });
            });
        };

        var initExport = function () {
            exportElement = document.getElementById('kt_modal_export_users');
            exportForm = exportElement.querySelector('#kt_modal_export_users_form');
            exportModal = new bootstrap.Modal(exportElement);
        };

        var initDataTable = function () {
            oTable = $('#tbl_datatable').DataTable({
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
                    "url": "<?=site_url('admin/push/ajax_datatable')?>", // ajax URL
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
                    var html = `
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="`+data['uid']+`" />
                        </div>
                    `;
                    $('td:eq(0)', row).html(html);
                },

                // pagination control
                lengthMenu: [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100], // change per page values here
                ],
                // set the initial value
                pageLength: 10
            });

            oTable.on('draw', function () {
                KTMenu.createInstances();
            });
        };

        var initHandler = function () {
            $('input[numberonly]').on('input', function (e) {
                $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
            });

            $("#cb_check_all").change(function () {
                var checked = $("#cb_check_all").is(":checked");
                $('input:checkbox[name="check-cell"]').each(function () {
                    this.checked = checked;
                });
            });

            // Close button handler
            const closeButton = exportElement.querySelector('[data-kt-users-modal-action="close"]');
            closeButton.addEventListener('click', function (e) {
                e.preventDefault();

                exportForm.reset(); // Reset form
                exportModal.hide(); // Hide modal
            });

            // Cancel button handler
            const cancelButton = exportElement.querySelector('[data-kt-users-modal-action="cancel"]');
            cancelButton.addEventListener('click', function (e) {
                e.preventDefault();

                exportForm.reset(); // Reset form
                exportModal.hide(); // Hide modal
            });
        };

        // Toggle toolbars
        const toggleToolbars = () => {
            // Select refreshed checkbox DOM elements
            var table = document.getElementById('tbl_datatable');
            const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
        };

        const getAllCheckedValues = () => {
            // Select refreshed checkbox DOM elements
            var table = document.getElementById('tbl_datatable');
            const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;
            var arrUid = [];

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                    arrUid.push($(c).val());
                }
            });

            return arrUid;
        };

        const ajaxSendPush = function (arrUid) {
            $.ajax({
                url: '<?= site_url("admin/push/ajax_resend_gotify") ?>',
                type: 'POST',
                data: {
                    uids: arrUid
                },
                dataType:'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        showNotification("<?=t('msg_success_done')?>", true);
                    } else {
                        showNotification("<?=t('msg_error_request')?>");
                    }
                },
                error: function (a, b, c) {
                    hideLoading();
                    showNotification("<?=t('msg_error_server')?>");
                }
            });
        };

        const ajaxDeletePush = function (arrUid) {
            $.ajax({
                url: '<?= site_url("admin/push/ajax_push_delete") ?>',
                type: 'post',
                data: {
                    uids: arrUid
                },
                dataType:'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        showNotification("<?=t('msg_success_done')?>", true);
                        oTable.draw(true);
                    } else {
                        showNotification("<?=t('msg_error_request')?>");
                    }
                },
                error: function (a, b, c) {
                    hideLoading();
                    showNotification("<?=t('msg_error_server')?>");
                }
            });
        };


        return {
            init: function () {
                initView();
                initHandler();
            },
            onSearch: function () {
                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onInit: function () {
                $('#frm_search').trigger('reset');

                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onSend: function () {
                SendPushPopup.show();
            },
            onResendAll: function () {
                const arrUid = getAllCheckedValues();

                if (arrUid.length === 0) {
                    showNotification("<?=t('msg_select_list')?>");
                    return;
                }

                ajaxSendPush(arrUid);
            },
            redraw : function () {
                if (oTable != null) {
                    oTable.draw(true);
                }
            }
        }
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            PushList.init();
        });
    });
</script>

