<?php
class MessageController extends Controller{

    public function index(){
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $messageManager = new MessageManager();
        $userManager = new UserManager();

        $conversations = $messageManager->findConversationsWith($_SESSION['user_id']);

        $activeMessages = [];
        $activeUser = null;

        if(isset($_GET['with'])){
            $otherUserId = (int) $_GET['with'];
            $activeMessages = $messageManager->findConversation($_SESSION['user_id'], $otherUserId);
            $activeUser = $userManager->findById($otherUserId);
        }

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $content = trim($_POST['content'] ?? '');
            $receiverId = (int) ($_POST['receiver_id'] ?? 0);

            if(empty($content)){
                $errors['content'] = "Un message est requis";
            }

            if(empty($errors) && $receiverId > 0){
                $message = new Message();
                $message->setSenderId($_SESSION['user_id']);
                $message->setReceiverId($receiverId);
                $message->setContent($content);
                $messageManager->create($message);

                header('Location: index.php?controller=message&action=index&with=' . $receiverId);
                exit;
            }
        }

        $this->render('message/index', [
            'conversations' => $conversations,
            'activeMessages' => $activeMessages,
            'activeUser' => $activeUser,
            'errors' => $errors
        ]);
    }
}