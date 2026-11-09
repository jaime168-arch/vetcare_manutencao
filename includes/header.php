<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$titulo = $titulo ?? 'VetCare';

// Verifica se a página atual está dentro de uma subpasta (como /tutores, /animais, etc)
$em_subpasta = file_exists('../assets/style.css');
$prefixo = $em_subpasta ? '../' : './';
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($titulo) ?> | VetCare</title>
<link rel="stylesheet" href="<?= $prefixo ?>assets/style.css">
</head>
<body>
<header class="topbar">
  <a class="brand" href="<?= $prefixo ?>index.php">🐾 VetCare</a>
  <nav>
    <?php if (!empty($_SESSION['usuario_id'])): ?>
      <a href="<?= $prefixo ?>index.php">Painel</a>
      <a href="<?= $prefixo ?>tutores/index.php">Tutores</a>
      <a href="<?= $prefixo ?>animais/index.php">Animais</a>
      <a href="<?= $prefixo ?>consultas/index.php">Consultas</a>
      <a href="<?= $prefixo ?>chamados/index.php">Suporte</a>
      <a href="<?= $prefixo ?>logout.php">Sair</a>
    <?php endif; ?>
  </nav>
</header>
<main class="container">