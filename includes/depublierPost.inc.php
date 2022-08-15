<?php


if(!empty($_GET['id_articles']) && is_numeric($_GET['id_articles'])) {
    $id = $_GET['id_articles'];
    $articles = getArticles($id);
    if(!empty($articles)) {
        
        $sql = "UPDATE articles SET status = 'draft', edit_at = NOW() WHERE id_articles = :id_articles";
        $query = $pdo=pdo()->prepare($sql);
        $query->bindValue(':id_articles',$id, PDO::PARAM_INT);
        $query->execute();
        
        // header('Location: listingPost.php');
        exit();
    }
}

