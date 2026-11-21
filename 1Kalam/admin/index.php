<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/layout.php';

exige_admin();

$nQuestoes = (int) $pdo->query('SELECT COUNT(*) FROM questoes')->fetchColumn();
$nAlunos   = (int) $pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo = 'aluno'")->fetchColumn();
$nTent     = (int) $pdo->query('SELECT COUNT(*) FROM tentativas WHERE finalizada_em IS NOT NULL')->fetchColumn();
$media     = $pdo->query('SELECT AVG(acertos) FROM tentativas WHERE finalizada_em IS NOT NULL')->fetchColumn();

$porTema = $pdo->query('SELECT tema, COUNT(*) AS n FROM questoes GROUP BY tema ORDER BY tema')->fetchAll();

cabecalho('Painel do administrador', '../');
?>
<h1>Painel do administrador</h1>

<section class="grade-numeros">
  <div class="numero"><span><?= $nQuestoes ?></span>questões no banco</div>
  <div class="numero"><span><?= $nAlunos ?></span>alunos cadastrados</div>
  <div class="numero"><span><?= $nTent ?></span>avaliações feitas</div>
  <div class="numero"><span><?= $media !== null && $media !== false ? number_format((float) $media, 1, ',', '') : '0' ?></span>média de acertos</div>
</section>

<section class="cartao">
  <h2>Questões por tema</h2>
  <ul class="historico">
    <?php foreach ($porTema as $t): ?>
      <li><?= e($t['tema']) ?>: <?= (int) $t['n'] ?></li>
    <?php endforeach; ?>
  </ul>
  <?php if ($nQuestoes < QTD_QUESTOES_PROVA): ?>
    <p class="aviso erro">O banco tem menos questões do que a avaliação sorteia (<?= (int) QTD_QUESTOES_PROVA ?>).</p>
  <?php endif; ?>
  <div class="acoes">
    <a class="botao" href="questoes.php">Gerenciar questões</a>
    <a class="botao secundario" href="questao_form.php">Nova questão</a>
  </div>
</section>
<?php rodape(); ?>
