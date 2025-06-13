<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de eventos y revistas</title>
    <link rel="icon" href="build/img/Logo-utpl.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/docx-preview@0.1.15/dist/docx-preview.js"></script>
 


    <link rel="stylesheet" href="build/css/app.css">
</head>

<body>

    <?php echo $contenido; ?>
    <?php echo $script ?? ''; ?>
</body>


<!-- Footer -->
<footer>
    <div>
        <h1 class="footer-content">&copy; Universidad Técnica Particular de Loja. 2025-2026 </h1>
    </div>
</footer>

</html>