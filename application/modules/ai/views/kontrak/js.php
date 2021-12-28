<script src="<?= base_url() ?>assets/light/main/custom/global.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/select2/select2.min.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/datatable.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getAction.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getTahun.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getOnePrk.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getAllPrk.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getAllVendor.js"></script>
<script src="https://unpkg.com/imask"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("select[name='filter-tahun']").select2({
      data: GetAllTahun.data.map((a) => {
        return {
          id: a.tahunCode,
          text: a.tahun
        }
      }),
    });
    renderDataTable({
      columns: [{
          name: 'kontrakNo',
          data: 'kontrakNo',
          title: 'No Kontak'
        }, {
          name: 'tahunKontrakSekarang',
          data: 'tahunKontrakSekarang',
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
          name: 'kontrakCode',
          data: 'kontrakCode',
          render: getAction
        },
      ],
      url: `${API_URL}Kontrak/GetAllKontrakNormalDt`,
      filter: function(d) {
        d.tahunCode = $("#filter-tahun option:selected").val()
      },
    })
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
    $('#detailModal').modal({
      backdrop: 'static',
      keyboard: false
    })
    let dataid = e.target.getAttribute('data-id')
    console.log(e)
    $.ajax({
      async: false,
      url: `${API_URL}Kontrak/GetOneKontrak/index/${dataid}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(data) {
        const k = data && data.data
        $('#tambahPrkDetail').attr('data-id', k.dkCode)
        $('#kontrak-detail').html(`<div class="col-6"> <table> <tr> <td>NO Kontrak</td> <td>:</td> <td>${k.kontrakNo}</td> </tr> <tr> <td>Vendor</td> <td>:</td> <td>${k.vendorNama}</td> </tr> <tr> <td>Nilai</td> <td>:</td> <td>${k.dkNilai}</td> </tr> <tr> <td>AI Terbit</td> <td>:</td> <td>${k.dkAITerbit}</td> </tr> <tr> <td>AKI Terbit</td> <td>:</td> <td>${k.dkAKITerbit}</td> </tr> </table> </div> <div class="col-6 "> <table> <tr> <td>Tanggal Awal</td> <td>:</td> <td>${k.kontrakTglAwal}</td> </tr> <tr> <td>Tanggal Akhir</td> <td>:</td> <td>${k.kontrakTglAkhir}</td> </tr> <tr> <td>Sistem Pengadaan</td> <td>:</td> <td>${k.kontrakSistemPengadaan}</td> </tr> <tr> <td>Sumber Dana</td> <td>:</td> <td>${k.kontrakSumberDana}</td> </tr> <tr> <td>Uraian</td> <td>:</td> <td>${k.kontrakUraian}</td> </tr> <tr> <td>Keterangan</td> <td>:</td> <td>${k.kontrakKeterangan}</td> </tr> </table> </div>`)
        kontrakDetailPRK(k.dkCode)
      }
    })
  })

  $('#addButton').click(() => {
    getSKKIInput()
    $('#prk-form').trigger('reset');
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah Kontrak')
    $('#btn-simpan').attr('name', 'tambah');
  })
  $('#btn-simpan').click(function() {
    let form = $('#prk-form').serializeArray();
    loadingKuy();
    const dataPsCode = [];
    $("#detail-prk-form > tr").map(function(index, tr) {
      dataPsCode.push($(this).attr("data-id"))
    })
    if (dataPsCode.length == 0) {
      $("#e-psCode").html("prk minimal 1");
    }
    form.push({
      name: "psCode",
      value: dataPsCode
    })
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `${API_URL}Kontrak/InsertKontrak`,
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
  $(document).on('click', '#tambahPrkDetail', function(e) {
    let dkcode = e.target.getAttribute('data-id')
    let pscode = $("#detail-input-prk option:selected").val()
    $.ajax({
      url: `${API_URL}Kontrak/InsertPRKToKontrak`,
      type: "POST",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      data: {
        dkCode: dkcode,
        psCode: pscode
      },
      success: function(data, textStatus, xhr) {
        console.log(data)
        toastSuccess(data.success.message)
        kontrakDetailPRK(dkcode)
      },
      error: function(xhr, textStatus) {
        const er = xhr.responseJSON
        toastError(er.error.form.psCode)
      }
    })
  })
</script>

<script>
  function kontrakDetailRemovePRK(psdkCode, dkCode) {
    $.ajax({
      url: `${API_URL}Kontrak/DeletePRKFromKontrak/index/${psdkCode}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(data, textStatus, xhr) {
        console.log(data)
        toastSuccess(data.success.message)
        kontrakDetailPRK(dkCode)
      },
      error: function(xhr, textStatus) {
        const er = xhr.responseJSON
        toastError(er.error.form.psCode)
      }
    })
  }

  function kontrakDetailPRK(dkCode) {
    $.ajax({
      async: false,
      url: `${API_URL}PRK/GetAllPRKNoDt/forKontrak/${dkCode}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(data) {
        const prk = data && data.data
        const item = prk.map((p) => {
          const tr = `<tr>
          <td>${p.prkNo}</td>
          <td>${p.tahun}</td>
          <td>${p.programNama}</td>
          <td>${p.unitNama}</td>
          <td>${p.psStatus}</td>
          <td>${p.prkUraian}</td>
          <td>${p.prkNilai}</td>
          <td>${p.fungsiNama}</td>
          <td><a href="javascript:void(0)" onclick="kontrakDetailRemovePRK(${p.psdkCode},${p.dkCode})"><i data-feather="trash"></i></a></td>
          </tr>`
          return tr;
        })
        $('#tbody-prk').html(item)
        feather.replace()
      }
    })
    unLoadingKuy()
  }

  function removePrkDetail(element) {
    $(element).closest('tr').remove()
  }
  const getSKKIInput = function() {
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllSKKINoDt/index/${$("#input-tahun option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
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
          dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
        });
      }
    })
  }
  const getPRKInput = function() {
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllPRKNoDt/index/${$("#input-skki option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(o) {
        $("select[id='input-prk']").empty();
        var no = new Option("Pilih PRK", "");
        $(no).html("Pilih PRK");
        $("select[id='input-prk']").append(no);
        $("select[id='input-prk']").select2({
          data: o.data.map((a) => {
            return {
              id: a.psCode,
              text: a.prkNo
            }
          }),
          dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
        });
      },
      error: function(xhr, status, err) {
        $("select[id='input-prk']").empty();
        var no = new Option("Pilih PRK", "");
        $(no).html("Pilih PRK");
        $("select[id='input-prk']").append(no);
        $('#tambahPrk').addClass('disabled')

      }
    })
  }
  const disableBtnAddPrk = () => {
    let id = $("#input-prk option:selected").val()
    if (id) {
      $('#tambahPrk').removeClass('disabled')
    } else {
      $('#tambahPrk').addClass('disabled')
    }
  }
  const getSKKIInputDetail = function() {
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllSKKINoDt/index/${$("#detail-input-tahun option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(o) {
        $("select[id='detail-input-skki']").empty();
        var no = new Option("Pilih SKKI", "");
        $(no).html("Pilih SKKI");
        $("select[id='detail-input-skki']").append(no);
        $("select[id='detail-input-skki']").select2({
          data: o.data.map((a) => {
            return {
              id: a.skkiCode,
              text: a.skkiNo
            }
          }),
          dropdownParent: $('#detailModal > .modal-dialog > .modal-content')
        });
      }
    })
  }
  const getPRKInputDetail = function() {
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllPRKNoDt/index/${$("#detail-input-skki option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(o) {
        $("select[id='detail-input-prk']").empty();
        var no = new Option("Pilih PRK", "");
        $(no).html("Pilih PRK");
        $("select[id='detail-input-prk']").append(no);
        $("select[id='detail-input-prk']").select2({
          data: o.data.map((a) => {
            return {
              id: a.psCode,
              text: a.prkNo
            }
          }),
          dropdownParent: $('#detailModal > .modal-dialog > .modal-content')
        });
      },
      error: function(xhr, status, err) {
        $("select[id='detail-input-prk']").empty();
        var no = new Option("Pilih PRK", "");
        $(no).html("Pilih PRK");
        $("select[id='detail-input-prk']").append(no);
        $('#tambahPrkDetail').attr('disabled', true)

      }
    })
  }
  const disableBtnAddPrkDetail = () => {
    let skki = $("#detail-input-skki option:selected").val()
    console.log(skki,'skki')
    let id = $("#detail-input-prk option:selected").val()
    if (skki) {
      if (id) {
        $('#tambahPrkDetail').attr('disabled', false)
      } else {
        $('#tambahPrkDetail').attr('disabled', true)
      }
    } else {
      $("select[id='detail-input-prk']").empty();
      var no = new Option("Pilih PRK", "");
      $(no).html("Pilih PRK");
      $("select[id='detail-input-prk']").append(no);
      $('#tambahPrkDetail').attr('disabled', true)
    }
  }
</script>

<script>
  $('#tambahPrk').click(function() {
    let id = $("#input-prk option:selected").val()
    const {
      data
    } = GetOnePRK(id);
    const prk = data && data
    const dataPsCode = [];
    $("#detail-prk-form > tr").map(function(index, tr) {
      dataPsCode.push($(this).attr("data-id"))
    })
    if (dataPsCode.indexOf(prk.psCode) == -1) {
      const tr = `<tr data-id="${prk.psCode}">
          <td>${prk.prkNo}</td>
          <td>${prk.tahun}</td>
          <td>${prk.programNama}</td>
          <td>${prk.unitNama}</td>
          <td>${prk.psStatus}</td>
          <td>${prk.prkUraian}</td>
          <td>${prk.prkNilai}</td>
          <td>${prk.fungsiNama}</td>
          <td><a href="javascript:void(0)" onclick="removePrkDetail(this)"><i data-feather="trash"></i></a></td>
          </tr>`
      $('#detail-prk-form').append(tr);
    }
    feather.replace()
  });

  $("select[name='vendorCode']").select2({
    data: GetAllVendor.data.map((a) => {
      return {
        id: a.vendorCode,
        text: a.vendorNama
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
  });

  $('select[name="filter-tahun"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });

  $("select[id='input-tahun']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
  });

  $('select[id="input-tahun"]').on('change', function() {
    getSKKIInput()
    disableBtnAddPrk();
  });
  $('select[id="input-skki"]').on('change', function() {
    getPRKInput()
    disableBtnAddPrk();
  });
  $('select[id="input-prk"]').on("select2:select", function(e) {
    disableBtnAddPrk();
  });
  $("select[id='detail-input-tahun']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
    dropdownParent: $('#detailModal > .modal-dialog > .modal-content')
  });

  $('select[id="detail-input-tahun"]').on('change', function() {
    getSKKIInputDetail()
    disableBtnAddPrkDetail();
  });
  $('select[id="detail-input-skki"]').on('change', function() {
    getPRKInputDetail()
    disableBtnAddPrkDetail();
  });
  $('select[id="detail-input-prk"]').on("select2:select", function(e) {
    disableBtnAddPrkDetail();
  });
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