<div class="row">
    <div class="col-md-12" style="margin-top: 10px;">
        <div class="col-md-12">
            <table id="api_manage_table" class="table">
                <thead>
                <th style="width: 20px;text-align: center">No.</th>
                <th style="width: 15%;text-align: center"><?= t('name') ?></th>
                <th style="width: 40%;text-align: center"><?= t('description') ?></th>
                <th style="text-align: center">URL</th>
                </thead>
                <tbody>
                <?php
                for($i=0;$i<count($apilist);$i++) {
                    ?>
                    <tr <?= ($apilist[$i]['api_ver'] > API_VERSION) ? 'style="background-color: rgba(255, 0, 0, 0.08)"' : '' ?>>
                        <td><?=$i+1?></td>
                        <td><a style="cursor: pointer;" href="<?=site_url('api/ApiManage/view')?>?api_idx=<?=$apilist[$i]['api_idx']?>"><?=$apilist[$i]['api_name']?></a></td>
                        <td><?=$apilist[$i]['api_exp']?></td>
                        <td><a style="cursor: pointer;" target="_blank" href="<?=site_url("api/".$apilist[$i]['api_name'])?>"><?=site_url("api/api/".$apilist[$i]['api_name'])?></a></td>
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
        $('#menu_api_doc').addClass('active');
        $('#page_title').html("<?= t('api_doc') ?>");
    })
</script>