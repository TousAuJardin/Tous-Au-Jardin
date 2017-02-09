<?php
class ConnexionPDObis
{
  public static function getMysqlConnexionWithPDO()
  {
    $db = new PDO('mysql:host=193.37.145.61;dbname=devto790346', 'devto790346', 'tousJardiniers2017');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
  }


}
