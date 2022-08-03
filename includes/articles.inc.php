<h1>Articles</h1>
<?php

$requeteCategoriesNiveau1 = "
    SELECT *
    FROM articles
    WHERE  id_articles
    ORDER BY created_at
";

$connexionCategories = new Sql();

$resultatCaterogies = $connexionCategories->select($requeteCategoriesNiveau1);

$menuCategories = "<ul>";

for ($i = 0; $i < count($resultatCaterogies); $i++) {
    $menuCategories .= "<li>";
    $menuCategories .= "<a href=\"index.php?page=articles&amp;id_articles=" . $resultatCaterogies[$i]['id_articles'] . "\">";
    $menuCategories .= $resultatCaterogies[$i]['auteur'] . ['description'];
    $menuCategories .= "</a>";
    $menuCategories .= "</li>";
}

$menuCategories .= "</ul>";

echo $menuCategories;


if (isset($_GET['id_articles'])) {
    $id_articles = $_GET['id_articles'];

    $requeteArticlesParCategorie = "SELECT *
    FROM articles
    WHERE id_article= $id_articles
    ORDER BY created_at";


    $connexionArticles = new Sql();

    $resultatArticles = $connexionArticles->select($requeteArticlesParCategorie);

    $articles = "<ul>";
    for ($i = 0; $i < count($resultatArticles); $i++) {
        $articles .= "<li>";
        $articles .= $resultatArticles[$i]['description'];
        $articles .= "</li>";
    }


    $articles .= "</ul>";

    echo $articles;
}
