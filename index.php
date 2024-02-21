<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';

//appel de l'autoload
require('class/autoload.php');



//création d'instances
$pdo = new PDO('mysql:host=localhost;dbname=galerie_photo', 'root');
$addImage = new ADDIMG($pdo);
$viewImage = new ADDIMG($pdo);

// Vérification du  formulaire
if (isset($_POST["envoyer"])) {
    //application de la méthode addImage
    $addImage->addImage($pdo);
}
?>

<!-- Partie HTML -->

    <!-- inclusion de header.php -->
    <?php include('inc/header.inc.php');?>
    <title>Forum Photo</title>

</head>

<body>
    <!-- inclusion de nav.php -->
    <?php include('inc/nav.inc.php');?>

    <!-- formulaire pour ajouter une image dans la galerie -->
    <!-- enctype = type d'encodage de données nécessaire au formulaire de téléchargement de fichier -->
    <form action="" method="post" enctype="multipart/form-data" class="d-flex justify-content-center mt-5 ">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000000"><!-- La value correspond à la taille de l'image, le champs MAX_FILE_SIZE est mesuré en octets -->
        <input class="btn btn-primary me-2" type="file" name="file" id="file">
        <input class="btn btn-primary" type="submit" name="envoyer" value="ajouter">
    </form>
    
    <!-- affichage des images -->
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <?php
                //application de la méthode viewImage
                $viewImage->viewImage();
            ?>
        </div>
    </div>
    
    <?php
        //nouvelle instance de la class COMMENT
        //$addComment = new COMMENT($pdo);
        //vérification du formulaire
        //if(isset($_POST["send"])){
        //application de la méthode addComment
        //$addComment->addComment();
    ?>

    <!-- <div>
      <h1>Commentaire</h1>
      <?php 
        //nouvelle instance de la class COMMENT
        //$viewComment = new COMMENT($pdo);
        //application de la méthode viewComment
        //$viewComment->viewComment();
      ?>
    </div> -->


</body>
