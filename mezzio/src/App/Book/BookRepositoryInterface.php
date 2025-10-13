<?php

namespace App\Book;

interface BookRepositoryInterface
{
    public function findAll(): array;

    public function find(int $id): ?Book;

    public function create(array $data): Book;

    public function update(int $id, Book $book): Book;

    public function delete(int $id): void;
}
