<?php
foreach ($alertas as $key => $mensajes):

    foreach ($mensajes as $mensaje):

?>
        <div id="alerta" class="alerta <?php echo $key; ?>">

            <?php echo $mensaje; ?>

        </div>

<?php

    endforeach;

endforeach;
?>