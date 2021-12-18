
  const GetAllFungsi = function() {
    var result = null;
    $.ajax({
      async: false,
      url: `${API_URL}Fungsi/GetAllFungsi`,
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