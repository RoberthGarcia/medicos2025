-- =============================================
-- BASE DE DATOS: DIRECTORIO MÉDICO
-- =============================================

-- Tabla de Países
CREATE TABLE paises (
    id_pais INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    codigo_iso CHAR(2) NOT NULL UNIQUE,
    codigo_telefono VARCHAR(5),
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Estados/Provincias
CREATE TABLE estados (
    id_estado INT PRIMARY KEY AUTO_INCREMENT,
    id_pais INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    codigo VARCHAR(10),
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_pais) REFERENCES paises(id_pais) ON DELETE CASCADE
);

-- Tabla de Ciudades
CREATE TABLE ciudades (
    id_ciudad INT PRIMARY KEY AUTO_INCREMENT,
    id_estado INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    codigo_postal VARCHAR(10),
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_estado) REFERENCES estados(id_estado) ON DELETE CASCADE
);

-- Tabla de Especialidades Médicas
CREATE TABLE especialidades (
    id_especialidad INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT,
    icono VARCHAR(100),
    activo BOOLEAN DEFAULT TRUE,
    orden INT DEFAULT 0,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Subespecialidades
CREATE TABLE subespecialidades (
    id_subespecialidad INT PRIMARY KEY AUTO_INCREMENT,
    id_especialidad INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_especialidad) REFERENCES especialidades(id_especialidad) ON DELETE CASCADE
);

-- Tabla de Seguros Médicos
CREATE TABLE seguros_medicos (
    id_seguro INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    telefono VARCHAR(20),
    email VARCHAR(100),
    sitio_web VARCHAR(200),
    logo VARCHAR(200),
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Planes de Seguros
CREATE TABLE planes_seguros (
    id_plan INT PRIMARY KEY AUTO_INCREMENT,
    id_seguro INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_seguro) REFERENCES seguros_medicos(id_seguro) ON DELETE CASCADE
);

-- Tabla de Usuarios (Pacientes)
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    fecha_nacimiento DATE,
    genero ENUM('masculino', 'femenino', 'otro', 'no_especifica') DEFAULT 'no_especifica',
    foto_perfil VARCHAR(200),
    password_hash VARCHAR(255) NOT NULL,
    email_verificado BOOLEAN DEFAULT FALSE,
    telefono_verificado BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP NULL,
    token_recuperacion VARCHAR(100),
    token_expiracion TIMESTAMP NULL
);

-- Tabla de Direcciones de Usuarios
CREATE TABLE direcciones_usuarios (
    id_direccion_usuario INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_ciudad INT NOT NULL,
    calle VARCHAR(200),
    numero_exterior VARCHAR(20),
    numero_interior VARCHAR(20),
    colonia VARCHAR(100),
    codigo_postal VARCHAR(10),
    referencia TEXT,
    latitud DECIMAL(10, 8),
    longitud DECIMAL(11, 8),
    principal BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_ciudad) REFERENCES ciudades(id_ciudad)
);

-- Tabla de Médicos
CREATE TABLE medicos (
    id_medico INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    celular VARCHAR(20),
    fecha_nacimiento DATE,
    genero ENUM('masculino', 'femenino', 'otro') DEFAULT 'masculino',
    foto_perfil VARCHAR(200),
    cedula_profesional VARCHAR(50) NOT NULL UNIQUE,
    universidad VARCHAR(200),
    anio_graduacion YEAR,
    biografia TEXT,
    password_hash VARCHAR(255) NOT NULL,
    email_verificado BOOLEAN DEFAULT FALSE,
    perfil_verificado BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    destacado BOOLEAN DEFAULT FALSE,
    permite_telemedicina BOOLEAN DEFAULT FALSE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP NULL,
    plan_suscripcion ENUM('basico', 'premium', 'platino') DEFAULT 'basico',
    fecha_inicio_plan DATE,
    fecha_fin_plan DATE
);

-- Tabla de Especialidades de Médicos (relación muchos a muchos)
CREATE TABLE medicos_especialidades (
    id_medico_especialidad INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    id_especialidad INT NOT NULL,
    id_subespecialidad INT,
    certificacion VARCHAR(200),
    anio_certificacion YEAR,
    institucion_certificadora VARCHAR(200),
    principal BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    FOREIGN KEY (id_especialidad) REFERENCES especialidades(id_especialidad),
    FOREIGN KEY (id_subespecialidad) REFERENCES subespecialidades(id_subespecialidad),
    UNIQUE KEY unique_medico_especialidad (id_medico, id_especialidad, id_subespecialidad)
);

