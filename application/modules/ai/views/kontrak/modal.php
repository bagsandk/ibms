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
          <div class="form-row d-flex align-items-center">
            <div class="form-group col-md-6">
              <label for="input-kontrakNo">No Kontrak</label>
              <input type="text" name="kontrakNo" class="form-control" id="input-kontrakNo" placeholder="No Kontrak">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakNo"><span>

            </div>
            <div class="form-group col-md-6">
              <label for="input-vendorCode">Vendor</label>
              <select name="vendorCode" id="input-vendorCode" class="form-control">
                <option value="">Pilih Vendor</option>
              </select>
              <span class="e_message" style="color: #e7515a;" id="e-vendorCode"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-dkNilai">Nilai</label>
              <input type="text" name="dkNilai" class="form-control number-input" id="input-dkNilai" placeholder="Nilai">
              <span class="e_message" style="color: #e7515a;" id="e-dkNilai"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-dkAITerbit">AI Terbit</label>
              <input type="text" name="dkAITerbit" class="form-control number-input" id="input-dkAITerbit" placeholder="AI Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-dkAITerbit"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-dkAKITerbit">AKI Terbit</label>
              <input type="text" name="dkAKITerbit" class="form-control number-input" id="input-dkAKITerbit" placeholder="AKI Terbit">
              <span class="e_message" style="color: #e7515a;" id="e-dkAKITerbit"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-kontrakTglAwal">Tanggal Awal</label>
              <input type="date" name="kontrakTglAwal" class="form-control" id="input-kontrakTglAwal" placeholder="Tanggal Awal">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakTglAwal"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-kontrakTglAkhir">Tanggal Akhir</label>
              <input type="date" name="kontrakTglAkhir" class="form-control" id="input-kontrakTglAkhir" placeholder="Tanggal Akhir">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakTglAkhir"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-kontrakSistemPengadaan">Sistem Pengadaan</label>
              <input type="text" name="kontrakSistemPengadaan" class="form-control" id="input-kontrakSistemPengadaan" placeholder="Sistem Pengadaan ">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakSistemPengadaan"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-kontrakSumberDana">Sumber Dana</label>
              <input type="text" name="kontrakSumberDana" class="form-control" id="input-kontrakSumberDana" placeholder="Sumber Dana ">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakSumberDana"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-kontrakUraian">Uraian</label>
              <input type="text" name="kontrakUraian" class="form-control" id="input-kontrakUraian" placeholder="Uraian">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakUraian"><span>
            </div>
            <div class="form-group col-md-4">
              <label for="input-kontrakKeterangan">Keterangan</label>
              <input type="text" name="kontrakKeterangan" class="form-control" id="input-kontrakKeterangan" placeholder="Keterangan ">
              <span class="e_message" style="color: #e7515a;" id="e-kontrakKeterangan"><span>
            </div>
            <div class="col-12 border-bottom mb-1 pb-1">
            </div>
            <div class="form-group col-md-12">
              <h6 class="m-0 mt-3">PRK</h6>
            </div>
            <div class="form-group col-md-3">
              <label for="input-tahun">Tahun</label>
              <select id="input-tahun" class="form-control  basic">
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="input-skki">No SKKI</label>
              <select id="input-skki" class="form-control  basic">
                <option value="">Pilih SKKI</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="input-prk">No PRK</label>
              <select id="input-prk" class="form-control  basic">
                <option value="">Pilih PRK</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <button type="button" id="tambahPrk" class="btn mt-4 float-right mr-3 btn-success disabled">Tambah PRK</button>
            </div>
            <div class="form-group col-md-12">
              <div class="table-responsive mt-4">
                <table id="tb-detail" class="table " style="width:100%">
                  <thead>
                    <tr>
                      <th>NO PRK</th>
                      <th>Tahun</th>
                      <th>Program</th>
                      <th>Unit</th>
                      <th>Jenis</th>
                      <th>Uraian</th>
                      <th>NIlai</th>
                      <th>FUNGSI</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody id="detail-prk-form">

                  </tbody>

                </table>
              </div>
              <span class="e_message" style="color: #e7515a;" id="e-psCode"><span>
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


<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Kontrak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div id="kontrak-detail" class="row">
          <div class="col-6">
            <table>
              <tr>
                <td>NO Kontrak</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Vendor</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Nilai</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>AI Terbit</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>AKI Terbit</td>
                <td>:</td>
                <td>-</td>
              </tr>
            </table>
          </div>
          <div class="col-6 ">
            <table>
              <tr>
                <td>Tanggal Awal</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Tanggal Akhir</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Sietem Pengadaan</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Sumber Dana</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Uraian</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>-</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-12 border-bottom mb-3 pb-2">
        </div>
        <div class="">
          <h6>PRK</h6>
          <div class="d-flex row col-md-12 justify-content-end align-items-center">
            <div class="form-group col-md-3">
              <label for="detail-input-tahun">Tahun</label>
              <select id="detail-input-tahun" class="form-control  basic">
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="detail-input-skki">No SKKI</label>
              <select id="detail-input-skki" class="form-control  basic">
                <option value="">Pilih SKKI</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="detail-input-prk">No PRK</label>
              <select id="detail-input-prk" class="form-control  basic">
                <option value="">Pilih PRK</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <button type="button" disabled id="tambahPrkDetail" class="btn mt-4 float-right mr-3 btn-success">Tambah PRK</button>
            </div>
          </div>
        </div>
        <div class="table-responsive mt-4">
          <table id="zero-configa" class="table " style="width:100%">
            <thead>
              <tr>
                <th>NO PRK</th>
                <th>Tahun</th>
                <th>Program</th>
                <th>Unit</th>
                <th>Jenis</th>
                <th>Uraian</th>
                <th>NIlai</th>
                <th>FUNGSI</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="tbody-prk">

            </tbody>

          </table>
        </div>
        <div class="col-12 border-bottom mb-3 pb-2">
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <h6>Status <span class="badge badge-warning">Pendding</span></h1>
          </h6>
          <button class="btn btn-info">Setuju</button>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Kembali</button>

      </div>
    </div>
  </div>
</div>