<?php

if(isset($_SESSION['userId'])){
    $user = User::loadUserById($_SESSION['userId']);    
}

if(isset($_SESSION['flash'])){
    echo $_SESSION['flash'];
    unset($_SESSION['flash'] );
}


if(isset($user)){
    echo "witaj ".$user->getUsername()."</br>";
    echo '<a href="register.php">register</a></br>';
    echo '<a href="logout.php">logout</a>';
} else {
    echo '<a href="login.php">login</a></br>';
    echo '<a href="register.php">register</a></br>';
}
