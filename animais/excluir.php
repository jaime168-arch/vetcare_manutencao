<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    try {
        // Deleta APENAS o animal com o ID selecionado
        $stmt = $pdo->prepare("DELETE FROM animais WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        // Trata erros (ex: se o animal possuir registros vinculados em consultas)
        error_log("Erro ao excluir animal: " . $e->getMessage());
    }
}

// Redireciona de volta para a lista de animais
header('Location: index.php');
exit;