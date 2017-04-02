<?php
require_once __DIR__.('/config/init.php');



    if(isset($_POST['username']) && isset($_POST['password'])){
        echo "jestem";
        $validation = new Validation();
        if($validation->check($_POST, 
            array(
                'username' => array(
                'required' => true,
                'lenght'   => 40
            ),
                'password' => array(
                'required' => true,
                'length'   => 40
                )
            )
          )->passed()){
            if(User::loginUser($_POST['username'], $_POST['password'])){
                $_SESSION['userId'] = User::getUserIdFromDbByUsername($_POST['username']);   
                
                header('location:index.php');
            } else {
                echo "password or login incorrect";
            }
          } else {
            print_r($validation->get_errors());
          }
                   
    }





?>


<form action="#" method="POST">
    <fieldset>
        <legend>Login panel:</legend>
        login</br>
        <input type="text" name="username"></br>
        password</br>
        <input type="password" name="password"></br>
        <input type="submit">
    </fieldset>
    
</form>


