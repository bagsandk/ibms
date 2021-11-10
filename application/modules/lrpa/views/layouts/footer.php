<div class="footer-wrapper">
  <div class="footer-section f-section-1">
    <p class="">Copyright © 2021 All rights reserved.</p>
  </div>
  <div class="footer-section f-section-2">
    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
      </svg></p>
  </div>
</div>
</div>
</div>
<!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?= base_url() ?>assets/light/main/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?= base_url() ?>assets/light/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/light/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/light/main/js/app.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/table/datatable/datatables.js"></script>
<script src="<?= base_url() ?>assets/light/main/js/scrollspyNav.js"></script>
<script>
  let baseUrl = '<?= base_url() ?>'
  $(document).ready(function() {
    App.init();
  });
</script>
<script type="text/javascript">
  feather.replace();
  $('.basic').select2({
    dropdownParent: $('#modalGift')
  });
</script>
<?= $this->session->flashdata('message') ?>
<?php $this->session->unset_userdata('message') ?>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<?php if (isset($_js) && $_js)
  $this->load->view($_js);
?>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


<!-- <script src="<?= base_url() ?>assets/light/main/js/components/ui-accordions.js"></script>
<script src="<?= base_url() ?>assets/light/main/js/custom.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/apex/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/light/main/js/dashboard/dash_1.js"></script>
<script src="<?= base_url() ?>assets/light/main/js/dashboard/dash_2.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/lightbox/photoswipe.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/lightbox/photoswipe-ui-default.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/lightbox/custom-photswipe.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/font-icons/feather/feather.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/file-upload/file-upload-with-preview.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/select2/select2.min.js"></script> -->




</body>

</html>