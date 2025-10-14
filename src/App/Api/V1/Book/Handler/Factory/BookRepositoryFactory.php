<?php 

namespace App\Api\V1\Book\Handler\Factory;

use App\Api\V1\Book\BookRepository;
use App\Api\V1\Book\BookRepositoryInterface;
use Psr\Container\ContainerInterface;

final class BookRepositoryFactory
{
    public function __invoke(ContainerInterface $container): BookRepositoryInterface
    {
      // TODO:ne pas mettre le chemin en dur
      $csvFile = __DIR__ . '/../../../../../../../data/books.csv';
      return new BookRepository($csvFile);
    }
}
