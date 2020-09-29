<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="col-md-12">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">API명</label>
            <span><?= $info['api_name'] ?></span>
        </div>
        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">API설명</label>
            <span><?= $info['api_exp'] ?></span>
        </div>

        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">호출정보</label>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="bg bg-success">호출주소</th>
                    <th>
                        <a href="<?= site_url("api/" . $info['api_name']) ?>"
                           target="_blank"><?= site_url("api/" . $info['api_name']) ?></a>
                    </th>
                </tr>
                <tr>
                    <th class="bg bg-success">호출방식</th>
                    <th><?= $info['api_method'] ?></th>
                </tr>
                <tr>
                    <th class="bg bg-success">Request Content Type</th>
                    <th>application/x-www-form-urlencoded</th>
                </tr>
                <tr>
                    <th class="bg bg-success">Response Content Type</th>
                    <th>application/json</th>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <form action="<?= site_url("api/" . $info['api_name']) ?>" method="<?= $info['api_method'] ?>"
                  enctype="multipart/form-data" id="frm_test">
                <input type="hidden" name="pretty" value="1">
                <table class="table table-hover table-bordered">
                    <tbody>
                    <tr>
                        <th style="text-align: center" class="bg bg-warning" width="120">변수명</th>
                        <th style="text-align: center" class="bg bg-warning" width="100">타입</th>
                        <th style="text-align: center" class="bg bg-warning" width="80">종류</th>
                        <th style="text-align: center" class="bg bg-warning">설명</th>
                        <th style="text-align: center" class="bg bg-warning" width="250" style="text-align: center">
                            <button type="button" class="btn btn-xs btn-success" onclick="testResult()">결과보기</button>
                        </th>
                    </tr>
                    <tr style="display: none">
                        <td>lang</td>
                        <td>String</td>
                        <td>생략가능</td>
                        <td style="text-align: left;">
                            오류메시지 언어: 'korean'인 경우 한글, 생략 또는 기타 영문(default)
                        </td>
                        <td>
                            <select name="lang">
                                <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;english&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </option>
                                <option value="korean" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;korean&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                            </select>
                        </td>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($arr_input); $i++) {
                        ?>
                        <tr>
                            <td><?= $arr_input[$i]['ai_name'] ?></td>
                            <td><?= $arr_input[$i]['ai_type'] ?></td>
                            <td><?= $arr_input[$i]['ai_ness'] ?></td>
                            <td style="text-align: left;white-space: pre-wrap;"><?= $arr_input[$i]['ai_exp'] ?></td>
                            <td>
                                <?php
                                if ($arr_input[$i]['ai_type'] == "File") {
                                    ?>
                                    <input type="file" name="<?= $arr_input[$i]['ai_name'] ?>">
                                    <?php
                                } else if ($arr_input[$i]['ai_type'] == "Multi Files") {
                                    ?>
                                    <input type="file" multiple="multiple" name="<?= $arr_input[$i]['ai_name'] ?>">
                                    <?php
                                } else {
                                    ?>
                                    <input name="<?= $arr_input[$i]['ai_name'] ?>">
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">리턴값</label>

            <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                    <th colspan="2" style="text-align: center" class="bg bg-warning" width="120">변수명</th>
                    <th style="text-align: center" class="bg bg-warning" width="100">타입</th>
                    <th style="text-align: center" class="bg bg-warning" width="80">종류</th>
                    <th style="text-align: center" class="bg bg-warning">설명</th>
                </tr>
                <tr>
                    <td colspan="2">result</td>
                    <td>Integer</td>
                    <td>필수</td>
                    <td style="text-align: left;">
                        <strong>0: 성공</strong><br>
                        기타 오류 &nbsp;&nbsp; <a target="_blank" href="<?= site_url('apiManage/apierrors') ?>">오류코드표 바로가기</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">msg</td>
                    <td>String</td>
                    <td>필수</td>
                    <td style="text-align: left;">
                        <strong>오류메시지(사용자용)</strong><br>
                        성공인 경우 '성공', 'Success'<br>
                        오류인 경우 오류메시지
                    </td>
                </tr>
                <tr>
                    <td colspan="2">reason</td>
                    <td>String</td>
                    <td>필수</td>
                    <td style="text-align: left;">
                        <strong>오류원인(개발자용)</strong><br>
                        성공인 경우 빈 문자열<br>
                        오류인 경우 오류원인
                    </td>
                </tr>
                <tr>
                    <td colspan="2">data</td>
                    <td>Object</td>
                    <td>성공시</td>
                    <td style="text-align: left;">
                        <strong>성공인 경우에만 존재함</strong><br><br>
                        <strong style="color: red;font-size: small">※아래의 필드들은 data object 내부변수들임</strong>
                    </td>
                </tr>

                <?php
                for ($i = 0; $i < count($arr_output); $i++) {
                    ?>
                    <tr>
                        <?php if ($i === 0) {
                            echo '<td id="td_data_subs" rowspan="' . count($arr_output) . '">data</td>';
                        } ?>
                        <td><?= $arr_output[$i]['ai_name'] ?></td>
                        <td><?= $arr_output[$i]['ai_type'] ?></td>
                        <td><?= $arr_output[$i]['ai_ness'] ?></td>
                        <td style="text-align: left;white-space: pre-wrap;"><?= $arr_output[$i]['ai_exp'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:24px;color: black;font-weight: 700">JSON Decoded Sample</label>

            <textarea id="jsondecode_result" class="form-control" readonly rows="20"></textarea>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(1)").addClass("open");
        $('#page_title').html("<?=$info['api_name']?> : <?=$info['api_exp']?>");
    })

    function testResult() {
        var options = {
            success: afterSuccess,  // post-submit callback
            beforeSend: beforeSubmit,
            error: afterError,
            resetForm: false        // reset the form after successful submit
        };

       $("#frm_test").ajaxSubmit(options);
        // $("#frm_test").submit();

        function beforeSubmit() {
            App.blockUI({
                animate: true,
                target: '#total_body',
                boxed: false
            });
        }

        function afterSuccess(data) {
            App.unblockUI('#total_body');
            $('#jsondecode_result').html(data);
        }

        function afterError(request, status, error) {
            App.unblockUI('#total_body');
            var data = "code:" + request.status + "\n" + "error:" + error + "\n\n" + "message:" + request.responseText;
            $('#jsondecode_result').text(data);
        }
    }
</script>