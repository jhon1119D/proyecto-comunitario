<div class="contenedor-buscador">

    <form class="form-buscador" method="POST" action="<?php echo $form_action; ?>">


        <div class="campos">
            <label for="titulo">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                placeholder="Título del evento"
                value="<?php echo s($eventos->titulo); ?>" />
        </div>
        <!-- ------------------------------------- -->

        <div class="campos">
            <label for="acronimo">Acrónimo:</label>
            <input
                type="text"
                id="acronimo"
                name="acronimo"
                placeholder="Acrónimo"
                value="<?php echo s($eventos->acronimo); ?>" />
        </div>


        <div class="campos">
            <label for="ranking">Ranking:</label>
            <select id="ranking" name="ranking">
                <option value="" disabled <?php echo empty($eventos->ranking) ? 'selected' : ''; ?>>--Elegir ranking--</option>
                <option value="<?php echo s('A*'); ?>" <?php echo $eventos->ranking == 'A*' ? 'selected' : ''; ?>>A*</option>
                <option value="<?php echo s('A'); ?>" <?php echo $eventos->ranking =='A' ? 'selected' : ''; ?>>A</option>
                <option value="<?php echo s('B'); ?>" <?php echo $eventos->ranking =='B' ? 'selected' : ''; ?>>B</option>
                <option value="<?php echo s('C'); ?>" <?php echo $eventos->ranking =='C' ? 'selected' : ''; ?>>C</option>
                <option value="<?php echo s('Unranked'); ?>" <?php echo $eventos->ranking === 'Unranqued' ? 'selected' : ''; ?>>Unranked</option>
            </select>
        </div>

        <div class="campos">
            <label for="fecha">Fecha subida:</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo s($eventos->fecha); ?>" />
        </div>
        <!-- ------------------------------------- -->


        <button type="submit" name="reset" class="boton">Mostrar todos</button>
        <input type="submit" class="boton" value="buscar">

    </form>
</div>

</div>

<?php
$script = "
  <script src='build/js/app.js'></script>
";
?>