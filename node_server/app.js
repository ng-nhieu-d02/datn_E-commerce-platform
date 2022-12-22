const express = require('express');

const app = express();


const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

app.get('/', (req, res) => {
    res.send('Nguyễn Nhiều: Server is working dev .....')
})

var connection = {};

io.on('connection', (socket) => {
    console.log('connection '+ socket.id);

    if(socket.handshake.auth.session in connection) {
        connection[socket.handshake.auth.session].push(socket.id);
    } else {
        connection[socket.handshake.auth.session] = [socket.id];
    }
    console.log(connection);
   
    socket.on('chat', (res) => {
        if(res.to in connection) {
            connection[res.to].forEach(function(item){
                io.to(item).emit('new_chat', res);
            });
        }
    })

    socket.on('disconnect', () => {
        connection[socket.handshake.auth.session] = connection[socket.handshake.auth.session].filter(item => item !== socket.id);
        if(connection[socket.handshake.auth.session].length == 0) {
            delete connection[socket.handshake.auth.session];
        }
        console.log('Disconnect');
    });
});

server.listen(1507, () => {
    console.log('Server is running');
});

