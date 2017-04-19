<?php


require_once __DIR__.('/config/init.php');
require_once __DIR__.('/view/loginHeader.php');
var_dump($_POST);

if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addTweet']) ){
    $twitter = new Twitter();
    $twitter->setUser_id($user->getId());
    $twitter->setTwitter_text($_POST['twitter_text']);
    $twitter->setTweetName($_POST['tweetName']);
    $twitter->setTwitter_creation_date(time());
    
    $twitter->saveToDb();
    header('location:index.php');
}
?>






<form id="addTweetForm" action="#" method="POST">
    <fieldset>
        <legend>Add new tweet</legend>
        tweet name</br>
        <input type="text" name="tweetName"></br>
        text</br>
        <textarea rows="20" cols="30" name="twitter_text" form="addTweetForm">Enter text here...</textarea></br>
        <input type="submit" value="dodaj tweet">
        <input type="hidden" name= "addTweet" value="addTweetPostConfirmation">
    </fieldset>
    
</form>

