<script src="<?= base_url() ?>assets/light/main/custom/global.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?= base_url() ?>assets/light/plugins/select2/select2.min.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/datatable.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getAction.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getProgram.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getFungsi.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getTahun.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getUnit.js"></script>
<script src="<?= base_url() ?>assets/light/main/custom/getOnePrk.js"></script>

<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
  $(document).ready(function() {
    renderDataTable({
      url: `${API_URL}PRK/GetAllPRK`,
      columnDefs: [{
        targets: [0, 9],
        orderable: false,
      }, ],
      footerCallback: function(row, data, start, end, display) {
        var api = this.api(),
          total = api
          .column(7)
          .data()
          .reduce(function(a, b) {
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;
            return x + y;
          }, 0);
        rp = $.fn.dataTable.render.number(".", ",", 0, "Rp.").display;
        $(api.column(7).footer()).html(rp(total));
      },
      filter: function(d) {
        d.tahunCode = $("#filter-tahun option:selected").val()
        d.psStatus = $("#filter-status option:selected").val()
      },
      columns: [{
        name: 'prkCode',
        data: 'no',
        title: '#',
      }, {
        name: 'tahun',
        data: 'tahun',
        title: 'Tahun',
      }, {
        name: 'prkNo',
        data: 'prkNo',
        title: 'NO PRK',
      }, {
        name: 'programNama',
        data: 'programNama',
        title: 'Program',
      }, {
        name: 'unitNama',
        data: 'unitNama',
        title: 'Unit',
      }, {
        name: 'psStatus',
        data: 'psStatus',
        title: 'Jenis',
      }, {
        name: 'prkUraian',
        data: 'prkUraian',
        title: 'Uraian',
      }, {
        name: 'prkNilai',
        data: 'prkNilai',
        className: 'prkNilai',
        title: 'Nilai',
        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp.')
      }, {
        name: 'fungsiNama',
        data: 'fungsiNama',
        title: 'Fungsi',
      }, {
        title: 'Action',
        name: 'prkCode',
        data: 'prkCode',
        render: getAction
      }, ],
    })
  });


  $(document).on('click', '.editButton', (e) => {
    let dataid = e.target.getAttribute('data-id')
    const {
      data
    } = GetOnePRK(dataid)
    const prk = data && data;
    for (var key in prk) {
      if (prk.hasOwnProperty(key)) {
        if ($(`input[name="${key}"]`).length) {
          $(`input[name="${key}"]`).val(prk[key])
        }
        if ($(`select[name="${key}"]`).length) {
          $(`select[name="${key}"]`).val(prk[key]).trigger('change')
        }
      }
    }
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Edit PRK')
    $('#btn-simpan').show()
    $('#btn-simpan').attr('name', 'edit');
    $('#btn-simpan').attr('data-id', dataid);
    $('#prkModal').modal({
      backdrop: 'static',
      keyboard: false
    })
  })

  $(document).on('click', '.detailButton', (e) => {
    let dataid = e.target.getAttribute('data-id')
    const {
      data
    } = GetOnePRK(dataid)
    const prk = data && data;
    for (var key in prk) {
      if (prk.hasOwnProperty(key)) {
        if ($(`input[name="${key}"]`).length) {
          $(`input[name="${key}"]`).val(prk[key])
        }
        if ($(`select[name="${key}"]`).length) {
          $(`select[name="${key}"]`).val(prk[key]).trigger('change')
        }
      }
    }
    $("#prk-form :input").prop("disabled", true);
    $('#prkModalLabel').html('Detail PRK')
    $('#btn-simpan').hide();
    $('#prkModal').modal({
      backdrop: 'static',
      keyboard: false
    })
  })

  $('#addButton').click(() => {
    $('#prk-form').trigger('reset');
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah PRK')
    $('#btn-simpan').attr('name', 'tambah');
  })

  $('#btn-simpan').click(function() {
    let form = $('#prk-form').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `${API_URL}PRK/InsertPRKMurni`,
        type: "POST",
        headers: {
          "Authorization": `Bearer ${accessToken}`,
        },
        data: form,
        success: function(data, textStatus, xhr) {
          var table = $('#zero-config').DataTable()
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
    }
    unLoadingKuy();
  })
</script>
<script>
  $('select[name="filter-tahun"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });
  $('select[name="filter-status"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });

  $("select[name='filter-status']").select2()
  $("select[name='filter-tahun']").select2({
    data: GetAllTahun.data.map((a) => {
      return {
        id: a.tahunCode,
        text: a.tahun
      }
    }),
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

  $("select[name='programCode']").select2({
    data: GetAllProgram.data.map((a) => {
      return {
        id: a.programCode,
        text: a.programNama
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
  });

  $("select[name='fungsiCode']").select2({
    data: GetAllFungsi.data.map((a) => {
      return {
        id: a.fungsiCode,
        text: a.fungsiNama
      }
    }),
    dropdownParent: $('#prkModal > .modal-dialog > .modal-content')
  });
</script>
<script>
  var numberMask = IMask(
    document.getElementById('input-prkNilai'), {
      mask: Number,
      min: 1,
    });
</script>