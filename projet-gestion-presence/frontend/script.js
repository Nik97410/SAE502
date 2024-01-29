// frontend/script.js

function submitForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Appel � l'API d'authentification (exemple simplifi� avec fetch)
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
            // Rediriger vers une autre page ou effectuer d'autres actions en cas de succ�s
        })
        .catch(error => {
            console.error('Erreur:', error);
            // G�rer les erreurs d'authentification ici
        });
}
