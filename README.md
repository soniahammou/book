# Mezzio Book API

Ce projet est une petite API REST développée avec **[Mezzio](https://docs.mezzio.dev/)**  permettant de gérer une ressource `Book` persistée dans un fichier CSV.




## Fonctionnalités

- API REST complète pour la ressource **Book**
- Persistance dans un fichier **CSV** (`data/books.csv`)
- Gestion d’erreurs avec réponses JSON
- Validation des données entrantes (bonus)
- Architecture découpée : Handlers, Repository
- Compatible avec Postman pour les tests

- 
## Installation
### 1. Cloner le projet
`git clone git@github.com:soniahammou/book.git`
`cd mezzio`
`composer install`
`php -S 0.0.0.0:8080 -t public`

L’API sera accessible à :
http://localhost:8080
