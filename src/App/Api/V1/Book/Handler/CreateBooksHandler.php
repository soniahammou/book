<?php

namespace App\Api\V1\Book\Handler;;

use App\Api\V1\Book\BookRepositoryInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class CreateBooksHandler implements RequestHandlerInterface
{
    private BookRepositoryInterface $repo;


    public function __construct(BookRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (!$data) {
           // return new JsonResponse(['error' => 'Invalid JSON body'], 400);
           $data = $request->getParsedBody();

        }

        $book = $this->repo->create($data);

        return new JsonResponse($book->toArray(), 201);
    }

}   
