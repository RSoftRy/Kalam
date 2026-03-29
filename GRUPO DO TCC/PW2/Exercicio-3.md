### Ao executar o arquivo no navegador
Na primeira execução, o PHP envia o **Set-Cookie** para o navegador
Esse codigo diz para o navegador guardar o cookie **contador=1** por 1 hora
Mas, nessa mesma requisição, o **$_COOKIE["contador"]** ainda não existe no servidor
Por isso aparece: “Cookie ainda não disponível.”

### Ao atualizar a página
Na segunda execução, o navegador já envia o cookie salvo junto
Agora o PHP consegue ler **$_COOKIE["contador"]**
Então a mensagem exibida vai ser: “Valor do cookie: 1”
Isso mostra que o cookie passou a estar disponível após a primeira execução

### Ao abrir as ferramentas do navegador e ver os cookies
Nas ferramentas do navegador, o cookie contador aparece na lista de cookies do site
Mostra o nome, o valor 1 e o tempo de expiração confirmando que o navegador
realmente armazenou o cookie. O cookie fica associado ao domínio e ao
caminho da página

### Ao limpar os cookies e atualizar novamente
Depois de limpar os cookies, o navegador deixa de enviar contador
Na próxima atualização, o PHP não encontrará esse cookie no **$_COOKIE**
fazendo a proxima página voltar a mostrar: “Cookie ainda não disponível.”
Em seguida, o código executa **setcookie()** de novo e cria o cookie outra vez

### Por que o cookie não aparece imediatamente na primeira execução?
Porque **setcookie()** não altera os cookies na mesma execução da página,
ele apenas envia uma instrução ao navegador, por meio de um cabeçalho HTTP,
para que o cookie seja salvo ao final da resposta atual.
Além disso, os cookies representam apenas os dados que o navegador já enviou ao servidor em requisições anteriores,
ou seja, o PHP não tem acesso imediato a valores que ainda não retornaram do cliente.
O cookie só será incluído pelo navegador na próxima requisição feita ao mesmo domínio,
Por isso, o valor do cookie só se torna visível no código após atualizar a página,
quando então ele passa a existir dentro da variável **$_COOKIE**.
