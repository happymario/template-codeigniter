<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="col-md-12">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700"><?= t('api_name')  ?></label>
            <span><?= $info['api_name'] ?></span>
        </div>
        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">API <?= t('description') ?></label>
            <span><?= $info['api_exp'] ?></span>
        </div>

        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700"><?= t('request') ?></label>

            <table class="table">
                <tbody>
                <tr>
                    <th class="bg bg-success">URL</th>
                    <th>
                        <a href="<?= site_url("api/" . $info['api_name']) ?>"
                           target="_blank"><?= site_url("api/" . $info['api_name']) ?></a>
                    </th>
                </tr>
                <tr>
                    <th class="bg bg-success"><?= t('method') ?></th>
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
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th style="text-align: center" class="bg bg-warning" width="120"><?= t('variable_name') ?></th>
                        <th style="text-align: center" class="bg bg-warning" width="100"><?= t('data_type') ?></th>
                        <th style="text-align: center" class="bg bg-warning" width="80"><?= t('required') ?></th>
                        <th style="text-align: center" class="bg bg-warning"><?= t('description') ?></th>
                        <th style="text-align: center" class="bg bg-warning" width="250" style="text-align: center">
                            <button type="button" class="btn btn-xs btn-success" onclick="testResult()"><?= t('view_result') ?></button>
                        </th>
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
                                    <input type="file" multiple="multiple" name="<?= $arr_input[$i]['ai_name'].'[]' ?>">
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
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700"><?= t('response') ?></label>

            <table class="table table-hover">
                <tbody>
                <tr>
                    <th colspan="2" style="text-align: center" class="bg bg-warning" width="120"><?= t('variable_name') ?></th>
                    <th style="text-align: center" class="bg bg-warning" width="100"><?= t('data_type') ?></th>
                    <th style="text-align: center" class="bg bg-warning" width="80"><?= t('required') ?></th>
                    <th style="text-align: center" class="bg bg-warning"><?= t('description') ?></th>
                </tr>
                <tr>
                    <td colspan="2">result</td>
                    <td>Integer</td>
                    <td><?= t('required') ?></td>
                    <td style="text-align: left;">
                        <strong>0: <?= t('success') ?></strong><br>
                        <?= t('other_error') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">msg</td>
                    <td>String</td>
                    <td><?= t('required') ?></td>
                    <td style="text-align: left;">
                        <strong><?= t('err_msg_user') ?></strong><br>
                        <?= t('success_in_case_of_success') ?><br>
                        <?= t('error_msg_in_case_of_error') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">reason</td>
                    <td>String</td>
                    <td><?= t('required') ?></td>
                    <td style="text-align: left;">
                        <strong><?= t('err_reason_dev') ?></strong><br>
                        <?= t('empty_string_in_case_of_success') ?><br>
                        <?= t('error_reason_in_case_of_error') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">data</td>
                    <td>Object</td>
                    <td><?= t('only_when_success') ?></td>
                    <td style="text-align: left;">
                        <strong><?= t('exists_only_when_success') ?></strong><br><br>
                        <strong style="color: red;font-size: small"><?= t('these_are_data_object_variables') ?></strong>
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
        $('#menu_api_doc').addClass('active');
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