# Installation

## Prérequis
- PHP 8.4 
- Composer
- Serveur web Apache, PHP built-in

## Étapes
1. Cloner le dépôt :

  ``git clone git@github.com:soniahammou/book.git``

2. Installer les dependences 
    
  `` composer install``

3. lancer le serveur 

  ``composer run --timeout=86400 serve``


# Installation avec Docker

1. Construire l'image : 

  `` docker compose build``

2. Lancer le conteneur en arrière plan : 
   
  ``docker compose up -d``
