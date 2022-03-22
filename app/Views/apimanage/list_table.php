<div class="col-md-12" style="margin-top: 10px;">
    <label><?= t('all') ?> : <span><?=count($apilist)?></span>건</label>
</div>

<div class="col-md-12">
    <table id="api_manage_table" class="table">
        <thead>
        <th style="width: 5%;text-align: center"></th>
        <th style="width: 15%;text-align: center"><?= t('name') ?></th>
        <th style="width: 10%;text-align: center"><?= t('method') ?></th>
        <th style="width: 30%;text-align: center"><?= t('description') ?></th>
        <th style="width: 14%;text-align: center"><?= t('note') ?></th>
        <th style="width: 10%;text-align: center"><?= t('input_variable') ?></th>
        <th style="width: 10%;text-align: center"><?= t('output_variable') ?></th>
        <th style="width: 6%;text-align: center"><?= t('edit') ?></th>
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
                <td style="padding: 0px;"><a class="btn blue btn-sm" style="margin: 0px;padding: 3px 10px 3px 10px ;" href="<?=site_url('api/ApiManage/api_input_list')?>?id=<?=$apilist[$i]['api_idx']?>"><?= t('detail') ?></a></td>
                <td style="padding: 0px;"><a class="btn blue btn-sm" style="margin: 0px;padding: 3px 10px 3px 10px ;" href="<?=site_url('api/ApiManage/api_output_list')?>?id=<?=$apilist[$i]['api_idx']?>"><?= t('detail') ?></a></td>
                <td><a onclick="Edit('<?=$apilist[$i]['api_idx']?>')"><i class="fa fa-edit"></i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>