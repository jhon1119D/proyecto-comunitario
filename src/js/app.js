// Código principal de la aplicación
document.addEventListener("DOMContentLoaded", function () {
  mensajetemporal();
  menuBurger();
  darkMode();
  confirmarDelete();
  modal();
  onGetFile();
  formularios();
});

//MENÚ HAMBURGUESA
function menuBurger() {
  const containerIcons = document.getElementById("container__icons");
  const ulLinks = document.getElementById("ul__links");
  const listIcon = document.getElementById("list__icon");
  const closeIcon = document.getElementById("close__icon");
  // Verifica que todos los elementos existen antes de añadir los event listeners
  if (containerIcons && ulLinks && listIcon && closeIcon) {
    containerIcons.addEventListener("click", function () {
      ulLinks.classList.toggle("ul__links--show");
      listIcon.classList.toggle("icon--hidden");
      closeIcon.classList.toggle("icon--show");
    });
  } else {
    console.warn("Uno o más elementos no se encontraron en el DOM.");
  }
}

// AÑADIR EL MODO OSCURO PARA DESCANSO DE LA VISTA
function darkMode() {
  // Verifica si el modo oscuro está habilitado en localStorage
  const currentMode = localStorage.getItem("dark-mode");
  if (currentMode === "enabled") {
    document.body.classList.add("dark-mode");
  }

  // Selecciona todos los elementos con la clase "toggle-dark-mode"
  const toggleButtons = document.querySelectorAll(".toggle-dark-mode");

  // Añade el evento de clic para alternar el modo oscuro a cada botón
  toggleButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Previene el comportamiento predeterminado de los enlaces
      document.body.classList.toggle("dark-mode");

      // Guarda la preferencia del usuario en localStorage
      if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("dark-mode", "enabled");
      } else {
        localStorage.setItem("dark-mode", "disabled");
      }
    });
  });
}

function mensajetemporal() {
  const alertas = document.querySelectorAll(".alerta");

  // Itera sobre todas las alertas
  alertas.forEach(function (alerta) {
    setTimeout(function () {
      // Reducir la opacidad a 0 para el efecto de desvanecimiento
      alerta.style.opacity = 0;
      // Después de que la opacidad haya cambiado (500ms), ocultamos la alerta completamente
      setTimeout(function () {
        alerta.style.display = "none"; // Ocultamos la alerta completamente
      }, 1500);
    }, 3000);
  });
}

//Mensaje de alerta para eliminar
function confirmarDelete() {
  document.querySelectorAll(".eliminar-E").forEach(function (enlace) {
    enlace.addEventListener("click", function (e) {
      e.preventDefault();
      const nombre = this.getAttribute("data-nombre");
      console.log("Nombre del registro a eliminar:", nombre); // Verificar el valor de nombre
      Swal.fire({
        title: "¿Estás seguro?",
        html:
          "Se eliminará el siguiente registro:<br><ul class='delete-list'><li>" +
          nombre +
          "</li></ul>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33", // Color rojo para el botón de confirmar
        cancelButtonColor: "#004370", // Color azul para el botón de cancelar
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false, // No permitir cerrar la alerta haciendo clic fuera
      }).then((result) => {
        if (result.isConfirmed) {
          //mostrar mensaje de éxito
          Swal.fire({
            title: "Eliminado",
            html:
              "Se eliminó el siguiente registro:<br><ul class='delete-list'><li>" +
              nombre +
              "</li></ul>",
            icon: "success",
            allowOutsideClick: false,
          }).then(() => {
            window.location.href = enlace.href;
          });
        }
      });
    });
  });
}

//Ventana modal para cambiar datos de usuario
function modal() {
  var modal = document.getElementById("myModal");
  var btn = document.getElementById("openModalBtn");
  var span = document.getElementsByClassName("close")[0];

  if (modal && btn && span) {
    btn.onclick = function () {
      modal.style.display = "block";
    };
    span.onclick = function () {
      modal.style.display = "none";
    };
  } else {
    console.error("Uno o más elementos no se encontraron en el DOM.");
  }
}

async function onGetFile(url) {
  if (url) {
    // Vaciar el contenedor del modal antes de cargar un nuevo documento
    document.getElementById("modal-contenedor").innerHTML = "";

    try {
      // Convertir URL relativa en absoluta
      const absoluteUrl = new URL(url, window.location.origin).href;
      console.log("Absolute URL:", absoluteUrl); // Verificar la URL absoluta

      const response = await fetch(absoluteUrl);
      const blob = await response.blob();

      // Usar la API URL para obtener la extensión del archivo
      const urlObject = new URL(absoluteUrl);
      const extension = urlObject.pathname.split(".").pop().toLowerCase();

      if (extension === "docx") {
        const options = {
          inWrapper: false,
          ignoreWidth: true,
          ignoreHeight: true,
        };
        docx
          .renderAsync(
            blob,
            document.getElementById("modal-contenedor"),
            null,
            options
          )
          .then(() => {
            console.log("docx: terminado");
            document.getElementById("myModal").style.display = "block";
            const docContent = document.querySelector(
              "#modal-contenedor .docx"
            );
            if (docContent) {
              docContent.style.padding = "0";
            }
          })
          .catch((error) => {
            console.error("Error al renderizar el archivo DOCX:", error);
          });
      } else if (extension === "txt" || extension === "tex") {
        const text = await blob.text();
        const pre = document.createElement("pre");
        pre.textContent = text;
        document.getElementById("modal-contenedor").appendChild(pre);
        document.getElementById("myModal").style.display = "block";
      } else {
        console.log("Tipo de archivo no soportado");
      }
    } catch (error) {
      console.error("Invalid URL:", url);
    }
  }
}

function formularios() {
  document
    .getElementById("mostrarFormulario")
    .addEventListener("click", function () {
      document.getElementById("formularioRevistas").classList.toggle("hidden");
      this.classList.toggle("girado");
    });
}
