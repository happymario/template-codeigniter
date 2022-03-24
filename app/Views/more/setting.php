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
                <!--begin::Card-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_email_preferences" aria-expanded="true"
                         aria-controls="kt_account_email_preferences">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Preferences</h3>
                        </div>
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_setting">
                        <!--begin::Card body-->
                        <div class="card-body border-top px-9 py-9">
                            <!--begin::Option-->
                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" type="checkbox" name="email-preferences[]"
                                       value="1">
                                <!--end::Input-->
                                <!--begin::Label-->
                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Successful Payments</span>
														<span class="text-muted fs-6">Receive a notification for every successful payment.</span>
													</span>
                                <!--end::Label-->
                            </label>
                            <!--end::Option-->
                            <!--begin::Option-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--end::Option-->
                            <!--begin::Option-->
                            <div class="col">
                                <span class="fw-bolder fs-5 mb-0"><?= t('qa_phone'); ?></span>
                                <input class="form-control my-3" id="client_phone" name="client_phone"
                                       placeholder="<?= t('qa_phone') ?>"
                                       value='<?= !empty($setting) ? $setting->client_phone : '' ?>'>
                            </div>
                            <!--end::Option-->
                            <!--begin::Option-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--end::Option-->
                            <!--begin::Option-->
                            <div class="col">
                                <a class="fw-bolder fs-5 mb-3"
                                   href="<?= site_url("admin/login/term") ?>"> <?= t('use_agreement') ?> </a>
                                <textarea class="form-control" rows="10" id="use_agreement"
                                          name="use_agreement"><?= !empty($setting) ? $setting->use_agreement : '' ?></textarea>
                            </div>
                            <!--end::Option-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button class="btn btn-light btn-active-light-primary me-2"
                                    onclick="SettingPage.onCancel()"><?= t('cancel') ?></button>
                            <button class="btn btn-primary px-6"
                                    onclick="SettingPage.onSave()"><?= t('save') ?></button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Card-->
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
    var SettingPage = function () {
        var form;
        var ckEditor;

        var initView = function () {
            form = document.getElementById('kt_setting');
            ClassicEditor
                .create(document.querySelector('#use_agreement'))
                .then(editor => {
                    ckEditor = editor;
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        };

        var initHandler = function () {
            $('input[numberonly]').on('input', function (e) {
                $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
            });
        };

        var ajaxSave = function () {
            const titleElement = form.querySelector('[name="client_phone"]');

            //Form data
            var data = {
                client_phone: titleElement.value,
                use_agreement: ckEditor.getData()
            };

            $.ajax({
                url: '<?= site_url("admin/more/ajax_setting_save") ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    hideLoading();
                    if (response.result == '<?=AJAX_RESULT_SUCCESS?>') {
                        showNotification("<?=t('msg_success_done')?>", true);
                    } else {
                        showNotification("<?=t('msg_error_request')?>");
                    }
                },
                error: function (a, b, c) {
                    showAlertError('<?=t('msg_error_server')?>');
                }
            });
        };

        var ajaxUpload = function () {
            var data = new FormData();
            data.append("uploadfile", files[0]);
            $.ajax({
                data: data,
                type: "POST",
                url: '<?= site_url('api/Common/upload_file') ?>',
                cache: false,
                contentType: false,
                processData: false,
                success: function (url) {
                    editor.insertImage(welEditable, url.data.file_url);
                }
            });
        };

        return {
            init: function () {
                initView();
                initHandler();
            },
            onCancel: function () {
                history.go(-1);
            },
            onSave: function () {
                const titleElement = form.querySelector('[name="client_phone"]');
                const data = ckEditor.getData();

                if ($(titleElement).val() === '' || data == '') {
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
            SettingPage.init();
        });
    });
</script>