-- Tabla de Formación Académica
CREATE TABLE formacion_academica (
    id_formacion INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    tipo ENUM('licenciatura', 'especialidad', 'maestria', 'doctorado', 'curso', 'diplomado') NOT NULL,
    institucion VARCHAR(200) NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    pais VARCHAR(100),
    anio_inicio YEAR,
    anio_fin YEAR,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE
);

-- Tabla de Experiencia Profesional
CREATE TABLE experiencia_profesional (
    id_experiencia INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    institucion VARCHAR(200) NOT NULL,
    cargo VARCHAR(150) NOT NULL,
    descripcion TEXT,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    actual BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE
);

-- Tabla de Consultorios
CREATE TABLE consultorios (
    id_consultorio INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    tipo ENUM('privado', 'clinica', 'hospital', 'centro_medico') NOT NULL,
    id_ciudad INT NOT NULL,
    calle VARCHAR(200) NOT NULL,
    numero_exterior VARCHAR(20),
    numero_interior VARCHAR(20),
    colonia VARCHAR(100),
    codigo_postal VARCHAR(10),
    telefono VARCHAR(20),
    email VARCHAR(100),
    sitio_web VARCHAR(200),
    latitud DECIMAL(10, 8),
    longitud DECIMAL(11, 8),
    descripcion TEXT,
    fotos TEXT,
    servicios_disponibles TEXT,
    estacionamiento BOOLEAN DEFAULT FALSE,
    accesibilidad_discapacitados BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ciudad) REFERENCES ciudades(id_ciudad)
);

-- Tabla de Médicos en Consultorios (relación muchos a muchos)
CREATE TABLE medicos_consultorios (
    id_medico_consultorio INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    id_consultorio INT NOT NULL,
    principal BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_inicio DATE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    FOREIGN KEY (id_consultorio) REFERENCES consultorios(id_consultorio) ON DELETE CASCADE,
    UNIQUE KEY unique_medico_consultorio (id_medico, id_consultorio)
);

-- Tabla de Horarios de Atención
CREATE TABLE horarios_atencion (
    id_horario INT PRIMARY KEY AUTO_INCREMENT,
    id_medico_consultorio INT NOT NULL,
    dia_semana ENUM('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo') NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    duracion_cita INT DEFAULT 30 COMMENT 'Duración en minutos',
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_medico_consultorio) REFERENCES medicos_consultorios(id_medico_consultorio) ON DELETE CASCADE
);

-- Tabla de Días No Laborables (vacaciones, días festivos, etc.)
CREATE TABLE dias_no_laborables (
    id_dia_no_laborable INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    fecha DATE NOT NULL,
    motivo VARCHAR(200),
    todo_el_dia BOOLEAN DEFAULT TRUE,
    hora_inicio TIME,
    hora_fin TIME,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE
);

-- Tabla de Seguros Aceptados por Médico
CREATE TABLE medicos_seguros (
    id_medico_seguro INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    id_seguro INT NOT NULL,
    id_plan INT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    FOREIGN KEY (id_seguro) REFERENCES seguros_medicos(id_seguro) ON DELETE CASCADE,
    FOREIGN KEY (id_plan) REFERENCES planes_seguros(id_plan),
    UNIQUE KEY unique_medico_seguro_plan (id_medico, id_seguro, id_plan)
);

-- Tabla de Servicios/Tratamientos
CREATE TABLE servicios (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    id_especialidad INT NOT NULL,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_especialidad) REFERENCES especialidades(id_especialidad)
);

-- Tabla de Servicios Ofrecidos por Médico
CREATE TABLE medicos_servicios (
    id_medico_servicio INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    id_servicio INT NOT NULL,
    precio DECIMAL(10, 2),
    duracion INT COMMENT 'Duración en minutos',
    descripcion TEXT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio),
    UNIQUE KEY unique_medico_servicio (id_medico, id_servicio)
);

