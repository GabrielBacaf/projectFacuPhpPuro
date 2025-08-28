Funcionamento do projeto:

Pages:

foi criado um layout que serve como base para os nossos projetos e todas as pagina que forem ser feitas tem que extender(incluir) o layout.
include_once __DIR__ . '/layout.php';

o css também vai ser erdado pelas a outras paginas, se reparar na pagina layout.php na parte do  <head>
  <link rel="stylesheet" href="../css/style.css"> <head> 
já tem o arquivo para referenciar o css que vai ser criado na pasta correspondente.

Service:

o service é o que executa a ação de fato.Sendo a pasta responsvel por fazer a comunicação com o msql(banco de dados), então é o lugar para colocarmos as funcões de salvar, editar, atualizar e deletar;
Toda a vez que precisar fazer algo com o banco vc precisa usar a função que foi criada para comunicar com o banco conectaBanco() que está na pasta  config.

 Controller:
 Todas as requisições vão ser enviadas para o controler. É o intermediario que vai receber os dados da pagina e enviar para o service e delvolver os dados para a pagina.
  No caso do listagem, vai fazer o processo de buscar os dados no service e enviar para a pagina.
  

Ajuda extra, caso precise:

A conexão com o banco cria caso não exista o banco.Então não precisa se preocupar com isso.

Dicas para config o msql:
$server     = "localhost";
    $user       = "root";
    $password   = "";
    $basedados  = "projetophp";  // nome do banco que você vai usar
    $porta      = 3380;          // sua porta customizada

a porta pode ser a que está sendo usado pelo seu msqp que está rodando dentro do apche.

caso de problema, pode ser resolvido com isso:

c: \xamp\phPMyAdmin\config.inc
Alterando a porta para a qual vc vai usar;


