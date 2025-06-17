<div class="contenedor">
    <!-- -----------------------MENÚ DE NAVEGACIÓN -->
    <header class="header">
        <nav class="nav">
            <!-- imagen logo utpl menú -->
            <img class="imagenM" src="/build/img/Logo-utpl.svg" alt="Logo utpl">

            <div>
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="return" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                    </svg>
                </a>
            </div>


        </nav>

    </header>
    <!-- -----------------------MENÚ DE NAVEGACIÓN -->

    <div class="titulo">
        <p>Información para alumnos del curso de venta directa</p>
    </div>

    <div class="contenedor-sm">
        
<div class="imagen">
    <!-- imagen de la utpl -->
    <img src="/build/img/logo_ec_red.png" alt="Logo utpl">

</div>
        


        <p class="descripcion-pagina">Iniciar Sesión</p>
        <!-- BOTON USUARIO Y DARK MODE -->
        <div class="botones-utiles">
            <a><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill toggle-dark-mode" viewBox="0 0 16 16">
                    <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
                    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z" />
                </svg>
            </a>

            <a id="openModalBtn"> <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                </svg>
            </a>
        </div>

        <!-- ALERTAS  -->
        <?php
        include_once __DIR__ . "../../plantillas/alertas.php";
        ?>
        <!--ALERTAS -->

        <form class="formulario" method="POST" action="/login">
            <!-- usuario -->
            <div class="campo">
                <label for="nombre">Nombre usuario:</label>

                <input
                    type="text"
                    id="nombre"
                    placeholder="Nombre usuario"
                    value="<?php echo s($auth->nombre) ?>"
                    name="nombre" />
            </div>
            <!-- contraseña -->
            <div class="campo">
                <label for="contrasena">Contraseña:</label>

                <input
                    type="password"
                    id="contrasena"
                    placeholder="Contraseña"
                    name="contrasena" />
            </div>

            <input type="submit" class="boton" value="Acceder">

        </form>

        <div class="acciones">

            <a href="/registrar_usuario">Validar alumno</a>

            <a href="https://servicios.utpl.edu.ec/">servicios UTPL</a>
        </div>


    </div>


    <!-- Modal uno-->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>

            <h1>Cambiar contraseña</h1>

            <form action="/actualizar" method="POST" class="actualizar">
                <!-- -------------------------------------------------------------------------------- -->
                <div class="camp">
                    <label for="nombre">Nombre usuario:</label>
                    <input type="text" id="nombre" name="nombre">
                </div>
                <!-- -------------------------------------------------------------------------------- -->
                <div class="camp">
                    <label for="antiguaContraseña">Contraseña:</label>
                    <input type="password" id="antiguaContraseña" name="antiguaContraseña">
                </div>
                <!-- -------------------------------------------------------------------------------- -->
                <div class="camp">
                    <label for="nuevaContraseña">Nueva contraseña:</label>
                    <input type="password" id="nuevaContraseña" name="nuevaContraseña">
                </div>
                <!-- -------------------------------------------------------------------------------- -->
                <button type="submit">Cambiar</button>
            </form>
        </div>
    </div>
    <!-- Modal-uno -->


</div>

<?php
$script = "
  <script src='build/js/app.js'></script>
";
?>