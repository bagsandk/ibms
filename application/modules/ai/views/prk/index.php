<div class="container">
  <div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
      <div class="widget-content widget-content-area br-6">
        <div class="d-flex justify-content-between">
          <h4>PRK</h4>
          <button type="button" id="addButton" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#prkModal">
            Tambah
          </button>
        </div>
        <div class="table-responsive mt-4">
          <table id="zero-configa" class="table " style="width:100%">
            <thead>
              <tr>
                <th>Tahun</th>
                <th>NO PRK</th>
                <th>Program</th>
                <th>Unit</th>
                <th>Jenis PRK</th>
                <th>Uraian PRK</th>
                <th>Nilai PRK</th>
                <th>Program 2</th>
                <th>Nilai PRK</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2020</td>
                <td>2020.DLPG.1.013.SF</td>
                <td>09.A04 - Pemasaran Penambahan Pelanggan </td>
                <td>Kantor Distribusi</td>
                <td>Murni</td>
                <td>Penyambungan Pelanggan Golongan Tarif R.2/> 3500 s/d 5500 VA</td>
                <td>273.085.150</td>
                <td>Program Khusus Pemasaran (Self Financing)</td>
                <td>273.085.150,00 </td>
                <td class="text-center">
                  <div class="dropdown custom-dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i data-feather="more-horizontal"></i>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                      <a class="dropdown-item detailButton" href="javascript:void(0);">Detail</a>
                      <a class="dropdown-item editButton" data-prk="1" href="javascript:void(0);">Edit</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2020</td>
                <td>2020.DLPG.1.013.SF</td>
                <td>09.A04 - Pemasaran Penambahan Pelanggan </td>
                <td>Kantor Distribusi</td>
                <td>Murni</td>
                <td>Penyambungan Pelanggan Golongan Tarif R.2/> 3500 s/d 5500 VA</td>
                <td>273.085.150</td>
                <td>Program Khusus Pemasaran (Self Financing)</td>
                <td>273.085.150,00 </td>
                <td class="text-center">
                  <div class="dropdown custom-dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i data-feather="more-horizontal"></i>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                      <a class="dropdown-item detailButton" href="javascript:void(0);">Detail</a>
                      <a class="dropdown-item editButton" data-prk="2" href="javascript:void(0);">Edit</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require(__DIR__ . '/modal.php') ?>