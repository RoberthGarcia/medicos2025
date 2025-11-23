<h1 class="nombre-pagina">Registro de Médicos</h1>
<p class="descripcion-pagina">Crea tu cuenta profesional en nuestro directorio médico</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/medicos/registro">
    <!-- Información Personal -->
    <fieldset>
        <legend>Información Personal</legend>
        
        <div class="campo">
            <label for="nombre">Nombre <span class="obligatorio">*</span></label>
            <input 
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Tu nombre"
                value="<?php echo s($medico->nombre); ?>"
                required
            />
        </div>

        <div class="campo">
            <label for="apellido">Apellido <span class="obligatorio">*</span></label>
            <input 
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Tu apellido"
                value="<?php echo s($medico->apellido); ?>"
                required
            />
        </div>

        <div class="campo">
            <label for="email">Email <span class="obligatorio">*</span></label>
            <input 
                type="email"
                id="email"
                name="email"
                placeholder="Tu email profesional"
                value="<?php echo s($medico->email); ?>"
                required
            />
        </div>

        <div class="campo">
            <label for="password">Password <span class="obligatorio">*</span></label>
            <input 
                type="password"
                id="password"
                name="password"
                placeholder="Mínimo 6 caracteres"
                required
            />
        </div>

        <div class="campo">
            <label for="telefono">Teléfono <span class="obligatorio">*</span></label>
            <input 
                type="tel"
                id="telefono"
                name="telefono"
                placeholder="Tu teléfono"
                value="<?php echo s($medico->telefono); ?>"
                required
            />
        </div>

        <div class="campo">
            <label for="celular">Celular</label>
            <input 
                type="tel"
                id="celular"
                name="celular"
                placeholder="Tu celular"
                value="<?php echo s($medico->celular); ?>"
            />
        </div>
    </fieldset>

    <!-- Información Profesional -->
    <fieldset>
        <legend>Información Profesional</legend>
        
        <div class="campo">
            <label for="cedula_profesional">Cédula Profesional <span class="obligatorio">*</span></label>
            <input 
                type="text"
                id="cedula_profesional"
                name="cedula_profesional"
                placeholder="Número de cédula profesional"
                value="<?php echo s($medico->cedula_profesional); ?>"
                required
            />
        </div>

        <div class="campo">
            <label for="universidad">Universidad</label>
            <input 
                type="text"
                id="universidad"
                name="universidad"
                placeholder="Universidad de egreso"
                value="<?php echo s($medico->universidad); ?>"
            />
        </div>

        <div class="campo">
            <label for="anio_graduacion">Año de Graduación</label>
            <input 
                type="number"
                id="anio_graduacion"
                name="anio_graduacion"
                placeholder="YYYY"
                min="1950"
                max="<?php echo date('Y'); ?>"
                value="<?php echo s($medico->anio_graduacion); ?>"
            />
        </div>

        <div class="campo">
            <label for="biografia">Biografía / Descripción Profesional</label>
            <textarea 
                id="biografia"
                name="biografia"
                placeholder="Cuéntanos sobre tu experiencia profesional..."
                rows="5"
            ><?php echo s($medico->biografia); ?></textarea>
        </div>
    </fieldset>

    <!-- Opciones Adicionales -->
    <fieldset>
        <legend>Preferencias</legend>
        
        <div class="campo-checkbox">
            <input 
                type="checkbox"
                id="permite_telemedicina"
                name="permite_telemedicina"
                value="1"
            />
            <label for="permite_telemedicina">Permitir consultas por telemedicina</label>
        </div>
    </fieldset>

    <p class="nota-importante">
        <strong>Nota:</strong> Al registrarte, tu perfil será revisado y aprobado por nuestro equipo administrativo antes de ser publicado en el directorio.
    </p>

    <input type="submit" value="Crear Cuenta Profesional" class="boton">
</form>

<div class="acciones">
    <a href="/medicos/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/">Ir al inicio</a>
</div>

<style>
fieldset {
    border: 1px solid #e1e1e1;
    padding: 2rem;
    margin: 2rem 0;
    border-radius: 1rem;
}

legend {
    font-weight: 700;
    padding: 0 1rem;
    color: #0D2C54;
}

.obligatorio {
    color: red;
}

.campo-checkbox {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.campo-checkbox input[type="checkbox"] {
    width: auto;
}

.nota-importante {
    background-color: #FFF3CD;
    border: 1px solid #FFE69C;
    padding: 1.5rem;
    border-radius: 0.5rem;
    margin: 2rem 0;
}
</style>
