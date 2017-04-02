<?php

require_once __DIR__.('/config/init.php');

    if(isset($_POST['username']) && isset($_POST['password'])){
       
        $validation = new Validation();
        if($validation->check($_POST, 
            array(
                'username' => array(
                    'required' => true,
                    'lenght'   => 40,
                    'unique'   => 'users'
            ),
                'password' => array(
                    'required' => true,
                    'length'   => 40                
                ),
                'passwordRepeat' => array(
                    'required' => true,
                    'match'    => array($_POST['password'] => 'password')
                ),
                'mail'     => array(
                    'required' => true,
                    'unique'   => 'users'
                )
            )
          )->passed()){           
            $user = new User();
            $user->setEmail($_POST['mail']);
            $user->setUsername($_POST['username']);
            $user->setHashedPassword($_POST['password']);
            $user->saveToDb();
            $_SESSION['flash'] = "register successfull! You can login now!";
            header('location:index.php');
          } else {
            print_r($validation->get_errors());
          }                   
    }





?>



<form action="#" method="POST">
    <fieldset>
        <legend>register panel:</legend>
        username</br>
        <input type="text" name="username"></br>
        password</br>
        <input type="password" name="password"></br>
        password repeat</br>
        <input type="password" name="passwordRepeat"></br>
        mail</br>
        <input type="text" name="mail"></br>
        <input type="submit">
    </fieldset>
    
</form>
