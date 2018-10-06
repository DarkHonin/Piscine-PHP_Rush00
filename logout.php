<?php
session_start();
session_destroy();
unset($_SESSION["UNAME"]);
header("Location: /");
?>