<div class="contenedor">


   <?php
   session_start();
   define('CORREO_ESPECIFICO', 'lenciso@utpl.edu.ec');

   $menu_links = ' 
    <li class="li__links">
    <a href="/Revistas" class="link">Calificaciones</a>
    </li> 
    <li class="li__links">
    <a href="/Eventos" class="link">Asistencia</a>
    </li>';

   // Verificar si el correo del usuario coincide con el correo específico
   if (isset($_SESSION['email']) && $_SESSION['email'] === CORREO_ESPECIFICO) {
      $menu_links .= '
    <li class="li__links">
    <a href="/paginaAdministrador" class="link">Administradores</a>
    </li>';
   }

   // Añadir el enlace "Salir" al final
   $menu_links .= '
    <li class="li__links">
    <a href="/logout" class="link--salir">Salir</a>
    </li>';

   include_once __DIR__ . "../../plantillas/Menu.php";
   ?>






   <h1>¡Ha sido hackeado!</h1>

   <!-- Mensaje de aprendizaje del proyecto -->
   <div class="advertencia">
      <p>Proteger nuestros datos personales es clave para evitar fraudes y ataques cibernéticos. Usa contraseñas seguras, evita compartir información confidencial en sitios no confiables y mantén tus dispositivos actualizados. No hagas clic en enlaces sospechosos y activa la verificación en dos pasos siempre que sea posible. La seguridad digital depende de nuestras precauciones. ¡Cuida tu información!</p>
   </div>

   <div class="imgen-hakeado">

   </div>





</div>

<?php
$script = "<script src='build/js/app.js'></script>";
?>