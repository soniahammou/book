<?php

namespace App\Api\V1\Book\Handler;

use App\Api\V1\Book\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ReadBooksHandler implements RequestHandlerInterface
{
    private BookRepository $repo;


    public function __construct(BookRepository $repo)
    {
        $this->repo = $repo;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        try {
            $book = $this->repo->find($id);
            return new JsonResponse(['book' => $book->toArray(),
    ], 200);

        } catch (\RuntimeException $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
