<div class="container">
  <div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <div class="d-flex justify-content-between">
          <h4>PRK</h4>
          <div>

            <button type="button" id="addButton" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#prkModal">
              Tambah Baru
            </button>
            <button type="button" id="addButtonLanjutan" class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#prkModalLanjutan">
              Tambah Lanjutan
            </button>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="input-filter">Tahun</label>
          <select name="filter-tahun" id="filter-tahun" class="form-control  basic">

          </select>
        </div>
        <div class="table-responsive mt-4">
          <table id="zero-config" class="table " style="width:100%">

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require(__DIR__ . '/modal.php') ?>