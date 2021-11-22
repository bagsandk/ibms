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
            <div class="form-group col-md-4">
              <label for="input-tahun">Tahun</label>
              <select id="input-tahun" class="form-control  basic">
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="input-prk">No PRK</label>
              <select id="input-prk" class="form-control  basic">
                <option value="">Pilih PRK</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="input-skki">No SKKI</label>
              <select name="skkiCode" id="input-skki" class="form-control  basic">
                <option value="">Pilih SKKI</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-skkiCode"><span>
            </div>
            <div class="table-responsive" id="detail-skki-form">

            </div>
            <div class="form-group col-md-6">
              <label for="input-vendorCode">Vendor</label>
              <select name="vendorCode" id="input-vendorCode" class="form-control">
                <option value="">Pilih Vendor</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-vendorCode"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-kontrakNo">No Kontrak</label>
              <input type="text" name="kontrakNo" class="form-control" id="input-kontrakNo" placeholder="No Kontrak">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakNo"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-dkNilai">Nilai</label>
              <input type="text" name="dkNilai" class="form-control number-input" id="input-dkNilai" placeholder="Nilai">
              <span class="e_message" style="color: #e7515a;" id="e-dkNilai"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-dkAITerbit">AI Terbit</label>
              <input type="text" name="dkAITerbit" class="form-control number-input" id="input-dkAITerbit" placeholder="AI Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-dkAITerbit"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-dkAKITerbit">AKI Terbit</label>
              <input type="text" name="dkAKITerbit" class="form-control number-input" id="input-dkAKITerbit" placeholder="AKI Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-dkAKITerbit"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-kontrakTglAwal">Tanggal Awal</label>
              <input type="date" name="kontrakTglAwal" class="form-control" id="input-kontrakTglAwal" placeholder="Tanggal Awal">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakTglAwal"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-kontrakTglAkhir">Tanggal Akhir</label>
              <input type="date" name="kontrakTglAkhir" class="form-control" id="input-kontrakTglAkhir" placeholder="Tanggal Akhir">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakTglAkhir"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-kontrakUraian">Uraian</label>
              <input type="text" name="kontrakUraian" class="form-control" id="input-kontrakUraian" placeholder="Uraian">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakUraian"><span>

            </div>

            <div class="form-group col-md-6">
              <label for="input-kontrakSistemPengadaan">Sistem Pengadaan</label>
              <input type="text" name="kontrakSistemPengadaan" class="form-control" id="input-kontrakSistemPengadaan" placeholder="Sistem Pengadaan ">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakSistemPengadaan"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-kontrakSumberDana">Sumber Dana</label>
              <input type="text" name="kontrakSumberDana" class="form-control" id="input-kontrakSumberDana" placeholder="Sumber Dana ">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakSumberDana"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-kontrakKeterangan">Keterangan</label>
              <input type="text" name="kontrakKeterangan" class="form-control" id="input-kontrakKeterangan" placeholder="Keterangan ">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakKeterangan"><span>

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
</div>

<div class="modal fade" id="prkModalLanjutan" tabindex="-1" role="dialog" aria-labelledby="prkModalLanjutanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prkModalLanjutanLabel">Tambah Kontrak Lanjutan</h5>
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
              <select name="skkiCode" id="skkiCodeLanjutan" class="form-control  basic">
                <option value="">Pilih SKKI</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-skkiCodeLanjutan"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-psCode">Kontrak</label>
              <select name="kontrakCodeLama" id="kontrakCodeLamaLanjutan" class="form-control  basic">
                <option value="">Pilih Kontrak</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-kontrakCodeLamaLanjutan"><span>
            </div>
            <div class="table-responsive" id="detail-prk-form">
            </div>
            <div class="form-group col-md-6">
              <label for="input-dkAITerbit">AI Terbit</label>
              <input type="text" name="dkAITerbit" class="form-control number-input" id="input-dkAITerbitLanjutan" placeholder="AI Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-dkAITerbitLanjutan"><span>
            </div>
            <div class="form-group col-md-6">
              <label for="input-dkAKITerbit">AKI Terbit</label>
              <input type="text" name="dkAKITerbit" class="form-control  number-input" id="input-dkAKITerbitLanjutan" placeholder="AKI Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-dkAKITerbitLanjutan"><span>
            </div>
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