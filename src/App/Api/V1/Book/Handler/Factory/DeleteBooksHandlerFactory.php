<?php
namespace App\Api\V1\Book\Handler\Factory;

use App\Api\V1\Book\BookRepositoryInterface;
use App\Api\V1\Book\Handler\DeleteBooksHandler;
use Psr\Container\ContainerInterface;

final class DeleteBooksHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteBooksHandler
    {
        $repository = $container->get(BookRepositoryInterface::class);

        return new DeleteBooksHandler($repository);
    }
}
