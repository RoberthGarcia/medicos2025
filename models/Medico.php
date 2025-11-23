<?php

namespace Model;

class Medico extends ActiveRecord {
    protected static $tabla = 'medicos';
    protected static $columnasDB = ['id_medico', 'nombre', 'apellido', 'email', 'telefono', 'celular', 'fecha_nacimiento', 'genero', 'foto_perfil', 'cedula_profesional', 'universidad', 'anio_graduacion', 'biografia', 'password_hash', 'email_verificado', 'perfil_verificado', 'activo', 'destacado', 'permite_telemedicina', 'fecha_registro', 'ultimo_acceso', 'plan_suscripcion', 'fecha_inicio_plan', 'fecha_fin_plan', 'token'];

    public $id_medico;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password_hash;
    public $telefono;
    public $celular;
    public $fecha_nacimiento;
    public $genero;
    public $foto_perfil;
    public $cedula_profesional;
    public $universidad;
    public $anio_graduacion;
    public $biografia;
    public $email_verificado;
    public $perfil_verificado;
    public $activo;
    public $destacado;
    public $permite_telemedicina;
    public $fecha_registro;
    public $ultimo_acceso;
    public $plan_suscripcion;
    public $fecha_inicio_plan;
    public $fecha_fin_plan;
    public $token;

    public function __construct($args = []) {
        $this->id_medico = $args['id_medico'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->celular = $args['celular'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->genero = $args['genero'] ?? 'masculino';
        $this->foto_perfil = $args['foto_perfil'] ?? '';
        $this->cedula_profesional = $args['cedula_profesional'] ?? '';
        $this->universidad = $args['universidad'] ?? '';
        $this->anio_graduacion = $args['anio_graduacion'] ?? '';
        $this->biografia = $args['biografia'] ?? '';
        $this->email_verificado = $args['email_verificado'] ?? 0;
        $this->perfil_verificado = $args['perfil_verificado'] ?? 0;
        $this->activo = $args['activo'] ?? 0;
        $this->destacado = $args['destacado'] ?? 0;
        $this->permite_telemedicina = $args['permite_telemedicina'] ?? 0;
        $this->fecha_registro = $args['fecha_registro'] ?? date('Y-m-d H:i:s');
        $this->ultimo_acceso = $args['ultimo_acceso'] ?? null;
        $this->plan_suscripcion = $args['plan_suscripcion'] ?? 'basico';
        $this->fecha_inicio_plan = $args['fecha_inicio_plan'] ?? null;
        $this->fecha_fin_plan = $args['fecha_fin_plan'] ?? null;
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para el registro de médico
    public function validarRegistro() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }
        if (!$this->cedula_profesional) {
            self::$alertas['error'][] = 'La cédula profesional es obligatoria';
        }
        
        return self::$alertas;
    }

    // Validación para login
    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        return self::$alertas;
    }

    // Validación de email
    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    // Validación de password
    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Revisa si el médico ya existe
    public function existeMedico() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El médico ya está registrado';
        }
        
        return $resultado;
    }

    // Hashea el password
    public function hashPassword() {
        $this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Crea un token único
    public function crearToken() {
        $this->token = uniqid();
    }

    // Comprobar password y verificación
    public function comprobarPasswordYVerificado($password) {
        $resultado = password_verify($password, $this->password_hash);
        
        if (!$resultado) {
            self::$alertas['error'][] = 'Password incorrecto';
            return false;
        }
        
        if (!$this->email_verificado) {
            self::$alertas['error'][] = 'Tu email aún no ha sido verificado';
            return false;
        }
        
        if (!$this->perfil_verificado) {
            self::$alertas['error'][] = 'Tu perfil está pendiente de aprobación por un administrador';
            return false;
        }
        
        if (!$this->activo) {
            self::$alertas['error'][] = 'Tu cuenta está inactiva';
            return false;
        }
        
        return true;
    }

    // Método para buscar por columna (sobrescribimos el de ActiveRecord para usar id_medico)
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Método para obtener todos los médicos
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        return self::consultarSQL($query);
    }

    // Obtener médicos verificados y activos
    public static function medicosActivos() {
        $query = "SELECT * FROM " . static::$tabla . " WHERE email_verificado = 1 AND perfil_verificado = 1 AND activo = 1";
        return self::consultarSQL($query);
    }

    // Obtener médicos pendientes de aprobación
    public static function medicosPendientes() {
        $query = "SELECT * FROM " . static::$tabla . " WHERE email_verificado = 1 AND perfil_verificado = 0";
        return self::consultarSQL($query);
    }

    // Aprobar perfil de médico
    public function aprobarPerfil() {
        $this->perfil_verificado = 1;
        $this->activo = 1;
        return $this->guardar();
    }

    // Rechazar perfil de médico
    public function rechazarPerfil() {
        $this->perfil_verificado = 0;
        $this->activo = 0;
        return $this->guardar();
    }
}
