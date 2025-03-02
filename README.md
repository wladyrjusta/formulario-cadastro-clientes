Formulário de Cadastro de Clientes
Este é um projeto simples para inserção de clientes, criado como um exercício de integração entre PHP, HTML e MySQL. O objetivo é demonstrar como utilizar essas tecnologias juntas para criar um formulário web e armazenar os dados no banco de dados MySQL.

Pré-requisitos
Antes de começar, certifique-se de ter o Docker instalado na sua máquina. O Docker é uma plataforma que permite criar, implantar e executar aplicações em containers, garantindo que o ambiente de desenvolvimento seja o mesmo em qualquer máquina.


Instalando o Docker
Siga as instruções oficiais para instalar o Docker:

Docker para Windows
Docker para Mac
Docker para Linux


Instruções para rodar o projeto
Clone o repositório:
git clone https://github.com/wladyrjusta/formulario-cadastro-clientes.git
cd formulario-cadastro-clientes



Inicialize o Docker Compose:

O Docker Compose vai criar e iniciar os containers necessários para o projeto, incluindo o servidor web (PHP) e o banco de dados MySQL.
docker-compose up -d


Acesse o projeto no navegador:

Abra o seu navegador e vá para http://localhost:8080


Como Funciona
Preencher o formulário: O usuário preenche os campos do formulário (Nome, CPF, E-mail, Data de Nascimento) e clica em "Enviar".
Processar o formulário: Os dados são enviados para o script processa_cliente.php, que valida e insere os dados no banco de dados MySQL.
Exibir os dados: Após a inserção, o script exibe uma mensagem de sucesso ou erro e mostra a tabela com todos os clientes cadastrados.


Encerrando o Projeto
Para parar e remover os containers, volumes e redes criados pelo Docker Compose, execute:
docker-compose down -v
