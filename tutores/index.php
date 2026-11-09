<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();

$titulo = 'Tutores';
$busca = trim($_GET['busca'] ?? '');

// Busca considerando o nome completo digitado
if ($busca !== '') {
    $sql = "SELECT * FROM tutores WHERE nome LIKE ? ORDER BY nome";
    $param = ['%' . $busca . '%'];
} else {
    $sql = "SELECT * FROM tutores ORDER BY nome";
    $param = [];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($param);
$rows = $stmt->fetchAll();

include __DIR__ . '/../includes/header.php';
?>

<h1>Tutores</h1>
<p class="muted">Cadastro e consulta de responsáveis pelos animais.</p>

<div class="actions">
    <a class="btn" href="form.php">+ Novo tutor</a>
</div>

<section class="panel">
    <form method="get">
        <div class="field">
            <label>Buscar tutor</label>
            <input name="busca" placeholder="Digite o nome" value="<?= htmlspecialchars($busca) ?>">
        </div>
        <button>Buscar</button>
    </form>
</section>

<div class="panel table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="5">Nenhum tutor encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['nome']) ?></td>
                        <td><?= htmlspecialchars($r['telefone']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td><?= $r['ativo'] ? 'Ativo' : 'Inativo' ?></td>
                        <td>
                            <a href="form.php?id=<?= $r['id'] ?>">Editar</a> | 
                            <a href="excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Deseja realmente excluir este tutor?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>