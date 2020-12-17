const child_process = require('child_process');
const express = require('express');
const path = require('path');

let app = express();

app.all('/execute', (req, resp) => {
    resp.set('Content-Type', 'plain/text');
    const bin = req.query.bin || 'echo';
    const script = path.join(__dirname, req.query.script);
    console.log(`Executing [${bin}] ${script}`);
    const process = child_process.spawn(bin, [script]);
    let output = '';
    resp.status(200);
    resp.setHeader("Access-Control-Allow-Origin", "*");

    ['stdout', 'stderr'].forEach(source => {
        process[source].on('data', (data) => {
            output += `${data}`;
        });
    });

    process.on('exit', () => {
        resp.send(`${output.trimRight()}\n`);
        resp.end();
    });
});

app.listen(8080);