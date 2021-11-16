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
                <th>NO PRK</th>
                <th>NO KONTRAK</th>
                <th>Bulan</th>
                <th>TANGGAL REALISASI</th>
                <th>NILAI</th>
                <th>KETERANGAN</th>
                <th>KETERANGAN</th>
                <th>PROGRAM</th>
                <th>NO BG</th>
                <th>FUNGSI</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2021.DLPG.1.002</td>
                <td>0068.SPBL/DAN.01.01/260000/2021</td>
                <td>September</td>
                <td>24-Sep-21</td>
                <td> 3.581.273 </td>
                <td>PPN + PPh 100%</td>
                <td>Pajak</td>
                <td>Penyambungan Baru Tegangan Menengah (TM)</td>
                <td>IL587035</td>
                <td>Pemasaran</td>
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
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require(__DIR__ . '/modal.php') ?>