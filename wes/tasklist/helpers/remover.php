<?php

require "../config.php";
require "../bd.php";

delTask($conn,    $_GET['id']);
header('Location:	../tasklist.php');
