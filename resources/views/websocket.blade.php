<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Teste WebSocket Laravel</title>
</head>
<body>
    <h1>Teste WebSocket Laravel</h1>
    <p>Abra o console do navegador e acesse <a href="/send-message" target="_blank">/send-message</a> para disparar uma mensagem.</p>
    <!-- Importa Echo e socket.io-client via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/socket.io-client@4.7.5/dist/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.2/dist/echo.iife.js"></script>
    <script>
        // Configura o Echo para conectar ao servidor websocket
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001'
        });

        // Escuta o canal público 'chat' e evento 'MessageSent'
        window.Echo.channel('chat')
            .listen('MessageSent', (e) => {
                console.log('Mensagem recebida via websocket:', e.message);
            });
    </script>
</body>
</html>
