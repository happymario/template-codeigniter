<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 3:46 PM
 */
?>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 form-group" style="margin-top: 8px;">
        <div class="divider-filter"/>

        <div class="mt-radio-list" style="width: 100%;">
            <?php
            $arr_filter = ["심사중", "승인", "거절"];
            $arr_status = [STATUS_CHECK, STATUS_NORMAL, STATUS_DELETE];
            for ($i = 0; $i < count($arr_filter); $i++) {
                $filter = $arr_filter[$i];
                if ($i == 0) {
                    echo '<label class="mt-radio mt-radio-outline my">' . $filter . '
                                        <input type="radio" value="' . $arr_status[$i] . '" name="input-search-status" checked>
                                        <span></span>
                                      </label>';
                } else {
                    echo '<label class="mt-radio mt-radio-outline my" style="margin-left: 10px;">' . $filter . '
                                        <input type="radio" value="' . $arr_status[$i] . '" name="input-search-status">
                                        <span></span>
                                      </label>';
                }
            }
            ?>
        </div>

        <div class="divider-filter"/>
    </div>

    <div class="mt-element-card mt-element-overlay col-md-12" style="margin-top: 20px;">
        <div class="row" id="photo-grid">

        </div>
    </div>
</div>

<script>
    var gCurPage = 0;
    var gPhotoGrid = null;
    var gLoading = false;
    $(function () {
        init();
        $("input[name='input-search-status']").change(function () {
            refresh();
        });

        $(window).scroll(function() {
            if (($(window).scrollTop() + $('.page-header').height()) >= $(document).height() - $(window).height()) {
                var pageNum = gCurPage + 1;
                reqGetData(pageNum);
            }
        });

        reqGetData(0);
    });

    function onPhotoStatus(user_uid, status) {
        reqChangePhotoStatus(user_uid, status);
    }

    function init() {
        gPhotoGrid = $('#photo-grid');
    }

    function refresh() {
        reqGetData(gCurPage);
    }

    function addPhotoItem(user) {
        var starHtml = ' <div class="col-lg-1.5 col-md-2 col-sm-3 col-xs-6" id="user_'+user['uid']+'">\n' +
            '                <div class="mt-card-item">\n' +
            '                    <div class="mt-card-avatar mt-overlay-4">\n' +
            '                        <img src="' + user['profile_url'] + '">\n' +
            '                        <div class="mt-overlay">\n' +
            '                            <h2>' + user['name'] + '</h2>\n' +
            '                            <div class="mt-info font-white">\n' +
            '                                <div class="mt-card-content">\n';
        var buttonHtml =
            '                                    <a class="btn blue" onclick="' + user['uid'] + ","+'onPhotoStatus(' + user['profile_url_check'] + ')">on</a>\n';
        var lastHtml =
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>';

        if(user['profile_url_check'] == '<?=STATUS_CHECK?>') {
            buttonHtml =
                '<a class="btn blue" onclick="onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_NORMAL?> + ')">'+'<?=t('agree')?>'+'</a>\n' +
                '<a class="btn blue" onclick="onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_DELETE?> + ')">'+'<?= t('refuse')?>'+'</a>\n';
        }
        else if(user['profile_url_check'] == '<?=STATUS_NORMAL?>') {
            buttonHtml = '<a class="btn blue" onclick="onPhotoStatus(' + user['uid'] + "," + <?=STATUS_DELETE?> + ')">'+'<?= t('refuse')?>'+'</a>\n';
        }
        else if(user['profile_url_check'] == '<?=STATUS_DELETE?>') {
            buttonHtml = '<a class="btn blue" onclick="onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_NORMAL?> + ')">'+'<?= t('agree')?>'+'</a>\n';
        }

        gPhotoGrid.append((starHtml + buttonHtml + lastHtml));
    }

    function reqGetData(page) {
        if(gLoading == true) {
            return;
        }
        var status = '';
        $("input[name='input-search-status']").each(function (idx) {
            // 해당 체크박스의 Value 가져오기
            var chk = $(this).is(":checked");
            if (chk == true) {
                status = $(this).val();
            }
        });
        gLoading = true;
        $.ajax({
            url: '<?= site_url("user/ajax_photo_list") ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                page: page,
                status: status
            },
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == "<?=AJAX_RESULT_ERROR?>") {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                    return;
                }
                gLoading = false;
                gCurPage = page;

                if(page == 0) {
                    gPhotoGrid.empty();
                }

                for (var i = 0; i < result.list.length; i++) {
                    addPhotoItem(result.list[i]);
                }
            }
        });
    }

    function reqChangePhotoStatus(user_uid, status) {
        $.ajax({
            url: '<?= site_url("user/ajax_change_photo_status") ?>',
            type: 'post',
            data: {'user_uid':user_uid, "status":status},
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == "<?=AJAX_RESULT_SUCCESS?>") {
                    showNotification("<?=t('success')?>", "<?=t('msg_success_oper')?>", "success");
                    $('#user_'+user_uid).remove();

                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_fix')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>","<?=t('msg_error_occured')?>","error");
            }
        });
    }

</script>