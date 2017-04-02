<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Twitter
 *
 * @author mc
 */
class Twitter {
    private $id,
            $user_id,
            $twitter_text,
            $twitter_creation_date;
    
    public function __construct(){
        $this->setId(-1);
        $this->setTwitter_creation_date("");
        $this->setTwitter_text("");
        $this->setUser_id("");
    }
    
    
    public static function loadTweetById($tweet_id, $user_id){
        $pdo = Db::getInstance();
        $db = $pdo->get_pdo();
        
        $sql = "select * from Twitter where id= ? and user_id = ?";
        $preparedQuery = $db->prepare($sql);
        $preparedQuery->bindValue(1, $tweet_id);
        $preparedQuery->bindValue(2,$user_id);
        
        $preparedQuery->execute();
        $queryResult = $preparedQuery->fetchAll(PDO::FETCH_OBJ);
                
        if(count($queryResult) > 0){
            $queryResult = $queryResult[0];
            
            $tweet = new Twitter();
            $tweet->setId($queryResult->id);
            $tweet->setTwitter_creation_date($queryResult->twitter_creation_date);
            $tweet->setTwitter_text($queryResult->twitter_text);
            $tweet->setUser_id($queryResult->user_id);
            
            return $tweet;
        }
    return null;    
    }
    
    public static function getNumberOfTweetsByUser($userId){
        $pdo = Db::getInstance();
        $db = $pdo->get_pdo();
        
        $sql = "select * from Twitter where user_id = ?";
        $preparedQuery = $db->prepare($sql);
        $preparedQuery->bindValue(1, $userId);
        $preparedQuery->execute();
        
        return $preparedQuery->rowCount();        
    }
    
    
    public static function loadAllTweets($user_id){     
        $pdo = Db::getInstance();
        $db = $pdo->get_pdo();
        
        $tweetsByUser = array();
        
        $sql = "select id from Twitter where user_id = ?";
        $preparedQuery = $db->prepare($sql);
        $preparedQuery->bindValue(1, $user_id);
        $preparedQuery->execute();
        
        if ($preparedQuery->rowCount() > 0){
            foreach($preparedQuery->fetchAll(PDO::FETCH_ASSOC)[0] as $tweet_id){
                $tweetsByUser[] = Twitter::loadTweetById($tweet_id, $user_id);
            }
        }  
        return $tweetsByUser;
    }
    
    
    public function printTweetsInScope($userId, $tweetsToPrintFrom, $tweetsToPrint){
        $pdo = Db::getInstance();
        $db = $pdo->get_pdo();
        
        $tweetsByUser = array();
        
        $sql = "select * from Twitter where user_id = ? order by twitter_creation_date desc limit {$tweetsToPrint} offset {$tweetsToPrintFrom}";
        $preparedQuery = $db->prepare($sql);
        $preparedQuery->bindValue(1, $userId);
        $preparedQuery->execute();
        
        if ($preparedQuery->rowCount() > 0){
           
            echo "<table><tr><td>text</td><td>date</td></tr>";
            foreach($preparedQuery->fetchAll(PDO::FETCH_ASSOC) as $tweet){
                echo "<tr><td>".$tweet['twitter_text']."</td><td>".$tweet['twitter_creation_date']."</td></tr>";
                
            }
            echo "</table>";
        }  
        
        
        
        
        
    }       
    
    private function setId($id) {
        $this->id = $id;
    }

        
    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setTwitter_text($twitter_text) {
        $this->twitter_text = $twitter_text;
    }

    public function setTwitter_creation_date($twitter_creation_date) {
        $this->twitter_creation_date = $twitter_creation_date;
    }

    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getTwitter_text() {
        return $this->twitter_text;
    }

    public function getTwitter_creation_date() {
        return $this->twitter_creation_date;
    }
    

}
