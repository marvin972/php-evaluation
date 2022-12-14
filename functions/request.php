<?php


function getArticles($id_articles) {
    global $pdo;
    $sql = "SELECT * FROM articles WHERE id_articles = :id_articles";
    $query = $pdo=pdo()->prepare($sql);
    $query->bindValue(':id_articles',$id_articles, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}



function getAllArticles($limit = 10,$order = 'DESC')
{
    global $pdo;
    $sql = "SELECT * FROM articles ORDER BY created_at $order LIMIT $limit";
    $query = $pdo=pdo()->prepare($sql);
    $query->execute();
    $articles = $query->fetchAll();
    return $articles;
}

function publishedArticles() {
    global $pdo;
    $sql = "SELECT * FROM articles WHERE status = 'publish' ORDER BY created_at LIMIT 10";
$query = $pdo=pdo()->prepare($sql);
$query->execute();
$articles = $query->fetchall();
return $articles;
}