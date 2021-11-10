<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title><?= $title ?> </title>
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/light/main/img/favicon.ico" />
  <link href="<?= base_url() ?>assets/light/main/css/loader.css" rel="stylesheet" type="text/css" />
  <script src="<?= base_url() ?>assets/light/main/js/loader.js"></script>

  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
  <link href="<?= base_url() ?>assets/light/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/light/main/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/light/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>assets/light/plugins/font-icons/fontawesome/css/regular.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/light/plugins/font-icons/fontawesome/css/fontawesome.css">
  <!-- END GLOBAL MANDATORY STYLES -->

  <!--  BEGIN CUSTOM STYLE FILE  -->
  <?php if (isset($_css) && $_css)
    $this->load->view($_css);
  ?>
  <!--  END CUSTOM STYLE FILE  -->

  <!-- #2596be
	#fef200
	#ec1c20
	#00b3f5
	#feffff -->

</head>

<!-- 
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/main/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/plugins/table/datatable/dt-global_style.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/plugins/table/datatable/custom_dt_custom.css">
<link href="<?= base_url() ?>assets/light/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>assets/light/main/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/main/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/main/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/main/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/plugins/lightbox/photoswipe.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/plugins/lightbox/default-skin/default-skin.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/plugins/lightbox/custom-photswipe.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/light/main/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/plugins/select2/select2.min.css">
<link href="<?= base_url() ?>assets/light/main/css/elements/breadcrumb.css" rel="stylesheet" type="text/css" /> -->