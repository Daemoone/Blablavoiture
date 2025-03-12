$(document).ready(function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // Initialisation du composant Select2 sur l'élément avec l'ID 'search-item-head'
    $('.name_city').select2({
        theme: 'bootstrap-5', // Applique le thème Bootstrap 5 à Select2 pour un style visuel compatible avec Bootstrap
        placeholder: 'Rechercher une ville', // Texte par défaut dans le champ avant toute sélection ou recherche
        ajax: { // Configuration pour la recherche asynchrone via Ajax
            url: base_url + "travel/autocompleteCity", // URL vers le contrôleur qui gère la recherche d'items (base_url est une variable contenant l'URL de base du site)
            dataType: 'json', // Les résultats de la requête sont attendus au format JSON
            delay: 500, // Ajoute un délai de 500 ms avant d'envoyer la requête pour limiter les requêtes fréquentes
            data: function (params) {
                // Retourne les données envoyées à chaque requête, ici 'q' est le terme de recherche saisi par l'utilisateur
                return {
                    q: params.term // Le terme de recherche saisi par l'utilisateur (via le champ Select2)
                };
            },
            processResults: function (data, params) {
                // Gère les résultats de la requête et les formate pour Select2
                console.log(data);
                searchTerm = params.term; // Stocke le terme de recherche pour une utilisation future
                return {
                    results: [
                        ...data // Ajoute les résultats de la recherche dans Select2 (les suggestions)
                    ]
                };
            },
            cache: true // Active la mise en cache des requêtes pour optimiser les performances et éviter des appels redondants
        },
        minimumInputLength: 2, // Définit un seuil minimal de caractères à saisir avant de déclencher une recherche
        allowClear: true // Permet de nettoyer la sélection dans le champ Select2 (ajout d'un bouton "clear")
    });
});
