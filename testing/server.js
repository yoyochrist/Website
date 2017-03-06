/*
[0] Introduction
	var app = require('express')();
	var http = require('http').Server(app);
	var io = require('socket.io')(http);
are variables to do routing, get requests, send responses in socket.io
We can see these variable is depending with another variable,
i.e. "io" variable with "http" variable and "http" variable with "app" variable.
require('express')() means for expressjs is required for this file and it does not have variable required to do something and this variable will return
*/
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql = require('mysql');

var crud = mysql.createConnection({
	host: '192.168.14.229',
	user: 'root',
	database:'utv'
});

/*
[1]	app.get('/', function(req, res){
		res.sendfile('index.html');
	});
this command is routing system created by socket.io. It needs expressjs as its library.
As we see '/' is destination of URL, i.e "[IP Address]:[port][/]" is redirected by system to "index.html".
Another example is "[IP Address]:[port][/admin]" is redirected by system to "admin.html".
*/
app.get('/', function(req, res){
	res.sendfile('index.html');
});
app.get('/admin', function(req, res){
	res.sendfile('admin.html');
});

users = [];
clients = [];
io.on('connection', function(socket){
	console.info('New client connected (id='+socket.id+').');
	clients.push(socket);
	
	var date = new Date();
	var formatDate = date.toISOString(); 
	var formatTime = date.toTimeString();
	var socketId = socket.id;
	var clientIp = socket.request.connection.remoteAddress;
	
	//Default IPv4 for Windows is ::ffff:127.0.0.1 it is divided by two main IP standard
	// ::ffff: means for IPv6 Template it is mean 0000:0000:ffff:0000 while 127.0.0.1 is IPv4 Standard
	if (clientIp.substr(0, 7) == "::ffff:") {
		clientIp = clientIp.substr(7)
	}
	var count;
	//console.log(clientIp);
	crud.query("SELECT count(`ipAddress`) as `ipAddressCount` FROM device WHERE `ipAddress` = '"+clientIp+"'",
		function(err,rows){
			if(err)
			{
				throw err;
			}
			else
			{
				if(rows[0].ipAddressCount == "1")
				{
					crud.query("UPDATE device SET `lastSession` = '"+socket.id+"', `lastAccess` = '"+formatDate.slice(0,10)+' '+formatTime.split(' ')[0]+"' WHERE `ipAddress` = '"+clientIp+"'");
				}
				else
				{
					crud.query("INSERT INTO device(`ipAddress`, `lastSession`, `lastAccess`) VALUES ('"+clientIp+"', '"+socket.id+"', '"+formatDate.slice(0,10)+' '+formatTime.split(' ')[0]+"')");
				}
			}
		});
	console.log('A user connected from IP Address: '+clientIp+' on '+ formatDate.slice(0,10)+' '+formatTime.split(' ')[0]);
	
	socket.on('setUsername', function(data){
		console.log(data);
		if(users.indexOf(data) > -1){
			socket.emit('userExists', data + ' username is taken! Try some other username.');
		}
		else{
			users.push(data);
			socket.emit('userSet', {username: data});
		}
	});
	
	socket.on('msg', function(data){
		//Send message to everyone
		io.sockets.emit('newmsg', data);
	});
	
	//Whenever someone disconnects this piece of code executed
	socket.on('disconnect', function () {
		var index = clients.indexOf(socket);
		if(index !=1)
		{
			console.log('A user disconnected (id='+socket.id+') from IP Address: '+clientIp);
			clients.splice(index,1);
		}
	})
});

http.listen(3000, function(){
	console.log('listening on port 3000');
});