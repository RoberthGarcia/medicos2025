<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicos Oaxaca</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/medicos.css">
    <link rel="stylesheet" href="/build/css/formularios_medicos.css">

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