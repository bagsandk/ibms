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
      pageLength: 10,
      processing: true,
      serverSide: true,
      order: [],
      columns: [{
          // order dfault
          name: 'prkCode',
          data: 'no',
          title: '#',
        },
        {
          name: 'tahun',
          data: 'tahun',
          title: 'Tahun',
        },
        {
          name: 'prkNo',
          data: 'prkNo',
          title: 'NO PRK',
        },
        {
          name: 'programNama',
          data: 'programNama',
          title: 'Program',
        },
        {
          name: 'unitNama',
          data: 'unitNama',
          title: 'Unit',
        },
        {
          name: 'psStatus',
          data: 'psStatus',
          title: 'Jenis',
        },
        {
          name: 'prkUraian',
          data: 'prkUraian',
          title: 'Uraian',
        },
        {
          name: 'prkNilai',
          data: 'prkNilai',
          title: 'Nilai',
        },
        {
          name: 'fungsiNama',
          data: 'fungsiNama',
          title: 'Fungsi',
        },
        {
          title: 'Action',
          name: 'prkCode',
          data: 'prkCode',
          render: getAction
        },

      ],
      ajax: {
        url: `<?= IP_BACKEND ?>PRK/GetAllPRK`,
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
        },
      },
      scrollX: true,
      columnDefs: [{
        targets: [0, 9],
        orderable: false,
      }, ],
      drawCallback: function(settings) {
        feather.replace()
      }
    });
  });

  $(document).on('click', '.editButton', (e) => {
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Edit PRK')
    $('#btn-simpan').removeAttr('style')
    $('#btn-simpan').attr('name', 'edit');
    $('#prkModal').modal('show')
  })

  $(document).on('click', '.detailButton', (e) => {
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", true);
    $('#prkModalLabel').html('Detail PRK')
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
    dropdownParent: $('#prkModal')
  });

  $('#addButton').click(() => {
    $('#prk-form').trigger('reset');
    // $('select[name="unitCode"]').prop('selectedIndex', 0);
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah PRK')
    $('#btn-simpan').attr('name', 'tambah');
  })
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
    $("select[name='prkCode']").select2({
      data: PRK.data.map((a) => {
        return {
          id: a.prkCode,
          text: a.prkNo
        }
      }),
      dropdownParent: $('#prkModalLanjutan')
    });
  })
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
                  <td>${PRKONE.data.psStatus}</td>
                  <td>${PRKONE.data.prkUraian}</td>
                  <td>${PRKONE.data.prkNilai}</td>
                  <td>${PRKONE.data.fungsiNama}</td>
                </tr>
              </table>`)
    } else {
      $('#detail-prk-form').html('')
    }

  });
  $('#btn-simpan').click(function() {
    let form = $('#prk-form').serialize();
    loadingKuy();
    $(".e_message").html("");
    if (this.name == 'tambah') {
      $.ajax({
        url: `<?= IP_BACKEND ?>PRK/InsertPRKMurni`,
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
        url: `<?= IP_BACKEND ?>PRK/InsertPRKLanjutan`,
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
            $("#e-" + key).html(errorForm[key]);
          }
        }
      })
      unLoadingKuy();
    }
  })

  $('select[name="filter-tahun"]').on('change', function() {
    let table = $('#zero-config').DataTable()
    table.draw()
  });

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
</script>
<script>
  var numberMask = IMask(
    document.getElementById('input-prkNilai'), {
      mask: Number,
      min: 1,
    });
</script>