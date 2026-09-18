<?php

class BookController extends Controller{

    public function index(){
        
        $bookManager = new BookManager();   
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $search = $_GET['search'];
            $books =  $bookManager->searchByTitle($search);
        } else{
            $books = $bookManager->findAll();
        }

        $this->render('books/index', ['books' => $books]);
    }

    public function show(){

        $id = (int) $_GET['id'];
        $userManager = new UserManager();
        $bookManager = new BookManager();

        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $user = $userManager->findById($book->getUserId());

        $this->render('books/show', ['book' => $book, 'user' => $user]);

    }

    public function create(){
        $this->requireAuth();
        $errors = [];
        $bookManager = new BookManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            $description = trim($_POST['description']);

            if(empty($title)){
                $errors['title'] = "Le titre est requis";
            }

            if(empty($author)){
                $errors['author'] = "L'auteur est requis";
            }

            if(empty($description)){
                $errors['description'] = "La description est requise";
            }

            if(empty($errors)){
                $book = new Book();
                $book->setTitle($title);
                $book->setAuthor($author);
                $book->setDescription($description);
                $book->setUserId($_SESSION['user_id']);
                $id = $bookManager->create($book);
                header('Location: index.php?controller=book&action=show&id=' . $id);
                exit;
            }
        }

        $this->render('books/form', ['errors' => $errors, 'book' => null]);
    }


    public function edit(){

        $this->requireAuth();
        $id = (int) $_GET['id'];
        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        if($book->getUserId() !== $_SESSION['user_id']){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $errors = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            $description = trim($_POST['description']);
            $availability = $_POST['availability'];

            if(!empty($title)){
                $book->setTitle($title);
            }

            if(!empty($author)){
                $book->setAuthor($author);
            }

            if(!empty($description)){
                $book->setDescription($description);
            }

            if(!empty($availability)){
                $book->setAvailability($availability);
            }

            $bookManager->update($book);
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $this->render('books/form', ['book' => $book, 'errors' => $errors]);
    }

    public function delete(){
        $this->requireAuth();
        $id = (int) $_GET['id'];
        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        if($book->getUserId() !== $_SESSION['user_id']){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $bookManager->delete($id);
        header('Location: index.php?controller=account&action=index');
        exit;
    }
}