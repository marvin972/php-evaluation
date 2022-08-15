<?php

function verifierInscrit(): bool {
    if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['role'] === 'Utilisateur inscrit') 
        return true;
    else
        return false;
}

