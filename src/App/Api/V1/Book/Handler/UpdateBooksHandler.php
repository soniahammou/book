<?php

namespace App\Api\V1\Book\Handler;

use App\Api\V1\Book\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class UpdateBooksHandler implements RequestHandlerInterface
{
    private BookRepository $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        $data = json_decode($request->getBody()->getContents(), true);

        if (!$data) {
            return new JsonResponse(['error' => 'Corps JSON invalide'], 400);
        }
        try {

            $book = $this->bookRepository->find($id);

            if (isset($data['title'])) {
                $book->setTitle($data['title']);
            }
            if (isset($data['author'])) {
                $book->setAuthor($data['author']);
            }
            if (isset($data['genre'])) {
                $book->setGenre($data['genre']);
            }
            if (isset($data['height'])) {
                $book->setHeight($data['height']);
            }
            if (isset($data['publisher'])) {
                $book->setPublisher($data['publisher']);
            }

            $updatedBook = $this->bookRepository->update($id, $book);

            return new JsonResponse([
              'message' => 'modification réussie',
              'book' => $updatedBook->toArray(),
            ], 200);

        } catch (\RuntimeException $e) {
            return new JsonResponse([
              'error' => $e->getMessage(),
    ], 404);
        }
    }
}
