<?php
// Affichage des articles pour les utilisateurs connectés avec les droits admin
if (verifierAdmin()) {
    if ($pdo = pdo()) {
        $nom = $_GET['nom'] ?? "nom";
        $orderby = $_GET['orderby'] ?? "asc";

        $requeteArticles = "SELECT * FROM utilisateurs ORDER BY $nom $orderby";

        $tableauResultats = "<table>";
        $tableauResultats .= "<thead>";
        $tableauResultats .= "<tr>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrlUsers('Id Utilisateur', 'id_utilisateur', $nom, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrlUsers('Nom', 'nom', $nom, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrlUsers('Prénom', 'prenom', $nom, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrlUsers('E-mail', 'email', $nom, $orderby);;
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrlUsers('Mot de passe', 'mdp', $nom, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "<th>";
        $tableauResultats .= genererUrlUsers('Rôle', 'role', $nom, $orderby);
        $tableauResultats .= "</th>";
        $tableauResultats .= "</tr>";
        $tableauResultats .= "</thead>";
        $tableauResultats .= "<tbody>";
        $resultatRequeteArticles = $pdo->query($requeteArticles)->fetchAll();

        foreach ($resultatRequeteArticles as $row) {
            $tableauResultats .= "<tr>";
            $tableauResultats .= "<td>" . $row['id_utilisateur'] . "</td>";
            $tableauResultats .= "<td>" . $row['nom'] . "</td>";
            $tableauResultats .= "<td>" . $row['prenom'] . "</td>";
            $tableauResultats .= "<td>" . $row['email'] . "</td>";
            $tableauResultats .= "<td>" . $row['mdp'] . "</td>";
            $tableauResultats .= "<td>" . $row['role'] . "</td>";
            $tableauResultats .= "<td><a href=\"index.php?page=editUsers&amp;id_utilisateur=" . $row['id_utilisateur'] . "\">" . "Modifier</a></td>";
            $tableauResultats .= "<td><a href=\"index.php?page=deleteUsers&amp;id_utilisateur=" . $row['id_utilisateur'] . "\">" . "Supprimé</a></td>";
            

            $tableauResultats .= "</tr>";
        }

        $tableauResultats .= "</tbody>";
        $tableauResultats .= "</table>";

        echo $tableauResultats;
    } else {
        echo "<p>Erreur PDO</p>";
    }
} else {
    $codeJs = "<p>Vous allez être redirigé dans 5 secondes.<br />Si la redirection n'est pas automatique, <a href=\"http://localhost/php-fred/index.php?page=accueil\">cliquez ici</a></p>";
    $codeJs .= "
    <script>
        setTimeout(function() {
            window.location.replace('http://localhost/php-fred/index.php?page=accueil')
        }, 5000);
    </script>
    ";
    echo $codeJs;
}
