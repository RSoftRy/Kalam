<?php
 
/* ============================================================
   CONFIGURAÇÃO GERAL
   ============================================================ */
 
$chave = "minha-chave";
 
$texto = "";
$tipo  = "";
$erro  = "";
 
/*
 * As chaves RSA estão diretamente no código apenas para a demonstração
 * desta atividade. Em uma aplicação real, a chave privada deve
 * ficar protegida e fora do código-fonte público.
 */
 
$chavePublica = <<<'KEY'
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4aOtYKx43stwlfKVg0yg
9XrBYwJW/+PvobcbNBzyAIJL4Jvt0MGrj70F5Enjye8dgXgbvu8X5qKytrSB3UNu
r5KxBzrRCETjq9HA+jsoah9rkd6vGbosB/GtkFFtNGTi9mwblKS5oVoMuTPsTtFl
Lqkhg4EY/X5MiO4Kj5qKRFg0yOT5FUjj3IghX7W7nN++No8LLrje040mCQfrao1i
wtBMoYqKYqRO67Vy3+FUkuOwM+cpH3a9AppEGGj1sWzKGUCfRYL0/idWPvbM6+qp
+Hqo8h2qao8WnYyWTeiV1xDPT5YkNgxGCXhRS+Gyg0ILRaAzQOgMNw4Yvha2zcDI
KQIDAQAB
-----END PUBLIC KEY-----
KEY;
 
$chavePrivada = <<<'KEY'
-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDho61grHjey3CV
8pWDTKD1esFjAlb/4++htxs0HPIAgkvgm+3QwauPvQXkSePJ7x2BeBu+7xfmorK2
tIHdQ26vkrEHOtEIROOr0cD6OyhqH2uR3q8ZuiwH8a2QUW00ZOL2bBuUpLmhWgy5
M+xO0WUuqSGDgRj9fkyI7gqPmopEWDTI5PkVSOPciCFftbuc3742jwsuuN7TjSYJ
B+tqjWLC0EyhiopipE7rtXLf4VSS47Az5ykfdr0CmkQYaPWxbMoZQJ9FgvT+J1Y+
9szr6qn4eqjyHapqjxadjJZN6JXXEM9PliQ2DEYJeFFL4bKDQgtFoDNA6Aw3Dhi+
FrbNwMgpAgMBAAECggEAEzZg2aGt5AiOBFKEvQqODQDgDQpitoSlv48MA66wQ29U
vyH/yJ3o+gL2CLdq7COOT1sW/7WzgwmY7nolsZ2fg9cZeDxflpTpDtT8GcJmQUz+
F4xOvAHQZHfFV8u7IPIzKhjP62LwRGcavL1JUne9ZhD0H9Ki+lih8ynTn+Egg0uX
eVGOj2Y0hMIJRMnfNYsdvnzmaPKT3E5Z6JewVob+tYUufmUot8iEwLOS37blLfCB
JhBJsW0IWOz2jP3RyZpKFWY14j0oLAaNtNcYm0bnkY6MF43eNyYiNddlfsodd24h
p/qsugJH4FtpELRs3w5VkqFp/cdO+yXHRqGnty7fQQKBgQD06WnVzzHVIdTHzBBj
UhapQIv32VdHdwp+kSYQywlbmEs4vylEJxo0ATY888snkYKjVHAieWAUpm20ZOsj
81fGMKqiqqVHA1EwpdSaKOdYQUFITy4O99gz201L66yKIIBRF0HIXSWg/u3C/cxi
zju0aSw47ATHcxiZh1AJTbr7oQKBgQDr2uRZQq7dgYZmzv3Z9vpW7/7h7pW/69FJ
kvHVYiE2J2qv0zX/HabeJ43x4uBJqZ8GWvpM0WKavJ1By06fejR0bCUeXE/hd6S9
OTc8I0WeAmjjBepaf44er4B/2vDgpRe1dhM0jrUgcQbWdnpCGCFvR8H++quQKjGB
oGivRhO/iQKBgQCC6xcpNSXlUb1lxF7qSOJWPWvU5Li0Oh1BBSQ9C9wHu4RSZFWR
2fk23YL52DS8BRu5ZZS/yPQkdcblDKFpyVYdWryMUf4h1NMc1zir47uvQMq99Z2g
YLqRFeTe9a948uDE+FKw4aIQytWcS4FrO+VMjoAWOYxgddUrlNqi7otKoQKBgGNu
c6hB2ZCeo3fCOfjjC2UNZqn/OHihxSi8X2GzLgczlOGtLG1yJcAwcsIQALhtXxKB
1lX+TBCqBa4QNQQ8s9KFKRzkk/ScyQHRFj0vLZFQuMFE5Cjk75h2Krk8JyK91wH0
VmJo62lS3Swa5K3qmGXenaWOLjfn4dkhNCD4bSjpAoGAeEY2vizaGXDnB7SN2gQD
6PleTHDnFClV3X60LOhQpANe/GEmTiwcKFEiUbWOO/fqTPFHWEy61/nFOscdNLZl
TpwbN/qlrMGKQs17o/e4bALkjmcX4cRg0LNfKlMfgHhEh5lXXg16yfNGXxdfwsa5
64WNT7mr5G6gMGybPe/JvX8=
-----END PRIVATE KEY-----
KEY;
 
