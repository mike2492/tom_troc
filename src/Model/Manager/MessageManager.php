<?php
class MessageManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function create(Message $message) : bool{
        $stmt = $this->db->prepare('INSERT INTO messages (sender_id, receiver_id, content) VALUES (:senderId, :receiverId, :content)');
        return $stmt->execute([
            'senderId' => $message->getSenderId(),
            'receiverId' => $message->getReceiverId(),
            'content' => $message->getContent()
        ]);
    }

    public function findConversation(int $userId1, int $userId2) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE (sender_id = :userId1 AND receiver_id = :userId2) OR (sender_id = :userId2 AND receiver_id = :userId1) ORDER BY sent_at ASC');
        $stmt->execute([
            'userId1' => $userId1,
            'userId2' => $userId2
        ]);

        $messages = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $message = new Message();
            $message->setId($row['id']);
            $message->setSenderId($row['sender_id']);
            $message->setReceiverId($row['receiver_id']);
            $message->setContent($row['content']);
            $message->setSentAt(new DateTime($row['sent_at']));

            $messages[] = $message;
        }

        return $messages;
    }


    public function findConversationsWith(int $userId) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE sender_id = :userId OR receiver_id = :userId ORDER BY sent_at DESC');
        $stmt->execute([
            'userId' => $userId,
        ]);

        $conversations = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            if($row['sender_id'] === $userId){
                $otherUserId = $row['receiver_id'];
            } else{
                $otherUserId = $row['sender_id'];
            }

            if(!isset($conversations[$otherUserId])){
                $message = new Message();
                $message->setId($row['id']);
                $message->setSenderId($row['sender_id']);
                $message->setReceiverId($row['receiver_id']);
                $message->setContent($row['content']);
                $message->setSentAt(new DateTime($row['sent_at']));
                $conversations[$otherUserId] = $message;
            }
        }

        return $conversations;
    }
}