const form = document.getElementById("actualizar_remate");

form.querySelectorAll("input, select, textarea").forEach((input) => {
  input.addEventListener("change", function () {
    // Cuando un campo cambie, agrega el campo modificado al FormData
    const formData = new FormData(form);
    formData.set(input.name, input.value);
  });
});

document.getElementById("actualizar").addEventListener("click", function (event) {
  event.preventDefault();
  actualizarRemate();
});

document.getElementById("eliminar-remate").addEventListener("click", function (event) {
  event.preventDefault();
  if (window.confirm("¿Seguro que quieres eliminar este remate?")) {
    eliminarRemate();
  }
});

function eliminarRemate() {
  var currentURL = window.location.href;

  var url = currentURL.replace("editar", "eliminar");
  axios
    .get(url)
    .then((response) => {
      console.log("Éxito:", response.data);
      window.alert(response.data.mensaje);
      window.location.href = "/rumate/";
    })
    .catch((error) => {
      console.error("Error:", error);
      window.alert(error.response.data.mensaje);
    });
}

function actualizarRemate() {
  var camposRemate = document.querySelectorAll("input, select, textarea");

  var camposVacios = Array.from(camposRemate).some(function (input) {
    return !input.value.trim() && input.hasAttribute("required");
  });

  if (camposVacios) {
    alert("No pueden haber campos de lote o ficha vacíos.");
    return;
  }
  const form = document.getElementById("actualizar_remate");
  const formData = new FormData(form);
  const currentURL = window.location.href;
  axios
    .post(currentURL, formData)
    .then((response) => {
      console.log("Éxito:", response.data);
      window.alert(response.data.mensaje);
    })
    .catch((error) => {
      console.error("Error:", error);
      window.alert(response.data.mensaje);
    });
}