<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="btn-group"  style="float: right;margin-top: 20px;">
                <button type="button" class="btn red" style="font-size: 13px;" id="btnMultiDel"><i class="fa fa-trash-o"></i>&nbsp;<?=t('multiple_delete')?></button>
                <a type="button" class="btn btn-success" style="font-size: 13px;" href="<?=site_url('admin/apimanage/api_input_list')?>?id=<?=$api_idx?>">Input <?=t('list_go')?></a>
                <a type="button" class="btn btn-primary" style="font-size: 13px;" href="<?=site_url('admin/apimanage/edit_api_output_data')?>?ai_idx=0&api_idx=<?=$api_idx?>"><i class="fa fa-plus"></i>&nbsp;Output <?=t('var')?><?=t('add')?></a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="div_api_input_table">
        <div class="col-md-12" style="margin-top: 10px;">
            <label><?=t('total')?> : <span><?=count($arr_output)?></span><?=t('gen')?></label>
        </div>

        <div class="col-md-12">
            <table id="api_input_table" class="table table-bordered">
                <thead style="background-color: #36c6d3">
                <th style="width: 5%;text-align: center"></th>
                <th style="width: 15%;text-align: center"><?=t('var_name')?></th>
                <th style="width: 15%;text-align: center"><?=t('type')?></th>
                <th style="width: 10%;text-align: center"><?=t('kind')?></th>
                <th style="width: 40%;text-align: center"><?=t('explain')?></th>
                <th style="width: 8%;text-align: center"><?=t('order')?></th>
                <th style="width: 6%;text-align: center"><?=t('update')?></th>
                </thead>
                <tbody>
                <?php
                for($i = 0;$i<count($arr_output);$i++) {
                    ?>
                    <tr>
                        <td><input type="checkbox" class="chk" id="chk<?=$arr_output[$i]['ai_idx']?>" name="chk" value="<?=$arr_output[$i]['ai_idx']?>"></td>
                        <td><?=$arr_output[$i]['ai_name']?></td>
                        <td><?=$arr_output[$i]['ai_type']?></td>
                        <td><?=$arr_output[$i]['ai_ness']?></td>
                        <td style="text-align: left;white-space: pre-wrap;"><?=$arr_output[$i]['ai_exp']?></td>
                        <td><?=$arr_output[$i]['ai_sort']?></td>
                        <td><a href="<?=site_url('admin/apimanage/edit_api_output_data')?>?ai_idx=<?=$arr_output[$i]['ai_idx']?>&api_idx=<?=$api_idx?>"><i class="fa fa-edit"></i></a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(0)").addClass("open");
        $('#page_title').html("<?=$api_name?>:Output <?=t('list')?>");
    })

    $("#btnMultiDel").click(function () {
        var chks = document.getElementsByName("chk");
        var obj = new Object();

        var nNum = 0;
        for (var nInd = 0; nInd < chks.length; nInd ++) {
            if (chks[nInd].checked == true) {
                obj[nNum] = chks[nInd].value;
                nNum ++;
            }
        }

        if (nNum == 0) {
            return;
        }

        if (!confirm("<?=t('msg_ask_delete')?>"))
            return;

        $.ajax({
            type:'post',
            url:'<?=site_url("admin/apimanage/delete_api_output_data")?>',
            data:'id=' + JSON.stringify(obj) + '&api_idx=<?=$api_idx?>',
            beforeSend:function(){
                App.blockUI({
                    animate: true,
                    target: '#total_body',
                    boxed: false
                });
            },
            success:function(data){
                if(data == "success"){
                    drawTable();
                }else{
                    App.unblockUI('#total_body');
                    showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                }
            }
        })
    });

    function drawTable(){
        $.ajax({
            type:'post',
            url:'<?=site_url("admin/apimanage/draw_api_output_list")?>',
            data:'api_idx=' + '<?=$api_idx?>',
            success:function(data){
                App.unblockUI('#total_body');
                $('#div_api_input_table').html(data);
            }
        })
    }
</script>