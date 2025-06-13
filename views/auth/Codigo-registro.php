<div class="contenedor">
    <?php
    session_start();

    $menu_links = ' 
<li class="li__links">
<a href="/Revistas" class="link">Revistas</a>
</li> 
<li class="li__links">
<a href="/Eventos" class="link">Eventos</a>
</li>';

    // Verificar si el correo del usuario coincide con el correo específico
    if (isset($_SESSION['email']) && $_SESSION['email'] === 'lenciso@utpl.edu.ec') {
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


   

    <h1>Código para registro de administradores</h1>

    <div class="advertencia">
        <p>En esta página, puedes generar y actualizar un código secreto que los nuevos interesados en registrarse como administradores deben ingresar. Este código se puede cambiar según sea necesario para asegurar que solo los usuarios autorizados puedan registrarse y mantener la seguridad de la plataforma.</p>
    </div>


    <div class="contenedor-sm">
        <p class="advertencia">El código actual es: <strong class="eliminar"><?php echo s($codigo); ?></strong>

        <form method="POST" action="/actualizar_codigo" class="formulario">
            <div class="campo">
                <label for="nuevoCodigo">Nuevo Código Secreto:</label>
                <input
                    type="text"
                    id="nuevoCodigo"
                    name="nuevoCodigo"
                    value="<?php echo s($codigo); ?>" />

            </div>
            <input type="submit" class="boton eliminar" value="Cambiar código">



        </form>


    </div>
</div>