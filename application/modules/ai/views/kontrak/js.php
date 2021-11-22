<script src="<?= base_url() ?>assets/light/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="<?= base_url() ?>assets/light/plugins/select2/select2.min.js"></script>

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
      pageLength: 10,
      processing: true,
      serverSide: true,
      order: [],
      columns: [{
          name: 'kontrakNo',
          data: 'kontrakNo',
          title: 'No Kontak'
        }, {
          name: 'prkNo',
          data: 'prkNo',
          title: 'NO PRK'
        }, {
          name: 'skkiNo',
          data: 'skkiNo',
          title: 'No SKKI'
        }, {
          name: 'tahun',
          data: 'tahun',
          title: 'tahun'
        }, {
          name: 'kontrakKeterangan',
          data: 'kontrakKeterangan',
          title: 'Keterangan'
        }, {
          name: 'kontrakSelesai',
          data: 'kontrakSelesai',
          title: 'Selesai'
        }, {
          name: 'kontrakSistemPengadaan',
          data: 'kontrakSistemPengadaan',
          title: 'Sistem Pengadaan'
        }, {
          name: 'kontrakSumberDana',
          data: 'kontrakSumberDana',
          title: 'Sumber Dana'
        }, {
          name: 'kontrakTglAkhir',
          data: 'kontrakTglAkhir',
          title: 'Tgl Akhir'
        }, {
          name: 'kontrakTglAwal',
          data: 'kontrakTglAwal',
          title: 'Tgl Awal'
        }, {
          name: 'kontrakUraian',
          data: 'kontrakUraian',
          title: 'Uraian'
        }, {
          name: 'vendorNama',
          data: 'vendorNama',
          title: 'vendor Nama'
        },
        {
          title: 'Action',
          name: '',
          data: '',
          render: getAction
        },
      ],
      ajax: {
        url: `<?= IP_BACKEND ?>Kontrak/GetAllKontrakNormalDt`,
        type: "POST",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
        },
        dataFilter: function(data) {
          var json = JSON.parse(data)
          return JSON.stringify(json.data)
        },
        data: function(d) {
          d.tahunCode = $("#filter-tahun option:selected").val()
          d.prkCode = $("#filter-prk option:selected").val()
          d.skkiCode = $("#filter-skki option:selected").val()
        },
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
        url: `<?= IP_BACKEND ?>PRK/GetOnePRK/index/${d.prkCode}`,
        type: "GET",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
        },
        success: function(data) {
          result = data;
        }
      })
      return result;
    }()
    return `<table class="bg-primary" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"> <tr> <th>Tahun</th> <th>NO PRK</th> <th>Program</th> <th>Unit</th> <th>Jenis</th> <th>Uraian</th> <th>Nilai</th> <th>Fungsi</th> </tr> <tr> <td>${PRKONE.data.tahun}</td> <td>${PRKONE.data.prkNo}</td> <td>${PRKONE.data.programNama}</td> <td>${PRKONE.data.unitNama}</td> <td>${PRKONE.data.prkJenis}</td> <td>${PRKONE.data.prkUraian}</td> <td>${PRKONE.data.prkNilai}</td> <td>${PRKONE.data.fungsiNama}</td> </tr> </table>`;
  }

  $(document).on('click', 'tr.detail-prk', function() {
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
    $('#prkModalLabel').html('Edit Kontrak')
    $('#btn-simpan').removeAttr('style')
    $('#btn-simpan').attr('name', 'edit');

    $('input[name="tahun"]').val('2020');
    $('#prkModal').modal('show')
  })
  $(document).on('click', '.detailButton', (e) => {
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", true);
    $('#prkModalLabel').html('Detail Kontrak')
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
        url: `<?= IP_BACKEND ?>PRK/GetAllPRKNoDt`,
        type: "GET",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
        },
        success: function(data) {
          result = data;
        }
      })
      return result;
    }()
    $("select[name='prkCode']").select2({
      data: PRK.data.map((a) => {
        return {
          id: a.prkCode,
          text: a.prkNo
        }
      }),
      dropdownParent: $('#prkModal')
    });
    $('#prk-form').trigger('reset');
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah Kontrak')
    $('#btn-simpan').attr('name', 'tambah');
  })
  $('#btn-simpan').click(function() {
    let form = $('#prk-form').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `<?= IP_BACKEND ?>Kontrak/InsertKontrak`,
        type: "POST",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
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
  $('#btn-simpan-lanjutan').click(function() {
    let form = $('#prk-form-lanjutan').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `<?= IP_BACKEND ?>Kontrak/InsertKontrakLanjutan`,
        type: "POST",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
        },
        data: form,
        success: function(data, textStatus, xhr) {
          table = $('#zero-config').DataTable()
          toastSuccess(data.success.message);
          table.ajax.reload()
          $("#prkModalLanjutan").modal("toggle");
          $('#prk-form-lanjutan').trigger('reset');
        },
        error: function(xhr, textStatus) {
          let result = xhr.responseJSON
          errorForm = result.error.form;
          for (const key in errorForm) {
            $("#e-" + key + 'Lanjutan').html(errorForm[key]);
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

  $('select[name="prkCode"]').on("select2:select", function(e) {
    let id = e.params.data.id
    if (id) {
      const PRKONE = function() {
        var result = null;
        $.ajax({
          async: false,
          url: `<?= IP_BACKEND ?>PRK/GetOnePRK/index/${id}`,
          type: "GET",
          headers: {
            "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
          },
          success: function(data) {
            result = data;
          }
        })
        return result;
      }()
      $('#detail-prk-form').html(`<table id="zero" class="table " style="width:100%">
                <tr>
                  <th>Tahun</th>
                  <th>NO PRK</th>
                  <th>Program</th>
                  <th>Unit</th>
                  <th>Jenis</th>
                  <th>Uraian</th>
                  <th>Nilai</th>
                  <th>Fungsi</th>
                </tr>
                <tr>
                  <td>${PRKONE.data.tahun}</td>
                  <td>${PRKONE.data.prkNo}</td>
                  <td>${PRKONE.data.programNama}</td>
                  <td>${PRKONE.data.unitNama}</td>
                  <td>${PRKONE.data.prkJenis}</td>
                  <td>${PRKONE.data.prkUraian}</td>
                  <td>${PRKONE.data.prkNilai}</td>
                  <td>${PRKONE.data.fungsiNama}</td>
                </tr>
              </table>`)
    } else {
      $('#detail-prk-form').html('')
    }
  });

  $("select[name='filter-tahun']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
  });
  const getAllVendor = function() {
    var result = null;
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>Vendor/GetAllVendor`,
      type: "GET",
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(data) {
        result = data;
      }
    })
    return result;
  }()
  $("select[name='vendorCode']").select2({
    data: getAllVendor.data.map((a) => {
      return {
        id: a.vendorCode,
        text: a.vendorNama
      }
    }),
    dropdownParent: $('#prkModal')
  });
  $("select[id='input-tahun']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
    dropdownParent: $('#prkModal')
  });
  const getPRKFilter = function() {
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>PRK/GetAllPRKNoDt/forSKKI/${$("#filter-tahun option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(o) {
        $("select[name='filter-prk']").empty();
        var no = new Option("ALL", "");
        $(no).html("ALL");
        $("select[name='filter-prk']").append(no);
        $("select[name='filter-prk']").select2({
          data: o.data.map((a) => {
            return {
              id: a.prkCode,
              text: a.prkNo
            }
          }),
        });
      }
    })
  }
  const getSKKIFilter = function() {
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>SKKI/GetAllSKKINoDt/index/${$("#filter-tahun option:selected").val()}/${$("#filter-prk option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(o) {
        $("select[name='filter-skki']").empty();
        var no = new Option("ALL", "");
        $(no).html("ALL");
        $("select[name='filter-skki']").append(no);
        $("select[name='filter-skki']").select2({
          data: o.data.map((a) => {
            return {
              id: a.skkiCode,
              text: a.skkiNo
            }
          }),
        });
      }
    })
  }
  const getPRKInput = function() {
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>PRK/GetAllPRKNoDt/forSKKI/${$("#input-tahun option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(o) {
        $("select[id='input-prk']").empty();
        var no = new Option("Pilih PRK", "");
        $(no).html("Pilih PRK");
        $("select[id='input-prk']").append(no);
        $("select[id='input-prk']").select2({
          data: o.data.map((a) => {
            return {
              id: a.prkCode,
              text: a.prkNo
            }
          }),
          dropdownParent: $('#prkModal')
        });
      }
    })
  }
  const getSKKIInput = function() {
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>SKKI/GetAllSKKINoDt/index/${$("#input-tahun option:selected").val()}/${$("#input-prk option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(o) {
        $("select[id='input-skki']").empty();
        var no = new Option("Pilih SKKI", "");
        $(no).html("Pilih SKKI");
        $("select[id='input-skki']").append(no);
        $("select[id='input-skki']").select2({
          data: o.data.map((a) => {
            return {
              id: a.skkiCode,
              text: a.skkiNo
            }
          }),
          dropdownParent: $('#prkModal')
        });
      }
    })
  }
  getPRKInput()

  getPRKFilter()
  $('select[name="filter-tahun"]').on('change', function() {
    getPRKFilter()
    let table = $('#zero-config').DataTable()
    table.draw()
  });
  $('select[id="input-tahun"]').on('change', function() {
    getPRKInput()
  });
  $('select[name="filter-prk"]').on('change', function() {
    getSKKIFilter()
    let table = $('#zero-config').DataTable()
    table.draw()
  });
  $('select[id="input-prk"]').on('change', function() {
    getSKKIInput()
  });
  $('select[name="filter-skki"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });
  $('select[name="skkiCode"]').on("select2:select", function(e) {
    let id = e.params.data.id
    if (id) {
      const SKKI = function() {
        var result = null;
        $.ajax({
          async: false,
          url: `<?= IP_BACKEND ?>SKKI/GetOneSKKI/index/${id}`,
          type: "GET",
          headers: {
            "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
          },
          success: function(data) {
            result = data;
          }
        })
        return result;
      }()
      $('#detail-skki-form').html(`<table id="zero" class="table " style="width:100%">
                <tr>
                  <th>Tahun</th>
                  <th>NO PRK</th>
                  <th>NO SKKI</th>
                  <th>No Usulan</th>
                  <th>Tanggal Usulan</th>
                  <th>Tanggal Terbit</th>
                  <th>Unit</th>
                  <th>Uraian</th>
                  <th>Nilai</th>
                </tr>
                <tr>
                  <td>${SKKI.data.tahun}</td>
                  <td>${SKKI.data.prkNo}</td>
                  <td>${SKKI.data.skkiNo}</td>
                  <td>${SKKI.data.skkiNoUsulan}</td>
                  <td>${SKKI.data.skkiTglUsulan}</td>
                  <td>${SKKI.data.skkiTglTerbit}</td>
                  <td>${SKKI.data.unitNama}</td>
                  <td>${SKKI.data.skkiUraian}</td>
                  <td>${SKKI.data.skkiNilai}</td>
                </tr>
              </table>`)
    } else {
      $('#detail-skki-form').html('')
    }
  });
  const skkiLama = function(tahun, prkCode) {
    console.log(tahun)
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>SKKI/GetAllSKKINoDt/index/${tahun}/${prkCode}`,
      type: "GET",
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(o) {
        $("select[id='skkiCodeLanjutan']").empty();
        var no = new Option("Pilih SKKI", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(no).html("Pilih SKKI");
        $("select[id='skkiCodeLanjutan']").append(no);
        $("select[id='skkiCodeLanjutan']").select2({
          data: o.data.map((a) => {
            return {
              id: a.skkiCode,
              text: a.skkiNo
            }
          }),
          dropdownParent: $('#prkModalLanjutan')
        });
      }
    })
  }
  const getAllKontrak = function(skkiCode) {
    $.ajax({
      async: false,
      url: `<?= IP_BACKEND ?>Kontrak/GetAllKontrakNoDt`,
      type: "POST",
      data: {
        skkiCode: skkiCode
      },
      headers: {
        "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
      },
      success: function(o) {
        $("select[name='kontrakCodeLama']").empty();
        var no = new Option("Pilih Kontrak", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(no).html("Pilih Kontrak");
        $("select[name='kontrakCodeLama']").append(no);
        $("select[name='kontrakCodeLama']").select2({
          data: o.data.map((a) => {
            return {
              id: a.kontrakCode,
              text: a.kontrakNo
            }
          }),
          dropdownParent: $('#prkModalLanjutan')
        });
      }
    })
  }
  $('#addButtonLanjutan').click(() => {
    const PRK = function() {
      var result = null;
      $.ajax({
        async: false,
        url: `<?= IP_BACKEND ?>PRK/GetAllPRKNoDt/sebelum`,
        type: "GET",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
        },
        success: function(data) {
          result = data;
        }
      })
      return result;
    }()
    $("select[id='prkCodeLanjutan']").select2({
      data: PRK.data.map((a) => {
        return {
          id: a.prkCode,
          text: a.prkNo,
          tahun: a.tahunCode
        }
      }),
      dropdownParent: $('#prkModalLanjutan')
    });
  })
  $('select[id="prkCodeLanjutan"]').on("select2:select", function(e) {
    let data = e.params.data
    skkiLama(data.tahun, data.id)
  })
  $('select[id="skkiCodeLanjutan"]').on("select2:select", function(e) {
    let data = e.params.data.id
    getAllKontrak(data)
  })
</script>
<script>
  var numberMask = IMask(
    document.getElementById('input-dkNilai'), {
      mask: Number,
      min: 1,
    });
  var numberMask = IMask(
    document.getElementById('input-dkAKITerbit'), {
      mask: Number,
      min: 1,
    });
  var numberMask = IMask(
    document.getElementById('input-dkAITerbit'), {
      mask: Number,
      min: 1,
    });
  var numberMask = IMask(
    document.getElementById('input-dkAKITerbitLanjutan'), {
      mask: Number,
      min: 1,
    });
  var numberMask = IMask(
    document.getElementById('input-dkAITerbitLanjutan'), {
      mask: Number,
      min: 1,
    });
</script>