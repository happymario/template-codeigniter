
    </div>
    <!--end::Container-->
    </div>
    <!--end::Entry-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted font-weight-bold mr-2">2021©</span>
                <a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Nav-->
            <div class="nav nav-dark">
                <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">About</a>
                <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">Team</a>
                <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    </div>
    <!--end::Main-->

    <!-- Popups -->
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
                                    <span style="font-size: 14px;line-height: 42px;float: right"><?=t('name')?></span>
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
                                    <span style="font-size: 14px;line-height: 42px;float: right"><?=t('pwd')?></span>
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
                    <button type="button" class="btn btn-sm green" onclick="SaveManagerSetting()"><i class="fa fa-save"></i><?=t('save1')?>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger btn-outline" data-dismiss="modal"
                            id="btn_modal_manager_setting_cancel"><i class="fa fa-close"></i>&nbsp;<?=t('no')?>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!--end::Demo Panel-->
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/metronic/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/metronic/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="<?= base_url() ?>/assets/metronic/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="<?= base_url() ?>/assets/common/js/three.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/sphoords.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/PhotoSphereViewer.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/PSVNavBar.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/PSVNavBarButton.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/d3.min.js" type="text/javascript"></script>
    <link href="<?= base_url() ?>/assets/common/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>
    <script src="<?= base_url() ?>/assets/common/plugins/magnific-popup/magnific-popup.js" type="text/javascript"></script>
    <link href="<?= base_url() ?>/assets/common/plugins/image-picker/image-picker.css" rel="stylesheet" type="text/css"/>
    <script src="<?= base_url() ?>/assets/common/plugins/image-picker/image-picker.js" type="text/javascript"></script>

    <script src="<?= base_url() ?>/assets/common/js/directive.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/admin/js/common.js" type="text/javascript"></script>
    <!--end::Page Scripts(used by this page)-->
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
                App.blockUI({
                    animate: true,
                    target: '#total_body',
                    boxed: false
                });
            },
            success: function (data) {
                App.unblockUI('#total_body');
                if (data == "success") {
                    $('#btn_modal_manager_setting_cancel').trigger("click");
                    showNotification("성공", "조작이 성공하였습니다.", "success");
                    showNotification("<?=t('success')?>","<?=t('msg_sucess_oper')?>","success");
                    oTable._fnReDraw();
                } else {
                    showNotification("<?=t('error')?>","<?=t('msg_error_occured')?>","error");
                }
            }
        })
    }

    $(function() {
        $("#frm_search").submit(function() { return false; }); // input refresh submit 막기
        $("#search_keyword").keydown(function(key) { // 키보드 enter로 처리
            if (key.keyCode == 13) {
                onSearch();
            }
        });

        $(document).on('click', '.image-popup-no-margins', function (e) {
            e.preventDefault();

            if($(this).attr('type') == 'youtube') {
                window.open($(this).attr('media'), '_blank');
                return;
            }

            if($(this).attr('src') == '') {
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

            zoom({"zoom":"zoom"}, {"scaleDefault":1.5, "scaleMin":(700/$(window).height())});
        });
    });
</script>
</body>

</html>