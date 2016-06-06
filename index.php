<?php

//parametres
$DayToKeep = $_GET['jours']; if (empty($DayToKeep)) $DayToKeep = 7;
$xml = $_GET['xml']; if (empty($xml)) $xml = 0;

//supression recursive d'un répertoire et de son contenu
function delTree($dir) {
   $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
  }

$dateYear = date("Y", mktime(0, 0, 0, date("m") , date("d") - $DayToKeep, date("Y")));
$dateMonth = date("m", mktime(0, 0, 0, date("m") , date("d") - $DayToKeep, date("Y")));
$dateDay = date("d", mktime(0, 0, 0, date("m") , date("d") - $DayToKeep, date("Y")));

//echo $dateYear."/".$dateMonth."/".$dateDay;
delTree($dateYear."/".$dateMonth."/".$dateDay);

if ($xml == 1) {
//----------- Génération du XML
  echo '<?xml version="1.0"?>';
  echo '<racine>';
  echo '<camerafiles>';
  echo '<maj>'.$dateYear."/".$dateMonth."/".$dateDay.'</maj>';
  echo '</camerafiles>';
  echo '</racine>';
}
?>
