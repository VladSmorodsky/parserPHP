<?php include_once "templates/header.php"; ?>

<div style="text-align: center">
    <h1>Site Parsing App</h1>
    <ul>
        <li><a href="parser.php">Parse the site</a></li>
        <li><a href="select_news.php">Select news</a></li>
    </ul>
</div>

<?php

/* TEST ADDING LINKS */
/*
require_once ("lib/sql.php");

$r = $connection->prepare("SELECT * FROM table_content");
$r->execute();
$contents = $r->fetchAll(PDO::FETCH_ASSOC);

foreach ($contents as $content){

    $id_contents = $connection->prepare("SELECT * FROM table_content INNER JOIN description_anchors ON table_content.id = description_anchors.id_content WHERE table_content.id = ?");
    //$id_contents = $connection->prepare("SELECT * FROM description_anchors ");
    $id_contents->execute(array($content["id"]));
    $replace_content = $id_contents->fetchAll(PDO::FETCH_ASSOC);

    $r_count =  count($replace_content["src"]);

    foreach ($replace_content as $r_content){
        //var_dump($r_content["src"]);
        preg_match_all('/<p>(.*?)<\/p>/s', $content["description"], $paragraphs, PREG_OFFSET_CAPTURE);
        //var_dump($paragraphs);

        for ($p_count = 0; $p_count < count($paragraphs[0]); $p_count++) {
            //var_dump($p_count);
            //var_dump($r_content["p_number"]-1);
            if ($p_count == $r_content["p_number"] - 1){
                $position = strpos($paragraphs[0][$p_count][0], $r_content["text"]);
                //var_dump(substr_replace($paragraphs[0][$p_count][0],"<a href=".$r_content["src"].">".$r_content["text"]."</a>",$position,strlen($r_content["text"])));
                $paragraphs[0][$p_count][0] = substr_replace($paragraphs[0][$p_count][0],"<a href=".$r_content["src"].">".$r_content["text"]."</a>",$position,strlen($r_content["text"]));

            }
            $desctiption = ($paragraphs[0][$p_count][0]);
            $updateDescription = $connection->prepare("UPDATE table_content SET description=? WHERE id=?");
            //$updateDescription->bindParam($content["description"],$r_content["id_content"]);
            $updateDescription->execute(array($desctiption,$r_content["id_content"]));
            continue;
        }
        echo "<hr>";

    }
}*/
?>

<?php include_once "templates/footer.php"; ?>
