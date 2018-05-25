<?php include "templates/header.php"; ?>
<?php
require_once ("lib/sql.php");

$statement = $connection->prepare("SELECT description from table_content");
$statement->execute();

while($row=$statement->fetch(PDO::FETCH_OBJ))
try{
/*its getting data in line.And its an object*/
        echo $row->description;
    } catch(PDOException  $e ){
echo "Error: ".$e;
}
?>

<?php include "templates/footer.php"; ?>

