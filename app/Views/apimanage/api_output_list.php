<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="btn-group"  style="float: right;margin-top: 20px;">
                <button type="button" class="btn red" style="font-size: 13px;" id="btnMultiDel"><i class="fa fa-trash-o"></i>&nbsp;<?= t('multi_delete') ?></button>
                <a type="button" class="btn btn-success" style="font-size: 13px;" href="<?=site_url('api/ApiManage/api_input_list')?>?id=<?=$api_idx?>"><?= t('go_input_list') ?></a>
                <a type="button" class="btn btn-primary" style="font-size: 13px;" href="<?=site_url('api/ApiManage/edit_api_output_data')?>?ai_idx=0&api_idx=<?=$api_idx?>"><i class="fa fa-plus"></i>&nbsp;<?= t('add_output_variable') ?></a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="div_api_input_table">
        <div class="col-md-12" style="margin-top: 10px;">
            <label><?= t('all') ?> : <span><?=count($arr_output)?></span>건</label>
        </div>

        <div class="col-md-12">
            <table id="api_input_table" class="table">
                <thead>
                <th style="width: 5%;text-align: center"></th>
                <th style="width: 15%;text-align: center"><?= t('variable_name') ?></th>
                <th style="width: 15%;text-align: center"><?= t('data_type') ?></th>
                <th style="width: 10%;text-align: center"><?= t('required') ?></th>
                <th style="width: 40%;text-align: center"><?= t('description') ?></th>
                <th style="width: 8%;text-align: center"><?= t('order') ?></th>
                <th style="width: 6%;text-align: center"><?= t('edit') ?></th>
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
                        <td><a href="<?=site_url('api/ApiManage/edit_api_output_data')?>?ai_idx=<?=$arr_output[$i]['ai_idx']?>&api_idx=<?=$api_idx?>"><i class="fa fa-edit"></i></a></td>
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
        $('#menu_api_mng').addClass('active');
        $('#page_title').html("<?=$api_name?>:Output<?= t('list') ?>");
    })

    $("#btnMultiDel").click(function () {
        var chks = document.getElementsByName("chk");
        var obj = new Object();
        var id_arr = [];

        var nNum = 0;
        for (var nInd = 0; nInd < chks.length; nInd ++) {
            if (chks[nInd].checked == true) {
                obj[nNum] = chks[nInd].value;
                id_arr.push(chks[nInd].value);
                nNum ++;
            }
        }

        if (nNum == 0) {
            return;
        }

        if (!confirm("<?= t('msg_ask_delete') ?>"))
            return;

        $.ajax({
            type:'post',
            url:'<?=site_url("api/ApiManage/delete_api_output_data")?>',
            data:'id=' + id_arr.join(",") + '&api_idx=<?=$api_idx?>',
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
                    showNotification("<?= t('error') ?>","<?= t('failed') ?>","error");
                }
            }
        })
    });

    function drawTable(){
        $.ajax({
            type:'post',
            url:'<?=site_url("api/ApiManage/draw_api_output_list")?>',
            data:'api_idx=' + '<?=$api_idx?>',
            success:function(data){
                App.unblockUI('#total_body');
                $('#div_api_input_table').html(data);
            }
        })
    }
</script>