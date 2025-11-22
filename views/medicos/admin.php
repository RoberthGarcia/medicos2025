
<h2>Medicos</h2>

<?php 
    if($resultado) {            
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php }       
    }
?>

<a href="/medicos/crear" class="boton-verde">Alta Medico</a>  

<table class="tabla">     
    <thead>
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>Imagen</th>
            <th>Lugar</th>
            <th>Acciones</th>                                  
        </tr>                
    </thead>
    <tbody>
        <?php foreach($medicos as $medico ):  ?>
            <tr>
                <td><?php echo $medico->id_medico; ?></td>
                <td><?php echo $medico->nombre ." " . $medico->apellido ; ?></td>
                <td><img src="/imagenes/<?php echo $medico->imagen; ?>" class="imagen-tabla"></td>
                <td><?php echo $medico->fecha_registro; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/medicos/eliminar">
                        <input type="hidden" name="id" value="<?php echo $medico->id_medico; ?>">
                        <input type="hidden" name="tipo" value="evento">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/medicos/actualizar?id=<?php echo $medico->id_medico; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>             
