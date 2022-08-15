<?php
// Affichage des articles pour les utilisateurs connectés avec les droits admin
if (verifierAdmin()) {

    if ($pdo = pdo()) {
        $champ = $_GET['champ'] ?? "description";
        $orderby = $_GET['orderby'] ?? "asc";

        $requeteArticles = "SELECT * FROM articles ORDER BY $champ $orderby";

        $tableauResultats = "<table>";
        $tableauResultats .= "<thead>";
        $tableauResultats .= "<tr>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Id Articles', 'id_articles', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Titre', 'titre', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Déscription', 'description', $champ, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Auteur', 'auteur', $champ, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Créé le', 'created_at', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Modifié le', ' 	edit_at', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrl('Status', ' status', $champ, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "</tr>";
        $tableauResultats .= "</thead>";
        $tableauResultats .= "<tbody>";
        $resultatRequeteArticles = $pdo->query($requeteArticles)->fetchAll();

        foreach ($resultatRequeteArticles as $row) {
            $tableauResultats .= "<tr>";
            $tableauResultats .= "<td>" . $row['id_articles'] . "</td>";
            $tableauResultats .= "<td>" . $row['titre'] . "</td>";
            $tableauResultats .= "<td><a href=\"index.php?page=articleDetailAdmin&amp;articleId=" . $row['id_articles'] . "\">" . $row['description'] . "</a></td>";
            $tableauResultats .= "<td>" . $row['auteur'] . "</td>";
            $tableauResultats .= "<td>" . $row['created_at'] . "</td>";
            $tableauResultats .= "<td>" . $row['edit_at'] . "</td>";
            $tableauResultats .= "<td>" . $row['status'] . "</td>";
            $tableauResultats .= "<td><a href=\"index.php?page=editPost&amp;id_articles=" . $row['id_articles'] . "\">" . "Modifier</a></td>";
            $tableauResultats .= "<td><a href=\"index.php?page=deleteArticles&amp;id_articles=" . $row['id_articles'] . "\">" . "Supprimer</a></td>";
            // $tableauResultats .= "<td><a href=\"index.php?page=depublierPost&amp;id_articles=". $row['id_articles']."\">" . "Dépublié</a></td>";
            // $tableauResultats .= "<td><a href=\"index.php?page=publishedPost&amp;id_articles=". $row['id_articles']."\">" . "Publié</a></td>";
            if ($row['status'] == 'publish') {
                $tableauResultats .= "<td><a href=\"index.php?page=depublierPost&amp;id_articles=" . $row['id_articles'] . "\">" . "Dépublier</a></td>";
            }
            if ($row['status'] == 'draft') {
                $tableauResultats .= "<td><a href=\"index.php?page=publishedPost&amp;id_articles=" . $row['id_articles'] . "\">" . "Publié</a></td>";
            }






            $tableauResultats .= "</tr>";
        }

        $tableauResultats .= "</tbody>";
        $tableauResultats .= "</table>";

        echo $tableauResultats;
    } else {
        echo "<p>Erreur PDO</p>";
    }
} else {
    $codeJs = "<p>Vous allez être redirigé dans 5 secondes.<br />Si la redirection n'est pas automatique, <a href=\"http://localhost/php-evaluation/index.php?page=articlesAdmin\">cliquez ici</a></p>";
    $codeJs .= "
    <script>
        setTimeout(function() {
            window.location.replace('http://localhost/php-evaluation/index.php?page=articlesAdmin')
        }, 5000);
    </script>
    ";
    echo $codeJs;
}
