<div class="contenedor">

    <!-- -----------------------MENÚ DE NAVEGACIÓN -->
    <?php
    $menu_links = ' 

   <li class="li__links">
   <a href=https://cursos-ec.utpl.edu.ec/course/view.php?id=326 class="link">Portal educativo</a>
   </li>
  
   <li class="li__links">
   <a href="/login" class="link--entrar">Ingresar</a>
   </li> 
   ';
    include_once __DIR__ . "../../plantillas/Menu.php";
    ?>
    <!-- -----------------------MENÚ DE NAVEGACIÓN -->

    <div class="contenedor-sm">
        <!-- <h1>Sistema de calificación academica del curso de venta directa</h1> -->
        <img src="build/img/logo_ec_red.png" alt="Revistas">

        <div class="card-container">
            <div class="card">
                <img src="build/img/eventos.jpg" alt="Eventos">
                <div class="card-content">
                    <h3> Registro de asistencia de los talleres</h3>
                    <a href="/login">Ver más</a>
                </div>
            </div>
            <div class="card">
                <img src="build/img/revistas.jpg" alt="Revistas">
                <div class="card-content">
                    <h3>Revisar calificación final del curso</h3>
                    <a href="/login">Ver más</a>
                </div>
            </div>
        </div>
    </div>



    <?php
    $script = "
  <script src='build/js/app.js'></script>
";
    ?>