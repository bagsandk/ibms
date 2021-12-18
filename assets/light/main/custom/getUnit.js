
  const GetAllUnit = function() {
    var result = null;
    $.ajax({
      async: false,
      url: `${API_URL}Unit/GetAllUnit`,
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
