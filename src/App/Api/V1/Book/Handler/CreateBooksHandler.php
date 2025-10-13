<?php

namespace App\Api\V1\Book\Handler;;

use App\Api\V1\Book\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class CreateBooksHandler implements RequestHandlerInterface
{
    private BookRepository $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);

        if (!$data) {
            return new JsonResponse(['error' => 'Invalid JSON body'], 400);
        }

        $book = $this->bookRepository->create($data);

        return new JsonResponse($book->toArray(), 201);
    }

}
