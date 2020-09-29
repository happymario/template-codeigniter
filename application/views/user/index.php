<style>
    .modal .table {
        border-spacing: 0 20px;
        border-collapse: initial;
    }

    .modal table > tbody > tr > td {
        border-top: none;
    }

    .modal .center_align_title_td {
        text-align: left !important;
        padding-left: 20px;
    }

    .modal .fields_td {
        text-align: left;
        padding-left: 20px;
    }

    .link {
        cursor: pointer;
        color: #5b9bd5;
        text-decoration: underline;
    }

    .link.red {
        color: red;
    }
</style>

<div class="row" style="margin-top: 20px;">
    <form id="frm_search" role="form">
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="20%" class="center_align_title_td"><?=t('search_word')?></td>
                        <td width="80%" class="padding_1">
                            <input class="form-control" id="search_name" placeholder="<?=t('name')?>">
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
            <th><?=t('no')?></th>
            <th><?=t('email')?></th>
            <th><?=t('name')?></th>
            <th><?=t('picture')?></th>
            <th><?=t('status')?></th>
            <th><?=t('manage')?></th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade in" id="edit_modal" tabindex="-1" aria-hidden="true"
     style="display: none; padding-right: 16px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?=t('add_user')?></h4>
            </div>
            <div class="modal-body">
                <form id="frm_edit">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td width="30%" class="center_align_title_td"><?=t('name')?></td>
                                    <td width="70%" class="fields_td">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="<?=t('input_name')?>"/>
                                    </td>
                                </tr>
                                <tr id="normal_tr">
                                    <td class="center_align_title_td"><?=t('pwd')?></td>
                                    <td class="fields_td">
                                        <input type="text" numberonly class="form-control" id="pwd" name="pwd"
                                               placeholder="<?=t('input_password')?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center_align_title_td"><?=t('status')?></td>
                                    <td class="fields_td">
                                        <select class="form-control" id="status" name="status">
                                            <option value="y"><?=t('normal')?></option>
                                            <option value="p"><?=t('pause')?></option>
                                            <option value="c"><?=t('manage')?></option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" id="user_uid" name="user_uid"/>
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
                "zeroRecords": <?= t('no_data')?>
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
                if (data['login_type'] != 'normal') {
                    $('td:eq(2)', row).css('color', '#00b050').html('SNS');
                } else {
                    $('td:eq(2)', row).html('<?= t('normal')?>');
                }
                $('td:eq(4)', row).html(data['status'] == 'y' ? '<?= t('normal')?>' : '<?= t('pause')?>');

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
    });

    function onSetSearchParams(data) {
        data['search_name'] = $('#search_name').val();
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
        $('.modal-title').html('<?= t('add_user')?>');
        $('#btn_save').html('&nbsp;&nbsp;<?= t('add')?>&nbsp;&nbsp;');
        $('#name').val('');
        $('#pwd').val('');
        $('#status').val('y');
        $('#user_uid').val('0');
        $('#normal_tr').show();
        $('#naver_tr').hide();
        $('#edit_modal').modal();
    }

    function onUserDetail(user_uid) {
        $.ajax({
            url: '<?= site_url("User/get_contents/") ?>' + user_uid,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                $('.modal-title').html('회원상세');
                $('#btn_save').html('&nbsp;&nbsp;수정&nbsp;&nbsp;');
                $('#user_uid').val(user_uid);
                $('#name').val(result.name);
                if (result.login_type == 'naver') {
                    $('#naver_tr').show();
                    $('#normal_tr').hide();
                } else {
                    $('#naver_tr').hide();
                    $('#normal_tr').show();
                    $('#pwd').val(result.pwd);
                }
                $('#status').val(result.status);
                $('#edit_modal').modal();
            }
        });
    }

    $('#btn_save').click(function () {
        if ($('#name').val() == '') {
            showNotification("오류", "이름을 입력해 주세요.", "warning");
            $('#name').focus();
            return;
        }

        if ($('#naver_tr').is(':hidden')) {
            if ($('#pwd').val() == '' && $('#pwd').val() == '') {
                showNotification("오류", "비밀번호를 입력해 주세요.", "warning");
                $('#pwd').focus();
                return;
            }
        }

        $.ajax({
            url: '<?= site_url("User/save") ?>',
            type: 'POST',
            data: $('#frm_edit').serialize(),
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == 'success') {
                    showNotification("성공", "저장되었습니다", "success");
                    $('#edit_modal').modal('hide');
                    oTable.draw(true);
                } else if (result == 'dup') {
                    showNotification("오류", "이름이 중복됩니다.", "error");
                } else {
                    showNotification("오류", "조작이 실패하였습니다.", "error");
                }
            }
        });
    });

    function onDelete(user_uid) {
        $.ajax({
            url: '<?= site_url("User/delete") ?>',
            type: 'post',
            data: 'user_uid=' + user_uid,
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == "success") {
                    showNotification("성공", "삭제되었습니다.", "success");
                    oTable.draw(true);
                } else {
                    showNotification("오류", "조작이 실패하였습니다.", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("오류", "조작이 실패하였습니다.", "error");
            }
        });
    }

    $('input[numberonly]').on('input', function (e) {
        $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
    });
</script>
