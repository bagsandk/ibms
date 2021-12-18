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

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail SKKI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div id="skki-detail" class="row">
          <div class="col-6">
            <table>
              <tr>
                <td>NO SKKI</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>NO USULAN</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Nilai SKKI</td>
                <td>:</td>
                <td>-</td>
              </tr>
            </table>
          </div>
          <div class="col-6 ">
            <table>
              <tr>
                <td>Tanggal Terbit</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Tanggal Usulan</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>UNIT</td>
                <td>:</td>
                <td>-</td>
              </tr>
              <tr>
                <td>Uraian</td>
                <td>:</td>
                <td>-</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-12 border-bottom mb-3 pb-2">
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <h6>PRK</h6>
          <div class="d-flex row col-md-8 justify-content-end align-items-center">
            <div class="mr-2 col-md-7">
              <select name="psCode" class="form-control  basic mr-3">
                <option value="">Pilih PRK</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="button" disabled="true" id="addPrkSkkiDetail" class="btn btn-primary  mr-2 float-right">
                Tambah
              </button>
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
        <form id="prk-form">
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Kembali</button>
        <!-- <button type="button" id="btn-simpan" name="tambah" class="btn btn-primary">Simpan</button> -->
      </div>
      </form>
    </div>
  </div>
</div>