# API Routes 

| Méthode | Route | Handler | Nom  | Description |
|----------|--------|----------|--------------|--------------|
| **GET** | `/books` | `App\Book\ListBooksHandler` | `books.list` | Liste de tout les livres. |
| **GET** | `/books/{id}` | `App\Book\ReadBooksHandler` | `book.read` | Récupère les détails d’un livre par son `id`. |
| **POST** | `/books` | `App\Book\CreateBooksHandler` | `book.create` | Crée un nouveau livre |
| **PUT** | `/books/{id}` | `App\Book\UpdateBookHandler` | `book.update` | Met à jour les informations d’un livre existant |
| **DELETE** | `/books/{id}` | `App\Book\DeleteBooksHandler` | `book.delete` | Supprime un livre spécifique selon son `id`. |
