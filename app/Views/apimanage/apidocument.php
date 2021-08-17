<div class="row">
    <div class="col-md-12" style="margin-top: 10px;">
        <div class="col-md-12">
            <table id="api_manage_table" class="table table-bordered">
                <thead style="background-color: #36c6d3">
                <th style="width: 20px;text-align: center">No.</th>
                <th style="width: 15%;text-align: center"><?=t('name')?></th>
                <th style="width: 40%;text-align: center"><?=t('explain')?></th>
                <th style="text-align: center">URL</th>
                </thead>
                <tbody>
                <?php
                for($i=0;$i<count($apilist);$i++) {
                    ?>
                    <tr <?= ($apilist[$i]['api_ver'] > API_CURRENT_VERSION) ? 'style="background-color: rgba(255, 0, 0, 0.08)"' : '' ?>>
                        <td><?=$i+1?></td>
                        <td><a style="cursor: pointer;" href="<?=site_url('apiManage/view')?>?api_idx=<?=$apilist[$i]['api_idx']?>"><?=$apilist[$i]['api_name']?></a></td>
                        <td><?=$apilist[$i]['api_exp']?></td>
                        <td><a style="cursor: pointer;" target="_blank" href="<?=site_url("api/".$apilist[$i]['api_name'])?>"><?=site_url("api/".$apilist[$i]['api_name'])?></a></td>
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
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(1)").addClass("open");
        $('#page_title').html("<?=t('menu_api_doc')?>");
    })
</script>