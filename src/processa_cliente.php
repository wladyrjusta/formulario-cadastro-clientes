<?php
/***VALIDAÇÃO DOS DADOS RECEBIDOS DO FORMULÁRIO ***/
if ($_REQUEST['nome_cliente'] == "") {
    echo "O campo Nome não pode ficar vazio.";
    exit;
}

if (strlen($_REQUEST['cpf_cliente']) != 11) {
    echo "O campo CPF precisa ter 11 caracteres.";
    exit;
}

if (!stripos($_REQUEST['email_cliente'], "@") || !stripos($_REQUEST['email_cliente'], ".")) {
    echo "O campo E-mail não é válido.";
    exit;
}

if ($_REQUEST['data_nascimento_cliente'] == "") {
    echo "O campo Data de Nascimento não pode ficar vazio.";
    exit;
}
/***FIM DA VALIDAÇÃO DOS DADOS RECEBIDOS DO FORMULÁRIO ***/


/***CONEXÃO COM O BD ***/
//Constantes para armazenamento das variáveis de conexão.
define('HOST', 'db'); // Nome do serviço no docker-compose
define('PORT', '3306');
define('DBNAME', 'clientes'); // Certifique-se de que o nome do banco de dados esteja correto
define('USER', 'root');
define('PASSWORD', 'nova_senha');

try {
    // Ajustar o DSN para MySQL
    $dsn = new PDO("mysql:host=" . HOST . ";port=" . PORT . ";dbname=" . DBNAME, USER, PASSWORD);
    // Configurar o modo de erro do PDO para exceção
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'A conexão falhou e retorno a seguinte mensagem de erro: ' . $e->getMessage();
    exit;
}
/*** FIM DOS CÓDIGOS DE CONEXÃO COM O BD ***/


/***PREPARAÇÃO E INSERÇÃO NO BANCO DE DADOS ***/
$stmt = $dsn->prepare("INSERT INTO cliente(nome_cliente, cpf_cliente, email_cliente, data_nascimento_cliente)
                        VALUES (?, ?, ?, ?)");

$resultSet = $stmt->execute([
    $_REQUEST['nome_cliente'], 
    $_REQUEST['cpf_cliente'], 
    $_REQUEST['email_cliente'], 
    $_REQUEST['data_nascimento_cliente']
]);


/*** EXIBIR MENSAGEM E TABELA ***/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulário HTML - Cadastro de Clientes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($resultSet) {
                    echo "<div class='alert alert-success' role='alert'>Os dados foram inseridos com sucesso.</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Ocorreu um erro e não foi possível inserir os dados.</div>";
                }

                // Query para buscar todos os dados da tabela cliente
                $stmt = $dsn->query("SELECT * FROM cliente");

                // Verificar se a consulta retornou resultados
                if ($stmt->rowCount() > 0) {
                    echo "<table class='table'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>#</th>
                                    <th scope='col'>Nome</th>
                                    <th scope='col'>CPF</th>
                                    <th scope='col'>E-mail</th>
                                    <th scope='col'>Data de Nascimento</th>
                                </tr>
                            </thead>
                            <tbody>";

                    // Loop para exibir cada linha da tabela
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <th scope='row'>{$row['id_cliente']}</th>
                                <td>{$row['nome_cliente']}</td>
                                <td>" . preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $row['cpf_cliente']) . "</td>
                                <td>{$row['email_cliente']}</td>
                                <td>" . date('d/m/Y', strtotime($row['data_nascimento_cliente'])) . "</td>
                              </tr>";
                    }

                    echo "</tbody>
                          </table>";
                } else {
                    echo "<div class='alert alert-info' role='alert'>Nenhum cliente cadastrado.</div>";
                }

                // Destruindo o objeto statement e fechando a conexão
                $stmt = null;
                $dsn = null;
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