-- Tabla de Citas
CREATE TABLE citas (
    id_cita INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_medico INT NOT NULL,
    id_consultorio INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    duracion INT DEFAULT 30,
    tipo ENUM('presencial', 'telemedicina') DEFAULT 'presencial',
    motivo TEXT,
    estado ENUM('pendiente', 'confirmada', 'en_curso', 'completada', 'cancelada_paciente', 'cancelada_medico', 'no_asistio') DEFAULT 'pendiente',
    precio DECIMAL(10, 2),
    metodo_pago ENUM('efectivo', 'tarjeta', 'transferencia', 'seguro', 'pendiente') DEFAULT 'pendiente',
    notas_paciente TEXT,
    notas_medico TEXT,
    recordatorio_enviado BOOLEAN DEFAULT FALSE,
    codigo_verificacion VARCHAR(10),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    cancelado_por INT COMMENT 'ID del usuario o médico que canceló',
    motivo_cancelacion TEXT,
    fecha_cancelacion TIMESTAMP NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico),
    FOREIGN KEY (id_consultorio) REFERENCES consultorios(id_consultorio)
);

-- Tabla de Reseñas/Opiniones
CREATE TABLE resenas (
    id_resena INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_medico INT NOT NULL,
    id_cita INT,
    calificacion DECIMAL(2, 1) NOT NULL CHECK (calificacion >= 1 AND calificacion <= 5),
    comentario TEXT,
    calificacion_puntualidad INT CHECK (calificacion_puntualidad >= 1 AND calificacion_puntualidad <= 5),
    calificacion_atencion INT CHECK (calificacion_atencion >= 1 AND calificacion_atencion <= 5),
    calificacion_instalaciones INT CHECK (calificacion_instalaciones >= 1 AND calificacion_instalaciones <= 5),
    recomendaria BOOLEAN DEFAULT TRUE,
    anonimo BOOLEAN DEFAULT FALSE,
    verificada BOOLEAN DEFAULT FALSE,
    aprobada BOOLEAN DEFAULT FALSE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_aprobacion TIMESTAMP NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    FOREIGN KEY (id_cita) REFERENCES citas(id_cita),
    UNIQUE KEY unique_usuario_cita (id_usuario, id_cita)
);

-- Tabla de Respuestas de Médicos a Reseñas
CREATE TABLE respuestas_resenas (
    id_respuesta INT PRIMARY KEY AUTO_INCREMENT,
    id_resena INT NOT NULL,
    id_medico INT NOT NULL,
    respuesta TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_resena) REFERENCES resenas(id_resena) ON DELETE CASCADE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico)
);

-- Tabla de Preguntas Frecuentes por Médico
CREATE TABLE preguntas_frecuentes (
    id_pregunta INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    pregunta TEXT NOT NULL,
    respuesta TEXT NOT NULL,
    orden INT DEFAULT 0,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE
);

-- Tabla de Favoritos
CREATE TABLE favoritos (
    id_favorito INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_medico INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE,
    UNIQUE KEY unique_usuario_medico (id_usuario, id_medico)
);

-- Tabla de Notificaciones
CREATE TABLE notificaciones (
    id_notificacion INT PRIMARY KEY AUTO_INCREMENT,
    tipo_destinatario ENUM('usuario', 'medico') NOT NULL,
    id_destinatario INT NOT NULL,
    tipo ENUM('cita', 'cancelacion', 'recordatorio', 'resena', 'sistema', 'mensaje') NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    mensaje TEXT NOT NULL,
    leida BOOLEAN DEFAULT FALSE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_lectura TIMESTAMP NULL,
    id_referencia INT COMMENT 'ID de cita, reseña, etc.',
    INDEX idx_destinatario (tipo_destinatario, id_destinatario, leida)
);

-- Tabla de Mensajes entre Usuario y Médico
CREATE TABLE mensajes (
    id_mensaje INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_medico INT NOT NULL,
    remitente ENUM('usuario', 'medico') NOT NULL,
    mensaje TEXT NOT NULL,
    leido BOOLEAN DEFAULT FALSE,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_lectura TIMESTAMP NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico)
);

