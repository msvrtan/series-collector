<?php
ini_set("display_errors", 1);

include 'App/System/Folder.class.php';
include 'App/System/File.class.php';
include 'App/Series/EpisodeFile.class.php';
include 'App/Series/Decorator.class.php';
include 'App/Series/FormattedEpisodeFile.class.php';
include 'App/Series/FormattedSeasonFolder.class.php';
include 'App/Series/Worker.class.php';


echo '<pre>';

$sourcePath = '/media/mcnulty/#series/spremi/';
$targetPath = '/media/mcnulty/#series/sorted/';

$sourcePath = '/vagrant/serije/source/';
$targetPath = '/vagrant/serije/target/';


$objSourceFolder = new App\System\Folder($sourcePath);
$objTargetFolder = new App\System\Folder($targetPath);


$z = new App\Series\Worker($objSourceFolder, $objTargetFolder);
$z->test();


/*

breaking.bad.s03e12.720p.hdtv.x264-ctu.mkv
touch.102.hdtv-lol.mp4
Touch.S01E01.HDTV.XviD-LOL.avi
 */

?>

END