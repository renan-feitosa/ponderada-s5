# Ponderada Semana 5

## Desenvolvimento de um Sistema de Anotações na AWS com PHP e MariaDB

### 📖 Introdução

Neste readme, está descrito o processo de instalação, criação e configuração de uma aplicação básica em PHP para adição e listagem de anotações armazenados em um banco de dados MariaDB na infraestrutura da AWS. A aplicação PHP será implantada em uma instância EC2, enquanto o banco de dados MariaDB será hospedado em um serviço RDS.

### 📁 Estrutura de pastas

|--> imagens<br>
|--> src<br>
  &emsp;|--> CMD.md<br>
  &emsp;|--> NOTES.sql<br>
  &emsp;|--> Notes.php<br>
| readme.md<br>


### ⚙️ Configuração AWS

- Criei uma instância EC2 para hospedar a aplicação PHP. 

- Criei uma instância RDS para hospedar o banco de dados MariaDB.

Durante a criação, configurei as opções de instância, como tipo de instância, capacidade de armazenamento e configurações de segurança.

### ⚙️ Configuração da Instância EC2

Conectei à instância EC2 via SSH pelo CMD e, seguindo o tutorial, instalei o servidor web Apache e o interpretador PHP.

A EC2 foi configurada com o sistema operacional Amazon Linux, com key pair `ponderada-s5-kp.pem`.

### ⚙️ Configuração do Banco de Dados RDS

Foi decidido usar o MariaDB como banco de dados para armazenar as anotações, sendo esta escolha por ser padrão do tutorial utilizado como base para a criação da aplicação, disponível em <a src="https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.CreateWebServer.html#CHAP_Tutorials.WebServerDB.CreateWebServer.Apache">Install a web server on your EC2 instance</a>. O database inclui uma tabela chamada `NOTES` com os seguintes campos:
- `ID`: Identificador único para cada anotação | Int.
- `PRIORITY`: Prioridade da nota | Int.
- `NOTE`: Texto da nota | String.
- `AUTHOR`: Autor da nota | String.
- `CREATION_DATE`: Data de criação da nota | Date.