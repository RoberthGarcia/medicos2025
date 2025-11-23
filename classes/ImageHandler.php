<?php

namespace Classes;

class ImageHandler {
    
    private $carpetaImagenes;
    private $tiposPermitidos = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    private $pesoMaximo = 5242880; // 5MB en bytes
    
    public function __construct($carpeta = 'medicos') {
        $this->carpetaImagenes = __DIR__ . '/../public/imagenes/' . $carpeta . '/';
        
        // Crear carpeta si no existe
        if(!is_dir($this->carpetaImagenes)) {
            mkdir($this->carpetaImagenes, 0755, true);
        }
    }
    
    /**
     * Subir una imagen
     * @param array $archivo El archivo de $_FILES
     * @return array ['resultado' => bool, 'nombreArchivo' => string|null, 'error' => string|null]
     */
    public function subirImagen($archivo) {
        // Validar que haya archivo
        if(!$archivo || !$archivo['tmp_name']) {
            return [
                'resultado' => false,
                'nombreArchivo' => null,
                'error' => 'No se proporcionó ninguna imagen'
            ];
        }
        
        // Validar tipo de archivo
        if(!in_array($archivo['type'], $this->tiposPermitidos)) {
            return [
                'resultado' => false,
                'nombreArchivo' => null,
                'error' => 'Formato de imagen no permitido. Solo JPG, PNG y WEBP'
            ];
        }
        
        // Validar peso del archivo
        if($archivo['size'] > $this->pesoMaximo) {
            return [
                'resultado' => false,
                'nombreArchivo' => null,
                'error' => 'La imagen es muy pesada. Máximo 5MB'
            ];
        }
        
        // Generar nombre único
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombreArchivo = md5(uniqid(rand(), true)) . '.' . $extension;
        
        // Mover archivo
        if(move_uploaded_file($archivo['tmp_name'], $this->carpetaImagenes . $nombreArchivo)) {
            return [
                'resultado' => true,
                'nombreArchivo' => $nombreArchivo,
                'error' => null
            ];
        } else {
            return [
                'resultado' => false,
                'nombreArchivo' => null,
                'error' => 'Error al subir la imagen'
            ];
        }
    }
    
    /**
     * Eliminar una imagen
     * @param string $nombreArchivo Nombre del archivo a eliminar
     * @return bool
     */
    public function eliminarImagen($nombreArchivo) {
        if(!$nombreArchivo) {
            return false;
        }
        
        $rutaArchivo = $this->carpetaImagenes . $nombreArchivo;
        
        if(file_exists($rutaArchivo)) {
            return unlink($rutaArchivo);
        }
        
        return false;
    }
    
    /**
     * Validar si existe una imagen
     * @param string $nombreArchivo
     * @return bool
     */
    public function existeImagen($nombreArchivo) {
        if(!$nombreArchivo) {
            return false;
        }
        
        $rutaArchivo = $this->carpetaImagenes . $nombreArchivo;
        return file_exists($rutaArchivo);
    }
    
    /**
     * Obtener la ruta pública de una imagen
     * @param string $nombreArchivo
     * @return string
     */
    public function obtenerRutaPublica($nombreArchivo) {
        if(!$nombreArchivo) {
            return '/imagenes/default-avatar.jpg';
        }
        
        return '/imagenes/medicos/' . $nombreArchivo;
    }
}
