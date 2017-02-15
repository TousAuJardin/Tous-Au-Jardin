<?php

if (isset($_GET['modifier']))
{
  $news = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
  $manager->delete((int) $_GET['supprimer']);
  $message = '<div class="alert alert-info" role="alert">La news a bien été suprimée !</div>';
}
if (isset($_POST['auteur']))
{
  $news = new News(
    [
      'auteur' => $_POST['auteur'],
      'titre' => $_POST['titre'],
      'contenu' => $_POST['contenu']
    ]
  );

  if (isset($_POST['id_news']))
  {
    $news->setId($_POST['id_news']);
  }

  if ($news->isValid())
  {
    $manager->save($news);

    $message = $news->isNew() ? '<div class="alert alert-success" role="alert">La news a bien été ajoutée !</div>' : '<div class="alert alert-success" role="alert">La news a bien été modifiée !</div>';
  }
  else
  {
    $erreurs = $news->erreurs();
  }
}
?>
<div class = "container" id="PagePubli">

    <a class="btn btn-default" href="profil.php" role="button">Fil d'actualités</a>

    <form action="publications.php" method="post">
	<div class="form-group">
      <p style="text-align: center">
<?php
if (isset($message))
{
  echo $message, '<br />';
}
?>
<div class= "form-horizontal">
        <?php if (isset($erreurs) && in_array(News::AUTEUR_INVALIDE, $erreurs)) echo '<div class="alert alert-danger" role="alert">L\'auteur est invalide.</div><br />'; ?>
        <div class = "form-group"><label for="inputEmail3" class="col-sm-2 control-label">Auteur :</label> <input type="text" name="auteur" value="<?php if (isset($news)) echo $news->auteur(); ?>" /><br /></div>

        <?php if (isset($erreurs) && in_array(News::TITRE_INVALIDE, $erreurs)) echo '<div class="alert alert-danger" role="alert">Le titre est invalide.</div><br />'; ?>
        <div class = "form-group"><label for="inputEmail3" class="col-sm-2 control-label">Titre :</label><input type="text" name="titre" value="<?php if (isset($news)) echo $news->titre(); ?>" /><br /></div>

        <?php if (isset($erreurs) && in_array(News::CONTENU_INVALIDE, $erreurs)) echo '<div class="alert alert-danger" role="alert">Le contenu est invalide.</div><br />'; ?>
       <div class = "form-group"><label for="inputEmail3" class="col-sm-2 control-label">Contenu :</label><textarea  rows="8" cols="60" name="contenu"><?php if (isset($news)) echo $news->contenu(); ?></textarea></div>
</div>
<?php
if(isset($news) && !$news->isNew())
{
?>
        <input type="hidden" name="id_news" value="<?= $news->id_news() ?>" />
        <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
       <div class ="container"> <input type="submit" class="btn btn-primary" value="Ajouter" /><div>
<?php
}
?>
		</div>
      </p>
    </form>

    <p class="bg-info" style="text-align: center; color: white">Il y a actuellement <?= $manager->count() ?> news. En voici la liste :</p>

    <table class="table table-bordered table-striped">
      <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($manager->getList() as $news)
{
  echo '<tr class="active"><td>', $news->auteur(), '</td><td>', $news->titre(), '</td><td>', $news->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($news->dateAjout() == $news->dateModif() ? '-' : $news->dateModif()->format('d/m/Y à H\hi')), '</td><td><a href="?modifier=', $news->id_news(), '">Modifier</a> | <a href="?supprimer=', $news->id_news(), '">Supprimer</a></td></tr>', "\n";
}
?>
    </table>


	</div>
