<?php

namespace App\Api\V1\Book\Handler;

use App\Api\V1\Book\BookRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DeleteBooksHandler implements RequestHandlerInterface
{
    private BookRepository $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        try {
            $this->bookRepository->delete($id);
            return new JsonResponse([
                'message' => "livre supprimé"
            ], 200);
        } catch (\RuntimeException $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
