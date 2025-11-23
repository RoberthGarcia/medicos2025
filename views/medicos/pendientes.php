<h2>Médicos Pendientes de Aprobación</h2>

<?php 
    if(isset($_GET['resultado'])) {
        $resultado = $_GET['resultado'];
        if($resultado == 1) { ?>
            <p class="alerta exito">Médico aprobado correctamente</p>
        <?php } else if($resultado == 2) { ?>
            <p class="alerta error">Médico rechazado</p>
        <?php }
    }
?>

<a href="/medicos/admin" class="boton-verde">Ver todos los médicos</a>

<?php if(empty($medicos)): ?>
    <p class="alerta">No hay médicos pendientes de aprobación</p>
<?php else: ?>

<table class="tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Cédula</th>
            <th>Universidad</th>
            <th>Email Verificado</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($medicos as $medico): ?>
            <tr>
                <td><?php echo $medico->id_medico; ?></td>
                <td><?php echo $medico->nombre . " " . $medico->apellido; ?></td>
                <td><?php echo $medico->email; ?></td>
                <td><?php echo $medico->cedula_profesional; ?></td>
                <td><?php echo $medico->universidad; ?></td>
                <td>
                    <?php if($medico->email_verificado): ?>
                        <span class="badge-success">✓ Verificado</span>
                    <?php else: ?>
                        <span class="badge-warning">✗ Pendiente</span>
                    <?php endif; ?>
                </td>
                <td><?php echo $medico->fecha_registro; ?></td>
                <td>
                    <div class="acciones-tabla">
                        <form method="POST" action="/medicos/aprobar" class="formulario-inline">
                            <input type="hidden" name="id" value="<?php echo $medico->id_medico; ?>">
                            <input type="submit" class="boton-verde-block" value="✓ Aprobar">
                        </form>
                        
                        <form method="POST" action="/medicos/rechazar" class="formulario-inline">
                            <input type="hidden" name="id" value="<?php echo $medico->id_medico; ?>">
                            <input type="submit" class="boton-rojo-block" value="✗ Rechazar" 
                                onclick="return confirm('¿Estás seguro de rechazar este médico?');">
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

<style>
.badge-success {
    background-color: #28a745;
    color: white;
    padding: 0.3rem 0.6rem;
    border-radius: 0.3rem;
    font-size: 0.85rem;
}

.badge-warning {
    background-color: #ffc107;
    color: #000;
    padding: 0.3rem 0.6rem;
    border-radius: 0.3rem;
    font-size: 0.85rem;
}

.acciones-tabla {
    display: flex;
    gap: 0.5rem;
    flex-direction: column;
}

.formulario-inline {
    margin: 0;
}

.boton-verde-block,
.boton-rojo-block {
    width: 100%;
    padding: 0.5rem;
    font-size: 0.9rem;
}
</style>
