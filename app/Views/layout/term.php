<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title><?=t('site_name')?></title>
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?= base_url() ?>/assets/metronic/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>/assets/metronic/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <link href="<?= base_url() ?>/assets/app/css/base.css" rel="stylesheet" type="text/css"/>
<body>
<div style="padding: 10px;">
    <?php echo $term; ?>
</div>
<script>
</script>

<script src="<?= base_url() ?>/assets/common/plugins/jquery/jquery.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/assets/common/js/jquery.form.js" type="text/javascript"></script>
</body>
</html>