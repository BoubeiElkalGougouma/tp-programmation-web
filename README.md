#Système d'Inscription Dynamique (PHP / MySQL)
Ce projet est un système d'inscription complet développé intégralement dans un environnement Linux. 
L'objectif était de creer un formulaire sans utiliser d'outils simplifiés (comme Wamp), 
en configurant manuellement le serveur et la base de données.
#Environnement de Développement
	OS : Linux (Ubuntu/Debian)
	Éditeur : VS Code avec terminal intégré
	Serveur : Apache / MySQL (installation native)
	Gestion de version : Git (maîtrise du terminal et des commandes init, add, commit, push)
#Maîtrise Technique

	Frontend (HTML5/CSS3) : Création d'un formulaire responsive basé sur Flexbox. J'ai résolu les problèmes de décalage visuel pour garantir une interface stable, même lors de l'affichage des erreurs de validation.

	Backend (PHP) : Traitement des données, validation de la sécurité des champs et gestion de la redirection avec transmission de données via URL (sérialisation).

	Sécurité des Données : Mise en place d'une architecture sécurisée via un fichier .env pour isoler les identifiants de la base de données, empêchant toute fuite de mot de passe sur les dépôts publics.
#Structure du Projet
tp-pweb/
	.env
	.gitignore
	db.php	         # Logique de connexion à MySQL (sécurisée par .env)
	index.php        # Formulaire d'inscription et validation PHP
	redirection.php  # Page de réception et affichage des données
	README.md	 # Documentation du projet
