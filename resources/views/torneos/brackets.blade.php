<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brackets del Torneo: {{ $torneo->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f5f5f5;
            font-family: 'Press Start 2P', cursive;
        }
        .container {
            text-align: center;
        }
        h1, h2 {
            margin-bottom: 30px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #333;
            color: #f5f5f5;
            border: 1px solid #444;
            margin: 10px 0;
            padding: 10px;
        }
        .btn-secondary {
            background-color: #444;
            border-color: #555;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Brackets del Torneo: {{ $torneo->nombre }}</h1>

        <form id="update-form" action="{{ route('torneos.updateBrackets', ['id' => $torneo->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @foreach($rounds as $roundIndex => $round)
                <h2>Ronda {{ $roundIndex + 1 }}</h2>
                <ul>
                    @foreach($round as $participante)
                        <li>
                            {{ $participante->nombre }}
                            @if($participante->is_winner)
                                <span class="badge bg-success">Ganador</span>
                            @else
                                <input type="radio" name="winners[{{ $roundIndex }}]" value="{{ $participante->id }}">
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endforeach
            <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Actualizar Ganadores</button>
        </form>
        <a href="{{ route('torneos.index') }}" class="btn btn-secondary mt-3">Volver a la Lista de Torneos</a>
    </div>

    <script>
        function confirmUpdate() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esto actualizará los ganadores!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lanzar confetti durante más tiempo
                    const duration = 15 * 1000; // 15 segundos
                    const animationEnd = Date.now() + duration;
                    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

                    function randomInRange(min, max) {
                        return Math.random() * (max - min) + min;
                    }

                    const interval = setInterval(function() {
                        const timeLeft = animationEnd - Date.now();

                        if (timeLeft <= 0) {
                            return clearInterval(interval);
                        }

                        const particleCount = 50 * (timeLeft / duration);
                        confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
                        confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
                    }, 250);

                    document.getElementById('update-form').submit();
                }
            });
        }
    </script>
</body>
</html>