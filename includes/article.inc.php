<h1>Articles 2</h1>
<?php

$articles = getAllArticles(3, 'ASC');?>

<h1>Liste Articles</h1>

<ul>
    <?php foreach($articles as $article) {
 ?>
    <li>
        <p><strong>ID : </strong><?php echo $article['id_articles']; ?>
        </p>
        <h2><?php echo ucfirst($article['titre']); ?></h2>
        <p><strong>Contenus : </strong><?php echo nl2br($article['description']); ?></p>
        <p><strong>Auteur : </strong><?php echo nl2br($article['auteur']); ?></p>
        <p><strong>Status : </strong><?php echo nl2br($article['status']); ?></p>

        <p><strong>Date de création : </strong><?php echo date('d/m/Y à H:i:s', strtotime($article['created_at'])); ?>
        </p>

        <p><strong>Date modifier : </strong><?php echo date('d/m/Y à H:i:s', strtotime($article['edit_at'])); ?></p>


        <a href="editPost.php?id=<?php echo $article['id_articles']; ?>">Modifier</a>

        <a href="deletePost.php?id=<?php echo $article['id_articles']; ?>">Delete</a>Supprimer</a>


        <?php if ($article['status'] == 'publish') { ?>
        <a href="depublierPost.php?id=<?php echo $article['id_articles']; ?>">Dépublier</a><?php } ?>

        <?php if ($article['status'] !== 'publish') { ?>
        <a href="publishedPost.php?id=<?php echo $article['id_articles']; ?>">Publier</a><?php } ?>
    </li>
    <?php } ?>
</ul>