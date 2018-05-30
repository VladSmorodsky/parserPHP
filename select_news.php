<?php include "templates/header.php"; ?>

<?php
require_once ("lib/sql.php");

$s = $connection->prepare("SELECT * FROM table_content Order by DATE(date) limit 3");
$s->execute();

while ($content = $s->fetch(PDO::FETCH_OBJ)){
    try{
        echo "<h1>$content->title</h1>";
        echo "<p>$content->date</p>";
        echo "<div class='img'><img src='$content->img'></div>";
        echo "<div class='description'>$content->description</div>";
        echo "<hr>";
    }
    catch (Exception $e){
        $e->getMessage();
    }
}

?>

<?php include "templates/footer.php"; ?>

