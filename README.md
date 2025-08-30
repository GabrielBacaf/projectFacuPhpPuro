Projeto PHP Puro
Estrutura do Projeto
Layout Base

O projeto possui um layout base que serve como referência para todas as páginas.
Todas as páginas devem incluir esse layout utilizando:

include_once DIR . '/layout.php';


Dessa forma, o CSS definido no layout será automaticamente herdado por todas as páginas, garantindo consistência visual.
O arquivo layout.php já contém a referência ao CSS que será criado na pasta correspondente, então não é necessário vincular o estilo manualmente em cada página.

Service
Projeto PHP Puro
Estrutura do Projeto
Layout Base


Service

A pasta Service é responsável por executar as ações relacionadas ao banco de dados.
Ela contém funções para salvar, editar, atualizar e deletar registros.
Sempre que for necessário interagir com o banco, deve-se utilizar a função conectaBanco() presente na pasta config, que garante a comunicação correta com o banco e evita duplicação de código.


Controller

O Controller atua como intermediário entre as páginas e os serviços.
Ele recebe os dados enviados pelas páginas, envia esses dados para o service executar as ações necessárias e retorna os resultados para a página.
Por exemplo, em uma listagem, o controller solicita os dados ao service e os envia para a página que fará a exibição das informações.

Configuração do Banco de Dados
O Controller atua como intermediário entre as páginas e os serviços.
Ele recebe os dados enviados pelas páginas, envia esses dados para o service executar as ações necessárias e retorna os resultados para a página.
Por exemplo, em uma listagem, o controller solicita os dados ao service e os envia para a página que fará a exibição das informações.

Configuração do Banco de Dados

A conexão com o banco de dados é configurada para criar o banco caso ele não exista, portanto não é necessário criar manualmente.

Parâmetros padrão de conexão MySQL:

$server = "localhost";
$user = "root";
$password = "";
$basedados = "projetophp";
$porta = 3380; da sua preferencia


A porta deve corresponder à utilizada pelo MySQL no Apache.
Caso ocorram problemas de conexão, é possível alterar a porta diretamente no arquivo:
C:\xampp\phpMyAdmin\config.inc.php.

