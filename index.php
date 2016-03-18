<?php

//parametres
$DayToKeep = 15;

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

delTree($dateYear."/".$dateMonth."/".$dateDay);

?>
