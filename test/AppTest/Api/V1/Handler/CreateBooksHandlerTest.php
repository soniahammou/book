<?php

declare(strict_types=1);

namespace AppTest\Api\V1\Handler;

use App\Api\V1\Book\Book;
use App\Api\V1\Book\BookRepositoryInterface;
use App\Api\V1\Book\Handler\CreateBooksHandler;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\Stream;

final class CreateBooksHandlerTest extends TestCase
{

  public function testCreateBookReturnSuccessMessage(): void
  {
    $data = [
      "title" => "1984",
      "author" => "George Orwell",
      "genre" => "Dystopian",
      "height" => "20cm",
      "publisher" => "Secker & Warburg"
    ];

    $book = new Book(
      $data['title'],
      $data['author'],
      $data['genre'],
      $data['height'],
      $data['publisher']
    );

    $repo = $this->createMock(BookRepositoryInterface::class);
    $repo->method('create')->willReturn($book);

    $handler = new CreateBooksHandler($repo);
    
    $json = json_encode($data);

    $request = (new ServerRequest())->withParsedBody($data);

    $response = $handler->handle($request);

    $this->assertEquals(201, $response->getStatusCode());
    $json = json_decode((string)$response->getBody(), true);
    $this->assertEquals('1984', $json['title']);
  }
}
