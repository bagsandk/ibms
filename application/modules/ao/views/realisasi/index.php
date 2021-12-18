<div class="container">
  <div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <div class="d-flex justify-content-between">
          <h4>REALISASI</h4>
          <button type="button" id="addButton" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#prkModal">
            Tambah
          </button>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="input-filter">Tahun</label>
            <select name="filter-tahun" id="fiter-tahun" class="form-control  basic">
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="input-filter">Jenis</label>
            <select name="filter-unit" id="filter-unit" class="form-control  basic">
              <option value="UNIT">UNIT</option>
              <option value="POLIS">POLIS</option>
              <option value="PUSAT">PUSAT</option>
            </select>
          </div>
        </div>
        <div class="table-responsive mt-4">
          <table id="zero-config" class="table " style="width:100%">

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<tr>
  <th>#</th>
  <th>Tahun</th>
  <th>NO PRK</th>
  <th>Program</th>
  <th>Unit</th>
  <th>Jenis</th>
  <th>Uraian</th>
  <th>Nilai</th>
  <th>Fungsi</th>
</tr>
<?php require(__DIR__ . '/modal.php') ?>