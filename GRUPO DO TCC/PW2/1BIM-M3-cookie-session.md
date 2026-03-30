## Exercicio 1
### Diferença entre Cookies e Sessions

Os Cookies armazenam as informações no navegador do usúario (podem ficar salvas mesmo se o usuário fechar a guia), já as sessions armazenam no servidor (enquanto a sessão do usuário estiver ativa, os dados ficarão lá). Os Cookies tem menos segurança que as Sessions, pois eles podem ser acessados ou alterados pelo próprio usuário, enquanto as Sessions apenas ficam armazenadas no servidor, sendo inacessiveís ao usuário.
Os momentos corretos para se usar os Cookies são:
- Para gguardar preferências do usuário (tema (cor da tela), idioma)
- Para informações não sensíveis do usuário, por tanto, coisas que mão sejam senhas ou documentos pessoais.
- Para armazenar dados que precisam persistir por mais tempo

Já os momentos corretos para se usar as Sessions são:
- Fazer a autenticação do usuário
- Para guardar dados sensíveis


  
## Exercicio 3

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

## Exercício 4

Por que Sessions são geralmente preferidas para autenticação de usuários em sistemas web?

Resposta:

Sessions são preferíveis pela maior segurança. Elas detém um período de interação de informações entre o usuário e o sistema, e com elas os dados 
são armazenados no servidor, não no navegador do usuário- de fácil acesso para modificações, e então instabilidades nos dados, resultando em ameaça à privacidade. Além disso as sessions não possuem tamanho limitado, tornando-as flexíveis.
Então, quando estas são usadas para autenticação do usuário, o processo de legitimidade da identidade do usuário é mais efetivo e concreto.
Já na utilização de cookies, os dados são armazenados no navegador do usuário, causando vulnerabilidade pela facilidade de acesso e modificação
a esses dados; além da desvantagem do espaço limitado. Dessa forma, pode ocorrer: criação de perfis para monitoramento do usuário, 
rastreamento de atividades onlines por cookies de terceiro (cookies de sites que não estão sendo diretamente acessados pelo usuário), roubo de
informações pessoais, malware, etc.



Referências:

https://kfcdicasdigital.com/glossario/o-que-e-session-entenda-o-conceito-de-session/
https://olhardigital.com.br/2024/02/23/seguranca/aceitar-cookies-e-seguro-veja-quando-pratica-e-um-risco/#google_vignette
