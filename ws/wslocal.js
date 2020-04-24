const fs = require('fs');
const https = require('http');
const WebSocket = require('ws');

const server = https.createServer();
const wss = new WebSocket.Server({ server });



wss.on('connection', function connection(ws) {
  ws.on('message', function incoming(data) {
    wss.clients.forEach(function each(client) {
      if (client.readyState === WebSocket.OPEN) {
        client.send(data);
      }
    });

  });


});

server.listen(8080);
