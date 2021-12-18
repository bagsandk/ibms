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
              <label for="input-prkNo">No PRK</label>
              <input type="text" name="prkNo" class="form-control" id="input-prkNo" placeholder="No PRK">
              <span class="e_message" style="color: #e7515a;" id="e-prkNo"><span>
            </div>

            <div class="form-group col-md-6">
              <label for="input-programCode">Program</label>
              <select name="programCode" class="form-control  basic">
                <option>Pilih</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-programCode"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-unitCode">Unit</label>
              <select name="unitCode" class="form-control  basic">
                <option>Pilih</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-unitCode"><span>
            </div>

            <div class="form-group col-md-6">
              <label for="input-prkUraian">Uraian</label>
              <input type="text" name="prkUraian" class="form-control" id="input-prkUraian" placeholder="Uraian">
              <span class="e_message" style="color: #e7515a;" id="e-prkUraian"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-prkNilai">Nilai PRK</label>
              <input type="text" name="prkNilai" class="form-control" id="input-prkNilai" placeholder="Nilai PRK">
              <span class="e_message" style="color: #e7515a;" id="e-prkNilai"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-fungsiCode">Fungsi</label>
              <select name="fungsiCode" class="form-control  basic">
                <option>Pilih</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-fungsiCode"><span>
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
<div class="modal fade" id="prkModalLanjutan" tabindex="-1" role="dialog" aria-labelledby="prkModalLanjutanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prkModalLanjutanLabel">Tambah PRK Lanjutan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <div class="modal-body">
        <form id="prk-form-lanjutan">
          <div class="form-group col-md-12">
            <label for="input-prkCode">PRK</label>
            <select name="prkCode" class="form-control  basic">
              <option value="">Pilih PRK</option>
            </select>
            <span class="e_message" style="color: #e7515a;" id="e-prkCode"><span>
          </div>
          <div class="table-responsive" id="detail-prk-form">
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Kembali</button>
        <button type="button" id="btn-simpan-lanjutan" name="tambah" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>