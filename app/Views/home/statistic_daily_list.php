<!--begin::Post-->
<div class="post d-flex flex-column-fluid mt-10" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card Search-->
        <div class="card card-custom">
            <div class="card-body">
                <form id="frm_search" role="form">
                    <div class="col-md-12">
                        <div class="col-md-12" style="background: white;">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td width="5%" class="center_align_title_td"><?= t('year') ?></td>
                                    <td width="20%" class="padding_1">
                                        <select id="search_year" name="search_year" class="form-control">
                                            <?php
                                            for ($i = STATISTIC_MIN_YEAR; $i <= STATISTIC_MAX_YEAR; $i++) {
                                                if ($i == date('Y')) {
                                                    echo '<option value="' . $i . '" selected>' . $i . t('year') . '</option>';
                                                } else {
                                                    echo '<option value="' . $i . '">' . $i . t('year') . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td width="5%" class="center_align_title_td"><?= t('month') ?></td>
                                    <td width="20%" class="padding_1">
                                        <select id="search_month" name="search_month" class="form-control">
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                if ($i == date('m')) {
                                                    echo '<option value="' . $i . '" selected>' . $i . t('month') . '</option>';
                                                } else {
                                                    echo '<option value="' . $i . '">' . $i . t('month') . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td width="10%" class="center_align_title_td"><?= t('search_word') ?></td>
                                    <td width="40%" class="padding_1">
                                        <input class="form-control" id="search_keyword" placeholder="">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <div class="mb-0">
                                            <label class="form-label">Basic example</label>
                                            <input class="form-control form-control-solid" placeholder="Pick date rage" id="kt_daterangepicker_1"/>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12" align="center" style="margin-top: 16px;">
                            <a class="btn btn-primary" onclick="StatisticDailyList.onSearch()">&nbsp;<?= t('search') ?></a>
                            <a class="btn btn-secondary" onclick="StatisticDailyList.onInit()">&nbsp;&nbsp;<?= t('initialize') ?>&nbsp;&nbsp;</a>
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
                        <h3 class="card-label"><?= $page_title ?></h3>
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Export-->
                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_export_users">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                            <span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2"
                                                              rx="1" transform="rotate(90 12.75 4.25)" fill="black"/>
														<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                              fill="black"/>
														<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                              fill="#C4C4C4"/>
													</svg>
												</span>
                            <!--end::Svg Icon-->Export
                        </button>
                        <!--end::Export-->
                    </div>
                    <!--end::Toolbar-->

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
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                         data-kt-users-modal-action="close">
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
                                    <form id="kt_modal_export_users_form" class="form" action="#">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold form-label mb-2">Select Roles:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="role" data-control="select2" data-placeholder="Select a role"
                                                    data-hide-search="true"
                                                    class="form-select form-select-solid fw-bolder">
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
                                            <label class="required fs-6 fw-bold form-label mb-2">Select Export
                                                Format:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="format" data-control="select2"
                                                    data-placeholder="Select a format" data-hide-search="true"
                                                    class="form-select form-select-solid fw-bolder">
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
                                            <button type="reset" class="btn btn-light me-3"
                                                    data-kt-users-modal-action="cancel">Discard
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                    data-kt-users-modal-action="submit">
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
                <p><span style='font-weight: 700'><?= t('total_count') ?></span> <span style='font-weight: 700;'
                                                                                       class='color_white_blue'
                                                                                       id="total_count"></span></p>
                <!--begin: Datatable-->
                <table id="tbl_datatable" class="table align-middle table-row-dashed min-h-400px fs-6 gy-5">
                    <thead class="th_custom_color">
                    <th><?= t('date') ?></th>
                    <th><?= t('send_count') ?></th>
                    <th><?= t('signup_count') ?></th>
                    </thead>
                    <tbody>

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


<script>
    var StatisticDailyList = function () {
        var oTable;

        var initView = function () {
            oTable = $('#tbl_datatable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
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
                    "url": "<?=site_url('admin/statistic/ajax_daily_list')?>", // ajax URL
                    "type": "POST",
                    "data": function (data) {
                        data['search_keyword'] = $('#search_keyword').val();
                        data['search_year'] = $('#search_year').val();
                        data['search_month'] = $('#search_month').val();
                    },
                },
                columnDefs: [
                    {targets: '_all', orderable: false}
                ],
                order: [],
                createdRow: function (row, data, dataIndex) {
                    //$('td:eq(1)', row).text(formatMoney(data['money'], 0));
                },
                "bLengthChange": false,
                "bPaginate": false,
                bInfo: false,
                "dom": "<'row'<'col-md-6 col-sm-12'i><'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-3 col-sm-12'><'col-md-6 col-sm-12'p>>"
            });

            $("#kt_daterangepicker_1").daterangepicker();
        };

        var initHandler = function () {
            $('input[numberonly]').on('input', function (e) {
                $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
            });
        };

        var ajaxTotalTime = function () {
            $.ajax({
                url: '<?= site_url("admin/statistic/ajax_daily_total") ?>',
                type: 'POST',
                data: {
                    search_keyword: $('#search_keyword').val()
                },
                dataType: "json",
                beforeSend: function () {
                    showLoading();
                },
                success: function (result) {
                    hideLoading();
                    $('#total_count').text(result.data);
                },
                error: function (a, b, c) {
                    hideLoading();
                    showNotification("<?=t('msg_error_server')?>");
                }
            });
        }

        return {
            init: function () {
                initView();
                initHandler();

                ajaxTotalTime();
            },
            onSearch: function () {
                ajaxTotalTime();

                if (oTable != null) {
                    oTable.draw(true);
                }
            },
            onInit: function () {
                $('#frm_search').trigger('reset');

                ajaxTotalTime();

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
            StatisticDailyList.init();
        });
    });

</script>
