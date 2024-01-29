// backend/server.js

const express = require('express');
const bodyParser = require('body-parser');
const database = require('./config/database');
const authRoutes = require('./routes/authRoutes');

const app = express();
const port = 3000;

app.use(bodyParser.json());

app.use('/auth', authRoutes);

app.listen(port, () => {
    console.log(`Serveur en cours d'exécution sur le port ${port}`);
});
