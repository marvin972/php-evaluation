<?php

function verifierUtilisateur($email, $pseudo) {
    if ($pdo = pdo()) {
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE email='$email', pseudo='$pseudo'";
        $reponse = $pdo->query($sql);
        $nbreLigne = $reponse->fetchColumn();
        if ($nbreLigne > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
