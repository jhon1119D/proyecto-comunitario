<div class="contenedor">
    <!-- -----------------------MENÚ DE NAVEGACIÓN -->
    <header class="header">
        <nav class="nav">
            <!-- imagen logo utpl menú -->
            <img class="imagenM" src="/build/img/Logo-utpl.svg" alt="Logo utpl">

            <div>
                <a href="/login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="return" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                    </svg>
                </a>
            </div>


        </nav>
        <a>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-moon-stars-fill toggle-dark-mode" viewBox="0 0 16 16">
                <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
                <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z" />
            </svg>
        </a>
    </header>
    <!-- -----------------------MENÚ DE NAVEGACIÓN -->

    <!-- Modal dos-->



    <div class="contenedor-sm">
        <h1>Recuperar contraseña</h1>
        <!-- ALERTAS  -->
        <?php
        include_once __DIR__ . "../../plantillas/alertas.php";
        ?>
        <!--ALERTAS -->

        <form action="/olvide" method="POST" class="formulario">
            <!-- -------------------------------------------------------------------------------- -->
            <div class="campo">
                <label for="nombreUsuario">Nombre:</label>
                <input type="text"
                 id="nombreUsuario" 
                 name="nombreUsuario" 
                 placeholder="Nombre con el que creaste la cuenta"
                 value="<?php echo s($usuario->nombre); ?>" />
                
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <!-- -------------------------------------------------------------------------------- -->
            <div class="campo">
                <label for="emailUsuario">Correo electrónico:</label>
                <input type="email" id="emailUsuario" name="emailUsuario" placeholder="Correo electrónico">
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="campo">
                <label for="telefonoUsuario">Télefono:</label>
                <input type="tel" id="telefonoUsuario" name="telefonoUsuario" placeholder="Télefono con el que creo la cuenta">
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="campo">
                <label for="nuevaContraseña">Nueva contraseña:</label>
                <input type="password" id="nuevaContraseña" name="nuevaContraseña">
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <input type="submit" class="boton" value="Recuperar contraseña">
        </form>
    </div>
</div>

<?php
$script = "
  <script src='build/js/app.js'></script>
";
?>