<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
        'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta name='viewport' content='width=device-width'/>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
    <title>알고바다</title>
</head>
<body style='http://localhost:9901/background-color: #f6f6f6; box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; height: 100%; line-height: 1.6; margin: 0; padding: 0; width: 100% !important;'>
<table class='body-wrap'
       style='background-color: #f6f6f6; box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0; width: 100%;'>
    <tr style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
        <td style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0; vertical-align: top;'></td>
        <td style='box-sizing: border-box; clear: both !important; display: block !important; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0 auto !important; max-width: 600px !important; padding: 0; vertical-align: top;'
            width='600'>
            <div class='content'
                 style='box-sizing: border-box; display: block; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0 auto; max-width: 600px; padding: 20px;'>
                <table cellpadding='0' cellspacing='0' class='main'
                       style='background: #fff; border: 1px solid #e9e9e9; border-radius: 3px; box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'
                       width='100%'>
                    <tr style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                        <td align='center'>
                            <div style='margin-top: 20px'><img
                                        src='<?= base_url() ?>assets/images/ic_logo.png' ALT='알고바다'
                                        style='max-width: 80%;height: auto;display:block'></div>
                        </td>
                    </tr>
                    <tr style='box-sizing: border-box; font-family: "NanumGothic", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                        <td class='content-wrap'
                            style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 20px; vertical-align: top;'>
                            <table cellpadding='0' cellspacing='0'
                                   style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'
                                   width='100%'>
                                <tr style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                                    <td class='content-block'
                                        style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0 0 20px; text-align: left; vertical-align: top;'>
                                        <b><font style='font-size:11pt;'><?= $mail_title ?></font></b>
                                    </td>
                                </tr>
                                <tr style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                                    <td class='content-block'
                                        style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0; text-align: left; vertical-align: top;'>
                                        <div style='padding: 20px 20px 20px 20px; border:3px solid #ea5916;'>
                                            <font style='font-size:11pt;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;'>
                                                안녕하세요! 알고바다입니다.
                                                <br/>
                                                <?= $mail_description ?>
                                            </font>
                                            <br/>
                                            <?php if (isset($mail_important_string)) { ?>
                                                <br/>
                                                <b><?= $mail_important_string ?></b>
                                                <br/>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php if (isset($mail_footer)) { ?>
                        <tr>
                            <td style="text-align: center">
                                <?= $mail_footer ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class='footer'
                     style='box-sizing: border-box; clear: both; color: #999; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 20px; width: 100%;'>
                    <table style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'
                           width='100%'>
                        <tr style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                            <td class='aligncenter content-block'
                                style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 12px; margin: 0; padding: 0 0 20px; text-align: left; vertical-align: top;'>
                                <div style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                                    본 메일은 발신전용이며 회신되지 않습니다.<br>
                                    본 메일과 관련한 문의는 고객센터이메일 <a href='mailto:info@ihappymind.com'>info@ihappymind.com</a>로 문의하여 주시기 바랍니다.<br>
                                </div>
                            </td>
                        </tr>
                        <tr style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                            <td class='aligncenter content-block'
                                style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 12px; margin: 0; padding: 0 0 20px; text-align: center; vertical-align: top;'>
                                <div style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0;'>
                                    Copyright ⓒ Happymind All Rights Reserved.<br/>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style='box-sizing: border-box; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0; padding: 0; vertical-align: top;'></td>
    </tr>
</table>
</body>
</html>