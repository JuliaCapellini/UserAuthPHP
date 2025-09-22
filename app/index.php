<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once './Class/UserManager.php';
require_once './Class/User.php';

echo "<h3>Caso 1 - Cadastro Válido</h3>";

$userManager1 = new UserManager();

$user1 = new User(1, 'Maria de Oliveira', 'maria@email.com', 'Senha123');

$result1 = $userManager1->registerUser($user1);
echo $result1 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager1->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}

echo "<h3>Caso 2 - Cadastro com E-mail Inválido</h3>";

$userManager2 = new UserManager();

$user2 = new User(2, 'Pedro', 'pedro@email', 'Senha123');

$result2 = $userManager2->registerUser($user2);
echo $result2 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager2->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}

echo "<h3>Caso 3 - Tentativa de login com senha inválida</h3>";

$userManager3 = new UserManager();

$user3 = new User(3, 'João', 'joao@email.com', 'Umasenha123');

$result3 = $userManager3->registerUser($user3);
echo $result3 . "<br>";
$result3 = $userManager3->loginUser('joao@email.com', 'Errada123');
echo $result3 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager3->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}

echo "<h3>Caso 4 - Reset de Senha Válido</h3>";

$userManager4 = new UserManager();

$user4 = new User(4, 'Gabriele Martinez', 'gabi@email.com', 'Senha123');

$result4 = $userManager4->registerUser($user4);
echo $result4 . "<br>";

$result4 = $userManager4->resetPassword('gabi@email.com', 'NovaSenha1');
echo $result4 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager4->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}

echo "<h3>Caso 5 — Cadastro de usuário com e-mail duplicado</h3>";

$userManager5 = new UserManager();

$user5 = new User(5, 'Julia Capellini', 'julia@email.com', 'Senha123');

$result5 = $userManager5->registerUser($user5);
echo $result5 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager5->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}

$user6 = new User(6, 'Julia', 'julia@email.com', 'Senha321');

$result6 = $userManager5->registerUser($user6);
echo $result5 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager5->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}

echo "<h3>Caso 6 - Cadastro Válido com sucesso no Login</h3>";

$userManager7 = new UserManager();

$user7 = new User(7, 'João dos Santos', 'joaosantos@email.com', 'Santos123');

$result7 = $userManager7->registerUser($user7);
echo $result7 . "<br>";
$result7 = $userManager7->loginUser('joaosantos@email.com', 'Santos123');
echo $result7 . "<br>";

echo "<h3>Log de criação de usuário:</h3>";
$logs = $userManager7->getLogs();
foreach ($logs as $log) {
    echo $log . "<br>";
}