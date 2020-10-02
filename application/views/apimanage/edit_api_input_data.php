<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <form method="post" action="<?=site_url('apiManage/api_input_edit')?>" id="frm_api_input_edit">
            <input class="hidden" name="ai_idx" value="<?=$ai_idx?>">
            <input class="hidden" name="api_idx" value="<?=$api_idx?>">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;"><?=t('var_name')?></label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" id="ai_name" name="ai_name" value="<?php echo  $ai_idx > 0  ? $ai_name : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;"><?=t('type')?></label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="ai_type" id="ai_type">
                            <option value="String">String</option>
                            <option value="Integer">Integer</option>
                            <option value="Double">Double</option>
                            <option value="Object">Object</option>
                            <option value="String Arr">String Arr</option>
                            <option value="Integer Arr">Integer Arr</option>
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
                    <label style="font-size: 13px;float: right;font-weight: 700;"><?=t('kind')?></label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="ai_ness" id="ai_ness">
                            <option value="필수">필수</option>
                            <option value="필수아님">필수아님</option>
                            <option value="성공">성공</option>
                            <option value="오유">오유</option>
                            <option value="빈값">빈값</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;"><?=t('explain')?></label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" name="ai_exp"><?php echo  $ai_idx > 0  ? $ai_exp : ""; ?></textarea>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;"><?=t('order')?></label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" name="ai_sort"  value="<?php echo  $ai_idx > 0  ? $ai_sort : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-12">
                    <div style="float: right;">
                        <a class="btn btn-danger" onclick="history.go(-1)"><?=t('cancel')?></a>
                        <a class="btn btn-success" onclick="add_api_input()"><?=t('store')?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<form class="hidden" method="get" action="<?=site_url('apiManage/api_input_list')?>" id="frm_go_api_input_list">
    <input class="hidden" name="id" value="<?=$api_idx?>">
</form>
<script>
    $(document).ready(function(){
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(0)").addClass("open");
        $('#page_title').html("Input <?=t('variable')?> <?=t('add')?>");

        if('<?=$ai_idx?>' != '0'){
            $('#ai_type').val('<?=$ai_type?>');
            $('#ai_ness').val('<?=$ai_ness?>');
        }
    })

    function add_api_input(){
        if($('#ai_name').val() == ""){
            showNotification("<?=t('error')?>","<?=t('msg_input_varname')?>","warning");
            return;
        }

        var options = {
            success: afterSuccess,  // post-submit callback
            beforeSend: beforeSubmit,
            resetForm: true        // reset the form after successful submit
        };

        $("#frm_api_input_edit").ajaxSubmit(options);

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
                $('#frm_go_api_input_list').submit();
            }else{
                showNotification("<?=t('error')?>","<?=t('msg_error_occured')?>","error");
            }
        }
    }
</script>