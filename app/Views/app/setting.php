<style>

</style>
<div class="card card-custom">
    <div class="card-body">
        <form id="frm_setting" role="form" action="<?= site_url("admin/appmanage/setting") ?>" method="post">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12" style="background: white;">
                    <div class="col-md-6">
                        <input class="form-control" id="client_phone" name="client_phone"
                               placeholder="<?= t('qa_phone') ?>"
                               value='<?= $setting->client_phone ?>'>
                    </div>
                    <button class="btn btn-primary" style="margin-left: 20px;" type="submit">&nbsp;&nbsp;<?= t('save') ?>&nbsp;&nbsp;</button>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="text-align: left"><a
                                        href="<?= site_url("admin/login/term") ?>"> <?= t('use_agreement') ?> </a></td>
                        </tr>
                        <tr>
                            <td class="fields_td" style="text-align: left;">
                        <textarea class="form-control summernote" rows="10" id="use_agreement"
                                  name="use_agreement"><?= $setting->use_agreement ?></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>/assets/common/plugins/summernote/summernote.css"/>
<link rel="stylesheet" href="<?= base_url() ?>/assets/common/plugins/summernote/summernote-bs3.css"/>
<script src="<?= base_url() ?>/assets/common/plugins/summernote/summernote.js"></script>

<script>
    $(function () {
        $('#left_menu_appmanage_parent').children("ul:eq(0)").children("li:eq(4)").addClass("open");

        $('input[numberonly]').on('input', function (e) {
            $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
        });

        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                // ['fontsize', ['fontsize']], // Still buggy
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['codeview']],
            ],
            onImageUpload: function (files, editor, welEditable) {
                var data = new FormData();
                data.append("uploadfile", files[0]);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: '<?= site_url('api/Common/upload_file') ?>',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (url) {
                        editor.insertImage(welEditable, url.data.file_url);
                    }
                });
            }
        });
    });
</script>

