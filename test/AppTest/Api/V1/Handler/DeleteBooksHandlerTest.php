<?php

declare(strict_types=1);

namespace AppTest\Api\V1\Handler;

use App\Api\V1\Book\BookRepositoryInterface;
use App\Api\V1\Book\Handler\DeleteBooksHandler;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;


final class DeleteBooksHandlerTest  extends TestCase
{
  public function testDeleteBookReturnsSuccessMessage(): void
  {
    $repo = $this->createMock(BookRepositoryInterface::class);
    $repo->expects($this->once())
         ->method('delete');

    $handler = new DeleteBooksHandler($repo);

    $request = (new ServerRequest())->withAttribute('id', 1);

    $response = $handler->handle($request);

    $body = (string) $response->getBody();
    $json = json_decode($body, true);
    
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals('livre supprimé', $json['message']);

  }

  
  public function testDeleteBookReturnsWarningMessage(): void
  {
    $repo = $this->createMock(BookRepositoryInterface::class);
    $repo->method('delete')
      ->willReturnCallback(function ($id) {
        if ($id === 20) {
            throw new \RuntimeException('livre introuvable');
        }
        return true;
    });

    $handler = new DeleteBooksHandler($repo);
    $request = (new ServerRequest())->withAttribute('id', 20);
    $response = $handler->handle($request);

    $body = (string) $response->getBody();
    $json = json_decode($body, true);

    $this->assertEquals(404, $response->getStatusCode());
    $this->assertEquals('livre introuvable', $json['error']);
  }
}
