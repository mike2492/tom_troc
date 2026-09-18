<?php
class MessageController extends Controller{

    public function index(){
        $this->requireAuth();

        $messageManager = new MessageManager();

        $listeConversations = $messageManager->findConversationByUserId($_SESSION['user_id']);
        $conversation = [];

        if(isset($_GET['id'])){
            $id = (int) $_GET['id'];
            $conversation = $messageManager->findConversation($_SESSION['user_id'], $id);
        }
        
        $this->render('messages/index', ['conversation' => $conversation, 'listeConversations' => $listeConversations]);
    }

    public function send(){

        $this->requireAuth();
        $messageManager = new MessageManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $content = trim($_POST['content']);

            if(isset($_GET['id'])){
                $id = (int) $_GET['id'];

                if(!empty($content)){
                    $message = new Message();
                    $message->setSenderId($_SESSION['user_id']);
                    $message->setReceiverId($id);
                    $message->setContent($content);
                    $messageManager->create($message);
                }

                header('Location: index.php?controller=message&action=index&id=' . $id);
                exit;
            }
        }
    }
}