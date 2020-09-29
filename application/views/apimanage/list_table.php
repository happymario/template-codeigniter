<div class="col-md-12" style="margin-top: 10px;">
    <label>전체 : <span><?=count($apilist)?></span>건</label>
</div>

<div class="col-md-12">
    <table id="api_manage_table" class="table table-bordered">
        <thead style="background-color: #36c6d3">
        <th style="width: 5%;text-align: center"></th>
        <th style="width: 15%;text-align: center">이름</th>
        <th style="width: 10%;text-align: center">호출방식</th>
        <th style="width: 30%;text-align: center">설명</th>
        <th style="width: 14%;text-align: center">비고</th>
        <th style="width: 10%;text-align: center">INPUT변수</th>
        <th style="width: 10%;text-align: center">OUTPUT변수</th>
        <th style="width: 6%;text-align: center">수정</th>
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
                <td style="padding: 0px;"><a class="btn blue btn-sm" style="margin: 0px;padding: 3px 10px 3px 10px ;" href="<?=site_url('apiManage/api_input_list')?>?id=<?=$apilist[$i]['api_idx']?>">상세보기</a></td>
                <td style="padding: 0px;"><a class="btn blue btn-sm" style="margin: 0px;padding: 3px 10px 3px 10px ;" href="<?=site_url('apiManage/api_output_list')?>?id=<?=$apilist[$i]['api_idx']?>">상세보기</a></td>
                <td><a onclick="Edit('<?=$apilist[$i]['api_idx']?>')"><i class="fa fa-edit"></i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>