const GetAllProgram = (function () {
  var result = null;
  $.ajax({
    async: false,
    url: `${API_URL}Program/GetAllProgram`,
    type: "GET",
    headers: {
      Authorization: `Bearer ${accessToken}`,
    },
    success: function (data) {
      result = data;
    },
  });
  return result;
})();
