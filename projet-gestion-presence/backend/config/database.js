// backend/config/database.js

const mongoose = require('mongoose');

mongoose.connect('mongodb://localhost:27017/projet-gestion-presence', {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

const db = mongoose.connection;

db.on('error', console.error.bind(console, 'Erreur de connexion à la base de données:'));
db.once('open', () => {
    console.log('Connexion réussie à la base de données');
});
