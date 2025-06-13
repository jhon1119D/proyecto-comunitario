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
    <a href="/actualizar_codigo" class="link">Administradores</a>
    </li>';
   }

   // Añadir el enlace "Salir" al final
   $menu_links .= '
    <li class="li__links">
    <a href="/logout" class="link--salir">Salir</a>
    </li>';

   include_once __DIR__ . "../../plantillas/Menu.php";
   ?>
   <h1>Actualizar revista</h1>
   <div class="contenedor-sm">


      <?php
      include_once __DIR__ . "../../plantillas/alertas.php";
      ?>

      <p class="descripcion-pagina">Registro de la revista:</p>
      <form class="formulario" method="POST" enctype="multipart/form-data">


         <!-- ----------------------------- -->
         <div class="campo">
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

         <div class="campo">
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

         <!-- --------------------------------- -->

         <div class="campo">
            <label for="enlace">Enlace:</label>
            <input
               type="enlace"
               id="enlace"
               name="enlace"
               placeholder="Enlace de revista"
               value="<?php echo s($revistas->enlace); ?>" />
         </div>
         <!-- ------------------------------------- -->

         <div class="campo">
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


         <div class="campo">
            <label for="tipo_revista">Area:</label>
            <select id="tipo_revista" name="tipo_revista">
               <option value="" disabled <?php echo empty($revistas->tipo_revista) ? 'selected' : ''; ?>>--Elegir--</option>
               <option value="<?php echo s('Educación'); ?>" <?php echo $revistas->tipo_revista == 'Educación' ? 'selected' : ''; ?>>Educación</option>
               <option value="<?php echo s('E-learning'); ?>" <?php echo $revistas->tipo_revista == 'E-learning' ? 'selected' : ''; ?>>E-learning</option>
               <option value="<?php echo s('Tecnología'); ?>" <?php echo $revistas->tipo_revista == 'Tecnología' ? 'selected' : ''; ?>>Tecnología</option>
               <option value="<?php echo s('Redes de datos'); ?>" <?php echo $revistas->tipo_revista == 'Redes de datos' ? 'selected' : ''; ?>>Redes de datos</option>
            </select>
         </div>

         <div class="campo">
            <label for="accesibilidad">Open access:</label>
            <select id="accesibilidad" name="accesibilidad">
               <option value="" disabled <?php echo empty($revistas->accesibilidad) ? 'selected' : ''; ?>>--Elegir--</option>
               <option value="<?php echo s('si'); ?>" <?php echo $revistas->accesibilidad == 'si' ? 'selected' : ''; ?>>Si</option>
               <option value="<?php echo s('no'); ?>" <?php echo $revistas->accesibilidad == 'no' ? 'selected' : ''; ?>>No</option>
            </select>
         </div>

         <div class="campo">
            <label for="archivo">Subir plantilla:</label>
            <input type="file" id="archivo" name="archivo" accept=".doc, .docx, .tex, .zip, .cls, .bib, .txt, .pdf">
         </div>

         <input type="submit" class="boton" value="Actualizar revista">

      </form>


   </div>

</div>