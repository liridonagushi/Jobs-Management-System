<?php
require_once ('includes/functions.php');

session_destroy();

header('Location: ../index.php?id_client='.$id_client.'');
?>