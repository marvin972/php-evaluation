<?php

function genererUrl(string $entete, string $lienChamp, string $recupChamp, string $recupOrderby,): string {
    if ($lienChamp === $recupChamp) {  
        if ($recupOrderby === 'asc')
            $orderby = 'desc';
        else 
            $orderby = 'asc';

    } else {
        $orderby = "asc";
    }

    $lien = "<a href=\"index.php?page=articlesAdmin&amp;";
    $lien .= "champ=$lienChamp&amp;";
    $lien .= "description=$recupChamp&amp;";
    $lien .= "description=$recupChamp&amp;";
    $lien .= "orderby=$orderby\">";
    $lien .= $entete;
    $lien .= "</a>";
    return $lien;
}

function genererUrlUsers(string $entete, string $lienNom, string $recupNom, string $recupOrderby,): string {
    if ($lienNom === $recupNom) {  
        if ($recupOrderby === 'asc')
            $orderby = 'desc';
        else 
            $orderby = 'asc';

    } else {
        $orderby = "asc";
    }

    $lien = "<a href=\"index.php?page=articlesAdmin&amp;";
    $lien .= "nom=$lienNom&amp;";
    $lien .= "nom=$recupNom&amp;";
    $lien .= "nom=$recupNom&amp;";
    $lien .= "orderby=$orderby\">";
    $lien .= $entete;
    $lien .= "</a>";
    return $lien;
}