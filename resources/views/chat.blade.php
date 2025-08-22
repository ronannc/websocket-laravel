<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Teste WebSocket Laravel</title>
</head>
<body>
    <h1>Chat WebSocket Laravel</h1>
    <form id="form">
        <input type="text" id="message" placeholder="Digite uma mensagem" required>
        <button type="submit">Enviar</button>
    </form>
    <ul id="messages"></ul>

    <!-- Echo e socket.io via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/socket.io-client@4.7.5/dist/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.2/dist/echo.iife.js"></script>
    <script>
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001'
        });

        // Escuta o canal público 'chat' e evento 'MessageSent'
        window.Echo.channel('chat')
            .listen('MessageSent', (e) => {
                const ul = document.getElementById('messages');
                const li = document.createElement('li');
                li.textContent = e.message;
                ul.appendChild(li);
            });

        // Envia mensagem via AJAX para o backend
        document.getElementById('form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: document.getElementById('message').value })
            }).then(res => res.json()).then(data => {
                document.getElementById('message').value = '';
            });
        });
    </script>
</body>
</html>

