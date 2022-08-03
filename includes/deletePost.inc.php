<?php

if(!empty($_GET['id_articles']) && is_numeric($_GET['id_articles'])) {
    $id_articles = $_GET['id_articles'];
    $articles = getArticles($id_articles);
    if(!empty($articles)) {
        
        $sql = "DELETE FROM articles WHERE id_articles = :id_articles";
        $query = $pdo=pdo()->prepare($sql);
        $query->bindValue(':id_articles',$id_articles, PDO::PARAM_INT);
        $query->execute();
        
       
        exit();
    }
}

