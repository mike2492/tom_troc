<?php

class MessageManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function create(Message $message) : void{
        $stmt = $this->db->prepare('INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)');
        $stmt->execute([
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
            'content' => $message->getContent() 
        ]);
    }

    public function findConversation(int $userId1, int $userId2) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE (sender_id = :userId1 AND receiver_id = :userId2) OR (sender_id = :userId2 AND receiver_id = :userId1) ORDER BY sent_at ASC');
        $stmt->execute([
            'userId1' => $userId1,
            'userId2' => $userId2
        ]); 

        $conversation = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $message = new Message();
            $message->setId($row['id']);
            $message->setSenderId($row['sender_id']);
            $message->setReceiverId($row['receiver_id']);
            $message->setContent($row['content']);
            $message->setSentAt(new DateTime($row['sent_at']));

            $conversation[] = $message;
        }

        return $conversation;

    }

    public function findConversationByUserId(int $userId) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE sender_id = :userId OR receiver_id = :userId ORDER BY sent_at DESC');
        $stmt->execute([
            'userId' => $userId
        ]);

        $rows = $stmt->fetchAll();
        $conversation = [];
        $seenUsers = [];
       
        foreach($rows as $row){
            if((int) $row['sender_id'] === $userId){
                $otherUserId = (int) $row['receiver_id'];
            } else{
                $otherUserId = (int) $row['sender_id'];
            }

            if(!in_array($otherUserId, $seenUsers)){
                $seenUsers[] = $otherUserId;
                $message = new Message();
                $message->setId($row['id']);
                $message->setSenderId($row['sender_id']);
                $message->setReceiverId($row['receiver_id']);
                $message->setContent($row['content']);
                $message->setSentAt(new DateTime($row['sent_at']));

                $conversation[] = $message;
            }
        }

        return $conversation;
    }
}