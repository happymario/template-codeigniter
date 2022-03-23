<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 3:46 PM
 */
?>

<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Pages</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="<?= base_url() ?>/admin/home"
                       class="text-muted text-hover-primary"><?= t('menu_home') ?></a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark"><?= $page_title ?? '' ?></li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Search vertical-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Layout-->
            <div class="flex-lg-row-fluid">
                <!--begin::Toolbar-->
                <div class="d-flex flex-wrap flex-stack pb-7">
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
                <!--end::Toolbar-->
                <!--begin::Row-->
                <div class="row g-6 g-xl-9" id="photo-grid">

                </div>
                <!--begin::Row-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Search vertical-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

<script>
    // class definition
    var UserPhotoList = function() {
        var curPage = 0;
        var photoGrid = null;
        var loading = false;

        var initView = function () {
            photoGrid = $('#photo-grid');
        };

        var initHandler = function () {
            $("input[name='input-search-status']").change(function () {
                ajaxGetData();
            });

            $(window).scroll(function() {
                if (($(window).scrollTop() + $('.page-header').height()) >= $(document).height() - $(window).height()) {
                    var pageNum = curPage + 1;
                    ajaxGetData(pageNum);
                }
            });
        };

        var addPhotoItem = function(user) {
            var idRow =  '<div class="col-lg-3" id="user_'+user["uid"]+'">';
            var imgRow = '<img src="'+user["profile_url"]+'" alt="" class="w-100 rounded" />';
            var buttonRow = '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="' + 'UserPhotoList.onPhotoStatus('+user['uid'] + "," + user['profile_url_check'] + ')">on</a>';

            if(user['profile_url_check'] == '<?=STATUS_CHECK?>') {
                buttonRow =
                    '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="' +'UserPhotoList.onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_NORMAL?> + ')">'+'<?=t('agree')?>'+'</a>' +
                    '<a class="btn font-weight-bold btn-light-primary btn-shadow ml-2" onclick="UserPhotoList.onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_DELETE?> + ')">'+'<?= t('refuse')?>'+'</a>';
            }
            else if(user['profile_url_check'] == '<?=STATUS_NORMAL?>') {
                buttonRow = '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="UserPhotoList.onPhotoStatus(' + user['uid'] + "," + <?=STATUS_DELETE?> + ')">'+'<?= t('refuse')?>'+'</a>';
            }
            else if(user['profile_url_check'] == '<?=STATUS_DELETE?>') {
                buttonRow = '<a class="btn font-weight-bold btn-primary btn-shadow" onclick="UserPhotoList.onPhotoStatus(' + user['uid'] + ","+ <?=STATUS_NORMAL?> + ')">'+'<?= t('agree')?>'+'</a>';
            }

            var html =
                idRow +
                `
                    <div class="card card-custom overlay">
                        <div class="card-body p-0">
                            <div class="overlay-wrapper">
                                `+imgRow+`
                            </div>
                            <div class="overlay-layer align-items-end justify-content-center">
                                <div class="d-flex flex-grow-1 flex-center bg-white-o-5 py-5">
                                    `+buttonRow+`
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `
            ;

            photoGrid.append(html);
        };

        var ajaxGetData = function (page = 0) {
            if(loading == true) {
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
            loading = true;
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
                success: function (response) {
                    hideLoading();
                    loading = false;

                    if (response['result'] == '<?=AJAX_RESULT_SUCCESS?>') {
                        curPage = page;

                        if(page == 0) {
                            photoGrid.empty();
                        }

                        for (var i = 0; i < response.data.list.length; i++) {
                            addPhotoItem(response.data.list[i]);
                        }
                    } else {
                        showNotification('<?=t('msg_error_request')?>');
                    }
                },
                error: function (a, b, c) {
                    hideLoading();
                    loading = false;

                    showNotification("<?=t('msg_error_server')?>");
                }
            });
        };

        var ajaxChangePhoto = function(user_uid, status) {
            $.ajax({
                url: '<?= site_url("admin/user/ajax_change_photo_status") ?>',
                type: 'post',
                data: {'user_uid':user_uid, "status":status},
                dataType: 'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();

                    if (response['result'] == '<?=AJAX_RESULT_SUCCESS?>') {
                        showNotification("<?=t('msg_success_done')?>", true);
                        $('#user_'+user_uid).remove();
                    } else {
                        showNotification('<?=t('msg_error_request')?>');
                    }
                },
                error: function (a, b, c) {
                    hideLoading();
                    showNotification("<?=t('msg_error_server')?>");
                }
            });
        };

        return {
            init: function () {
                initView();
                initHandler();

                ajaxGetData();
            },
            onPhotoStatus: function (user_uid, status) {
                ajaxChangePhoto(user_uid, status);
            }
        };
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            UserPhotoList.init();
        });
    });

</script>