const GetAllVendor = function() {
  var result = null;
  $.ajax({
    async: false,
    url: `${API_URL}Vendor/GetAllVendor`,
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
