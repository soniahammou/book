<?php
namespace App\Api\V1\Book\Handler\Factory;

use App\Api\V1\Book\BookRepositoryInterface;
use App\Api\V1\Book\Handler\ListBooksHandler;
use Psr\Container\ContainerInterface;

final class ListBooksHandlerFactory
{
    public function __invoke(ContainerInterface $container): ListBooksHandler
    {
        $repository = $container->get(BookRepositoryInterface::class);

        return new ListBooksHandler($repository);
    }
}
