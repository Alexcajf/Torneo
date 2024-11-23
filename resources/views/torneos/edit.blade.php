<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Torneo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
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
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Torneo</h1>
        <form action="{{ route('torneos.update', ['torneo' => $torneo->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Torneo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $torneo->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="videojuego" class="form-label">Videojuego</label>
                <input type="text" class="form-control" id="videojuego" name="videojuego" value="{{ $torneo->videojuego }}" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $torneo->fecha }}" required>
            </div>
            <div id="participantes-container">
                <h2>Participantes</h2>
                @foreach($torneo->participantes as $index => $participante)
                    <div class="participante mb-3" data-index="{{ $index }}">
                        <input type="hidden" name="participantes[{{ $index }}][id]" value="{{ $participante->id }}">
                        <label for="participante-nombre-{{ $index }}" class="form-label">Nombre del Participante</label>
                        <input type="text" class="form-control" id="participante-nombre-{{ $index }}" name="participantes[{{ $index }}][nombre]" value="{{ $participante->nombre }}" required>
                        <label for="participante-email-{{ $index }}" class="form-label">Email del Participante</label>
                        <input type="email" class="form-control" id="participante-email-{{ $index }}" name="participantes[{{ $index }}][email]" value="{{ $participante->email }}" required>
                        <label for="participante-edad-{{ $index }}" class="form-label">Edad del Participante</label>
                        <input type="number" class="form-control" id="participante-edad-{{ $index }}" name="participantes[{{ $index }}][edad]" value="{{ $participante->edad }}" required>
                        <button type="button" class="btn btn-danger mt-2" onclick="removeParticipante(this)">Eliminar Participante</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary mt-3" onclick="addParticipante()">Añadir Participante</button>
            <button type="submit" class="btn btn-primary mt-3">Actualizar Torneo</button>
        </form>
        <a href="{{ route('torneos.index') }}" class="btn btn-secondary mt-3">Volver a la Lista de Torneos</a>
    </div>

    <script>
        let participanteIndex = {{ $torneo->participantes->count() }};

        function addParticipante() {
            const container = document.getElementById('participantes-container');
            const newParticipante = `
                <div class="participante mb-3" data-index="${participanteIndex}">
                    <label for="participante-nombre-${participanteIndex}" class="form-label">Nombre del Participante</label>
                    <input type="text" class="form-control" id="participante-nombre-${participanteIndex}" name="participantes[${participanteIndex}][nombre]" placeholder="Nombre del Participante" required>
                    <label for="participante-email-${participanteIndex}" class="form-label">Email del Participante</label>
                    <input type="email" class="form-control" id="participante-email-${participanteIndex}" name="participantes[${participanteIndex}][email]" placeholder="Email del Participante" required>
                    <label for="participante-edad-${participanteIndex}" class="form-label">Edad del Participante</label>
                    <input type="number" class="form-control" id="participante-edad-${participanteIndex}" name="participantes[${participanteIndex}][edad]" placeholder="Edad del Participante" required>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeParticipante(this)">Eliminar Participante</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newParticipante);
            participanteIndex++;
        }

        function removeParticipante(button) {
            const participanteDiv = button.closest('.participante');
            participanteDiv.remove();
        }
    </script>
</body>
</html>
