<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title><?= t('site_name') ?></title>
    <meta name="description" content="It is Dashboard based on 'Metronic admin template 7.1'."/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- google검색엔진의 효율성 제거하는 표준URL-->
    <link rel="canonical" href="<?= base_url() ?>"/>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/admin/img/ic_logo.png"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="<?= base_url() ?>/assets/metronic/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>/assets/metronic/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <!--begin::First loading Script -->
    <link href="<?= base_url() ?>/assets/admin/css/custom.css" rel="stylesheet" type="text/css"/>
    <script src="<?= base_url() ?>/assets/common/js/jquery.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/jquery.form.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/common/js/ajaxupload.3.6.js" type="text/javascript"></script>
    <!--end::First loading Script -->
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
             data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
             data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="<?=base_url()?>">
                    <img alt="Logo" src="<?=base_url()?>/assets/admin/img/ic_logo.png" class="h-25px logo"/>
                </a>
                <!--end::Logo-->
                <!--begin::Aside toggler-->
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                     data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                     data-kt-toggle-name="aside-minimize">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                    <span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<path opacity="0.5"
                                          d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                          fill="black"/>
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                          fill="black"/>
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside toggler-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside menu-->
            <div class="aside-menu flex-column-fluid">
                <!--begin::Aside Menu-->
                <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                     data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                     data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                     data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                         id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                        <div class="menu-item <?= !empty($menu) && $menu == MENU_USER ? 'menu-item-active' : '' ?>">
                            <a class="menu-link" href="<?= site_url('admin/user') ?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z"
                                                          fill="black"/>
													<path opacity="0.3"
                                                          d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-title"><?= t('menu_users') ?></span>
                            </a>
                        </div>

                        <div class="menu-item <?= !empty($menu) && $menu == MENU_PHOTO_CHECK ? 'menu-item-active' : '' ?>">
                            <a class="menu-link" href="<?= site_url('admin/user/photo_list') ?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                          fill="black"/>
													<path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                          fill="black"/>
													<path opacity="0.3"
                                                          d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-title"><?= t('menu_photo_check') ?></span>
                            </a>
                        </div>

                        <div class="menu-item <?= !empty($menu) && $menu == MENU_NOTIFICATION ? 'menu-item-active' : '' ?>">
                            <a class="menu-link" href="<?= site_url('admin/push') ?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                          fill="black"/>
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-title"><?= t('menu_notifications') ?></span>
                            </a>
                        </div>

                        <div class="menu-item <?= !empty($menu) && $menu == MENU_NOTICE ? 'menu-item-active' : '' ?>">
                            <a class="menu-link" href="<?= site_url('admin/appmanage/notice_list') ?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path opacity="0.3"
                                                          d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z"
                                                          fill="black"/>
													<path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-title"><?= t('menu_notice') ?></span>
                            </a>
                        </div>

                        <div class="menu-item <?= !empty($menu) && $menu == MENU_SETTING ? 'menu-item-active' : '' ?>">
                            <a class="menu-link" href="<?= site_url('admin/appmanage/setting') ?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path opacity="0.3"
                                                          d="M21 18.3V4H20H5C4.4 4 4 4.4 4 5V20C10.9 20 16.7 15.6 19 9.5V18.3C18.4 18.6 18 19.3 18 20C18 21.1 18.9 22 20 22C21.1 22 22 21.1 22 20C22 19.3 21.6 18.6 21 18.3Z"
                                                          fill="black"/>
													<path d="M22 4C22 2.9 21.1 2 20 2C18.9 2 18 2.9 18 4C18 4.7 18.4 5.29995 18.9 5.69995C18.1 12.6 12.6 18.2 5.70001 18.9C5.30001 18.4 4.7 18 4 18C2.9 18 2 18.9 2 20C2 21.1 2.9 22 4 22C4.8 22 5.39999 21.6 5.79999 20.9C13.8 20.1 20.1 13.7 20.9 5.80005C21.6 5.40005 22 4.8 22 4Z"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-title"><?= t('menu_setting') ?></span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <div class="menu-content">
                                <div class="separator mx-1 my-4"></div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black"/>
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title"><?= t('menu_api') ?></span>
										<span class="menu-arrow"></span>
									</span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item">
                                    <a class="menu-link" href="<?= site_url('admin/apimanage/apimanage') ?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                        <span class="menu-title"><?= t('menu_api_list') ?></span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="<?= site_url('admin/apimanage/apidocument') ?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                        <span class="menu-title"><?= t('menu_api_doc') ?></span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="<?= site_url('admin/apimanage/apierrors') ?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                        <span class="menu-title"><?= t('menu_api_code') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside menu-->
            <!--begin::Footer-->
            <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                <a href="https://github.com/happymario" class="btn btn-custom btn-primary w-100"
                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
                   title="200+ in-house components and 3rd-party plugins">
                    <span class="btn-label">Docs &amp; Components</span>
                    <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                    <span class="svg-icon btn-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<path opacity="0.3"
                                          d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                                          fill="black"/>
									<rect x="7" y="17" width="6" height="2" rx="1" fill="black"/>
									<rect x="7" y="12" width="10" height="2" rx="1" fill="black"/>
									<rect x="7" y="7" width="6" height="2" rx="1" fill="black"/>
									<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </a>
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" style="" class="header align-items-stretch">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Aside mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                             id="kt_aside_mobile_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                                  fill="black"/>
											<path opacity="0.3"
                                                  d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                  fill="black"/>
										</svg>
									</span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Aside mobile toggle-->
                    <!--begin::Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="<?=base_url()?>" class="d-lg-none">
                            <img alt="Logo" src="<?=base_url()?>/assets/admin/img/ic_logo.png" class="h-30px"/>
                        </a>
                    </div>
                    <!--end::Mobile logo-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <!--begin::Navbar-->
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                            <!--begin::Menu wrapper-->
                            <div class="header-menu align-items-stretch" data-kt-drawer="true"
                                 data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                                 data-kt-drawer-overlay="true"
                                 data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                                 data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
                                 data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                 data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                <!--begin::Menu-->
                                <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                                     id="#kt_header_menu" data-kt-menu="true">
                                    <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                         class="menu-item menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
													<span class="menu-title">Menus</span>
													<span class="menu-arrow d-lg-none"></span>
												</span>
                                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                            <div class="menu-item">
                                                <a class="menu-link py-3"  onclick="history.go(-1)">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
                                                    <span class="menu-title">Back</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Navbar-->
                        <!--begin::Toolbar wrapper-->
                        <div class="d-flex align-items-stretch flex-shrink-0">
                            <!--begin::Theme mode-->
                            <div class="d-flex align-items-center ms-1 ms-lg-3">
                                <!--begin::Theme mode docs-->
                                <a class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                                   href="#">
                                    <i class="fonticon-sun fs-2"></i>
                                </a>
                                <!--end::Theme mode docs-->
                            </div>
                            <!--end::Theme mode-->
                            <!--begin::User menu-->
                            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                     data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                     data-kt-menu-placement="bottom-end">
                                    <img src="<?=base_url();?>/assets/admin/img/img_photo_default.png" alt="user"/>
                                </div>
                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                     data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="<?=base_url();?>/assets/admin/img/img_photo_default.png"/>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bolder d-flex align-items-center fs-5">Admin
                                                    <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                </div>
                                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">admin@gmail.com</a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5 my-1">
                                        <a onclick="ShowManagerSettingDialog()" class="menu-link px-5"><?= t('setting') ?></a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="<?=site_url("admin/login/logout")?>"
                                           class="menu-link px-5"><?= t('logout') ?></a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->
                            <!--begin::Header menu toggle-->
                            <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                     id="kt_header_menu_mobile_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                                    <span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                                          fill="black"/>
													<path opacity="0.3"
                                                          d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                                          fill="black"/>
												</svg>
											</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Header menu toggle-->
                        </div>
                        <!--end::Toolbar wrapper-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Toolbar-->
                <div class="toolbar" id="kt_toolbar">
                    <!--begin::Container-->
                    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                        <!--begin::Page title-->
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                            <!--begin::Title-->
                            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Others</h1>
                            <!--end::Title-->
                            <!--begin::Separator-->
                            <span class="h-20px border-gray-300 border-start mx-4"></span>
                            <!--end::Separator-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="<?=base_url()?>/admin/home" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-dark">Products</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <!--begin::Filter menu-->
                            <div class="m-0">
                                <!--begin::Menu toggle-->
                                <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
												<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                      fill="black"/>
											</svg>
										</span>
                                    <!--end::Svg Icon-->Filter</a>
                                <!--end::Menu toggle-->
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                     id="kt_menu_6220ed708463f">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                        data-placeholder="Select option"
                                                        data-dropdown-parent="#kt_menu_6220ed708463f"
                                                        data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1"/>
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                           checked="checked"/>
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       name="notifications" checked="checked"/>
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">Reset
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">Apply
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                            </div>
                            <!--end::Filter menu-->
                            <!--begin::Secondary button-->
                            <!--end::Secondary button-->
                            <!--begin::Primary button-->
                            <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_create_app">Create</a>
                            <!--end::Primary button-->
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

