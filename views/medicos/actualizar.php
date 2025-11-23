<h1>Actualizar Médico</h1>
<p>Modifica la información del médico</p>

<a href="/admin/medicos" class="boton boton-verde">Volver a Médicos</a>

<?php 
    foreach($alertas as $key => $mensajes) {
        foreach($mensajes as $mensaje) {
?>
            <div class="alerta <?php echo $key; ?>">
                <?php echo $mensaje; ?>
            </div>
<?php
        }
    }
?>

<form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include __DIR__ . '/formulario_medico.php'; ?>

    <input type="submit" value="Actualizar Médico" class="boton boton-verde">
</form>
