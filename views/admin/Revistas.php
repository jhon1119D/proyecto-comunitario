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






   <h1>Administrador de revistas</h1>

   <!-- Mensaje de aprendizaje del proyecto -->
   <div class="advertencia">
      <p>En esta página, puedes gestionar todas las revistas registradas. Utiliza el botón en la parte inferior para registrar una nueva revista. En la parte de abajo encontrarás una lista de todas las revistas registradas, donde puedes previsualizarlas, buscarlas, eliminarlas o editarlas según sea necesario.</p>
   </div>



   <!-- Boton para deslizar el formulario de registro -->
   <button id="mostrarFormulario" class="boton-añadir">
      Registrar una revista <span class="icono">+</span>
   </button>

   <?php
   include_once __DIR__ . "../../plantillas/alertas.php";
   ?>

   <div class="contenedor-sm hidden visible" id="formularioRevistas">

      <!-- -----------------------------INICIO FORMULARIO -->
      <form class="formulario" method="POST" action="/Revistas" enctype="multipart/form-data" id="formRegistro">
         <p class="descripcion-pagina">Formulario registro de revistas</p>


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
         <!-- ------------------------------------- -->

         <!-- ------------------------------------- -->


         <div class="campo">
            <label for="tipo_revista">Área:</label>
            <select id="tipo_revista" name="tipo_revista">
               <option value="" disabled <?php echo empty($revistas->tipo_revista) ? 'selected' : ''; ?>>--Elegir--</option>
               <option value="<?php echo s('Educación'); ?>" <?php echo $revistas->tipo_revista == 'Educación' ? 'selected' : ''; ?>>Educación</option>
               <option value="<?php echo s('E-learning'); ?>" <?php echo $revistas->tipo_revista == 'E-learning' ? 'selected' : ''; ?>>E-learning</option>
               <option value="<?php echo s('Tecnología'); ?>" <?php echo $revistas->tipo_revista == 'Tecnología' ? 'selected' : ''; ?>>Tecnología</option>
               <option value="<?php echo s('Redes de datos'); ?>" <?php echo $revistas->tipo_revista == 'redes de datos' ? 'selected' : ''; ?>>Redes de datos</option>
            </select>
         </div>
         <!-- ------------------------------------- -->

         <!-- ------------------------------------- -->

         <div class="campo">
            <label for="accesibilidad">Open access:</label>
            <select id="accesibilidad" name="accesibilidad">
               <option value="" disabled <?php echo empty($revistas->accesibilidad) ? 'selected' : ''; ?>>--Elegir--</option>
               <option value="<?php echo s('si'); ?>" <?php echo $revistas->accesibilidad == 'si' ? 'selected' : ''; ?>>Si</option>
               <option value="<?php echo s('no'); ?>" <?php echo $revistas->accesibilidad == 'no' ? 'selected' : ''; ?>>No</option>
            </select>
         </div>
         <!-- ------------------------------------- -->

         <!-- ------------------------------------- -->

         <div class="campo">
            <label for="archivo">Subir plantilla:</label>
            <input type="file" id="archivo" name="archivo" accept=".doc, .docx, .tex, .zip, .cls, .bib, .txt, .pdf">

         </div>
         <!-- -------------------------------------->

         <input type="submit" class="boton" value="Añadir revista">

      </form>
      <!-- -------------------------------------FIN FORMULARIO-->


   </div>

   <!-- -----------------------INICIO DE EN DONDE SE MUESTRA LA TABLA CON LOS DATOS -->
   <table class="borde">
      <h1 id="fucus1">Lista de Revistas</h1>

      <!-- -----------------------FILTRADOR DE DATOS -->
      <?php
      $form_action = '/buscar_revistas_admin';
      include_once __DIR__ . "/../plantillas/buscador_revistas.php";
      ?>
      <!-- -----------------------FILTRADOR DE DATOS -->

      <thead class="encabezado-datos">
         <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Enlace</th>
            <th>Open Source</th>
            <th>País</th>
            <th>Área</th>
            <th>Documento</th>
            <th>Actualizar</th>
         </tr>
      </thead>

      <tbody class="informacion-datos"> <?php foreach ($datos as $revista): ?>
            <tr>

               <td>
                  <?php echo s($revista->nombre); ?>
               </td>

               <td><?php echo s($revista->categoria); ?></td>

               <!-- -----------------------Enlace de la revista-->
               <td> <a href="<?php echo s($revista->enlace); ?>" target="_blank">
                     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="enlace" viewBox="0 0 16 16">
                        <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                     </svg>
                  </a>
               </td>
               <!-- -----------------------Fin enlace de la revista -->

               <td>
                  <?php echo s($revista->accesibilidad); ?>
               </td>

               <td>
                  <?php echo s($revista->pais); ?>
               </td>

               <td>
                  <?php echo s($revista->tipo_revista); ?>
               </td>

               <!-- -----------------------Enlace de descarga -->
               <td>
                  <?php if (!empty(trim($revista->documento_url))): ?>
                     <?php $documento_url = trim($revista->documento_url); ?>
                     <?php $extension = strtolower(pathinfo($documento_url, PATHINFO_EXTENSION)); ?>
                     <a href="documentos/revistas/<?php echo s($revista->documento_url); ?>" download>
                        <?php if ($extension === 'zip'): ?>
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="descargar-zip" viewBox="0 0 16 16">
                              <path d="M8.5 9.438V8.5h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243" />
                              <path d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m2.5 8.5v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1m1-5.5h-1v1h1v1h-1v1h1v1H9V6H8V5h1V4H8V3h1V2H8V1H6.5v1h1z" />
                           </svg>
                        <?php elseif ($extension === 'cls'|| $extension === 'bib'): ?>
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="descargar" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-2v-1h2a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.928 15.849v-3.337h1.136v-.662H0v.662h1.134v3.337zm4.689-3.999h-.894L4.9 13.289h-.035l-.832-1.439h-.932l1.228 1.983-1.24 2.016h.862l.853-1.415h.035l.85 1.415h.907l-1.253-1.992zm1.93.662v3.337h-.794v-3.337H6.619v-.662h3.064v.662H8.546Z" />
                           </svg>
                        <?php else: ?>
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="descargar" viewBox="0 0 16 16">
                              <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.485 6.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 9.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z" />
                           </svg>
                        <?php endif; ?>
                     </a>
                  <?php else: ?>
                     <!-- Mensaje cuando no hay archivo -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="eliminar" viewBox="0 0 16 16">
                        <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                     </svg>
                  <?php endif; ?>
                  <!-- Visualizar los documentos -->
                  <?php if (!empty(trim($revista->documento_url)) && $extension !== 'zip' && $extension !=='cls' && $extension !== 'bib'): ?>
                     <a href="#" onclick="onGetFile('documentos/revistas/<?php echo s($revista->documento_url); ?>'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="visualizar" viewBox="0 0 16 16">
                           <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                           <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg>
                     </a>
                     <!-- Modal -->
                     <div id="myModal" class="modal">
                        <div class="modal-content">
                           <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                           <div id="modal-contenedor"></div>
                        </div>
                     </div>
                  <?php endif; ?>
               </td>
               <!-- -----------------------Fin enlace de descarga -->

               <!-- ----------------------- actualizar datos eliminar/editar -->
               <td>
                  <a href="/editar?id=<?php echo $revista->id; ?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="editar" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                     </svg>
                  </a>

                  <a class="eliminar-E" href="/eliminar?id=<?php echo $revista->id; ?>" data-nombre="<?php echo s($revista->nombre); ?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="eliminar" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                     </svg>
                  </a>
               </td>
               <!-- -----------------------Fin actualizar datos eliminar/editar -->

            </tr>
         <?php endforeach; ?>
      </tbody>

   </table>

</div>

<?php
$script = "<script src='build/js/app.js'></script>";
?>