<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - Login Cover Page</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>assets/light/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/light/main/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/light/main/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="<?= base_url() ?>assets/light/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/main/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/light/main/css/forms/switches.css">
</head>

<body class="form">
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <?php if (isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image" style="background-image: url(<?= base_url('assets/light/main/img/login.png') ?>);">
                <img height="60" class="float-right m-4" src="<?= base_url('assets/light/pln.png') ?>" />
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url() ?>assets/light/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?= base_url() ?>assets/light/main/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url() ?>assets/light/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/light/bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url() ?>/assets/light/main/js/authentication/form-1.js"></script>
    <?= $this->session->flashdata('message') ?>
    <?php $this->session->unset_userdata('message') ?>


</body>

</html>