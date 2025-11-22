<?php

namespace Model;

class Medico extends ActiveRecord {
    protected static $tabla ='medicos';
    protected static $colomnasDB = ['id_medico', 'nombre', 'apellido', 'email', 'telefono', 'celular', 'fecha_nacimiento', 'genero', 'foto_perfil', 'cedula_profesional', 'universidad', 'anio_graduacion', 'biografia', 'perfil_verificado', 'activo', 'destacado', 'permite_telemedicina', 'fecha_registro', 'ultimo_acceso', 'plan_suscripcion', 'fecha_inicio_plan', 'fecha_fin_plan'];

    public $id_medico;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $celular;
    public $fecha_nacimiento;
    public $genero;
    public $foto_perfil;
    public $cedula_profesional;
    public $universidad;
    public $anio_graduacion;
    public $biografia;
    public $perfil_verificado;
    public $activo;
    public $destacado;
    public $permite_telemedicina;
    public $fecha_registro;
    public $ultimo_acceso;
    public $plan_suscripcion;
    public $fecha_inicio_plan;
    public $fecha_fin_plan;


    public function __construct($args=[]) 
    {
        $this->id_medico = $args['id_medico'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->celular = $args['celular'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->foto_perfil = $args['foto_perfil'] ?? '';
        $this->cedula_profesional = $args['cedula_profesional'] ?? '';
        $this->universidad = $args['universidad'] ?? '';
        $this->anio_graduacion = $args['anio_graduacion'] ?? '';
        $this->biografia = $args['biografia'] ?? '';
        $this->perfil_verificado = $args['perfil_verificado'] ?? '';
        $this->activo = $args['activo'] ?? '';
        $this->destacado = $args['destacado'] ?? '';
        $this->permite_telemedicina = $args['permite_telemedicina'] ?? '';
        $this->fecha_registro = date('Y/m/d');
        $this->ultimo_acceso = $args['ultimo_acceso'] ?? '';
        $this->plan_suscripcion = $args['plan_suscripcion'] ?? '';
        $this->fecha_inicio_plan = $args['fecha_inicio_plan'] ?? '';
        $this->fecha_fin_plan = $args['fecha_fin_plan'] ?? '';
    }

    public function validar() {
        //Validacion de variables        
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio ' ;
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio ' ;
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio ' ;
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El telefono es obligatorio ' ;
        }
        if (!$this->celular) {
            self::$alertas['error'][] = 'El celular es obligatorio ' ;
        }
        if (!$this->fecha_nacimiento) {
            self::$alertas['error'][] = 'El fecha_nacimiento es obligatorio ' ;
        }
        if (!$this->genero) {
            self::$alertas['error'][] = 'El genero es obligatorio ' ;
        }
        if (!$this->foto_perfil) {
            self::$alertas['error'][] = 'El foto_perfil es obligatorio ' ;
        }
        if (!$this->cedula_profesional) {
            self::$alertas['error'][] = 'El cedula_profesional es obligatorio ' ;
        }
        if (!$this->universidad) {
            self::$alertas['error'][] = 'El universidad es obligatorio ' ;
        }
        if (!$this->anio_graduacion) {
            self::$alertas['error'][] = 'El anio_graduacion es obligatorio ' ;
        }
        if (!$this->biografia) {
            self::$alertas['error'][] = 'El biografia es obligatorio ' ;
        }
        if (!$this->perfil_verificado) {
            self::$alertas['error'][] = 'El perfil_verificado es obligatorio ' ;
        }
        if (!$this->activo) {
            self::$alertas['error'][] = 'El activo es obligatorio ' ;
        }
        if (!$this->destacado) {
            self::$alertas['error'][] = 'El destacado es obligatorio ' ;
        }
        if (!$this->permite_telemedicina) {
            self::$alertas['error'][] = 'El permite_telemedicina es obligatorio ' ;
        }
        if (!$this->fecha_registro) {
            self::$alertas['error'][] = 'El fecha_registro es obligatorio ' ;
        }
        if (!$this->ultimo_acceso) {
            self::$alertas['error'][] = 'El ultimo_acceso es obligatorio ' ;
        }
        if (!$this->plan_suscripcion) {
            self::$alertas['error'][] = 'El plan_suscripcion es obligatorio ' ;
        }
        if (!$this->fecha_inicio_plan) {
            self::$alertas[] = 'El fecha_inicio_plan es obligatorio ' ;
        }
        if (!$this->fecha_fin_plan) {
            self::$alertas[] = 'El fecha_fin_plan es obligatorio ' ;
        }

        return self::$errores;
    }  
}