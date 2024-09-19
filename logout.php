<?php
/**
 * Arquivo para destruir uma sessão assim que o cliente sair do sistema
 */

// Inicia a sessão
session_start();

// Define 'logged_in' como falso
$_SESSION['logged_in'] = false;

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header('Location: login.php');
?>
