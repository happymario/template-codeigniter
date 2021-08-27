<style>

</style>

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

<div class="card card-custom" style="margin-top: 20px;">
    <div class="card-header">
        <div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
            <h3 class="card-label">User Table</h3>
        </div>
        <div class="card-toolbar">
            <div class="col-md-12" align="right">
                <a class="btn btn-primary" onclick="onReg()">&nbsp;&nbsp;<?= t('add') ?>&nbsp;&nbsp;</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-12" style="margin-top: 20px;">
            <table id="tbl_datatable" class="table table-bordered" style="width: 100%">
                <thead class="th_custom_color">
                <th class="no-sort">No</th>
                <th class="no-sort"><?= t('title') ?></th>
                <th class="no-sort"><?= t('content') ?></th>
                <th class="no-sort"><?= t('photo') ?></th>
                <th class="no-sort"><?= t('maker') ?></th>
                <th><?= t('update_date') ?></th>
                <th class="no-sort"><?= t('manage') ?></th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade in" id="edit_modal" tabindex="-1" aria-hidden="true" style="display: none; padding-right: 16px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?= t('add') ?></h4>
            </div>
            <div class="modal-body">
                <form id="frm_edit" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="center_align_title_td"><?= t('title') ?></td>
                                    <td class="fields_td">
                                        <input type="text" class="form-control" id="title" name="title" placeholder=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center_align_title_td"><?= t('content') ?></td>
                                    <td class="fields_td">
                                            <textarea type="text" class="form-control" id="content" name="content"
                                                      placeholder="" rows="5" style="resize: none;"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center_align_title_td"><?= t('photo') ?></td>
                                    <td class="fields_td">
                                        <div class="profile" id="profile">
                                            <img src="<?= base_url() ?>/assets/admin/img/img_photo_default.png" alt=""
                                                 class="bg"/>
                                            <img alt="" style="" id="img_src" class="img"/>
                                            <img src="<?= base_url() ?>/assets/admin/img/ic_close_black.png" alt=""
                                                 style="" id="img_del" class="del"/>
                                            <input type="file" id="uploadfile" name="uploadfile" style="display: none;">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" id="uid" name="uid"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align: center; border-top: none;">
                <button type="button" class="btn dark" id="btn_save" onclick="onEdit()">&nbsp;&nbsp;<?= t('add') ?>
                    &nbsp;&nbsp;
                </button>
                <button type="button" class="btn dark btn-outline" id="btn_cancel" data-dismiss="modal">
                    &nbsp;&nbsp;<?= t('close') ?>&nbsp;&nbsp;
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
        $('#left_menu_appmanage_parent').children("ul:eq(0)").children("li:eq(2)").addClass("open");

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
                "url": "<?=site_url('admin/appmanage/ajax_notice_list')?>", // ajax URL
                "type": "POST",
                "data": function (data) {
                    onSetSearchParams(data);
                },
            },
            columnDefs: [
                {data: "reg_time", orderable: true},
                {orderable: false, targets: "no-sort"}
            ],
            order: [],
            createdRow: function (row, data, dataIndex) {
                if (data['image_url'] != null && data['image_url'] != "") {
                    $('td:eq(3)', row).html("<img class=\"img image-popup-no-margins\" src='" + data['image_url'] + "' style='width: 180px;height: 100px;'/>");
                } else {
                    $('td:eq(3)', row).text("~");
                }
                $('td:last', row).html(
                    '<a class="btn btn-danger btn-delete" data-value="' + data['uid'] + '">삭제</a>');
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

        $(".profile .bg").click(function () {
            $("#uploadfile").click();
        });
        $(".profile #img_src").click(function () {
            $("#uploadfile").click();
        });
        $("#edit_modal #uploadfile").change(function () {
            $("#edit_modal #img_src").show();
            readURL("#edit_modal #img_src", this);
        });
        $("#edit_modal #img_del").click(function () {
            $("#edit_modal #img_src").attr("src", "");
            $("#edit_modal #img_src").hide();
        });
    });

    function onSetSearchParams(data) {
        data['search_keyword'] = $('#search_keyword').val();
        data['search_app_kind'] = $('#search_app_kind').val();
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

    function onReg() {
        $('#target_url').val("");
        $("#edit_modal #img_src").attr("src", "");
        $("#img_src").hide();
        $("#uploadfile").val('');
        $('#title').val('');
        $('#content').val('');

        $('#edit_modal .modal-title').text('<?php echo t('notice') . ' ' . t('add')?>');
        $('#edit_modal #btn_save').text('<?=t('add')?>');
        $('#edit_modal').modal();
    }

    function onDetail(uid) {
        $.ajax({
            url: '<?= site_url("admin/appmanage/ajax_notice_detail/") ?>' + uid,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();

                $('#target_url').val(result.target_url);
                $('#title').val(result.title);
                $('#content').val(result.content);
                $("#img_src").attr('src', result.image_url);
                $("#uploadfile").val('');

                $('#uid').val(result.uid);
                $('#edit_modal .modal-title').text('<?php echo t('notice') . t('modify')?>');
                $('#edit_modal #btn_save').text('<?=t('modify')?>');
                $('#edit_modal').modal();
            }
        });
    }

    function onEdit() {
        if ($('#title').val() == '') {
            showNotification("<?=t('error')?>", "<?=t('msg_input_title')?>", "warning");
            return;
        }

        if ($('#content').val() == '') {
            showNotification("<?=t('error')?>", "<?=t('msg_input_content')?>", "warning");
            return;
        }

        var data = new FormData();

        //Form data
        var form_data = $('#frm_edit').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        //File data
        var file_data = $('input[name="uploadfile"]')[0].files;
        if (file_data.length > 0) {
            data.append("uploadfile", file_data[0]);
        }

        if ($('#img_src').attr('src') == '') {
            data.append('img_src', '');
        }

        $.ajax({
            url: '<?= site_url("admin/appmanage/ajax_notice_save") ?>',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == 'success') {
                    showNotification("<?=t('success')?>", "<?=t('msg_success_oper')?>", "success");
                    $('#edit_modal').modal('hide');
                    oTable.draw(true);
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                }
            }
        });
    }

    function onDelete(uid) {
        $.ajax({
            url: '<?= site_url("admin/appmanage/ajax_notice_delete") ?>',
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
</script>

