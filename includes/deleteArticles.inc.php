<?php

function deleteArticles() {
    if(!empty($_GET['id_articles']) && is_numeric($_GET['id_articles'])) {
    $id = $_GET['id_articles'];
        if ($pdo = pdo()) {
            
        $sql = "DELETE FROM articles WHERE id_articles=$id";
        $query = $pdo->query($sql);
        $query->fetch();
        
        // echo "<script>window.location.replace('http://localhost/php-evaluation/index.php?page=accueil')</script>";
        
    }
} else {
    // exit();
}

}
deleteArticles();