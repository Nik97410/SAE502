// backend/routes/authRoutes.js

const express = require('express');
const router = express.Router();
const User = require('../models/User');

router.post('/login', async (req, res) => {
    try {
        const { username, password } = req.body;

        // Recherche de l'utilisateur dans la base de donn�es (exemple avec MongoDB)
        const user = await User.findOne({ username, password });

        if (user) {
            res.status(200).json({ message: 'Authentification r�ussie' });
        } else {
            res.status(401).json({ message: 'Authentification �chou�e' });
        }
    } catch (error) {
        console.error('Erreur:', error);
        res.status(500).json({ message: 'Erreur interne du serveur' });
    }
});

module.exports = router;
