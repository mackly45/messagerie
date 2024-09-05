$(document).ready(function() {
    
    // Fonction pour traiter le formulaire de connexion
    $('#loginForm').submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        $.ajax({
            url: 'index.php', // Fichier où la requête est envoyée
            type: 'POST',     // Méthode de la requête
            data: {
                action: 'login', // Indique que c'est une requête de connexion
                email: $('#loginEmail').val(), // Récupère l'email du formulaire
                password: $('#loginPassword').val() // Récupère le mot de passe du formulaire
            },
            success: function(response) {
                // Si connexion réussie, redirige vers le tableau de bord
                if (response.includes("Erreur")) {
                    alert(response); // Affiche le message d'erreur
                } else {
                    window.location.href = 'dashboard.php'; // Redirection vers le tableau de bord
                }
            },
            error: function() {
                alert('Erreur de connexion. Veuillez réessayer.'); // Gère les erreurs
            }
        });
    });

    // Fonction pour traiter le formulaire d'inscription
    $('#registerForm').submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        $.ajax({
            url: 'index.php', // Fichier où la requête est envoyée
            type: 'POST',     // Méthode de la requête
            data: {
                action: 'register', // Indique que c'est une requête d'inscription
                name: $('#registerName').val(), // Récupère le nom du formulaire
                email: $('#registerEmail').val(), // Récupère l'email du formulaire
                password: $('#registerPassword').val() // Récupère le mot de passe du formulaire
            },
            success: function(response) {
                // Si inscription réussie, redirige vers la page de confirmation
                if (response.includes("Erreur")) {
                    alert(response); // Affiche le message d'erreur
                } else {
                    window.location.href = 'inscris_ok.php'; // Redirection vers la page de confirmation
                }
            },
            error: function() {
                alert('Erreur d\'inscription. Veuillez réessayer.'); // Gère les erreurs
            }
        });
    });

});
