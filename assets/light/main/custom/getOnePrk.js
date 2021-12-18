function GetOnePRK(prkCode) {
  var result = null;
  $.ajax({
    async: false,
    url: `${API_URL}PRK/GetOnePRK/index/${prkCode}`,
    type: "GET",
    headers: {
      Authorization: `Bearer ${accessToken}`,
    },
    success: function (data) {
      result = data;
    },
  });
  return result;
}
