<div class="row" style="background: white;">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="btn-group"  style="float: right;margin-top: 20px;">
                <button type="button" class="btn red" style="font-size: 13px;" id="btnMultiDel"><i class="fa fa-trash-o"></i>&nbsp;<?=t('multiple_delete')?></button>
                <a type="button" class="btn btn-primary" style="font-size: 13px;" href="<?=site_url('admin/apimanage/write')?>"><i class="fa fa-plus"></i>&nbsp;API<?=t('add')?></a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="div_api_manage_table">
        <div class="col-md-12" style="margin-top: 10px;">
            <label><?=t('total')?> : <span><?=count($apilist)?></span><?=t('gen')?></label>
        </div>

        <div class="col-md-12">
            <table id="api_manage_table" class="table table-bordered">
                <thead style="background-color: #36c6d3">
                    <th style="width: 5%;text-align: center"></th>
                    <th style="width: 15%;text-align: center"><?=t('name')?> </th>
                    <th style="width: 10%;text-align: center"><?=t('access_way')?> </th>
                    <th style="width: 30%;text-align: center"><?=t('explain')?></th>
                    <th style="width: 14%;text-align: center"><?=t('etc')?></th>
                    <th style="width: 10%;text-align: center">INPUT <?=t('var')?></th>
                    <th style="width: 10%;text-align: center">OUTPUT <?=t('var')?></th>
                    <th style="width: 6%;text-align: center"><?=t('modify')?></th>
                </thead>
                <tbody>
                <?php
                    for($i=0;$i<count($apilist);$i++) {
                        ?>
                        <tr>
                            <td><input type="checkbox" class="chk" id="chk<?=$apilist[$i]['api_idx']?>" name="chk" value="<?=$apilist[$i]['api_idx']?>"></td>
                            <td><?=$apilist[$i]['api_name']?></td>
                            <td><?=$apilist[$i]['api_method']?></td>
                            <td><?=$apilist[$i]['api_exp']?></td>
                            <td><?=$apilist[$i]['api_bigo']?></td>
                            <td style="padding: 0px;"><a class="btn blue btn-sm" style="margin: 0px;padding: 3px 10px 3px 10px ;" href="<?=site_url('admin/apimanage/api_input_list')?>?id=<?=$apilist[$i]['api_idx']?>"><?=t('detail_view')?></a></td>
                            <td style="padding: 0px;"><a class="btn blue btn-sm" style="margin: 0px;padding: 3px 10px 3px 10px ;" href="<?=site_url('admin/apimanage/api_output_list')?>?id=<?=$apilist[$i]['api_idx']?>"><?=t('detail_view')?></a></td>
                            <td><a onclick="Edit('<?=$apilist[$i]['api_idx']?>')"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<form class="hidden" method="post" id="frm_go_apiwrite" action="<?=site_url('admin/apimanage/write')?>">
    <input type="hidden" name="api_idx" id="api_idx" value="0">
</form>

<script>
    $(document).ready(function(){
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(0)").addClass("open");
        $('#page_title').html("<?=t('menu_api_list')?>");
    })

    function Edit(id){
        $('#api_idx').val(id);
        $('#frm_go_apiwrite').submit();
    }

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

        if (!confirm("<?= t('msg_ask_delete')?>"))
            return;

        $.ajax({
            type:'post',
            url:'<?=site_url("admin/apimanage/delete_api_list")?>',
            data:{'id': obj },
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
                    showNotification("<?=t('error')?>","<?=t('msg_error_occured')?>","error");
                }
            }
        })
    });

    function drawTable(){
        $.ajax({
            type:'post',
            url:'<?=site_url("admin/apimanage/draw_apilist_table")?>',
            success:function(data){
                App.unblockUI('#total_body');
                $('#div_api_manage_table').html(data);
            }
        })
    }
</script>