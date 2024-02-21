<?php
//création d'une class qui permet d'enregistrer les commentaires dans la bdd ainsi que de les afficher sur le site
class COMMENT {
    private $pdo;
  
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
  
    //méthode pour insérer les commentaires dans la bdd
    public function addComment() {
        extract($_POST);
        var_dump($_POST);
        $id = $_GET['id'];
        //préparation de la requête d'insertion
        $pdoStatement = $this->pdo->prepare(
            'INSERT INTO `comments`(`comment`, `id_picture`) VALUES (
                :comment,
                :id
            )'
        );
        $pdoStatement->bindValue(':comment', $comment, PDO::PARAM_STR);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_STR);
        //exécution de la requête
        $pdoStatement->execute();
        //redirection vers la page index
        header('location:comment_page.php?id=' . $id);
    }
    
    public function viewComment() {
        $id = $_GET['id'];
        // Préparation de la requête de sélection
        $pdoStatement = $this->pdo->prepare('SELECT comment FROM comments WHERE id_picture = :id');
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_STR);
        // Exécution requête
        $pdoStatement->execute();
        // Récupération des résultats sous forme d'un tableau associatif
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        // Affichage des commentaires
        foreach ($result as $row) {
            echo $row['comment'] . '<br>';
        }
    }
}