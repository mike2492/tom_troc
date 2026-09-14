<?php
class BookManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function create(Book $book) : bool{
        $stmt = $this->db->prepare('INSERT INTO books (title, author, description, image, availability, user_id) VALUES (:title, :author, :description, :image, :availability, :user_id)');
        return $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'availability' => $book->getAvailability(),
            'user_id' => $book->getUserId()
        ]);
    }

    public function findAvailable(?string $search = null) : array{
        $sql = "SELECT * FROM books WHERE availability = :available";
        $params = ['available' => 'available'];

        if($search !== null){
            $sql .= " AND title LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $books = [];

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $book = new Book();
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $book->setAuthor($row['author']);
            $book->setDescription($row['description']);
            $book->setImage($row['image']);
            $book->setAvailability($row['availability']);
            $book->setCreatedAt(new DateTime($row['created_at']));
            $book->setUserId($row['user_id']);
            
            $books[] = $book;
        }

        return $books;
    }

    public function findById(int $id) : ?Book{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE id = :id');
        $stmt->execute(['id' => $id]);
        
        $data = $stmt->fetch();

        if($data === false){
            return null;
        }

        $book = new Book();
        $book->setId($data['id']);
        $book->setTitle($data['title']);
        $book->setAuthor($data['author']);
        $book->setDescription($data['description']);
        $book->setImage($data['image']);
        $book->setAvailability($data['availability']);
        $book->setCreatedAt(new DateTime($data['created_at']));
        $book->setUserId($data['user_id']);

        return $book;
    }

    public function findByUserId(int $userId) : array{
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);


        $books = [];
        $rows = $stmt->fetchAll();
    
        foreach($rows as $row){
            $book = new Book();
            $book->setId($row['id']);
            $book->setTitle($row['title']);
            $book->setAuthor($row['author']);
            $book->setDescription($row['description']);
            $book->setImage($row['image']);
            $book->setAvailability($row['availability']);
            $book->setCreatedAt(new DateTime($row['created_at']));
            $book->setUserId($row['user_id']);
            
            $books[] = $book;
        }

        return $books;
    }

    public function update(Book $book) : bool{
        $stmt = $this->db->prepare('UPDATE books SET title = :title, author = :author, description = :description, image = :image, availability = :availability WHERE id = :id');
        return $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'availability' => $book->getAvailability(),
            'id' => $book->getId()
        ]);
    }

    public function delete(int $id) : bool{
        $stmt = $this->db->prepare('DELETE FROM books WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}