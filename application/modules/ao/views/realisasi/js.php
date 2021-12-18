<script src="<?= base_url() ?>assets/light/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/select2/select2.min.js"></script>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
  var table;
  $(document).ready(function() {
    table = $('#zero-config').DataTable({
      oLanguage: {
        oPaginate: {
          sPrevious: '<i data-feather="arrow-left"></i>',
          sNext: '<i data-feather="arrow-right"></i>'
        },
        sSearch: '<i data-feather="search"></i>',
        sSearchPlaceholder: 'Search...',
        sLengthMenu: 'Results :  _MENU_',
      },
      stripeClasses: [],
      lengthMenu: [5, 10, 20, 50],
      pageLength: 5,
      processing: true,
      serverSide: true,
      order: [],
      columns: [{
          name: 'drCode',
          data: 'no',
          title: 'no'
        }, {
          name: 'kontrakNo',
          data: 'kontrakNo',
          title: 'No Kontrak',
          className: 'detail-kontrak'
        }, {
          name: 'drTgl',
          data: 'drTgl',
          title: 'Tgl'
        }, {
          name: 'realisasiJenis',
          data: 'realisasiJenis',
          title: 'Jenis'
        }, {
          name: 'tahun',
          data: 'tahun',
          title: 'tahun'
        }, {
          name: 'drKeterangan',
          data: 'drKeterangan',
          title: 'Keterangan'
        }, {
          name: 'drNilai',
          data: 'drNilai',
          title: 'Nilai'
        }, {
          name: 'drNoBG',
          data: 'drNoBG',
          title: 'NoBG'
        }, {
          name: 'unitNama',
          data: 'unitNama',
          title: 'unitNama'
        }, {
          title: 'Action',
          name: '',
          data: '',
          render: getAction
        },

      ],
      ajax: {
        url: `${API_URL}Realisasi/GetAllRealisasi`,
        type: "POST",
        headers: {
          "Authorization": `Bearer ${accessToken}`,
        },
        data: function(d) {
          d.realisasiJenis = $("#filter-unit option:selected").val()
        },
        dataFilter: function(data) {
          var json = JSON.parse(data)
          return JSON.stringify(json.data)
        }
      },
      scrollX: true,
      columnDefs: [{
        targets: [0],
        orderable: false,
      }, ],
      drawCallback: function(settings) {
        feather.replace()
      }
    });
  });

  function format(d) {
    const PRKONE = function() {
      var result = null;
      $.ajax({
        async: false,
        url: `${API_URL}PRK/GetOnePRK/index/${d.prkCode}`,
        type: "GET",
        headers: {
          "Authorization": `Bearer ${accessToken}`,
        },
        success: function(data) {
          result = data;
        }
      })
      return result;
    }()
    return `<table class="bg-gray text-black" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"> <tr> <th>Tahun</th> <th>NO PRK</th> <th>Program</th> <th>Unit</th> <th>Jenis</th> <th>Uraian</th> <th>Nilai</th> <th>Fungsi</th> </tr> <tr> <td>${PRKONE.data.tahun}</td> <td>${PRKONE.data.prkNo}</td> <td>${PRKONE.data.programNama}</td> <td>${PRKONE.data.unitNama}</td> <td>${PRKONE.data.prkJenis}</td> <td>${PRKONE.data.prkUraian}</td> <td>${PRKONE.data.prkNilai}</td> <td>${PRKONE.data.fungsiNama}</td> </tr> </table>`;
  }

  $(document).on('click', 'td.detail-kontrak', function() {
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass('shown');
    } else {
      row.child(format(row.data())).show();
      tr.addClass('shown');
    }
  });

  $(document).on('click', '.editButton', (e) => {
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Edit SKKI')
    $('#btn-simpan').removeAttr('style')
    $('#btn-simpan').attr('name', 'edit');

    $('input[name="tahun"]').val('2020');
    $('#prkModal').modal('show')
  })
  $(document).on('click', '.detailButton', (e) => {
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", true);
    $('#prkModalLabel').html('Detail SKKI')
    $('#btn-simpan').attr('style', 'display:none');

    $('#prkModal').modal('show')
  })

  $("select[name='tahunCode']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
    dropdownParent: $('#prkModal')
  });
  $("select[name='unitCode']").select2({
    data: GetAllUnit.data.map((a) => {
      return {
        id: a.unitCode,
        text: a.unitNama
      }
    }),
    dropdownParent: $('#prkModal')
  });
  $("select[name='unitCode']").select2({
    data: GetAllUnit.data.map((a) => {
      return {
        id: a.unitCode,
        text: a.unitNama
      }
    }),
    dropdownParent: $('#prkModal')
  });

  $('#addButton').click(() => {
    const PRK = function() {
      var result = null;
      $.ajax({
        async: false,
        url: `${API_URL}Kontrak/GetAllKontrakNoDt/detail`,
        type: "POST",
        headers: {
          "Authorization": `Bearer ${accessToken}`,
        },
        success: function(data) {
          result = data;
        }
      })
      return result;
    }()
    $("select[name='dkCode']").select2({
      data: PRK.data.map((a) => {
        return {
          id: a.dkCode,
          kontrak: a.kontrakCode,
          text: `${a.kontrakNo} - ${a.tahun}` 
        }
      }),
      dropdownParent: $('#prkModal')
    });
    $('#prk-form').trigger('reset');
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah Realisasi')
    $('#btn-simpan').attr('name', 'tambah');
  })
  $('#btn-simpan').click(function() {
    let form = $('#prk-form').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `${API_URL}Realisasi/InsertRealisasi`,
        type: "POST",
        headers: {
          "Authorization": `Bearer ${accessToken}`,
        },
        data: form,
        success: function(data, textStatus, xhr) {
          table = $('#zero-config').DataTable()
          toastSuccess(data.success.message);
          table.ajax.reload()
          $("#prkModal").modal("toggle");
          $('#prk-form').trigger('reset');
        },
        error: function(xhr, textStatus) {
          let result = xhr.responseJSON
          errorForm = result.error.form;
          for (const key in errorForm) {
            $("#e-" + key).html(errorForm[key]);
          }
        }
      })
      unLoadingKuy();
    }
  })

  function getAction() {
    return `<div class="dropdown custom-dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i data-feather="more-horizontal"></i>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                      <a class="dropdown-item detailButton" href="javascript:void(0);">Detail</a>
                      <a class="dropdown-item editButton" data-prk="2" href="javascript:void(0);">Edit</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>`;
  }

  $('select[name="filter-unit"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });
  $('select[name="dkCode"]').on("select2:select", function(e) {
    // let id = e.params.data.id
    // if (id) {
    //   const PRKONE = function() {
    //     var result = null;
    //     $.ajax({
    //       async: false,
    //       url: `${API_URL}Kontrak/GetOneKontrak/index/${id}`,
    //       type: "GET",
    //       headers: {
    //         "Authorization": `Bearer ${accessToken}`,
    //       },
    //       success: function(data) {
    //         result = data;
    //       }
    //     })
    //     return result;
    //   }()
    //   $('#detail-kontrak-form').html(`<table id="zero" class="table " style="width:100%">
    //             <tr>
    //               <th>No Kontrak</th>
    //               <th>Keterangan</th>
    //               <th>Selesai</th>
    //               <th>Pengadaan</th>
    //               <th>Sumber Dana</th>
    //               <th>Tgl Akhir</th>
    //               <th>Tanggal Awal</th>
    //               <th>Uraian</th>
    //               <th>No PRK</th>
    //               <th>No SKKI</th>
    //             </tr>
    //             <tr>
    //               <td>${PRKONE.data.kontrakNo}</td>
    //               <td>${PRKONE.data.kontrakKeterangan}</td>
    //               <td>${PRKONE.data.kontrakSelesai}</td>
    //               <td>${PRKONE.data.kontrakSistemPengadaan}</td>
    //               <td>${PRKONE.data.kontrakSumberDana}</td>
    //               <td>${PRKONE.data.kontrakTglAkhir}</td>
    //               <td>${PRKONE.data.kontrakTglAwal}</td>
    //               <td>${PRKONE.data.kontrakUraian}</td>
    //               <td>${PRKONE.data.prkNo}</td>
    //               <td>${PRKONE.data.skkiNo}</td>
    //             </tr>
    //           </table>`)
    // } else {
    //   $('#detail-prk-form').html('')
    // }

  });
</script>
<script>
  var numberMask = IMask(
    document.getElementById('input-drNilai'), {
      mask: Number,
      min: 1,
    });
</script>