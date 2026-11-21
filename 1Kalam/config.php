<?php
// Configuração do projeto Kalam.
define('DB_HOST', 'localhost');
define('DB_NAME', 'kalam');
define('DB_USER', 'root');
define('DB_PASS', '');

// Código exigido para criar uma conta de administrador. 
define('ADMIN_CODE', 'admin123');

// Quantas questões entram na avaliação final.
define('QTD_QUESTOES_PROVA', 10);

// Se true, o aluno só faz a prova depois de concluir as 10 aulas.
define('PROVA_EXIGE_TRILHA', false);
