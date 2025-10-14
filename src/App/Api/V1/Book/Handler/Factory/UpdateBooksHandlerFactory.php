<?php
namespace App\Api\V1\Book\Handler\Factory;

use App\Api\V1\Book\BookRepositoryInterface;
use App\Api\V1\Book\Handler\UpdateBooksHandler;
use Psr\Container\ContainerInterface;

final class UpdateBooksHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateBooksHandler
    {
        $repository = $container->get(BookRepositoryInterface::class);

        return new UpdateBooksHandler($repository);
    }
}
