<?php


if(!empty($_GET['id_utilisateur']) && is_numeric($_GET['id_utilisateur'])) {
    $id_utilisateur = $_GET['id_utilisateur'];
    $sql_edit_users = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
    $query = $pdo=pdo()->prepare($sql_edit_users);
    $query->bindValue(':id_utilisateur',$id_utilisateur, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetch();
    

$errors = [];
if(!empty($_POST['submitted'])) {

    $nom = cleanXss('nom');
    $prenom= cleanXss('prenom');
    $email = cleanXss('email');
    $role = cleanXss('role');
    $mdp = cleanXss('mdp');
    

    $errors = validText($errors,$nom,'nom',3,100);
    $errors = validText($errors,$prenom,'prenom',3,1000);
    $errors = validText($errors,$email,'email',3,100);
    $errors = validText($errors,$role,'role',3,20);
    $errors = validText($errors,$mdp,'mdp',3,500);

    if(count($errors) === 0) {
        $mdp = password_hash("$mdp", PASSWORD_DEFAULT);
        $sql = "UPDATE utilisateurs SET nom = :nom,prenom = :prenom,email = :email,role = :role, mdp = :mdp WHERE id_utilisateur = :id_utilisateur";
        $query = $pdo=pdo()->prepare($sql);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->bindValue(':role',$role,PDO::PARAM_STR);
        $query->bindValue(':mdp',$mdp,PDO::PARAM_STR);
        $query->bindValue(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);
        $query->execute();
        // header('Location: listingPost.php');
       $success = true;

    }
}
}







?>
<h1>Modifier un utilisateur</h1>
<form action="" method="post" novalidate class="wrap2">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id_utilisateur="nom" value="<?=getValue('nom',$users['nom'])?>">
    <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>

    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id_utilisateur="prenom" value="<?=getValue('prenom',$users['prenom'])?>">
    <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>

    <label for="email">Email</label>
    <input type="text" name="email" id_utilisateur="email" value="<?=getValue('email',$users['email'])?>">
    <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>

    <label for="mdp">Mots de passe</label>
    <input type="password" name="mdp" id_utilisateur="mdp" value="<?=getValue('mdp',$users['mdp'])?>">
    <span class="error"><?php if(!empty($errors['mdp'])) { echo $errors['mdp']; } ?></span>

    <?php
        $role = array(
            'Utilisateur inscrit' => 'Utilisateur inscrit',
            'Modérateur' => 'Modérateur',
            'Rédacteur' => 'Rédacteur',
            'admin' => 'admin'
        );

        ?>
    <select name="role">
        <option value=""><?=$users['role']?></option>
        <?php foreach ($role as $key => $value) {
                $selected = '';
                if(!empty($_POST['role'])) {
                    if($_POST['role'] == $key) {
                        $selected = ' selected="selected"';
                    }
                }
                ?>
        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
        <?php } ?>
    </select>
    <span class="error"><?php if(!empty($errors['role'])) { echo $errors['role']; } ?></span>


    <input type="submit" name="submitted" value="Modifier l'utilisateur">
</form>
