</div>
<!--end::Content-->
<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2022©</span>
            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            <li class="menu-item">
                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--end::Main-->


<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="black"/>
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                          fill="black"/>
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->

<!-- begin::Popups -->
<div class="quick-nav-overlay"></div>
<a class="btn blue btn-outline sbold hidden" data-toggle="modal" href="#modal_manager_setting"
   id="btn_show_manager_setting_modal" style="display: none;"></a>
<div class="modal fade" id="modal_manager_setting" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" style="padding-bottom: 0px;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <span style="font-size: 14px;line-height: 42px;float: right"><?= t('name') ?></span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" style="background-color: white;height: 38px;"
                                       id="admin_id">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <span style="font-size: 14px;line-height: 42px;float: right"><?= t('pwd') ?></span>
                            </div>
                            <div class="col-md-8">
                                <input type="password" class="form-control"
                                       style="background-color: white;height: 38px;" id="admin_pwd">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm green" onclick="SaveManagerSetting()"><i
                            class="fa fa-save"></i><?= t('save1') ?>
                </button>
                <button type="button" class="btn btn-sm btn-danger btn-outline" data-dismiss="modal"
                        id="btn_modal_manager_setting_cancel"><i class="fa fa-close"></i>&nbsp;<?= t('no') ?>
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--end::Popups-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url() ?>/assets/metronic/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="<?= base_url() ?>/assets/metronic/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Vendors Javascript-->

<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url() ?>/assets/common/js/three.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/sphoords.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/PhotoSphereViewer.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/PSVNavBar.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/PSVNavBarButton.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/d3.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/jquery.form.js" type="text/javascript"></script>
<link href="<?= base_url() ?>/assets/common/plugins/magnific-popup/magnific-popup.css" rel="stylesheet"
      type="text/css"/>
<script src="<?= base_url() ?>/assets/common/plugins/magnific-popup/magnific-popup.js" type="text/javascript"></script>
<link href="<?= base_url() ?>/assets/common/plugins/image-picker/image-picker.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url() ?>/assets/common/plugins/image-picker/image-picker.js" type="text/javascript"></script>

<script src="<?= base_url() ?>/assets/common/js/directive.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/admin/js/common.js" type="text/javascript"></script>
<!--end::Page Scripts(used by this page)-->
<!--end::Javascript-->
<script>
    $.ajaxSetup({
        timeout: 60000 //Time in milliseconds
    });

    var ComponentsSelect = function () {
        var handleDemo = function (id, placehold_str) {
            $.fn.select2.defaults.set("theme", "bootstrap");

            $("#" + id).select2({
                placeholder: placehold_str,
                width: null,
                minimumResultsForSearch: -1
            });

            $("#" + id).on("select2:open", function () {
                if ($(this).parents("[class*='has-']").length) {
                    var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                    for (var i = 0; i < classNames.length; ++i) {
                        if (classNames[i].match("has-")) {
                            $("body > .select2-container").addClass(classNames[i]);
                        }
                    }
                }
            });
        }

        return {
            init: function (id, placehold_str) {
                handleDemo(id, placehold_str);
            }
        };

    }();

    function ShowManagerSettingDialog() {
        $('#admin_id').val('');
        $('#admin_pwd').val('');
        $('#btn_show_manager_setting_modal').trigger("click");
    }

    function SaveManagerSetting() {
        if ($('#admin_id').val() == "" || $('#admin_pwd').val() == "") {
            showNotification("<?=t('error')?>", "<?=t('msg_input_all')?>", "warning");
            return;
        }

        $.ajax({
            type: 'post',
            url: '<?=site_url("Login/change_admin_info")?>',
            data: 'id=' + $('#admin_id').val() + '&pwd=' + $('#admin_pwd').val(),
            beforeSend: function () {
                KTApp.block('#total_body', {
                    animate: true,
                    target: '#total_body',
                    boxed: false
                });
            },
            success: function (data) {
                KTApp.unblock('#total_body');
                if (data == "success") {
                    $('#btn_modal_manager_setting_cancel').trigger("click");
                    showNotification("성공", "조작이 성공하였습니다.", "success");
                    showNotification("<?=t('success')?>", "<?=t('msg_sucess_oper')?>", "success");
                    oTable._fnReDraw();
                } else {
                    showNotification("<?=t('error')?>", "<?=t('msg_error_occured')?>", "error");
                }
            }
        })
    }

    $(function () {
        $("#frm_search").submit(function () {
            return false;
        }); // input refresh submit 막기
        $("#search_keyword").keydown(function (key) { // 키보드 enter로 처리
            if (key.keyCode == 13) {
                onSearch();
            }
        });

        $(document).on('click', '.image-popup-no-margins', function (e) {
            e.preventDefault();

            if ($(this).attr('type') == 'youtube') {
                window.open($(this).attr('media'), '_blank');
                return;
            }

            if ($(this).attr('src') == '') {
                return;
            }

            $.magnificPopup.open({
                closeOnContentClick: false,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                },
                items: {
                    src: '<div class="zoom"> <img class="img-responsive thumbnail media" style="margin: 0 auto;max-height:700px;" src="' + $(this).attr('src') + '"/> </div>',
                    type: 'inline'
                },
                type: 'inline'
            });

            zoom({"zoom": "zoom"}, {"scaleDefault": 1.5, "scaleMin": (700 / $(window).height())});
        });
    });
</script>
</body>

</html>