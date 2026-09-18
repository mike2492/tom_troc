<?php
class BookManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function create(Book $book) : void{
        $stmt = $this->db->prepare('INSERT INTO books (title, author, description, picture, user_id) VALUES (:title, :author, :description, :picture, :user_id)');
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'picture' => $book->getPicture(),
            'user_id' => $book->getUserId()
        ]);
    }

    public function findById(int $id) : ?Book{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);

        $data = $stmt->fetch();

        if($data === false){
            return null;
        }

        $book = new Book();
        $book->setId($data['id']);
        $book->setTitle($data['title']);
        $book->setAuthor($data['author']);
        $book->setDescription($data['description']);
        $book->setPicture($data['picture']);
        $book->setAvailability($data['availability']);
        $book->setCreatedAt(new DateTime($data['created_at']));
        $book->setUserId($data['user_id']);

        return $book;
    }

    public function findAll() : array{
        $stmt = $this->db->prepare('SELECT * FROM books');
        $stmt->execute();

        $books = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $book = new Book();
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $book->setAuthor($row['author']);
            $book->setDescription($row['description']);
            $book->setPicture($row['picture']);
            $book->setAvailability($row['availability']);
            $book->setCreatedAt(new DateTime($row['created_at']));
            $book->setUserId($row['user_id']);

            $books[] = $book;
        }

        return $books;
    }

    public function findByUserId(int $userId) : array{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE user_id = :user_id');
        $stmt->execute([
            'user_id' => $userId
        ]);

        $books = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $book = new Book();
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $book->setAuthor($row['author']);
            $book->setDescription($row['description']);
            $book->setPicture($row['picture']);
            $book->setAvailability($row['availability']);
            $book->setCreatedAt(new DateTime($row['created_at']));
            $book->setUserId($row['user_id']);

            $books[] = $book;
        }

        return $books;
    }

    public function searchByTitle(string $title) : array{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE title LIKE :title');
        $stmt->execute([
            'title' => '%' . $title . '%'
        ]);

        $books = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $book = new Book();
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $book->setAuthor($row['author']);
            $book->setDescription($row['description']);
            $book->setPicture($row['picture']);
            $book->setAvailability($row['availability']);
            $book->setCreatedAt(new DateTime($row['created_at']));
            $book->setUserId($row['user_id']);

            $books[] = $book;
        }

        return $books;
    }

    public function update(Book $book) : void{
        $stmt = $this->db->prepare('UPDATE books SET title = :title, author = :author, description = :description, picture = :picture, availability = :availability WHERE id = :id');
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'picture' => $book->getPicture(),
            'availability' => $book->getAvailability(),
            'id' => $book->getId()
        ]);
    }

    public function delete(int $id) : void{
        $stmt = $this->db->prepare('DELETE FROM books WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);
    }
}