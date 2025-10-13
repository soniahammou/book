<?php

namespace App\Api\V1\Book\Handler;

use App\Api\V1\Book\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ListBooksHandler implements RequestHandlerInterface
{
    private BookRepository $repo;


    public function __construct(BookRepository $repo)
    {
        $this->repo = $repo;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $books = $this->repo->findAll();

        $data = array_map(function ($book) {
            return $book->toArray();
        }, $books);

        return new JsonResponse(['books' => $data], 200);
    }
}
