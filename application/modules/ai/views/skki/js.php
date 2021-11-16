<script src="<?= base_url() ?>assets/light/plugins/blockui/jquery.blockUI.min.js"></script>
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
        sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
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
          name: 'prkNo',
          data: 'prkNo',
          title: 'NO PRK',
        },
        {
          title: 'Action',
          name: 'skkiCode',
          data: 'skkiCode',
          render: getAction
        },

      ],
      ajax: {
        url: `http://192.168.43.18/project/IBMS/Backend/SKKI/GetAllSKKI`,
        type: "POST",
        headers: {
          "Authorization": "Bearer <?= $this->session->userdata('accessToken') ?>",
        },
        dataFilter: function(data) {
          var json = JSON.parse(data)
          return JSON.stringify(json.data)
        }
      },
      columnDefs: [{
        targets: [0],
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

    $('input[name="tahun"]').val('2020');
    $('#prkModal').modal('show')
  })
  $(document).on('click', '.detailButton', (e) => {
    let dataid = e.target.getAttribute('data-prk')
    $("#prk-form :input").prop("disabled", true);
    $('#prkModalLabel').html('Detail PRK')
    $('#btn-simpan').attr('style', 'display:none');

    $('#prkModal').modal('show')
  })

  $('#addButton').click(() => {
    $('#prk-form').trigger('reset');
    $('#btn-simpan').removeAttr('style')
    $("#prk-form :input").prop("disabled", false);
    $('#prkModalLabel').html('Tambah PRK')
    $('#btn-simpan').attr('name', 'tambah');
  })

  $('.basic').select2({
    dropdownParent: $('#prkModal')
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