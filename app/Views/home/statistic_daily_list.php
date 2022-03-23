<style>

</style>

<!--begin::SearchForm-->
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
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12" align="center" style="margin-top: 16px;">
                    <a class="btn btn-primary" onclick="onSearch()">&nbsp;<?= t('search') ?></a>
                    <a class="btn btn-secondary" onclick="onInit()">&nbsp;&nbsp;<?= t('initialize') ?>&nbsp;&nbsp;</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!--end::SearchForm-->

<div class="card card-custom" style="margin-top: 20px;">
    <div class="col-md-12" style="margin-top: 20px;">
        <p><span style='font-weight: 700'><?= t('total_count') ?></span> <span style='font-weight: 700;'
                                                                               class='color_white_blue'
                                                                               id="total_count"></span></p>
        <table id="tbl_datatable" class="table table-bordered" style="width: 100%">
            <thead class="th_custom_color">
            <th><?= t('date') ?></th>
            <th><?= t('send_count') ?></th>
            <th><?= t('signup_count') ?></th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>
    var oTable;
    $(function () {
        oTable = $('#tbl_datatable').DataTable({
            stateSave: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
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
                "url": "<?=site_url('admin/statistic/ajax_daily_list')?>", // ajax URL
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
                //$('td:eq(1)', row).text(formatMoney(data['money'], 0));
            },
            "bLengthChange": false,
            "bPaginate": false,
            bInfo: false,
            "dom": "<'row'<'col-md-6 col-sm-12'i><'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-3 col-sm-12'><'col-md-6 col-sm-12'p>>"
        });

        $('input[numberonly]').on('input', function (e) {
            $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
        });

        reqTotalTime();
    });

    function onSetSearchParams(data) {
        data['search_keyword'] = $('#search_keyword').val();
        data['search_year'] = $('#search_year').val();
        data['search_month'] = $('#search_month').val();
    }

    function onSearch() {
        reqTotalTime();
        if (oTable != null) {
            oTable.draw(true);
        }
    }

    function onInit() {
        $('#frm_search').trigger('reset');
        onSearch();
    }

    function reqTotalTime() {
        $.ajax({
            url: '<?= site_url("admin/statistic/ajax_daily_total") ?>',
            type: 'POST',
            data: {
                search_keyword: $('#search_keyword').val()
            },
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                $('#total_count').text(result);
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>", "<?=t('msg_error_server')?>", "error");
            }
        });
    }
</script>
