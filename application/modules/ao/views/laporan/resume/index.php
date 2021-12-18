<!-- <?php var_dump($module); ?> -->
<div class="container">
  <div class="row" id="cancel-row">
    <div class="col-lg-6  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <h6>Filter</h6>
        <form id="prk-form">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="input-kontrakCode">Kontrak</label>
              <select name="kontrakCode" class="form-control  basic">
                <option value="">Pilih Kontrak</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-kontrakCode"><span>
            </div>
            <div class="table-responsive" id="detail-kontrak-form">

            </div>
            <div class="form-group col-md-6">
              <label for="input-tahunCode">Tahun</label>
              <select name="tahunCode" class="form-control  basic">
                <option>Pilih Tahun</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-tahunCode"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-realisasiJenis">Jenis</label>
              <select name="realisasiJenis" class="form-control  basic">
                <option value="UNIT">UNIT</option>
                <option value="POLIS">POLIS</option>
                <option value="PUSAT">PUSAT</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-realisasiJenis"><span>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-6  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <div class="col-lg-6  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <canvas id="myChart1"></canvas>
      </div>
    </div>
    <div class="col-lg-6  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <canvas id="myChart2"></canvas>
      </div>
    </div>
  </div>
</div>