/* Resultados que serão preenchidos conforme o tipo escolhido */
$resultado = [];
 
/* 
   PROCESSAMENTO DO FORMULÁRIO
*/
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $texto = trim($_POST["texto"] ?? "");
    $tipo  = $_POST["tipo"] ?? "";
 
    if ($texto === "") {
 
        $erro = "Digite uma informação antes de criptografar.";
 
    } elseif ($tipo === "simetrica") {
 
        /* CRIPTOGRAFIA SIMÉTRICA (AES-256-CBC) */
 
        $iv       = random_bytes(openssl_cipher_iv_length("AES-256-CBC"));
        $chaveAES = hash("sha256", $chave, true);
 
        $criptografado = openssl_encrypt($texto, "AES-256-CBC", $chaveAES, 0, $iv);
        $descriptografado = openssl_decrypt($criptografado, "AES-256-CBC", $chaveAES, 0, $iv);
 
        $resultado = [
            "Texto original"    => $texto,
            "Criptografado"     => base64_encode($criptografado),
            "Descriptografado"  => $descriptografado,
        ];
 
    } elseif ($tipo === "base64") {
 
        /* CRIPTOGRAFIA SIMÉTRICA + BASE64
           (o Base64 aqui serve para transformar o IV + o texto
           criptografado em uma string segura para armazenar/transmitir,
           conforme mostrado na pesquisa) */
 
        $iv       = openssl_random_pseudo_bytes(16);
        $chaveAES = hash("sha256", $chave, true);
 
        $criptografado = openssl_encrypt($texto, "AES-256-CBC", $chaveAES, 0, $iv);
        $criptografado_base64 = base64_encode($iv . $criptografado);
 
        $dados            = base64_decode($criptografado_base64);
        $iv_recuperado    = substr($dados, 0, 16);
        $texto_cripto     = substr($dados, 16);
        $descriptografado = openssl_decrypt($texto_cripto, "AES-256-CBC", $chaveAES, 0, $iv_recuperado);
 
        $resultado = [
            "Texto original"                => $texto,
            "IV + criptografado em Base64"  => $criptografado_base64,
            "Descriptografado"              => $descriptografado,
        ];
 
    } elseif ($tipo === "assimetrica") {
 
        /* CRIPTOGRAFIA ASSIMÉTRICA - RSA */
 
        $textoCriptografado    = "";
        $textoDescriptografado = "";
 
        if (!openssl_public_encrypt($texto, $textoCriptografado, $chavePublica, OPENSSL_PKCS1_OAEP_PADDING)) {
 
            $erro = "Erro ao criptografar com a chave pública.";
 
        } elseif (!openssl_private_decrypt($textoCriptografado, $textoDescriptografado, $chavePrivada, OPENSSL_PKCS1_OAEP_PADDING)) {
 
            $erro = "Erro ao descriptografar com a chave privada.";
 
        } else {
 
            $resultado = [
                "Texto original"                       => $texto,
                "Criptografado com a chave pública"    => base64_encode($textoCriptografado),
                "Descriptografado com a chave privada" => $textoDescriptografado,
            ];
        }
 
    } elseif ($tipo === "hashing") {
 
        /* HASHING */
 
        $hash         = password_hash($texto, PASSWORD_DEFAULT);
        $senhaValida  = password_verify($texto, $hash);
 
        $resultado = [
            "Texto original"                    => $texto,
            "Hash gerado com password_hash()"   => $hash,
            "Verificação com password_verify()" => $senhaValida ? "Senha válida!" : "Senha inválida!",
        ];
 
    } elseif ($tipo === "md5") {
 
        /* MD5 */
 
        $md5 = md5($texto);
 
        $resultado = [
            "Texto original" => $texto,
            "Hash MD5"       => $md5,
        ];
 
    } else {
 
        $erro = "Selecione um tipo de criptografia.";
    }
}
 