-- Tabla de Estadísticas de Médicos (para optimización de búsquedas)
CREATE TABLE estadisticas_medicos (
    id_estadistica INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL UNIQUE,
    total_citas INT DEFAULT 0,
    total_resenas INT DEFAULT 0,
    calificacion_promedio DECIMAL(3, 2) DEFAULT 0.00,
    tasa_respuesta DECIMAL(5, 2) DEFAULT 0.00 COMMENT 'Porcentaje de confirmación de citas',
    tasa_cancelacion DECIMAL(5, 2) DEFAULT 0.00,
    tiempo_respuesta_promedio INT DEFAULT 0 COMMENT 'En minutos',
    vistas_perfil INT DEFAULT 0,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_medico) REFERENCES medicos(id_medico) ON DELETE CASCADE
);

-- Tabla de Búsquedas (para analytics)
CREATE TABLE busquedas (
    id_busqueda INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    termino_busqueda VARCHAR(200),
    id_especialidad INT,
    id_ciudad INT,
    tipo_busqueda ENUM('especialidad', 'nombre', 'ubicacion', 'general'),
    resultados_encontrados INT,
    fecha_busqueda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_especialidad) REFERENCES especialidades(id_especialidad),
    FOREIGN KEY (id_ciudad) REFERENCES ciudades(id_ciudad)
);

-- Tabla de Logs de Actividad
CREATE TABLE logs_actividad (
    id_log INT PRIMARY KEY AUTO_INCREMENT,
    tipo_usuario ENUM('usuario', 'medico', 'admin') NOT NULL,
    id_usuario_sistema INT NOT NULL,
    accion VARCHAR(100) NOT NULL,
    descripcion TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_tipo_usuario (tipo_usuario, id_usuario_sistema, fecha_creacion)
);

-- =============================================
-- ÍNDICES PARA OPTIMIZACIÓN DE CONSULTAS
-- =============================================

CREATE INDEX idx_medicos_activo ON medicos(activo);
CREATE INDEX idx_medicos_destacado ON medicos(destacado);
CREATE INDEX idx_medicos_telemedicina ON medicos(permite_telemedicina);
CREATE INDEX idx_especialidades_activo ON especialidades(activo);
CREATE INDEX idx_citas_fecha ON citas(fecha_hora);
CREATE INDEX idx_citas_estado ON citas(estado);
CREATE INDEX idx_resenas_medico ON resenas(id_medico, aprobada);
CREATE INDEX idx_resenas_calificacion ON resenas(calificacion);
CREATE INDEX idx_consultorios_ciudad ON consultorios(id_ciudad);
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_medicos_email ON medicos(email);

-- =============================================
-- VISTAS ÚTILES
-- =============================================

-- Vista de Médicos con Información Completa
CREATE VIEW vista_medicos_completa AS
SELECT 
    m.id_medico,
    m.nombre,
    m.apellido,
    m.email,
    m.telefono,
    m.foto_perfil,
    m.cedula_profesional,
    m.biografia,
    m.activo,
    m.destacado,
    m.permite_telemedicina,
    em.calificacion_promedio,
    em.total_resenas,
    em.total_citas,
    GROUP_CONCAT(DISTINCT e.nombre SEPARATOR ', ') AS especialidades
FROM medicos m
LEFT JOIN estadisticas_medicos em ON m.id_medico = em.id_medico
LEFT JOIN medicos_especialidades me ON m.id_medico = me.id_medico
LEFT JOIN especialidades e ON me.id_especialidad = e.id_especialidad
WHERE m.activo = TRUE
GROUP BY m.id_medico;

-- Vista de Citas Próximas
CREATE VIEW vista_citas_proximas AS
SELECT 
    c.id_cita,
    c.fecha_hora,
    c.tipo,
    c.estado,
    CONCAT(u.nombre, ' ', u.apellido) AS paciente,
    u.telefono AS telefono_paciente,
    CONCAT(m.nombre, ' ', m.apellido) AS medico,
    m.telefono AS telefono_medico,
    co.nombre AS consultorio,
    co.calle AS direccion_consultorio
FROM citas c
INNER JOIN usuarios u ON c.id_usuario = u.id_usuario
INNER JOIN medicos m ON c.id_medico = m.id_medico
INNER JOIN consultorios co ON c.id_consultorio = co.id_consultorio
WHERE c.fecha_hora >= NOW() 
AND c.estado IN ('pendiente', 'confirmada')
ORDER BY c.fecha_hora;