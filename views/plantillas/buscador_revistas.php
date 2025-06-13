<div class="contenedor-buscador" >
    <form class="form-buscador" method="POST" action="<?php echo $form_action; ?>">


        <!-- ----------------------------- -->
        <div class="campos">
            <label for="nombre">Nombre:</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Nombre de la revista"
                value="<?php echo s($revistas->nombre); ?>" />
        </div>
        <!-- ------------------------------------- -->

        <!-- ------------------------------ -->

        <div class="campos">
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria">
                <option value="" disabled <?php echo empty($revistas->categoria) ? 'selected' : ''; ?>>--Elegir categoría--</option>
                <option value="<?php echo s('Q1'); ?>" <?php echo $revistas->categoria == 'Q1' ? 'selected' : ''; ?>>Q1</option>
                <option value="<?php echo s('Q2'); ?>" <?php echo $revistas->categoria == 'Q2' ? 'selected' : ''; ?>>Q2</option>
                <option value="<?php echo s('Q3'); ?>" <?php echo $revistas->categoria == 'Q3' ? 'selected' : ''; ?>>Q3</option>
                <option value="<?php echo s('Q4'); ?>" <?php echo $revistas->categoria == 'Q4' ? 'selected' : ''; ?>>Q4</option>
            </select>
        </div>

        <!-- --------------------------------- -->

        <div class="campos">
            <label for="pais">País:</label>
            <select id="pais" name="pais">
                <option value="" disabled <?php echo empty($revistas->pais) ? 'selected' : ''; ?>>--Elegir país--</option>
                <?php
                $paises = paises();
                foreach ($paises as $pais): ?>
                    <option value="<?php echo s($pais); ?>" <?php echo $revistas->pais == $pais ? 'selected' : ''; ?>>
                        <?php echo s($pais); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="campos">
            <label for="tipo_revista">Área:</label>
            <select id="tipo_revista" name="tipo_revista">
                <option value="" disabled <?php echo empty($revistas->tipo_revista) ? 'selected' : ''; ?>>--Elegir--</option>
                <option value="<?php echo s('Educación'); ?>" <?php echo $revistas->tipo_revista == 'Educación' ? 'selected' : ''; ?>>Educación</option>
                <option value="<?php echo s('E-learning'); ?>" <?php echo $revistas->tipo_revista == 'E-learning' ? 'selected' : ''; ?>>E-learning</option>
                <option value="<?php echo s('Tecnología'); ?>" <?php echo $revistas->tipo_revista == 'Tecnología' ? 'selected' : ''; ?>>Tecnología</option>
                <option value="<?php echo s('Redes de datos'); ?>" <?php echo $revistas->tipo_revista == 'Redes de datos' ? 'selected' : ''; ?>>Redes de datos</option>
            </select>
        </div>

        <div class="campos">
            <label for="accesibilidad">Open access:</label>
            <select id="accesibilidad" name="accesibilidad">
                <option value="" disabled <?php echo empty($revistas->accesibilidad) ? 'selected' : ''; ?>>--Elegir--</option>
                <option value="<?php echo s('si'); ?>" <?php echo $revistas->accesibilidad == 'si' ? 'selected' : ''; ?>>Revistas open access</option>
            </select>
        </div>

        <button  type="submit" name="reset" class="boton">Mostrar todas</button>
        <input  type="submit" class="boton" value="buscar" >

    </form>

</div>

<?php
$script = "
  <script src='build/js/app.js'></script>
";
?>