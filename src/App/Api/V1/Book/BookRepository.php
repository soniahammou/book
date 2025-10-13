<?php

namespace  App\Api\V1\Book;

final class BookRepository implements BookRepositoryInterface
{
    private string $csvFile;


    public function __construct(string $csvFile)
    {
        $this->csvFile = $csvFile;
    }

    public function findAll(): array
    {
        $csvFileContent = file_get_contents($this->csvFile);

        $lineContent = array_map(
            fn ($line) => str_getcsv($line, ',', '"', '\\'),
            explode("\n", trim($csvFileContent))
        );

        $headers = $lineContent[0];

        $books = [];

        $rowCount = count($lineContent);

        for ($i = 1; $i < $rowCount; $i++) {
            if (count($lineContent[$i]) !== count($headers)) {
                continue;
            }

            $row = array_combine($headers, $lineContent[$i]);

            // Création de l'objet Book
            $books[$i] = new Book(
                $row['Title'],
                $row['Author'],
                $row['Genre'],
                $row['Height'],
                $row['Publisher'],
            );
        }

        return $books;
    }

    public function find(int $id): ?Book
    {
        $books = $this->findAll();

        if (!array_key_exists($id, $books)) {

            throw new \RuntimeException("ressource inexistante");

        }
        return $books[$id];
    }

    public function create(array $data): Book
    {
        $books = $this->findAll();

        $nextId = count($books) ? max(array_keys($books)) + 1 : 1;

        $book = new Book(
            $nextId,
            $data['title'],
            $data['author'],
            $data['genre'],
            $data['height'],
            $data['publisher']
        );

        $this->save($book);

        return $book;
    }


    public function update(int $id, Book $book): Book
    {
        $this->existingBook($id);

        $books = $this->findAll();

        $books[$id] = $book;

        $this->writeCsvFile($books);

        return $book;
    }

    
    public function delete(int $id): void
    {
        $this->existingBook($id);

        $books = $this->findAll();
        unset($books[$id]);

        $this->writeCsvFile($books);
    }


    private function save(Book $book): void
    {
        $file  = fopen($this->csvFile, 'a');

        if ($file === false) {
            throw new \RuntimeException("Impossible d'ouvrir le fichier CSV pour écriture");
        }

        fputcsv($file, $book->toArray());

        fclose($file);
    }


    private function existingBook(int $id)
    {
        $existingBook = $this->find($id);
        if ($existingBook === null) {
            throw new \RuntimeException("Ressource inexistante.");
        }
    }


    // reecriture du CSV Complet
    private function writeCsvFile(array $books)
    {
        $fp = fopen($this->csvFile, 'w');
        if (!$fp) {
            throw new \RuntimeException("impossible d'écrire dans le fichier");
        }

        // headers
        fputcsv($fp, ['Title', 'Author', 'Genre', 'Height', 'Publisher']);

        // Réécriture de tous les livres
        foreach ($books as $b) {
            fputcsv($fp, [
              $b->getTitle(),
              $b->getAuthor(),
              $b->getGenre(),
              $b->getHeight(),
              $b->getPublisher(),
            ]);
        }

        fclose($fp);
    }
}
