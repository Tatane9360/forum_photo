<?php

//création d'une class ADDIMG qui permet d'enregistrer les images dans la bdd ainsi que de les afficher dans la galerie
class ADDIMG{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //méthode pour insérer les données de l'image dans la bdd
    public function addImage() {
        $filename = $_FILES['file']['name'];//nom original du fichier, tel que sur la machine de l'utilisateur
        $filenameTmp = $_FILES['file']['tmp_name'];//nom temporaire du fichier qui sera chargé sur le serveur
        $newFile = uniqid() . '-' . $filename;//ajout d'un identifiant unique devant le nom du fichier
        copy($filenameTmp, 'uploads/' . $newFile);//déplacement du  fichier dans un dossier uploads

        // Partie BDD

        extract($_POST);
        //requête sql pour insérer les données dans la bdd
        $pdoStatement = $this->pdo->prepare(
            'INSERT INTO `img`(`picture`) VALUES (:picture)'
        );

        // Association à l'aide de la méthode bindValue des marqueurs nominatifs aux valeurs
        $pdoStatement->bindValue('picture', $newFile, PDO::PARAM_STR);
        // Exécution de la requête préparée dans prepare à l'aide de la méthode execute
        $pdoStatement->execute();
        // Redirection page index 
        header('location: index.php');
    }

    //méthode pour afficher les images dans la galerie photo
    public function viewImage(){
        //requête sql pour sélectionner des données dans la bdd
        $pdoStatement = $this->pdo->prepare(
            'SELECT `picture`, `id_picture`FROM `img`'
        );
        //exécution de la requête
        $pdoStatement->execute();
        // récupération sous forme d'un tableau associatif
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        //boucle qui récupère chaque ligne du tableau associatif $result pour les afficher dans la galerie
        foreach ($result as $row) {
            echo '<div class="col-sm-12 col-md-6 col-lg-4">';
            echo '    <div class="card m-2 border border-dark">';
            echo '        <img src="uploads/' . $row['picture'] . '" class="card-img-top" alt="..." style="width: auto; height: 400px; object-fit: cover;">';
            echo '        <div class="card-body">';
            echo '            <a href="comment_page.php?id=' . $row['id_picture'] . '" class="btn btn-primary btn-block">Commenter la photo</a>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
    }

    //méthode pour afficher l'image sur comment_page
    public function openImage(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $pdoStatement = $this->pdo->prepare('SELECT `picture` FROM `img` WHERE `id_picture` = :id');
            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
            $pdoStatement->execute();
            $imageInfo = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            if ($imageInfo) {
                // Affichez l'image
                $imagePath = 'uploads/' . $imageInfo['picture'];
                echo '<html>';
                echo '<head>';
                echo '<title>Image</title>';
                echo '</head>';
                echo '<body>';
                echo '<img src="' . $imagePath . '" alt="Image" style="width: 400px; height: 400px;">';
                echo '</body>';
                echo '</html>';
            }
        } 
    }   

}