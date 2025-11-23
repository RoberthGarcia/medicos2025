<h1 class="nombre-pagina">Login - Médicos</h1>
<p class="descripcion-pagina">Inicia sesión con tu cuenta profesional</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/medicos/login" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
            value="<?php echo s($auth->email ?? ''); ?>"
            required
        />
    </div>
    
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password"
            required
        />
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/medicos/registro">¿Aún no tienes una cuenta? Regístrate como médico</a>
    <a href="/medicos/olvide">¿Olvidaste tu password?</a>
    <a href="/">Volver al inicio</a>
</div>
