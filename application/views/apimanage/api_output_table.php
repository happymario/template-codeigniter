<div class="col-md-12" style="margin-top: 10px;">
    <label><?=t('total')?> : <span><?=count($arr_output)?></span><?=t('gen')?></label>
</div>

<div class="col-md-12" id="div_api_input_table">
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
                <td><a href="<?=site_url('apiManage/edit_api_output_data')?>?ai_idx=<?=$arr_output[$i]['ai_idx']?>&api_idx=<?=$api_idx?>"><i class="fa fa-edit"></i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>