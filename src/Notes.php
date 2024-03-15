<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Anotações</h1>

<h4>Prioridades:</h4>
<ul>
  <li>1 - Alta</li>
  <li>2 - Média</li>
  <li>3 - Baixa</li>
</ul>

<?php

/* Conectar ao MySQL e selecionar o banco de dados. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

/* Garantir que a tabela NOTES exista. */
VerifyNotesTable($connection, DB_DATABASE);

/* Se os campos de entrada estiverem preenchidos, adicione uma linha à tabela NOTES. */
$note_priority = htmlentities($_POST['PRIORITY']);
$note_text = htmlentities($_POST['NOTE']);
$note_author = htmlentities($_POST['AUTHOR']);
$note_creation_date = date('Y-m-d');

if (strlen($note_text) || strlen($note_author)) {
  AddNote($connection, $note_priority, $note_text, $note_author, $note_creation_date);
}
?>

<!-- Formulário de Entrada -->
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>PRIORIDADE</td>
      <td>NOTA</td>
      <td>AUTOR</td>
    </tr>
    <tr>
      <td>
        <input type="number" name="PRIORITY" min="1" />
      </td>
      <td>
        <input type="text" name="NOTE" maxlength="255" size="60" />
      </td>
      <td>
        <input type="text" name="AUTHOR" maxlength="45" size="30" />
      </td>
      <td>
        <input type="submit" value="Adicionar Nota" />
      </td>
    </tr>
  </table>
</form>

<!-- Exibir dados da tabela. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>PRIORIDADE</td>
    <td>NOTA</td>
    <td>AUTOR</td>
    <td>DATA DE CRIAÇÃO</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM NOTES");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>";
  echo "</tr>";
}
?>

</table>

<!-- Limpar. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>


<?php

/* Adicionar uma nota à tabela. */
function AddNote($connection, $priority, $note, $author, $creation_date) {
   $p = mysqli_real_escape_string($connection, $priority);
   $n = mysqli_real_escape_string($connection, $note);
   $a = mysqli_real_escape_string($connection, $author);
   $d = mysqli_real_escape_string($connection, $creation_date);

   $query = "INSERT INTO NOTES (PRIORITY, NOTE, AUTHOR, CREATION_DATE) VALUES ('$p', '$n', '$a', '$d');";

   if(!mysqli_query($connection, $query)) echo("<p>Erro ao adicionar a nota.</p>");
}

/* Verificar se a tabela existe e, se não existir, criá-la. */
function VerifyNotesTable($connection, $dbName) {
  if(!TableExists("NOTES", $connection, $dbName))
  {
     $query = "CREATE TABLE NOTES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         PRIORITY INT,
         NOTE VARCHAR(255),
         AUTHOR VARCHAR(45),
         CREATION_DATE DATE
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Erro ao criar a tabela.</p>");
  }
}

/* Verificar a existência de uma tabela. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>
