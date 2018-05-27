<?php include "templates/header.php"; ?>
<?php
require_once ("lib/sql.php");



$statement = $connection->prepare("SELECT table_content.description, description_anchors.text FROM table_content LEFT JOIN description_anchors ON table_content.id = description_anchors.id_content ORDER BY (SELECT )");
$statement->execute();
$content = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($content);

/*foreach ($content as $el => $c){
    var_dump($c);
    if (){
        echo  '<a href="'.  $link['src'].'">' . $link['text']. '</a></br>';
        $position = strpos($c["description"], $link["text"]);
        //var_dump($position);
        //var_dump(strlen($href->text));
        //var_dump($row->id == $href->id_content);
        echo substr_replace($c->description,"<a href=".$link["src"].">".$link["text"]."</a>",$position,strlen($link["text"]));
        echo "-------------------------------------";
    }
}*/


/*while($row=$statement->fetch())
try{
    //var_dump($hrefs);
    //var_dump(count($hrefs->fetchAll(PDO::FETCH_OBJ)));
        while ($href = $hrefs->fetch()){

            //var_dump($row->id)."|";
            //var_dump($href->id_content);
            if ((int)$row->id == (int)$href->id_content){
                $position = strpos($row->description, $href->text);
                var_dump($position);
                //var_dump(strlen($href->text));
                //var_dump($row->id == $href->id_content);
                echo substr_replace($row->description,"<a href='$href->src'>$href->text</a>",$position,strlen($href->text));
                echo "-------------------------------------";
            }
            echo "-------------------------------------";
            if (!$position)
                continue;
        }

    echo $row->id;
    echo "<h1>$row->title</h1>";
    echo "<p>$row->date</p>";
    echo "<img src='$row->img'>";
    echo "<div>$row->description</div>";
    echo "<hr>";

    } catch(PDOException  $e ){
echo "Error: ".$e;
}*/

?>

<?php include "templates/footer.php"; ?>

