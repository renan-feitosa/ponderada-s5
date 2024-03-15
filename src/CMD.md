
```
ssh -i ponderada-s5-kp.pem ec2-user@ec2-54-87-30-220.compute-1.amazonaws.com
```
Este comando estabelece uma conexão SSH com uma instância EC2 na Amazon Web Services usando uma chave privada chamada ```ponderada-s5-kp.pem``` e o nome de usuário ```ec2-user```.

<hr>

```
sudo dnf update -y
```

Atualiza todos os pacotes do sistema usando o gerenciador de pacotes DNF, e a opção `-y` indica que o processo deve prosseguir automaticamente, sem exigir interação do usuário.

<hr>

```
sudo dnf install -y httpd php php-mysqli mariadb105
```
Usa o gerenciador de pacotes DNF para instalar os pacotes necessários para configurar um ambiente de desenvolvimento web. Isso inclui o servidor web Apache (httpd), PHP e suas extensões (php e php-mysqli), bem como o banco de dados MariaDB versão 10.5 (mariadb105).

<hr>

```
cat /etc/system-release
```
Exibe o conteúdo do arquivo `/etc/system-release`, que normalmente contém informações sobre a distribuição Linux e sua versão.

<hr>

```
sudo systemctl start httpd
```
Inicia o serviço do servidor web Apache.

<hr>

```
sudo systemctl enable httpd
```
Configura o servidor web Apache para iniciar automaticamente durante o boot do sistema.

<hr>

```
sudo usermod -a -G apache ec2-user
```
Adiciona o usuário `ec2-user` ao grupo `apache`. Isso concede permissões específicas ao usuário para acessar certos recursos.

<hr>

```
sudo chown -R ec2-user:apache /var/www
```
Altera o proprietário e o grupo do diretório `/var/www` para `ec2-user` e `apache`, respectivamente. Isso serve para garantir que o usuário possa manipular arquivos no diretório, enquanto o servidor web tenha permissão para acessá-los.

<hr>

```
sudo chmod 2775 /var/www
```
Define permissões no diretório `/var/www`, garantindo que novos arquivos e diretórios criados dentro dele herdem as permissões do diretório pai.

<hr>

```
find /var/www -type d -exec sudo chmod 2775 {} \;
```
Recursivamente define permissões nos diretórios dentro de `/var/www`, garantindo que todos os diretórios tenham as permissões corretas.

<hr>

```
find /var/www -type f -exec sudo chmod 0664 {} \;
```
Recursivamente define permissões nos arquivos dentro de `/var/www`, garantindo que todos os arquivos tenham as permissões corretas.

<hr>

```
cd /var/www && mkdir inc && cd inc
```
Navega até `/var/www`, cria um diretório chamado `inc` e navega até ele. Este é um diretório comumente usado para armazenar arquivos de inclusão (como configurações de banco de dados).

<hr>

```
>dbinfo.inc
```
Cria um arquivo vazio chamado `dbinfo.inc`. Este pode ser um arquivo usado para armazenar informações de configuração do database.

<hr>

```
nano dbinfo.inc
```
Abre o arquivo `dbinfo.inc` no editor de texto Nano para edição. Isso permite a inserção de informações de configuração do banco de dados, como nome de usuário, senha e nome do banco de dados.

<hr>

```
cd /var/www/html && >Notes.php && nano Notes.php
```
Navega até o diretório `/var/www/html`, cria um arquivo vazio chamado `Notes.php` e, em seguida, abre-o no editor Nano para edição. Este arquivo é usado para criar uma página web dinâmica em PHP.