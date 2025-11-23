#!/usr/bin/env php
<?php

/**
 * Script para crear las carpetas necesarias para imágenes
 * 
 * Ejecutar desde la raíz del proyecto:
 * php crear_carpetas.php
 * 
 * O desde terminal Unix/Linux:
 * chmod +x crear_carpetas.php
 * ./crear_carpetas.php
 */

echo "=================================\n";
echo "Creando estructura de carpetas...\n";
echo "=================================\n\n";

// Carpetas a crear
$carpetas = [
    'public/imagenes',
    'public/imagenes/medicos',
    'public/imagenes/consultorios',
    'public/imagenes/usuarios',
    'public/imagenes/temp'
];

$creadas = 0;
$existentes = 0;
$errores = 0;

foreach($carpetas as $carpeta) {
    
    $rutaCompleta = __DIR__ . '/' . $carpeta;
    
    if(is_dir($rutaCompleta)) {
        echo "✓ Ya existe: $carpeta\n";
        $existentes++;
    } else {
        if(mkdir($rutaCompleta, 0755, true)) {
            echo "✓ Creada: $carpeta\n";
            $creadas++;
        } else {
            echo "✗ Error al crear: $carpeta\n";
            $errores++;
        }
    }
}

echo "\n=================================\n";
echo "Resumen:\n";
echo "=================================\n";
echo "Carpetas creadas: $creadas\n";
echo "Ya existentes: $existentes\n";
echo "Errores: $errores\n";
echo "\n";

if($errores > 0) {
    echo "⚠️  Hubo errores al crear algunas carpetas.\n";
    echo "Verifica los permisos del directorio.\n";
    exit(1);
} else {
    echo "✓ ¡Estructura de carpetas lista!\n";
    exit(0);
}
