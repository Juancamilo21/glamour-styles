function successAlert(textMessage) {
  Swal.fire({
    title: "Eliminado",
    text: textMessage,
    icon: "success",
    confirmButtonColor: "var(--primary-color)",
  });
}

function errorAlert(textMessage) {
  Swal.fire({
    title: "Operación fallida",
    text: textMessage,
    icon: "error",
    confirmButtonColor: "var(--primary-color)",
  });
}

function confirmAlert(textMessage, callback) {
  Swal.fire({
    title: "¿Estas seguro?",
    text: textMessage,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "var(--primary-color)",
    cancelButtonColor: "#444",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      callback();
    }
  });
}

function detailsAlert(htmlDetails) {
  Swal.fire({
    title: "Detalles",
    html: htmlDetails,
    confirmButtonColor: "var(--primary-color)",
    customClass: {
      container: "custom-alert-container",
      title: "custom-title"
    }
  });
}

function alertForm(htmlForm, text, callbackOperation, callbackShowData) {
  Swal.fire({
    title: text,
    html: htmlForm,
    showCancelButton: true,
    confirmButtonColor: "var(--primary-color)",
    cancelButtonColor: "#444",
    confirmButtonText: text,
    cancelButtonText: "Cancelar",
    customClass: {
      container: "custom-alert-container",
      title: "custom-title",
    },
    preConfirm: () => {
      return callbackOperation();
    },
  }).then((result) => {
    if (result.isConfirmed) {
      const message = result.value.message;
      Swal.fire({
        title: "Operación Exitosa",
        text: message,
        icon: "success",
        confirmButtonColor: "var(--primary-color)",
      });
      callbackShowData();
    }
  });
}
