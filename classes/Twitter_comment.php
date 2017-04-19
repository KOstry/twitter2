<?php


class Twitter_comment {
    
    private $id,
            $user_id,
            $twitter_id,
            $text,
            $date;
            
    
    
    public function __constrct(){
        $this->id = -1;
        $this->user_id = "";
        $this->twitter_id = "";
        $this->text = "";
        $this->date = "";
    }
    
    private function setId($id) {
        $this->id = $id;
    }

    private function setTwitter_id($twitter_id) {
        $this->twitter_id = $twitter_id;
    }

    private function setText($text) {
        $this->text = $text;
    }

    private    function setDate($date) {
        $this->date = $date;
    }

        
    private function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getTwitter_id() {
        return $this->twitter_id;
    }

    public function getText() {
        return $this->text;
    }

    public function getDate() {
        return $this->date;
    }

    
    public function saveToDb(){
        $pdo = Db::getInstance();
        $db = $pdo->get_pdo();
        
         if($this->id == -1){
                $sql = "insert into Twitter_comments (user_id, twitter_id, date, text) values (?, ?, ?, ?)";
                $preparedQuery = $db->prepare($sql);
                $insertArray = array($this->getUser_id(), $this->getTwitter_id(), $this->getDate(), $this->getText());
                for($i=1;$i <= 4; $i++ ){
                    $preparedQuery->bindValue($i, $insertArray[$i-1]);                
                }           
                if($preparedQuery->execute()){
                    $this->id = $db->lastInsertId();
                    return true;
                }
            } else {
                $sql = "update Twitter set user_id = ?, twitter_id = ?, date = ?, text = ? where id = ".$this->getId();
                $preparedQuery = $db->prepare($sql);
                $insertArray = array($this->getUser_id(), $this->getTwitter_id(), $this->getDate(), $this->getText());
                for($i=1;$i <= 4; $i++ ){
                    $preparedQuery->bindValue($i, $insertArray[$i-1]);                
                }
                if($preparedQuery->execute()){
                    $this->id = $db->lastInsertId();
                    return true;
                }
            }
            return false;
    }
    
    public static function loadTweetCommentByTwitterId($tweet_id){
        $pdo = Db::getInstance();
        $db = $pdo->get_pdo();
        $twitter_comments_array = array();
        
        $sql = "select * from Twitter_comments where twitter_id = ? order by date desc";
        $preparedQuery = $db->prepare($sql);
        $preparedQuery->bindValue(1, $tweet_id);
        
        
        $preparedQuery->execute();
        $queryResult = $preparedQuery->fetchAll(PDO::FETCH_OBJ);
                
        if(count($queryResult) > 0){
           foreach($queryResult as $twitter_comment_db){
               
               $twitter_comment = new Twitter_comment();
               $twitter_comment->setId($twitter_comment_db->id);
               $twitter_comment->setText($twitter_comment_db->text);
               $twitter_comment->setTwitter_id($twitter_comment_db->twitter_id);
               $twitter_comment->setUser_id($twitter_comment_db->user_id);
               $twitter_comment->setDate($twitter_coment->date);
               $twitter_comments_array[] = $twitter_comment;               
           }            
           return $twitter_comments_array;
        }
    return null;    
    }
    
    
    public function loadTweetCommentById($id){
        
        
        
        
    }
    
}
