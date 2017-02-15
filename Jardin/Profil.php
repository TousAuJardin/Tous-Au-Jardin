<?php
require 'pdo/ConnexionPDObis.class.php';
require 'pdo/News.class.php';
require 'pdo/NewsManagerPDO.class.php';

$db = ConnexionPDObis::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($db);

?>
	<div class= "container" id = "PageProfil">
   
<?php
if (isset($_GET['id_news']))
{
  $news = $manager->getUnique((int) $_GET['id_news']);
  
  echo '<div class="well"><p>Par <em>', $news->auteur(), '</em>, le ', $news->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $news->titre(), '</h2>', "\n",
       '<p>', $news->contenu(), '</p><div>', "\n";
  
  if ($news->dateAjout() != $news->dateModif())
  {
    echo '<p style="text-align: right;"><small><em>Modifiée le ', $news->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
  }
}

else
{
  echo '<h2 style="text-align:center">Liste des dernières news</h2>';
  
  foreach ($manager->getList(0, 5) as $news)
  {
  
    $contenu = $news->contenu();
   
    
    echo '<div class="well"><h4><a href="?id_news=', $news->id_news(), '">', $news->titre(), '</a></h4>', "\n",
         '<p>', $contenu, '</p></div>';
  }
}
?>
</div>
