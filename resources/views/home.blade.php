<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - Torneo de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f5f5f5;
            font-family: 'Press Start 2P', cursive;
            overflow: hidden; /* Hide scrollbars during loading */
        }
        .container {
            text-align: center;
            display: none; /* Hide content initially */
        }
        .list-group-item {
            background-color: #333;
            color: #f5f5f5;
            border: 1px solid #444;
        }
        .list-group-item:hover {
            background-color: #555;
        }
        h1 {
            margin-bottom: 30px;
        }
        .loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .loader-text {
            font-size: 20px;
            margin-top: 20px;
        }
        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <div class="loader">
        <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading...">
        <div class="loader-text">Cargando...</div>
    </div>
    <div class="container mt-5">
        <h1>Bienvenido al Torneo de Videojuegos</h1>
        <p>¡Prepárate para competir y demostrar tus habilidades!</p>

        <!-- Carrusel -->
        <div id="torneosCarrusel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#torneosCarrusel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#torneosCarrusel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#torneosCarrusel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/Smash.jpg') }}" class="d-block w-100" alt="Torneo 1">
                    <div class="carousel-caption">
                        <h5>Torneo de Super Smash Bros</h5>
                        <p>Demuestra tu poder en cada pelea.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/fifa.jpg') }}" class="d-block w-100" alt="Torneo 2">
                    <div class="carousel-caption">
                        <h5>Torneo de FIFA</h5>
                        <p>¡Compite por el título de campeón mundial!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/lol.jpg') }}" class="d-block w-100" alt="Torneo 3">
                    <div class="carousel-caption">
                        <h5>Torneo de League of Legends</h5>
                        <p>Elige tu campeón y lidera tu equipo a la victoria.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#torneosCarrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#torneosCarrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <!-- Lista de enlaces -->
        <div class="list-group">
            <a href="{{ route('torneos.index') }}" class="list-group-item list-group-item-action">Lista de Torneos</a>
            <a href="{{ route('torneos.create') }}" class="list-group-item list-group-item-action">Crear Torneo</a>
        </div>


    <script>
        // Mostrar contenido y ocultar loader después de 1 segundo
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.loader').style.display = 'none';
                document.querySelector('.container').style.display = 'block';
                document.body.style.overflow = 'auto'; // Restore scrollbars after loading
            }, 1000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
