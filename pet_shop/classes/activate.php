<?php
if (!isset($_GET['email']) || !isset($_GET['activation_code'])) {
    // Redirect to the home page.
    header('Location: /');
    exit;
}

$email = $_GET['email'];
$activationCode = $_GET['activation_code'];

$user = User::findOne(['email' => $email]);
if (!$user) {
    // Redirect to the home page.
    header('Location: /');
    exit;
}

if ($user->activationCodeExpired) {
    // Redirect to the register page.
    header('Location: /register');
    exit;
}

if ($user->activationCode !== $activationCode) {
    // Redirect to the register page.
    header('Location: /register');
    exit;
}

// Mark the user record as active.
$user->activationCodeExpired = true;
$user->save();

// Redirect to the login page.
header('Location: /login');
?>
