
<?php

require_once __DIR__.('/config/init.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



if(!isset($_SESSION['userId'])){
    header('location: index.php');
} else {
    $userId = $_SESSION['userId'];
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {  
        $twitterId = $_GET['tweetId'];
        $tweet = Twitter::loadTweetById($twitterId, $userId);    
    } elseif( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( isset($_POST['tweetId']) ){
            $updatedTweetId = $_POST['tweetId'];
            
            $tweet = Twitter::loadTweetById($updatedTweetId, $userId);
            $tweet->setTweetName($_POST['tweetName']);
            $tweet->setTwitter_creation_date(time());
            $tweet->setTwitter_text($_POST['twitter_text']);
            
            $tweet->saveToDb();
            header('location: index.php');
        } else {
             header('location: index.php');
        }
    }   
}









?>









<form id="addTweetForm" action="#" method="POST">
    <fieldset>
        <legend>Your tweet</legend>
        </br>
        <input type="text" name="tweetName" value="<?php echo $tweet->getTweet_name();?>"></br>
        text</br>
        <textarea rows="20" cols="30" name="twitter_text" form="addTweetForm"><?php echo $tweet->getTwitter_text();  ?></textarea></br>
        
        <input type="hidden" name="tweetId" value ="<?php echo $tweet->getId(); ?>">
        <input type="submit" value="zapisz zmiany">
    </fieldset>
    
</form>
