<?php
namespace App\Api\V1\Book\Handler\Factory;

use App\Api\V1\Book\BookRepositoryInterface;
use App\Api\V1\Book\Handler\ReadBooksHandler;
use Psr\Container\ContainerInterface;

final class ReadBooksHandlerFactory
{
    public function __invoke(ContainerInterface $container): ReadBooksHandler
    {
        $repository = $container->get(BookRepositoryInterface::class);

        return new ReadBooksHandler($repository);
    }
}
