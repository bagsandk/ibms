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
            <div class="form-group col-md-12">
              <label for="input-psCode">PRK</label>
              <select name="psCode" class="form-control  basic">
                <option value="">Pilih PRK</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-psCode"><span>
            </div>
            <div class="table-responsive" id="detail-prk-form">

            </div>

            <div class="form-group col-md-6">
              <label for="input-skkiTglUsulan">Tanggal Usulan</label>
              <input type="date" name="skkiTglUsulan" class="form-control" id="input-skkiTglUsulan" placeholder="Tanggal Usulan">
              <span class="e_message" style="color: #e7515a;" id="e-skkiTglUsulan"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-skkiTglTerbit">Tanggal Terbit</label>
              <input type="date" name="skkiTglTerbit" class="form-control" id="input-skkiTglTerbit" placeholder="Tanggal Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-skkiTglTerbit"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-unitCode">Unit</label>
              <select name="unitCode" class="form-control  basic">
                <option>Pilih</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-unitCode"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-skkiNo">No SKKI</label>
              <input type="text" name="skkiNo" class="form-control" id="input-skkiNo" placeholder="No SKKI">
              <span class="e_message" style="color: #e7515a;" id="e-skkiNo"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-skkiNoUsulan">No Usulan</label>
              <input type="text" name="skkiNoUsulan" class="form-control" id="input-skkiNoUsulan" placeholder="No Usulan">
              <span class="e_message" style="color: #e7515a;" id="e-skkiNoUsulan"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-skkiNilai">Nilai SKKI</label>
              <input type="text" name="skkiNilai" class="form-control" id="input-skkiNilai" placeholder="Nilai SKKI">
              <span class="e_message" style="color: #e7515a;" id="e-skkiNilai"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-skkiUraian">Uraian</label>
              <input type="text" name="skkiUraian" class="form-control" id="input-skkiUraian" placeholder="Uraian">
              <span class="e_message" style="color: #e7515a;" id="e-skkiUraian"><span>
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
        <h5 class="modal-title" id="prkModalLanjutanLabel">Tambah SKKI Lanjutan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <div class="modal-body">
        <form id="prk-form-lanjutan">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="input-prkCode">PRK tahun lalu</label>
              <select id="prkCodeLanjutan" class="form-control  basic">
                <option value="">Pilih PRK</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-prkCodeLanjutanLanjutan"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-prkCode">SKKI tahun lalu</label>
              <select name="skkiCodeLama" class="form-control  basic">
                <option value="">Pilih SKKI</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-skkiCodeLamaLanjutan"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-psCode">PRK tahun sekarang</label>
              <select name="psCode" id="psCodeLanjutan" class="form-control  basic">
                <option value="">Pilih PRK</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-psCodeLanjutan"><span>
            </div>
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