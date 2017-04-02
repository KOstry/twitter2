<?php

require_once __DIR__.('/config/init.php');

User::logOut();
header('location:index.php');

