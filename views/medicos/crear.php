    <div class="contenedor">
        <div class="header-formulario">
            <h1>📋 Registro de Médicos</h1>
            <p>Complete el formulario para crear su cuenta profesional</p>
        </div>

        <div class="form-container">
            <form id="formularioMedico">
                <!-- Información Personal -->
                <div class="section-title">👤 Información Personal</div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" id="nombre" name="nombre" required>
                        <span class="error-message">Este campo es requerido</span>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido <span class="required">*</span></label>
                        <input type="text" id="apellido" name="apellido" required>
                        <span class="error-message">Este campo es requerido</span>
                    </div>
                   
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono">
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="tel" id="celular" name="celular">
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
                    </div>

                    <div class="form-group">
                        <label for="genero">Género</label>
                        <select id="genero" name="genero">
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>

                <!-- Foto de Perfil -->
                <div class="section-title">📸 Foto de Perfil</div>
                <div class="form-grid full">
                    <div class="form-group">
                        <label for="foto_perfil">Seleccionar Foto</label>
                        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
                        <span class="info-box">Formatos aceptados: JPG, PNG. Tamaño máximo: 5MB</span>
                    </div>
                </div>

                <!-- Información Profesional -->
                <div class="section-title">🎓 Información Profesional</div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cedula_profesional">Cédula Profesional <span class="required">*</span></label>
                        <input type="text" id="cedula_profesional" name="cedula_profesional" required>
                        <span class="error-message">Este campo es requerido</span>
                    </div>

                    <div class="form-group">
                        <label for="universidad">Universidad</label>
                        <input type="text" id="universidad" name="universidad">
                    </div>

                    <div class="form-group">
                        <label for="anio_graduacion">Año de Graduación</label>
                        <input type="text" id="anio_graduacion" name="anio_graduacion" placeholder="YYYY">
                    </div>
                </div>

                <div class="form-grid full">
                    <div class="form-group">
                        <label for="biografia">Biografía / Descripción Profesional</label>
                        <textarea id="biografia" name="biografia" placeholder="Cuéntenos sobre su experiencia profesional..."></textarea>
                    </div>
                </div>

                <!-- Preferencias de Consulta -->
                <div class="section-title">💻 Preferencias de Consulta</div>
                
                <div class="form-grid full">
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="permite_telemedicina" name="permite_telemedicina">
                            <label for="permite_telemedicina" class="checkbox-label">Permitir consultas por telemedicina</label>
                        </div>
                    </div>
                </div>

                <!-- Plan de Suscripción -->
                <div class="section-title">💳 Plan de Suscripción</div>
                
                <div class="form-grid full">
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="plan_basico" name="plan_suscripcion" value="basico" checked>
                            <label for="plan_basico" class="radio-label">Plan Básico (Gratuito)</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="plan_premium" name="plan_suscripcion" value="premium">
                            <label for="plan_premium" class="radio-label">Plan Premium ($9.99/mes)</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="plan_platino" name="plan_suscripcion" value="platino">
                            <label for="plan_platino" class="radio-label">Plan Platino ($19.99/mes)</label>
                        </div>
                    </div>
                </div>

                <!-- Fechas de Plan -->
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fecha_inicio_plan">Fecha de Inicio del Plan</label>
                        <input type="date" id="fecha_inicio_plan" name="fecha_inicio_plan">
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin_plan">Fecha de Fin del Plan</label>
                        <input type="date" id="fecha_fin_plan" name="fecha_fin_plan">
                    </div>
                </div>

                <!-- Términos -->
                <div class="form-grid full" style="margin-top: 30px;">
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="terminos" name="terminos" required>
                            <label for="terminos" class="checkbox-label">Acepto los términos y condiciones <span class="required">*</span></label>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="button-group">
                    <button type="reset" class="btn-secondary">Regresar</button>
                    <button type="submit" class="btn-primary">Registrarse</button>
                </div>
            </form>
        </div>
    </div>