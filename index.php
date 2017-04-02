<?php

require_once __DIR__.('/config/init.php');
require_once __DIR__.('/view/loginHeader.php');

/*
  
1. Check number of tweets
   a) if less/equal to 5 - print all - to te max
   b) if bigger:
       b.1) Check if $_GET is set
             b.1.a) if set - print all in given scope - set $currentScope = $_GET['displayTweetsScopeDown']
             b.1.b) if not set - print from 0/1 -> 5  - set $currentScope = 0,5  
       b.2) print links to another pages with tweets
            b.2.a) $tweetsIterations = floor($numOfTweets/$numOfDisplayTweets)
            $iteratorCurrentPage = $currentScope['downValue'];
            for($i=0; $i<$tweetsIterations;$i++){
      *              if($i==$iteratorCurrentPage) - exchange a into p (no active link)
                    echo "<a href="index.php?tweetsFrom=$currentScope['from']&$tweetsTo="currentScope['to']>From-To</a>
      *     }
*/
if(isset($user)){
        $numOfTweets = Twitter::getNumberOfTweetsByUser($user->getId());
        $numOfDisplayTweets = 4;
        $printLinks = false;
        $currentDisplayedTweetsScope= "";
        
        

            if($numOfTweets != 0){                
                if( $numOfTweets <= $numOfDisplayTweets){                
                Twitter::printTweetsInScope($user->getId(), 0, $numOfTweets);
                $printLinks = false;
                } elseif( $numOfTweets > $numOfDisplayTweets ){                    
                    $printLinks = true;
                    if( isset($_GET['tweetsToDisplayPage']) ) { 
                       
                        if( $_GET['tweetsToDisplayPage'] != "" ){                            
                            
                            Twitter::printTweetsInScope($user->getId(), ($_GET['tweetsToDisplayPage']-1)*$numOfDisplayTweets, $numOfDisplayTweets);
                            $currentDisplayedTweetsScope = ($_GET['tweetsToDisplayPage']);
                            
                        }               
                    } else {                        
                        Twitter::printTweetsInScope($user->getId(), 0, $numOfDisplayTweets);
                        $currentDisplayedTweetsScope = 1;
                    }
                }
            } else {
                echo '<p>nie masz żadnych tweetów! Stwórz je: <a href="addTweet.php">dodaj tweet</a></p>';
            }

    if($printLinks){
        for($i=1; $i<= ceil($numOfTweets/$numOfDisplayTweets); $i++){
            if($i==$currentDisplayedTweetsScope){
                echo "[".$i."]";
            } else {
                echo '<a href="index.php?tweetsToDisplayPage='.$i.'">['.$i.']</a>';          
            }
        }
    }   
    
}
