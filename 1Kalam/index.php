<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

$qtd = (int) $pdo->query('SELECT COUNT(*) FROM questoes')->fetchColumn();
$u = usuario_logado();

cabecalho('Início');
?>
<section class="hero">
  <h1>Entenda a Revolução Russa e as ideias que a empurraram</h1>
  <p>Kalam é uma trilha de estudo sobre 1917, o comunismo e o capitalismo. São 10 aulas em 5 módulos, cada uma com um documento histórico, e uma avaliação final de <?= (int) QTD_QUESTOES_PROVA ?> questões sorteadas de um banco com <?= $qtd ?> questões.</p>
  <p>A ideia é simples: quem termina a trilha consegue explicar por que a Rússia czarista caiu, o que Marx e Adam Smith defendiam e como a URSS e os Estados Unidos chegaram à Guerra Fria. Um tema que ainda aparece nos debates políticos de hoje.</p>
  <div class="acoes">
    <?php if ($u): ?>
      <a class="botao" href="trilha.php">Ir para a trilha</a>
    <?php else: ?>
      <a class="botao" href="cadastro.php">Criar conta</a>
      <a class="botao secundario" href="login.php">Já tenho conta</a>
    <?php endif; ?>
  </div>
</section>
<?php rodape(); ?>
