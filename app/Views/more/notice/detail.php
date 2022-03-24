<?php
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
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_notice_detail">
                    <!--begin::Customer-->
                    <div class="card card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder"><?= empty($item['uid']) ? t('add'): t('modify')?></h2>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required"><?=t('title')?></span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="<?=t('msg_input_title')?>"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="title" value="<?= !empty($item['title']) ? $item['title']: '';  ?>" />
                            </div>
                            <!--end::Input group-->

                            <!--begin::Invoice footer-->
                            <div class="d-flex flex-column mb-10 fv-row">
                                <!--begin::Label-->
                                <div class="fs-5 fw-bolder form-label mb-3"><?=t('content')?>
                                    <i tabindex="0" class="cursor-pointer fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-html="true" data-bs-content="<?=t('msg_input_content')?>"></i></div>
                                <!--end::Label-->
                                <textarea class="form-control form-control-solid rounded-3" rows="4" name="content"><?= !empty($item['content']) ?  $item['content']: '' ?></textarea>
                            </div>
                            <!--end::Invoice footer-->

                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                            <!--begin::Action buttons-->
                            <div class="d-flex justify-content-center">
                                <!--begin::Button-->
                                <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3" onclick="NoticeDetail.onCancel()"><?=t('cancel')?></button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="button" data-kt-contacts-type="submit" class="btn btn-primary" onclick="NoticeDetail.onSave()">
                                    <span class="indicator-label"><?=t('save')?></span>
                                    <span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Action buttons-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Customer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

<script>
    // Class definition
    var NoticeDetail = function () {
        var form;

        var initView = function () {
            form = document.getElementById('kt_notice_detail');
            console.log("notice detail item =>"  + '<?=json_encode($item)?>');
        };

        var initHandler = function () {
            $('input[numberonly]').on('input', function (e) {
                $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
            });
        };

        var ajaxSave = function() {
            const titleElement = form.querySelector('[name="title"]');
            const contentElement = form.querySelector('[name="content"]');

            //Form data
            var data = {
                title: titleElement.value,
                content:contentElement.value
            };

            var item_id = "<?=$item->id ?? ''?>";
            if (item_id != "") {
                data.id = item_id;
            }

            $.ajax({
                url: '<?= site_url("admin/more/ajax_notice_save") ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        showNotification("<?=t('msg_success_done')?>");
                        location.href = "<?=base_url('admin/More/notice_list')?>";
                    } else {
                        showNotification("<?=t('msg_error_request')?>");
                    }
                },
                error: function (a, b, c) {
                    showAlertError('<?=t('msg_error_server')?>');
                }
            });
        };

        return {
            init:function () {
                initView();
                initHandler();
            },
            onCancel:function () {
                history.go(-1);
            },
            onSave: function () {
                const titleElement = form.querySelector('[name="title"]');
                const contentElement = form.querySelector('[name="content"]');

                if($(titleElement).val() == '' || $(contentElement).val() == '') {
                    showNotification("<?=t('msg_input_all')?>");
                    return;
                }

                ajaxSave();
            },
        }
    }();

    // Document loaded
    $(function () {
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            NoticeDetail.init();
        });
    });
</script>
