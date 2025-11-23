<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos Oaxaca - Sistema de Gestión Médica</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/medicos.css">
</head>
<body>
    <div class="contenedor-app">        
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>
    
    <?php
        echo $script ?? '';        
    ?>
            
</body>
</html>
