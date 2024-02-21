<?php
//appel de l'autoload
require('class/autoload.php');

var_dump($_POST);
var_dump($_GET);

echo '<pre>';
print_r($_GET);
echo '</pre>';


$pdo = new PDO('mysql:host=localhost;dbname=galerie_photo', 'root');
$openImage = new ADDIMG($pdo);

$openImage->openImage($pdo);
?>

<div>
    <form action="" method="post">
        <input type="text" name="comment" placeholder="entrez votre commentaire">
        <input type="submit" name="send">
    </form>
</div>

<?php
      $addComment = new COMMENT($pdo);
      if(isset($_POST["send"])){
        $addComment->addComment();
      }
    ?>

<div>
    <h1>Commentaire</h1>
    <?php 
    $viewComment = new COMMENT($pdo);
    $viewComment->viewComment();
    ?>
</div>