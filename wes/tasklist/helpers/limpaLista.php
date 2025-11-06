<?php

include("../config.php");
require '../bd.php';

delTudo($conn);
header('Location:	../tasklist.php');

