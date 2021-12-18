<script src="<?= base_url() ?>assets/light/main/custom/global.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/select2/select2.min.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/datatable.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getAction.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getAllPrk.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getOnePrk.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getUnit.js"></script>
<script src="https://unpkg.com/imask"></script>

<script type="text/javascript">
  $(document).ready(function() {
    renderDataTable({
      url: `${API_URL}SKKI/GetAllSKKI`,
      columnDefs: [{
        targets: [0],
        orderable: false,
        searchable: false,
      }, ],
      columns: [{
          name: 'tahun',
          data: 'tahun',
          title: 'Tahun',
        },
        {
          name: 'skkiNoUsulan',
          data: 'skkiNoUsulan',
          title: 'No Usulan',
        },
        {
          name: 'skkiTglUsulan',
          data: 'skkiTglUsulan',
          title: 'Tanggal Usulan',
        },
        {
          name: 'skkiNo',
          data: 'skkiNo',
          title: 'No SKKI',
        },
        {
          name: 'unitNama',
          data: 'unitNama',
          title: 'Unit',
        },
        {
          name: 'skkiTglTerbit',
          data: 'skkiTglTerbit',
          title: 'Tanggal Terbit',
        },
        {
          name: 'skkiUraian',
          data: 'skkiUraian',
          title: 'Uraian SKKI',
        },
        {
          name: 'skkiNilai',
          data: 'skkiNilai',
          title: 'Nilai SKKI',
        },
        {
          title: 'Action',
          name: 'skkiCode',
          data: 'skkiCode',
          render: getAction
        },
      ],
    })
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
    selectPsCode()
    let dataid = e.target.getAttribute('data-id')
    loadingKuy()
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetOneSKKI/index/${dataid}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(data) {
        const skki = data && data.data
        $('#addPrkSkkiDetail').attr('data-id', skki.skkiCode)
        $('#skki-detail').html(`
        <div class="col-6"> <table> <tr> <td>NO SKKI</td> <td>:</td> <td id="">${skki.skkiNo}</td> </tr> <tr> <td>NO USULAN</td> <td>:</td> <td>${skki.skkiNoUsulan}</td> </tr> <tr> <td>Nilai SKKI</td> <td>:</td> <td>${skki.skkiNilai}</td> </tr><tr><td>Tahun</td> <td>:</td> <td>${skki.tahun}</td></tr> </table> </div> <div class="col-6 "> <table> <tr> <td>Tanggal Terbit</td> <td>:</td> <td>${skki.skkiTglTerbit}</td> </tr> <tr> <td>Tanggal Usulan</td> <td>:</td> <td>${skki.skkiTglUsulan}</td> </tr> <tr> <td>UNIT</td> <td>:</td> <td>${skki.unitNama}</td> </tr> <tr> <td>Uraian</td> <td>:</td> <td>${skki.skkiUraian}</td> </tr> </table> </div>
        `)
        skkiDetailPRK(dataid)
        unLoadingKuy()
      }
    })
    $('#detailModal').modal({
      backdrop: 'static',
      keyboard: false
    })
  })

  $(document).on('click', '#addPrkSkkiDetail', function(e) {
    let skkiCode = e.target.getAttribute('data-id')
    const pscode = $('select[name="psCode"]').select2('val')
    $.ajax({
      url: `${API_URL}SKKI/InsertPRKToSKKI`,
      type: "POST",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      data: {
        skkiCode: skkiCode,
        psCode: pscode
      },
      success: function(data, textStatus, xhr) {
        console.log(data)
        toastSuccess(data.success.message)
        skkiDetailPRK(skkiCode)
      },
      error: function(xhr, textStatus) {
        const er = xhr.responseJSON
        toastError(er.error.form.psCode)
      }
    })
  })

  $('#addButton').click(() => {
    const PRK = function() {
      var result = null;
      $.ajax({
        async: false,
        url: `${API_URL}PRK/GetAllPRKNoDt`,
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
    $("select[name='psCode']").select2({
      data: PRK.data.map((a) => {
        return {
          id: a.psCode,
          text: a.prkNo,
          prkCode: a.prkCode,
        }
      }),
      dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
    });
    $('#prk-form').trigger('reset');
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah SKKI')
    $('#btn-simpan').attr('name', 'tambah');
  })

  $('#btn-simpan').click(function() {
    let form = $('#prk-form').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `${API_URL}SKKI/InsertSKKI`,
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

  $('#btn-simpan-lanjutan').click(function() {
    let form = $('#prk-form-lanjutan').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `${API_URL}SKKI/InsertSKKILanjutan`,
        type: "POST",
        headers: {
          "Authorization": `Bearer ${accessToken}`,
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
  PRKSKKI()
</script>

<script>
  $('select[name="psCode"]').on("select2:select", function(e) {
    let id = e.params.data.id
    if (id) {
      $('#addPrkSkkiDetail').attr('disabled', false)
    } else {
      $('#addPrkSkkiDetail').attr('disabled', true)
    }
  });

  $("select[name='unitCode']").select2({
    data: GetAllUnit.data.map((a) => {
      return {
        id: a.unitCode,
        text: a.unitNama
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
  });

  // $('#addButtonLanjutan').click(() => {
  //   $("select[id='prkCodeLanjutan']").select2({
  //     data: GetAllPRKNoDt.data.map((a) => {
  //       return {
  //         id: a.prkCode,
  //         text: a.prkNo,
  //         tahun: a.tahunCode
  //       }
  //     }),
  //     dropdownParent: $('#prkModalLanjutan')
  //   });
  // })
</script>

<script>
  function skkiDetailRemovePRK(spsCode) {
    const skkiCode = $('#addPrkSkkiDetail').attr("data-id")
    $.ajax({
      url: `${API_URL}SKKI/DeletePRKFromSKKI/index/${spsCode}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(data, textStatus, xhr) {
        console.log(data)
        toastSuccess(data.success.message)
        skkiDetailPRK(skkiCode)
      },
      error: function(xhr, textStatus) {
        const er = xhr.responseJSON
        toastError(er.error.form.psCode)
      }
    })
  }

  function skkiDetailPRK(idSkki) {
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllPRKNoDt/index/${idSkki}`,
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
          <td><a href="javascript:void(0)" onclick="skkiDetailRemovePRK(${p.spsCode})"><i data-feather="trash"></i></a></td>
          </tr>`
          return tr;
        })
        $('#tbody-prk').html(item)
        feather.replace()
      }
    })
    unLoadingKuy()
  }

  function selectPsCode() {
    $("select[name='psCode']").select2({
      data: GetAllPRKNoDt.data.map((a) => {
        return {
          id: a.psCode,
          text: a.prkNo
        }
      }),
      dropdownParent: $('#detailModal > .modal-dialog > .modal-content')
    });
  }

  const skkiLama = function(tahun, prkCode) {
    console.log(tahun)
    $.ajax({
      async: false,
      url: `${API_URL}SKKI/GetAllSKKINoDt/index/${tahun}/${prkCode}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(o) {
        $("select[name='skkiCodeLama']").empty();
        var no = new Option("Pilih SKKI", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(no).html("Pilih SKKI");
        $("select[name='skkiCodeLama']").append(no);
        $("select[name='skkiCodeLama']").select2({
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

  const prkSekarang = function() {
    $.ajax({
      async: false,
      url: `${API_URL}PRK/GetAllPRKNoDt`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(o) {
        $("select[name='psCode']").empty();
        var no = new Option("Pilih PRK Sekarang", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(no).html("Pilih PRK Sekarang");
        $("select[name='psCode']").append(no);
        $("select[name='psCode']").select2({
          data: o.data.map((a) => {
            return {
              id: a.psCode,
              text: a.prkNo
            }
          }),
          dropdownParent: $('#prkModalLanjutan')
        });
      }
    })
  }

  const PRKSKKI = function() {
    $.ajax({
      async: false,
      url: `${API_URL}PRK/GetAllPRKNoDt/forSKKI/${$("#filter-tahun option:selected").val()}`,
      type: "GET",
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(o) {
        $("select[name='filter-prk']").empty();
        var no = new Option("ALL", "");
        /// jquerify the DOM object 'o' so we can use the html method
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
</script>

<script>
  var numberMask = IMask(
    document.getElementById('input-skkiNilai'), {
      mask: Number,
      min: 1,
    });
</script>