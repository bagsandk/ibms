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
          name: 'kontrakNo',
          data: 'kontrakNo',
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
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", true);
    $('#prkModalLabel').html('Detail Kontrak')
    $('#btn-simpan').attr('style', 'display:none');

    $('#prkModal').modal('show')
  })

  $('#addButton').click(() => {
    selectPRKAll()
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

  getPRKInput()
</script>

<script>
  function selectPRKAll() {
    $("select[id='input-prk']").select2({
      data: GetAllPRKNoDt.data.map((a) => {
        return {
          id: a.prkCode,
          text: a.prkNo
        }
      }),
      dropdownParent: $('#prkModal > .modal-dialog > .modal-content')

    });
  }
  console.log($("select[id='input-prk").select2())
  $("select[id='input-prk").on("results:message", function() {
    this.dropdown._positionDropdown();
  });
  const getPRKInput = function() {
    $.ajax({
      async: false,
      url: `${API_URL}PRK/GetAllPRKNoDt/forSKKI/${$("#input-tahun option:selected").val()}`,
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
              id: a.prkCode,
              text: a.prkNo
            }
          }),
          dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
        });
      }
    })
  }

  const getSKKIInput = function() {
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllSKKINoDt/index/${$("#input-tahun option:selected").val()}/${$("#input-prk option:selected").val()}`,
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

  function removePrkDetail(element) {
    $(element).closest('tr').remove()
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

  $("select[name='tahunCode']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
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

  $("select[id='input-tahun']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
  });

  $('select[name="filter-tahun"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });
  $('select[id="input-tahun"]').on('change', function() {
    getPRKInput()
  });

  $('select[name="skkiCode"]').on("select2:select", function(e) {
    let id = e.params.data.id
    if (id) {
      const SKKI = function() {
        var result = null;
        $.ajax({
          async: false,
          url: `${API_URL}SKKI/GetOneSKKI/index/${id}`,
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