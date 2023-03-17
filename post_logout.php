<?php
include('admin/assets/include/functions.php');

// Finally, destroy the session.
session_destroy();


// Redirection to the page
header('Location: index.php?logout=user');
?>