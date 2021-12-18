
const GetAllTahun = function() {
  var result = null;
  $.ajax({
    async: false,
    url: `${API_URL}Tahun/GetAllTahun`,
    type: "GET",
    headers: {
      "Authorization": `Bearer ${accessToken}`,
    },
    success: function(data) {
      result = data;
    }
  })
  return result;
}();