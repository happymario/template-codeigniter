<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <form method="post" action="<?=site_url('apiManage/api_write')?>" id="api_save_form">
            <input class="hidden" name="api_idx" value="<?=$api_idx?>">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;">API이름</label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" id="api_name" name="api_name" value="<?php echo  $api_idx > 0  ? $api_name : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;">설명</label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" name="api_exp"><?php echo  $api_idx > 0  ? $api_exp : ""; ?></textarea>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;">호출방식</label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="api_method" id="api_method">
                            <option value="POST">POST</option>
                            <option value="GET">GET</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;">사용여부</label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="api_use" id="api_use">
                            <option value="1">사용</option>
                            <option value="0">사용안함</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;">형태</label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" name="api_status"  value="<?php echo  $api_idx > 0  ? $api_status : ""; ?>">
                </div>
            </div>
            
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;">비고</label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" name="api_bigo"><?php echo  $api_idx > 0  ? $api_bigo : ""; ?></textarea>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-12">
                    <div style="float: right;">
                        <a class="btn btn-danger" onclick="history.go(-1)">취소</a>
                        <a class="btn btn-success" onclick="add_api()">추가</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<form class="hidden" method="get" action="<?=site_url('apiManage/apimanage')?>" id="frm_go_apimanage">
</form>
<script>
    $(document).ready(function(){
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(0)").addClass("open");
        $('#page_title').html("_API추가");

        if('<?=$api_idx?>' != '0'){
            $('#api_method').val('<?=$api_method?>');
            $('#api_use').val('<?=$api_use?>');
        }
    })

    function add_api(){
        if($('#api_name').val() == ""){
            showNotification("오류","API이름을 입력해주세요.","warning");
            return;
        }

        var options = {
            success: afterSuccess,  // post-submit callback
            beforeSend: beforeSubmit,
            resetForm: true        // reset the form after successful submit
        };

        $("#api_save_form").ajaxSubmit(options);

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
                $('#frm_go_apimanage').submit();
            }else{
                showNotification("오류","조작이 실패하였습니다.","error");
            }
        }
    }
</script>