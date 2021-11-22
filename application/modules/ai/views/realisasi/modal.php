<div class="modal fade" id="prkModal" tabindex="-1" role="dialog" aria-labelledby="prkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prkModalLabel">Tambah Realisasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="prk-form">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="input-dkCode">Kontrak</label>
              <select name="dkCode" class="form-control  basic">
                <option value="">Pilih Kontrak</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-dkCode"><span>
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
            <div class="form-group col-md-6">
              <label for="input-unitCode">Unit</label>
              <select name="unitCode" class="form-control  basic">
                <option>Pilih</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-unitCode"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-drTgl">Tanggal Realisasi</label>
              <input type="date" name="drTgl" class="form-control" id="input-drTgl" placeholder="Tanggal Realisasi">
              <span class="e_message" style="color: #e7515a;" id="e-drTgl"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-drNoBG">No BG</label>
              <input type="text" name="drNoBG" class="form-control" id="input-drNoBG" placeholder="No BG">
              <span class="e_message" style="color: #e7515a;" id="e-drNoBG"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-drNilai">Nilai</label>
              <input type="text" name="drNilai" class="form-control" id="input-drNilai" placeholder="Nilai ">
              <span class="e_message" style="color: #e7515a;" id="e-drNilai"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-drKeterangan">Keterangan</label>
              <input type="text" name="drKeterangan" class="form-control" id="input-drKeterangan" placeholder="Keterangan ">
              <span class="e_message" style="color: #e7515a;" id="e-drKeterangan"><span>
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