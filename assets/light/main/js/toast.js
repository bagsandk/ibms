function toastSuccess(message) {
  Snackbar.show({
    text: message,
    pos: "top-right",
    actionTextColor: "#fff",
    backgroundColor: "#8dbf428e",
  });
}

function toastError(message) {
  Snackbar.show({
    text: message,
    pos: "top-right",
    actionTextColor: "#fff",
    backgroundColor: "#e7515a8e",
  });
}
