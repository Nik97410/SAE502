const express = require('express');
const mariadb = require('mariadb');
const bodyParser = require('body-parser');

const app = express();
const PORT = process.env.PORT || 3000;

const pool = mariadb.createPool({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'bdd',
    connectionLimit: 5
});

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.post('/auth/login', async (req, res) => {
    const { email, password } = req.body;

    try {
        const conn = await pool.getConnection();
        const result = await conn.query('SELECT * FROM utilisateurs WHERE email = ? AND password = ?', [email, password]);
        conn.release();

        if (result.length > 0) {
            return res.json({ message: 'Authentification réussie' });
        } else {
            return res.status(401).json({ message: 'Identifiants invalides' });
        }
    } catch (error) {
        console.error('Erreur d\'authentification:', error);
        return res.status(500).json({ message: 'Erreur interne du serveur' });
    }
});

app.listen(PORT, () => {
    console.log(`Le serveur est en cours d'exécution sur http://localhost:${PORT}`);
});
