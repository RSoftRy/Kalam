<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

exige_login();

// Edite esta lista: uma linha por referência.
$referencias = [
  [
        'titulo'    => 'Capitalismo no Enem: características, fases, questões e mais!',
        'url'       => 'https://vestibulares.estrategia.com/portal/materias/geografia/capitalismo/',
        'descricao' => 'Estratégia Vestibulares, 2021.',
    ],
    [
        'titulo'    => 'Revolução russa: o stalinismo e os planos quinquenais',
        'url'       => 'https://militares.estrategia.com/portal/materias-e-dicas/historia/revolucao-russa-o-stalinismo-e-os-planos-quinquenais/',
        'descricao' => 'Estratégia Vestibulares, 2023.',
    ],
    [
        'titulo'    => 'Mais-valia',
        'url'       => 'https://www.historiadomundo.com.br/idade-contemporanea/mais-valia.htm',
        'descricao' => 'Historia do Mundo.',
    ],
    [
        'titulo'    => 'Da crise de 1929 ao New Deal',
        'url'       => 'https://www.preparaenem.com/historia/da-crise-1929-ao-new-deal.htm',
        'descricao' => 'PrePara Enem.',
    ],
    [
        'titulo'    => 'Guerra do Afeganistão de 1979',
        'url'       => 'https://www.preparaenem.com/historia/guerra-afeganistao-1979.htm',
        'descricao' => 'PrePara Enem.',
    ],
    [
        'titulo'    => 'Questões sobre Capitalismo',
        'url'       => 'https://www.todamateria.com.br/questoes-sobre-capitalismo/',
        'descricao' => 'Toda Materia.',
    ],
    [
        'titulo'    => 'Guerra Fria: o que foi, suas causas e consequências (resumo)',
        'url'       => 'https://www.todamateria.com.br/guerra-fria/',
        'descricao' => 'Toda Materia.',
    ],
    [
        'titulo'    => 'Corrida Espacial',
        'url'       => 'https://www.todamateria.com.br/corrida-espacial/',
        'descricao' => 'Toda Materia.',
    ],
    [
        'titulo'    => 'Muro de Berlim: história e construção',
        'url'       => 'https://www.todamateria.com.br/muro-de-berlim/',
        'descricao' => 'Toda Materia.',
    ],
];

cabecalho('Referências');
?>
<p class="migalha"><a href="trilha.php">Trilha</a> / Referências</p>

<h1>Referências</h1>
<p class="nota">Fontes e leituras usadas no conteúdo da trilha.</p>

<section class="cartao">
  <?php if (!$referencias): ?>
    <p class="nota">Nenhuma referência cadastrada ainda.</p>
  <?php else: ?>
    <ul class="lista-aulas">
      <?php foreach ($referencias as $r): ?>
        <li>
          <a href="<?= e($r['url']) ?>" target="_blank" rel="noopener noreferrer"><?= e($r['titulo']) ?></a>
          <?php if (!empty($r['descricao'])): ?>
            <p class="nota"><?= e($r['descricao']) ?></p>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>

<div class="acoes">
  <a class="botao secundario" href="trilha.php">Voltar à trilha</a>
</div>
<?php rodape(); ?>