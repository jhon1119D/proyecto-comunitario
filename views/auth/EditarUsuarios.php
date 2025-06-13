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
    <a <a href="/actualizar_codigo" class="advertencia" style="background-color: #ff6666; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; float: right; margin-top: 20px;">Código de Registro</a>







    <h1>Administrador de usuarios</h1>


    <div class="advertencia">
        <p>En esta página, encontrarás la información de los administradores registrados. Aquí puedes gestionar sus datos y, si es necesario, eliminar a un administrador para revocar su acceso al sistema. Esta funcionalidad asegura que solo los usuarios autorizados puedan ingresar y mantener la seguridad de la plataforma.</p>
    </div>



    <?php
    session_start();
    if (isset($_SESSION['mensaje_delete_user'])) {
        echo "<div class='alerta exito'>" . $_SESSION['mensaje_delete_user'] . "</div>";
        unset($_SESSION['mensaje_delete_user']);
    }
    ?>





    <table class="borde">
        <h1>Lista de administradores</h1>



        <?php
        include_once __DIR__ . "../../plantillas/alertas.php";
        ?>

        <thead class="encabezado-datos">
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Eliminar</th>

            </tr>
        </thead>
        <tbody class="informacion-datos"> <?php foreach ($administradores as $admin): ?>
                <tr>
                    <td><?php echo s($admin->nombre); ?></td>

                    <td><?php echo s($admin->email); ?></td>
                    <td><?php echo s($admin->contrasena); ?></td>
                    <td><?php echo s($admin->apellido); ?></td>
                    <td><?php echo s($admin->telefono); ?></td>




                    <td>
                        <a class="eliminar-E" href="/eliminarUsuario?id=<?php echo $admin->id; ?>" data-nombre="<?php echo s($admin->nombre); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="eliminar" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>


    </table>

</div>
<?php
$script = "
  <script src='build/js/app.js'></script>
";
?>