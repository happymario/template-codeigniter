<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <form method="post" action="<?=site_url('api/ApiManage/api_output_edit')?>" id="frm_api_output_edit">
            <input class="hidden" name="ai_idx" value="<?=$ai_idx?>">
            <input class="hidden" name="api_idx" value="<?=$api_idx?>">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;"><?= t('variable_name') ?></label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" id="ai_name" name="ai_name" value="<?php echo  $ai_idx > 0  ? $ai_name : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;"><?= t('data_type') ?></label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="ai_type" id="ai_type">
                            <option value="String">String</option>
                            <option value="Integer">Integer</option>
                            <option value="Double">Double</option>
                            <option value="Object">Object</option>
                            <option value="<?= t('string_arr') ?>"><?= t('string_arr') ?></option>
                            <option value="<?= t('integer_arr') ?>"><?= t('integer_arr') ?></option>
                            <option value="Object Arr">Object Arr</option>
                            <option value="File">File</option>
                            <option value="Multi Files">Multi Files</option>
                            <option value="boolean">boolean</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;"><?= t('required') ?></label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="ai_ness" id="ai_ness">
                            <option value="<?= t('required') ?>"><?= t('required') ?></option>
                            <option value="<?= t('not_required') ?>"><?= t('not_required') ?></option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;"><?= t('description') ?></label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" name="ai_exp"><?php echo  $ai_idx > 0  ? $ai_exp : ""; ?></textarea>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;"><?= t('order') ?></label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" name="ai_sort"  value="<?php echo  $ai_idx > 0  ? $ai_sort : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-12">
                    <div style="float: right;">
                        <a class="btn btn-danger" onclick="history.go(-1)"><?= t('cancel') ?></a>
                        <a class="btn btn-success" onclick="add_api_input()"><?= t('save') ?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<form class="hidden" method="get" action="<?=site_url('api/ApiManage/api_output_list')?>" id="frm_go_api_output_list">
    <input class="hidden" name="id" value="<?=$api_idx?>">
</form>
<script>
    $(document).ready(function(){
        $('#menu_api_mng').addClass('active');
        $('#page_title').html("<?= t('add_output_variable') ?>");

        if('<?=$ai_idx?>' != '0'){
            $('#ai_type').val('<?=$ai_type?>');
            $('#ai_ness').val('<?=$ai_ness?>');
        }
    })

    function add_api_input(){
        if($('#ai_name').val() == ""){
            showNotification("<?= t('error') ?>","<?= t('please_input_variable_name') ?>","warning");
            return;
        }

        var options = {
            success: afterSuccess,  // post-submit callback
            beforeSend: beforeSubmit,
            resetForm: true        // reset the form after successful submit
        };

        $("#frm_api_output_edit").ajaxSubmit(options);

        function beforeSubmit(){
            App.blockUI({
                animate: true,
                target: '#total_body',
                boxed: false
            });
        }

        function afterSuccess(data) {
            App.unblockUI('#total_body');
            if(data == "success"){
                $('#frm_go_api_output_list').submit();
            }else{
                showNotification("<?= t('error') ?>","<?= t('failed') ?>","error");
            }
        }
    }
</script>