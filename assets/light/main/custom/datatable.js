function renderDataTable({
  id = "#zero-config",
  columns,
  url,
  filter = (d) => {
    return d;
  },
  columnDefs,
}) {
  var table = $(id).DataTable({
    oLanguage: {
      oPaginate: {
        sPrevious: '<i data-feather="arrow-left"></i>',
        sNext: '<i data-feather="arrow-right"></i>',
      },
      sSearch: '<i data-feather="search"></i>',
      sSearchPlaceholder: "Search...",
      sLengthMenu: "Results :  _MENU_",
    },
    stripeClasses: [],
    lengthMenu: [5, 10, 20, 50],
    pageLength: 10,
    processing: true,
    serverSide: true,
    order: [],
    columns: columns,
    ajax: {
      url: url,
      type: "POST",
      headers: {
        Authorization: `Bearer ${accessToken}`,
      },
      dataFilter: function (data) {
        var json = JSON.parse(data);
        return JSON.stringify(json.data);
      },
      data: filter,
    },
    scrollX: true,
    columnDefs: columns,
    drawCallback: function (settings) {
      feather.replace();
    },
  });
}
