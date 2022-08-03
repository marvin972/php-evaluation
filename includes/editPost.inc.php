<?php


if(!empty($_GET['id_articles']) && is_numeric($_GET['id_articles'])) {
    $id_articles = $_GET['id_articles'];
    $sql_edit_articles = "SELECT * FROM articles WHERE id_articles = :id_articles";
    $query = $pdo=pdo()->prepare($sql_edit_articles);
    $query->bindValue(':id_articles',$id_articles, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch();
    

$errors = [];
if(!empty($_POST['submitted'])) {

    $titre = cleanXss('titre');
    $description= cleanXss('description');
    $auteur = cleanXss('auteur');
    $status = cleanXss('status');
    

    $errors = validText($errors,$titre,'titre',3,100);
    $errors = validText($errors,$description,'description',10,1000);
    $errors = validText($errors,$auteur,'auteur',3,100);
    $errors = validText($errors,$status,'status',3,20);

    if(count($errors) === 0) {

        $sql = "UPDATE articles SET titre = :titre,description = :description,auteur = :auteur,status = :status, edit_at = NOW() WHERE id_articles = :id_articles";
        $query = $pdo=pdo()->prepare($sql);
        $query->bindValue(':titre',$titre,PDO::PARAM_STR);
        $query->bindValue(':auteur',$auteur,PDO::PARAM_STR);
        $query->bindValue(':description',$description,PDO::PARAM_STR);
        $query->bindValue(':status',$statu,PDO::PARAM_STR);
        $query->bindValue(':id_articles',$id_articles,PDO::PARAM_INT);
        $query->execute();
        // header('Location: listingPost.php');
       $success = true;

    }
}
}







?>
<h1>Modifier un article</h1>
<form action="" method="post" novalidate class="wrap2">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id_articles="titre" value="<?=getValue('titre',$article['titre'])?>">
    <span class="error"><?php if(!empty($errors['titre'])) { echo $errors['titre']; } ?></span>

    <label for="description">Contenu</label>
    <textarea name="description" id_articles="description" cols="30" rows="10"><?=getValue('description',$article['description'])?></textarea>
    <span class="error"><?php if(!empty($errors['description'])) { echo $errors['description']; } ?></span>

    <label for="auteur">Auteur</label>
    <input type="text" name="auteur" id_articles="auteur" value="<?=getValue('auteur',$article['auteur'])?>">
    <span class="error"><?php if(!empty($errors['auteur'])) { echo $errors['auteur']; } ?></span>

    <?php
        $statu = array(
            'draft' => 'brouillon',
            'publish' => 'Publié'
        );

        ?>
    <select name="status">
        <option value=""><?=$article['status']?></option>
        <?php foreach ($status as $key => $value) {
                $selected = '';
                if(!empty($_POST['status'])) {
                    if($_POST['status'] == $key) {
                        $selected = ' selected="selected"';
                    }
                }
                ?>
        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
        <?php } ?>
    </select>
    <span class="error"><?php if(!empty($errors['status'])) { echo $errors['status']; } ?></span>


    <input type="submit" name="submitted" value="Modifier l'article">
</form>
