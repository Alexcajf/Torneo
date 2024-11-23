<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Torneo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f5f5f5;
            font-family: 'Press Start 2P', cursive;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .form-control, .form-label {
            background-color: #333;
            color: #f5f5f5;
            border: 1px solid #444;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .form-control:focus {
            background-color: #444;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        h1, h3 {
            margin-bottom: 30px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Crear Torneo</h1>

        <!-- Formulario para crear un torneo -->
        <form action="{{ route('torneos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Torneo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Torneo" required>
            </div>
            <div class="mb-3">
                <label for="videojuego" class="form-label">Videojuego</label>
                <input type="text" class="form-control" id="videojuego" name="videojuego" placeholder="Videojuego" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <!-- Formulario para agregar participantes -->
            <div id="participantes-container">
                <h2>Participantes</h2>
                <div class="mb-3">
                    <label for="participante-nombre-1" class="form-label">Nombre del Participante</label>
                    <input type="text" class="form-control" id="participante-nombre-1" name="participantes[0][nombre]" placeholder="Nombre del Participante" required>
                </div>
                <div class="mb-3">
                    <label for="participante-email-1" class="form-label">Email del Participante</label>
                    <input type="email" class="form-control" id="participante-email-1" name="participantes[0][email]" placeholder="Email del Participante" required>
                </div>
                <div class="mb-3">
                    <label for="participante-edad-1" class="form-label">Edad del Participante</label>
                    <input type="number" class="form-control" id="participante-edad-1" name="participantes[0][edad]" placeholder="Edad del Participante" required>
                </div>
            </div>

            <div class="button-group mb-3">
                <button type="button" class="btn btn-secondary" onclick="addParticipante()">Añadir Participante</button>
                <button type="submit" class="btn btn-primary">Crear Torneo</button>
            </div>
        </form>
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Volver al Home</a>
        <a href="{{ route('torneos.index') }}" class="btn btn-secondary mt-3">Volver a Torneos</a>
    </div>

    <script>
        let participanteIndex = 1;

        function addParticipante() {
            const container = document.getElementById('participantes-container');
            const newParticipante = `
                <div class="mb-3">
                    <label for="participante-nombre-${participanteIndex}" class="form-label">Nombre del Participante</label>
                    <input type="text" class="form-control" id="participante-nombre-${participanteIndex}" name="participantes[${participanteIndex}][nombre]" placeholder="Nombre del Participante" required>
                </div>
                <div class="mb-3">
                    <label for="participante-email-${participanteIndex}" class="form-label">Email del Participante</label>
                    <input type="email" class="form-control" id="participante-email-${participanteIndex}" name="participantes[${participanteIndex}][email]" placeholder="Email del Participante" required>
                </div>
                <div class="mb-3">
                    <label for="participante-edad-${participanteIndex}" class="form-label">Edad del Participante</label>
                    <input type="number" class="form-control" id="participante-edad-${participanteIndex}" name="participantes[${participanteIndex}][edad]" placeholder="Edad del Participante" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newParticipante);
            participanteIndex++;
        }
    </script>
</body>
</html>