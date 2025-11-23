<fieldset>
    <legend>Información Personal</legend>

    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input 
            type="text" 
            id="nombre" 
            name="nombre" 
            placeholder="Nombre del Médico"
            value="<?php echo s($medico->nombre); ?>"
            required
        >
    </div>

    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input 
            type="text" 
            id="apellido" 
            name="apellido" 
            placeholder="Apellido del Médico"
            value="<?php echo s($medico->apellido); ?>"
            required
        >
    </div>

    <div class="campo">
        <label for="email">Email:</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="correo@ejemplo.com"
            value="<?php echo s($medico->email); ?>"
            required
        >
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="<?php echo $medico->id_medico ? 'Dejar en blanco para no cambiar' : 'Contraseña del médico'; ?>"
        >
        <?php if($medico->id_medico): ?>
            <small>Dejar en blanco si no desea cambiar la contraseña</small>
        <?php endif; ?>
    </div>

    <div class="campo">
        <label for="telefono">Teléfono:</label>
        <input 
            type="tel" 
            id="telefono" 
            name="telefono" 
            placeholder="(55) 1234-5678"
            value="<?php echo s($medico->telefono); ?>"
        >
    </div>

    <div class="campo">
        <label for="celular">Celular:</label>
        <input 
            type="tel" 
            id="celular" 
            name="celular" 
            placeholder="(55) 9876-5432"
            value="<?php echo s($medico->celular); ?>"
        >
    </div>

    <div class="campo">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input 
            type="date" 
            id="fecha_nacimiento" 
            name="fecha_nacimiento" 
            value="<?php echo s($medico->fecha_nacimiento); ?>"
        >
    </div>

    <div class="campo">
        <label for="genero">Género:</label>
        <select id="genero" name="genero">
            <option value="" disabled>-- Seleccione --</option>
            <option value="masculino" <?php echo $medico->genero === 'masculino' ? 'selected' : ''; ?>>Masculino</option>
            <option value="femenino" <?php echo $medico->genero === 'femenino' ? 'selected' : ''; ?>>Femenino</option>
            <option value="otro" <?php echo $medico->genero === 'otro' ? 'selected' : ''; ?>>Otro</option>
        </select>
    </div>
</fieldset>

<fieldset>
    <legend>Información Profesional</legend>

    <div class="campo">
        <label for="cedula_profesional">Cédula Profesional:</label>
        <input 
            type="text" 
            id="cedula_profesional" 
            name="cedula_profesional" 
            placeholder="Número de cédula profesional"
            value="<?php echo s($medico->cedula_profesional); ?>"
            required
        >
    </div>

    <div class="campo">
        <label for="universidad">Universidad:</label>
        <input 
            type="text" 
            id="universidad" 
            name="universidad" 
            placeholder="Universidad de egreso"
            value="<?php echo s($medico->universidad); ?>"
        >
    </div>

    <div class="campo">
        <label for="anio_graduacion">Año de Graduación:</label>
        <input 
            type="number" 
            id="anio_graduacion" 
            name="anio_graduacion" 
            placeholder="2020"
            min="1950"
            max="<?php echo date('Y'); ?>"
            value="<?php echo s($medico->anio_graduacion); ?>"
        >
    </div>

    <div class="campo">
        <label for="biografia">Biografía:</label>
        <textarea 
            id="biografia" 
            name="biografia" 
            placeholder="Descripción profesional del médico..."
            rows="5"
        ><?php echo s($medico->biografia); ?></textarea>
    </div>

    <div class="campo">
        <label for="foto_perfil">Foto de Perfil:</label>
        <input 
            type="file" 
            id="foto_perfil" 
            name="foto_perfil"
            accept="image/jpeg, image/png, image/jpg"
        >
        <?php if($medico->foto_perfil): ?>
            <div class="imagen-preview">
                <img src="/imagenes/<?php echo $medico->foto_perfil; ?>" alt="Foto actual">
                <p>Foto actual</p>
            </div>
        <?php endif; ?>
    </div>
</fieldset>

<fieldset>
    <legend>Estado de la Cuenta</legend>

    <div class="campo-checkbox">
        <label for="email_verificado">
            <input 
                type="checkbox" 
                id="email_verificado" 
                name="email_verificado" 
                value="1"
                <?php echo $medico->email_verificado ? 'checked' : ''; ?>
            >
            Email Verificado
        </label>
    </div>

    <div class="campo-checkbox">
        <label for="perfil_verificado">
            <input 
                type="checkbox" 
                id="perfil_verificado" 
                name="perfil_verificado" 
                value="1"
                <?php echo $medico->perfil_verificado ? 'checked' : ''; ?>
            >
            Perfil Verificado
        </label>
    </div>

    <div class="campo-checkbox">
        <label for="activo">
            <input 
                type="checkbox" 
                id="activo" 
                name="activo" 
                value="1"
                <?php echo $medico->activo ? 'checked' : ''; ?>
            >
            Cuenta Activa
        </label>
    </div>

    <div class="campo-checkbox">
        <label for="destacado">
            <input 
                type="checkbox" 
                id="destacado" 
                name="destacado" 
                value="1"
                <?php echo $medico->destacado ? 'checked' : ''; ?>
            >
            Perfil Destacado
        </label>
    </div>

    <div class="campo-checkbox">
        <label for="permite_telemedicina">
            <input 
                type="checkbox" 
                id="permite_telemedicina" 
                name="permite_telemedicina" 
                value="1"
                <?php echo $medico->permite_telemedicina ? 'checked' : ''; ?>
            >
            Permite Telemedicina
        </label>
    </div>
</fieldset>

<fieldset>
    <legend>Plan de Suscripción</legend>

    <div class="campo">
        <label for="plan_suscripcion">Plan:</label>
        <select id="plan_suscripcion" name="plan_suscripcion">
            <option value="basico" <?php echo $medico->plan_suscripcion === 'basico' ? 'selected' : ''; ?>>Básico</option>
            <option value="premium" <?php echo $medico->plan_suscripcion === 'premium' ? 'selected' : ''; ?>>Premium</option>
            <option value="platino" <?php echo $medico->plan_suscripcion === 'platino' ? 'selected' : ''; ?>>Platino</option>
        </select>
    </div>

    <div class="campo">
        <label for="fecha_inicio_plan">Fecha Inicio Plan:</label>
        <input 
            type="date" 
            id="fecha_inicio_plan" 
            name="fecha_inicio_plan" 
            value="<?php echo s($medico->fecha_inicio_plan); ?>"
        >
    </div>

    <div class="campo">
        <label for="fecha_fin_plan">Fecha Fin Plan:</label>
        <input 
            type="date" 
            id="fecha_fin_plan" 
            name="fecha_fin_plan" 
            value="<?php echo s($medico->fecha_fin_plan); ?>"
        >
    </div>
</fieldset>
