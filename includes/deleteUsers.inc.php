<?php

function deleteUsers() {
    if(!empty($_GET['id_utilisateur']) && is_numeric($_GET['id_utilisateur'])) {
    $id = $_GET['id_utilisateur'];
        if ($pdo = pdo()) {
            
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur=$id";
        $query = $pdo->query($sql);
        $query->fetch();
        
        echo "<script>window.location.replace('http://localhost/php-evaluation/index.php?page=clientsAdmin')</script>";
        
    }
} else {
    exit();
}

}
deleteUsers();