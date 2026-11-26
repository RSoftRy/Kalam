<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

const TEMAS  = ['Revolução Russa', 'Comunismo', 'Capitalismo', 'Guerra Fria'];
const LETRAS = ['a', 'b', 'c', 'd', 'e'];

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

// Conexão PDO. EMULATE_PREPARES desligado faz o MySQL tratar os parâmetros
// separadamente da consulta, que é a proteção contra SQL injection.
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $ex) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Confira o arquivo config.php.');
}

function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function redirecionar(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_campo(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_valido(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && is_string($_POST['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

function usuario_logado(): ?array
{
    return $_SESSION['usuario'] ?? null;
}

function exige_login(): array
{
    $u = usuario_logado();
    if (!$u) {
        redirecionar('login.php');
    }
    return $u;
}

// Usada somente pelas páginas dentro de /admin.
function exige_admin(): array
{
    $u = usuario_logado();
    if (!$u || $u['tipo'] !== 'admin') {
        redirecionar('login.php');
    }
    return $u;
}

function iniciar_sessao_usuario(array $u): void
{
    session_regenerate_id(true);
    $_SESSION['usuario'] = [
        'id'   => (int) $u['id'],
        'nome' => $u['nome'],
        'tipo' => $u['tipo'],
    ];
}

// Devolve apenas as alternativas preenchidas de uma questão, no formato letra => texto.
function alternativas(array $q): array
{
    $r = [];
    foreach (LETRAS as $l) {
        $txt = $q['alt_' . $l] ?? null;
        if ($txt !== null && $txt !== '') {
            $r[$l] = $txt;
        }
    }
    return $r;
}

function flash(string $msg, string $tipo = 'ok'): void
{
    $_SESSION['flash'] = ['msg' => $msg, 'tipo' => $tipo];
}
