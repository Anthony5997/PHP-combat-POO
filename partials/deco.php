<?php

session_start() ; // On démarre la session

session_unset(); // On réinitialise les variables de sessions

session_destroy();// On arrête la session en cours

header('Location: /poo-tp-combat/index.php'); // Redirection vers l'index

?>
