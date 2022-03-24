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
                       class="text-muted text-hover-primary"><?= t('menu_notice') ?></a>
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
            <a class="btn btn-sm btn-primary" onclick="NoticeList.onAdd()">
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
                 </span><?= t('add') ?>
            </a>
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
                               class="form-control form-control-solid w-250px ps-14"
                               placeholder="<?= t('title') . ", " . t('content') ?>"
                               id="search_keyword"/>
                    </div>
                    <!--end::Search-->
                    <!--begin::Search-->
                    <a onclick="NoticeList.onSearch()" class="btn btn-primary"
                       style="margin-left: 10px;"><?= t('search') ?></a>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Init-->
                    <a onclick="NoticeList.onInit()" class="btn btn-primary"
                       style="margin-left: 10px;"><?= t('initialize') ?></a>
                    <!--end::Init-->
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
                        <th class="min-w-125px no-sort">No</th>
                        <th class="min-w-125px no-sort"><?= t('title') ?></th>
                        <th class="min-w-125px no-sort"><?= t('content') ?></th>
                        <th class="min-w-125px sorting"><?= t('update_date') ?></th>
                        <th class="text-end min-w-100px no-sort"><?= t('manage') ?></th>
                    </tr>
                    </thead>

                    <tbody class="text-gray-600 fw-bold">

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

<script>

    // Class definition
    var NoticeList = function () {
        var oTable;

        var initView = function () {
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
                    "url": "<?=site_url('admin/more/ajax_notice_list')?>", // ajax URL
                    "type": "POST",
                    "data": function (data) {
                        data['search_keyword'] = $('#search_keyword').val();
                    },
                },
                columnDefs: [
                    {data: "reg_time", orderable: true},
                    {orderable: false, targets: "no-sort"},
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            const delBtn = '<button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row" onclick="NoticeList.onDelete('+data['uid']+')">';

                            return delBtn +
                                    `
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                            </svg>
                                        </span>
                                     </button>
                                    `;
                        },
                    },
                ],
                order: [],
                createdRow: function (row, data, dataIndex) {
                    $(row).on("click", function () {
                        NoticeList.onDetail(data['uid']);
                    });
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

            $("#search_keyword").keydown(function (key) { // 키보드 enter로 처리
                if (key.keyCode == 13) {
                    PushList.onSearch();
                }
            });
        };

        var ajaxDelete = function(uid) {
            $.ajax({
                url: '<?= site_url("admin/more/ajax_notice_delete") ?>',
                type: 'post',
                data: 'uid=' + uid,
                dataType: 'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        showNotification("<?=t('success')?>", "<?=t('msg_success_done')?>", "success");
                        oTable.draw(true);
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
            init:function () {
                initView();
                initHandler();
            },
            onSearch:function () {
                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onInit: function () {
                $('#search_keyword').val('');

                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onAdd: function () {
                location.href = "<?=site_url('admin/More/notice_add') ?>";
            },
            onDelete: function (id) {
                if (!confirm("<?= t('msg_ask_delete') ?>"))
                    return;
                ajaxDelete(id);
            },
            onDetail: function (id) {
                location.href = "<?=site_url('admin/More/notice_detail')?>" + "/" + id;
            },
        }
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            NoticeList.init();
        });
    });
</script>

