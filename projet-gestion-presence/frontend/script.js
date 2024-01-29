// frontend/script.js

function submitForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Appel à l'API d'authentification (exemple simplifié avec fetch)
    fetch('/auth/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            // Rediriger vers une autre page ou effectuer d'autres actions en cas de succès
        })
        .catch(error => {
            console.error('Erreur:', error);
            // Gérer les erreurs d'authentification ici
        });
}
