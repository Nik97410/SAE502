const mariadb = require('mariadb');
const faker = require('faker');

const pool = mariadb.createPool({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'bdd',
    connectionLimit: 5
});

async function fillDatabase() {
    const conn = await pool.getConnection();

    try {
        // Create a table 'utilisateurs' if it does not exist
        await conn.query(`
            CREATE TABLE IF NOT EXISTS utilisateurs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            );
        `);

        // Generate and insert random data
        for (let i = 0; i < 10; i++) {
            const email = faker.internet.email();
            const password = faker.internet.password();

            await conn.query('INSERT INTO utilisateurs (email, password) VALUES (?, ?)', [email, password]);
        }

        console.log('Database filled with random data');
    } catch (error) {
        console.error('Error filling the database:', error);
    } finally {
        conn.release();
    }
}

fillDatabase();
