<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <form method="post" action="<?=site_url('apiManage/api_output_edit')?>" id="frm_api_output_edit">
            <input class="hidden" name="ai_idx" value="<?=$ai_idx?>">
            <input class="hidden" name="api_idx" value="<?=$api_idx?>">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;">변수명</label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" id="ai_name" name="ai_name" value="<?php echo  $ai_idx > 0  ? $ai_name : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;">타입</label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="ai_type" id="ai_type">
                            <option value="String">String</option>
                            <option value="Integer">Integer</option>
                            <option value="Double">Double</option>
                            <option value="Object">Object</option>
                            <option value="String배열">String배열</option>
                            <option value="Integer배열">Integer배열</option>
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
                    <label style="font-size: 13px;float: right;font-weight: 700;">종류</label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-2" style="padding: 0px;">
                        <select class="form-control" name="ai_ness" id="ai_ness">
                            <option value="필수">필수</option>
                            <option value="성공시">성공시</option>
                            <option value="오류시">오류시</option>
                            <option value="빈값">빈값</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;">설명</label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="6" name="ai_exp"><?php echo  $ai_idx > 0  ? $ai_exp : ""; ?></textarea>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label style="font-size: 13px;float: right;font-weight: 700;line-height: 30px;">순서</label>
                </div>
                <div class="col-md-10">
                    <input class="form-control" name="ai_sort"  value="<?php echo  $ai_idx > 0  ? $ai_sort : ""; ?>">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px;">
                <div class="col-md-12">
                    <div style="float: right;">
                        <a class="btn btn-danger" onclick="history.go(-1)">취소</a>
                        <a class="btn btn-success" onclick="add_api_input()">저장</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<form class="hidden" method="get" action="<?=site_url('apiManage/api_output_list')?>" id="frm_go_api_output_list">
    <input class="hidden" name="id" value="<?=$api_idx?>">
</form>
<script>
    $(document).ready(function(){
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(0)").addClass("open");
        $('#page_title').html("Output변수 추가");

        if('<?=$ai_idx?>' != '0'){
            $('#ai_type').val('<?=$ai_type?>');
            $('#ai_ness').val('<?=$ai_ness?>');
        }
    })

    function add_api_input(){
        if($('#ai_name').val() == ""){
            showNotification("오류","변수명을 입력해주세요.","warning");
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
                showNotification("오류","조작이 실패하였습니다.","error");
            }
        }
    }
</script>