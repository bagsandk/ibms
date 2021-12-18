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
              <label for="input-tahun">Tahun</label>
              <input type="text" name="tahun" class="form-control" id="input-tahun" placeholder="Tahun">
            </div>
            <div class="form-group col-md-6">
              <label for="input-noprk">No PRK</label>
              <select class="form-control  basic">
                <option selected="selected">orange</option>
                <option>white</option>
                <option>purple</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input-nousulan">No usulan</label>
              <input type="text" name="nousulan" class="form-control" id="input-nousulan" placeholder="No Usulan">
            </div>
            <div class="form-group col-md-6">
              <label for="input-tanggalusulan">Tanggal usulan</label>
              <input type="date" name="tanggalusulan" class="form-control" id="input-tanggalusulan" placeholder="Tanggal usulan">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input-noskki">No SKKI</label>
              <input type="text" name="noskki" class="form-control" id="input-noskki" placeholder="noskki">
            </div>
            <div class="form-group col-md-6">
              <label for="input-unit">Unit</label>
              <input type="text" name="unit" class="form-control" id="input-unit" placeholder="Unit">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input-tanggalterbit">Tanggal terbit</label>
              <input type="text" name="tanggalterbit" class="form-control" id="input-tanggalterbit" placeholder="Tanggal terbit">
            </div>
            <div class="form-group col-md-6">
              <label for="input-nilaiskki">Nilai SKKI</label>
              <input type="text" name="nilaiskki" class="form-control" id="input-nilaiskki" placeholder="Nilai SKKI">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input-uraian">Uraian</label>
              <input type="text" name="uraian" class="form-control" id="input-uraian" placeholder="Uraian Pekerjaan">
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