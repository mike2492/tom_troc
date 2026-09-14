<?php

class BookController extends Controller {

    public function list(){
        $bookManager = new BookManager();
        $search = $_GET['search'] ?? null;
        $books = $bookManager->findAvailable($search);
        $this->render('book/list', ['books' => $books]);    
    }

    public function show(){

        $id = (int) ($_GET['id'] ?? 0);

        $userManager = new UserManager();
        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=book&action=list');
            exit;
        }

        $owner = $userManager->findById($book->getUserId());

        $this->render('book/show', ['book' => $book, 'owner' => $owner]);
    }

    public function create(){

        if(!$this->isLoggedIn()) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        
        $errors = [];
        $bookManager = new BookManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $availability = $_POST['availability'] ?? '';

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
                $book->setAvailability($availability);
                $book->setUserId($_SESSION['user_id']);
                $bookManager->create($book);
                header('Location: index.php?controller=user&action=account');
                exit;
            }
        }

        $this->render('book/form', ['errors' => $errors, 'book' => null]);
    }

    public function edit(){
        if(!$this->isLoggedIn()) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $id = (int) ($_GET['id'] ?? 0);
        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=book&action=list');
            exit;
        }

        if($_SESSION['user_id'] === $book->getUserId()){

            $errors = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $title = trim($_POST['title'] ?? '');
                $author = trim($_POST['author'] ?? '');     
                $description = trim($_POST['description'] ?? '');
                $availability = $_POST['availability'] ?? '';

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
                    $book->setTitle($title);
                    $book->setAuthor($author);
                    $book->setDescription($description);
                    $book->setAvailability($availability);
                    $bookManager->update($book);
                    header('Location: index.php?controller=user&action=account');
                    exit;
                }
            }

            $this->render('book/form', ['errors' => $errors, 'book' => $book]);

        } else{
            header('Location: index.php?controller=user&action=account');
            exit;            
        }

    }

    public function delete(){
        if(!$this->isLoggedIn()) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $id = (int) ($_GET['id'] ?? 0);
        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=user&action=account');
            exit;
        }
           
        if($_SESSION['user_id'] === $book->getUserId()){
            $bookManager->delete($id);
            header('Location: index.php?controller=user&action=account');
            exit;
        } else{
            header('Location: index.php?controller=user&action=account');
            exit;
        }

    }
}