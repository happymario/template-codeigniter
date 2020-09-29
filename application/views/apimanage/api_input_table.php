<div class="col-md-12" style="margin-top: 10px;">
    <label>전체 : <span><?=count($arr_input)?></span>건</label>
</div>

<div class="col-md-12">
    <table id="api_input_table" class="table table-bordered">
        <thead style="background-color: #36c6d3">
        <th style="width: 5%;text-align: center"></th>
        <th style="width: 15%;text-align: center">변수명</th>
        <th style="width: 15%;text-align: center">타입</th>
        <th style="width: 10%;text-align: center">종류</th>
        <th style="width: 40%;text-align: center">설명</th>
        <th style="width: 8%;text-align: center">순서</th>
        <th style="width: 6%;text-align: center">수정</th>
        </thead>
        <tbody>
        <?php
        for($i = 0;$i<count($arr_input);$i++) {
            ?>
            <tr>
                <td><input type="checkbox" class="chk" id="chk<?=$arr_input[$i]['ai_idx']?>" name="chk" value="<?=$arr_input[$i]['ai_idx']?>"></td>
                <td><?=$arr_input[$i]['ai_name']?></td>
                <td><?=$arr_input[$i]['ai_type']?></td>
                <td><?=$arr_input[$i]['ai_ness']?></td>
                <td style="text-align: left;white-space: pre-wrap;"><?=$arr_input[$i]['ai_exp']?></td>
                <td><?=$arr_input[$i]['ai_sort']?></td>
                <td><a href="<?=site_url('apiManage/edit_api_input_data')?>?ai_idx=<?=$arr_input[$i]['ai_idx']?>&api_idx=<?=$api_idx?>"><i class="fa fa-edit"></i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>