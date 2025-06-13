<div class="contenedor">


    <?php
    session_start();
    define('CORREO_ESPECIFICO', 'lenciso@utpl.edu.ec');

    $menu_links = ' 
    <li class="li__links">
    <a href="/Revistas" class="link">Revistas</a>
    </li> 
    <li class="li__links">
    <a href="/Eventos" class="link">Eventos</a>
    </li>';

    // Verificar si el correo del usuario coincide con el correo específico
    if (isset($_SESSION['email']) && $_SESSION['email'] === CORREO_ESPECIFICO) {
        $menu_links .= '
    <li class="li__links">
    <a href=""/actualizar_codigo" class="link">Administradores</a>
    </li>';
    }

    // Añadir el enlace "Salir" al final
    $menu_links .= '
    <li class="li__links">
    <a href="/logout" class="link--salir">Salir</a>
    </li>';

    include_once __DIR__ . "../../plantillas/Menu.php";
    ?>

    <h1>Actualizar evento</h1>
    <div class="contenedor-sm">

        <?php
        include_once __DIR__ . "../../plantillas/alertas.php";
        ?>


        <p class="descripcion-pagina">Registro del evento</p>
        <form class="formulario" method="POST" enctype="multipart/form-data">



            <div class="campo">
                <label for="titulo">Título:</label>
                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Título del evento"
                    value="<?php echo s($eventos->titulo); ?>" />
            </div>
            <!-- ------------------------------------- -->
            <div class="campo">
                <label for="acronimo">Acrónimo:</label>
                <input
                    type="text"
                    id="acronimo"
                    name="acronimo"
                    placeholder="Acrónimo"
                    value="<?php echo s($eventos->acronimo); ?>" />
            </div>


            <div class="campo">
                <label for="ranking">Ranking:</label>
                <select id="ranking" name="ranking">
                    <option value="" disabled <?php echo empty($eventos->ranking) ? 'selected' : ''; ?>>--Elegir ranking--</option>
                    <option value="<?php echo s('A*'); ?>" <?php echo $eventos->ranking == 'A*' ? 'selected' : ''; ?>>A*</option>
                    <option value="<?php echo s('A'); ?>" <?php echo $eventos->ranking == 'A' ? 'selected' : ''; ?>>A</option>
                    <option value="<?php echo s('B'); ?>" <?php echo $eventos->ranking == 'B' ? 'selected' : ''; ?>>B</option>
                    <option value="<?php echo s('C'); ?>" <?php echo $eventos->ranking == 'C' ? 'selected' : ''; ?>>C</option>
                    <option value="<?php echo s('Unranked'); ?>" <?php echo $eventos->ranking == 'Unranked' ? 'selected' : ''; ?>>Unranked</option>
                </select>
            </div>

            <div class="campo">
                <label for="enlace">Enlace:</label>
                <input
                    type="enlace"
                    id="enlace"
                    name="enlace"
                    placeholder="Enlace de evento"
                    value="<?php echo s($eventos->enlace); ?>" />
            </div>
            <!-- ------------------------------------- -->


            <fieldset>
                <legend>Fechas Importantes</legend>

                <div class="campo">
                    <label for="fecha">Fecha subida:</label>
                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        value="<?php echo s($eventos->fecha); ?>" />
                </div>

                <div class="campo">
                    <label for="fechaAcep">Fecha aceptación:</label>

                    <?php if ($eventos->fechaAcep == '1111-11-11'): ?>

                        <input
                            type="date"
                            id="fechaAcep"
                            name="fechaAcep"
                            value="" />
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="descargar-zip" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>

                    <?php else: ?>
                        <input
                            type="date"
                            id="fechaAcep"
                            name="fechaAcep"
                            value="<?php echo s($eventos->fechaAcep); ?>" />
                    <?php endif; ?>

                </div>
                <div class="campo">
                    <label for="fecha_registro">Fecha registro:</label>

                    <?php if ($eventos->fecha_registro == '1111-11-11'): ?>

                        <input
                            type="date"
                            id="fecha_registro"
                            name="fecha_registro"
                            value="" />
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="descargar-zip" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>

                    <?php else: ?>
                        <input
                            type="date"
                            id="fecha_registro"
                            name="fecha_registro"
                            value="<?php echo s($eventos->fecha_registro); ?>" />
                    <?php endif; ?>

                </div>
            </fieldset>

            <div class="campo">
                <label for="archivo">Subir plantilla:</label>
                <input type="file" id="archivo" name="archivo" accept=".doc, .docx, .tex, .zip, .cls, .bib, .txt">
            </div>
            <input type="submit" class="boton" value="Actualizar evento">

    </div>





    </form>
</div>