const GetAllPRKNoDt = function() {
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