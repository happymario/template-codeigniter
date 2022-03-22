<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 3:46 PM
 */
?>
<!--begin::SearchForm-->
<div class="card card-custom">
    <div class="card-body">

        <div class="radio-inline" style="width: 100%;">
            <?php
            $arr_filter = ["심사중", "승인", "거절"];
            $arr_status = [STATUS_CHECK, STATUS_NORMAL, STATUS_DELETE];
            for ($i = 0; $i < count($arr_filter); $i++) {
                $filter = $arr_filter[$i];
                if ($i == 0) {
                    echo '<label class="radio"> <input type="radio" value="' . $arr_status[$i] . '" name="input-search-status" checked> <span></span> ' . $filter . '</label>';
                } else {
                    echo '<label class="radio" style="margin-left: 10px;"> <input type="radio" value="' . $arr_status[$i] . '" name="input-search-status"><span></span> ' . $filter . '</label>';
                }
            }
            ?>
        </div>

    </div>
</div>
<!--end::SearchForm-->

<!--begin::Card-->
<div class="card card-custom" style="margin-top: 20px;">
    <div class="mt-element-card mt-element-overlay col-md-12" style="margin-top: 20px;">
        <div class="row" id="photo-grid">

        </div>
    </div>
</div>
<!--end::Card-->

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
        var starHtml = "<div class=\"col-lg-3\" id=\"user_"+user["uid"]+"\">\n" +
            "<div class=\"card card-custom overlay\">\n" +
            "<div class=\"card-body p-0\">\n" +
            "  <div class=\"overlay-wrapper\">\n" +
            "   <img src=\""+user["profile_url"]+"\" alt=\"\" class=\"w-100 rounded\" />\n" +
            "  </div>\n" +
            "<div class=\"overlay-layer align-items-end justify-content-center\">\n" +
            "<div class=\"d-flex flex-grow-1 flex-center bg-white-o-5 py-5\">"
        var buttonHtml =
            '                                    <a class="btn font-weight-bold btn-primary btn-shadow" onclick="' + user['uid'] + ","+'onPhotoStatus(' + user['profile_url_check'] + ')">on</a>\n';
        var lastHtml = "</div></div></div></div></div>";

        if(user['profile_url_check'] == '<?=STATUS_CHECK?>') {
            buttonHtml =
                '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_NORMAL?> + ')">'+'<?=t('agree')?>'+'</a>\n' +
                '<a class="btn font-weight-bold btn-light-primary btn-shadow ml-2" onclick="onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_DELETE?> + ')">'+'<?= t('refuse')?>'+'</a>\n';
        }
        else if(user['profile_url_check'] == '<?=STATUS_NORMAL?>') {
            buttonHtml = '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="onPhotoStatus(' + user['uid'] + "," + <?=STATUS_DELETE?> + ')">'+'<?= t('refuse')?>'+'</a>\n';
        }
        else if(user['profile_url_check'] == '<?=STATUS_DELETE?>') {
            buttonHtml = '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_NORMAL?> + ')">'+'<?= t('agree')?>'+'</a>\n';
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
            url: '<?= site_url("admin/user/ajax_photo_list") ?>',
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
                    showNotification("<?=t('error')?>", "<?=t('msg_error_server')?>", "error");
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
            url: '<?= site_url("admin/user/ajax_change_photo_status") ?>',
            type: 'post',
            data: {'user_uid':user_uid, "status":status},
            beforeSend: function () {
                showLoading();
            },
            success: function (result) {
                hideLoading();
                if (result == "<?=AJAX_RESULT_SUCCESS?>") {
                    showNotification("<?=t('success')?>", "<?=t('msg_success_done')?>", "success");
                    $('#user_'+user_uid).remove();

                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_request')?>", "error");
                }
            },
            error: function (a, b, c) {
                hideLoading();
                showNotification("<?=t('error')?>","<?=t('msg_error_server')?>","error");
            }
        });
    }

</script>