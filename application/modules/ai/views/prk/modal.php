<div class="modal fade" id="prkModal" tabindex="-1" role="dialog" aria-labelledby="prkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prkModalLabel">Tambah PRK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="prk-form">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputtahun">Tahun</label>
              <input type="text" name="tahun" class="form-control" id="inputtahun" placeholder="Tahun">
            </div>
            <div class="form-group col-md-6">
              <label for="inputnoprk">No PRK</label>
              <input type="text" name="noprk" class="form-control" id="inputnoprk" placeholder="No PRK">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputprogram">Program</label>
              <input type="text" name="program" class="form-control" id="inputprogram" placeholder="Program">
            </div>
            <div class="form-group col-md-6">
              <label for="inputunit">Unit</label>
              <input type="text" name="unit" class="form-control" id="inputunit" placeholder="Unit">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputjenis">Jenis</label>
              <input type="text" name="jenis" class="form-control" id="inputjenis" placeholder="Jenis">
            </div>
            <div class="form-group col-md-6">
              <label for="inputuraian">Uraian</label>
              <input type="text" name="uraian" class="form-control" id="inputuraian" placeholder="Uraian">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputnilaiprk">Nilai PRK</label>
              <input type="text" name="nilaiprk" class="form-control" id="inputnilaiprk" placeholder="Nilai PRK">
            </div>
            <div class="form-group col-md-6">
              <label for="inputprogram2">Program 2</label>
              <input type="text" name="program2" class="form-control" id="inputprogram2" placeholder="Program 2">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputnilaiprk2">Nilai PRK 2</label>
              <input type="text" name="nilaiprk2" class="form-control" id="inputnilaiprk2" placeholder="Nilai PRK">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Kembali</button>
        <button type="button" id="btn-simpan" name="tambah" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>