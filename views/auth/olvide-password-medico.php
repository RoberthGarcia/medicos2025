<h1 class="nombre-pagina">Olvidé mi Password - Médicos</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/medicos/olvide" class="formulario" method="POST">
    <div class="campo">
       <label for="email">Email</label>
       <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu email profesional"
            required
       /> 
    </div>
    
    <input type="submit" class="boton" value="Enviar instrucciones">
</form>

<div class="acciones">
    <a href="/medicos/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/medicos/registro">¿Aún no tienes una cuenta? Regístrate</a>
    <a href="/">Volver al inicio</a>
</div>