$opcoes = [
    "simetrica"   => "Criptografia Simétrica (AES-256-CBC)",
    "base64"      => "Base64 (com Criptografia Simétrica)",
    "assimetrica" => "Criptografia Assimétrica (RSA)",
    "hashing"     => "Hashing (password_hash)",
    "md5"         => "MD5",
];
 
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
 
<head>
 
    <meta charset="UTF-8">
    <title>Criptografia em PHP</title>
 
    <style>
 
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }
 
        h1 {
            text-align: center;
        }
 
        .card {
            background: white;
            padding: 20px;
            margin: 15px auto;
            max-width: 800px;
            border-radius: 10px;
        }
 
        .resultado {
            background: #111;
            color:rgb(109, 214, 255);
            padding: 15px;
            border-radius: 5px;
            word-break: break-word;
        }
 
        .erro {
            background: #ffe5e5;
            color: #a00000;
            padding: 15px;
            border-radius: 5px;
        }
 
        code {
            background: #eee;
            padding: 3px 6px;
        }
 
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
 
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 15px;
        }
 
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #2c7be5;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
        }
 
        button:hover {
            background: #1a5fc2;
        }
 
    </style>
 
</head>
 
<body>
 
<h1>Criptografia em PHP</h1>
 
<div class="card">
 
    <h2>Escolha a informação e o tipo de criptografia</h2>
 
    <form method="POST">
 
        <label for="texto">Insira a informação (ex: uma senha)</label>
        <input
            type="text"
            id="texto"
            name="texto"
            placeholder="Digite aqui a informação a ser criptografada"
            value="<?= htmlspecialchars($texto) ?>"
            required
        >
 
        <label for="tipo">Tipo de criptografia</label>
        <select id="tipo" name="tipo" required>
            <option value="">-- Selecione --</option>
            <?php foreach ($opcoes as $valor => $rotulo): ?>
                <option value="<?= $valor ?>" <?= $tipo === $valor ? "selected" : "" ?>>
                    <?= $rotulo ?>
                </option>
            <?php endforeach; ?>
        </select>
 
        <button type="submit">Criptografar</button>
 
    </form>
 
</div>
 
<?php if ($erro !== ""): ?>
 
    <div class="card">
        <div class="erro"><?= htmlspecialchars($erro) ?></div>
    </div>
 
<?php elseif (!empty($resultado)): ?>
 
    <div class="card">
 
        <h2><?= htmlspecialchars($opcoes[$tipo]) ?></h2>
 
        <?php foreach ($resultado as $rotulo => $valor): ?>
 
            <p><?= htmlspecialchars($rotulo) ?>:</p>
            <div class="resultado"><?= htmlspecialchars($valor) ?></div>
 
        <?php endforeach; ?>
 

    </div>
 
<?php endif; ?>
 
</body>
 
</html>
 