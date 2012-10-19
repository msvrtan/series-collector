<?php
ini_set("display_errors", 1);

include 'App/Folder.class.php';
include 'App/FolderReader.class.php';
include 'App/File.class.php';
include 'App/Series/EpisodeFile.class.php';
include 'App/Series/Decorator.class.php';
include 'App/Series/FormattedEpisodeFile.class.php';
include 'App/Series/FormattedSeasonFolder.class.php';



echo '<pre>';

$sourcePath = '/media/mcnulty/#series/spremi/';
$targetPath = '/media/mcnulty/#series/sorted/';

$sourcePath = '/vagrant/serije/source/';
$targetPath = '/vagrant/serije/target/';



$objSourceFolder = new Folder($sourcePath);
$objTargetFolder = new Folder($targetPath);

$z = new Worker($objSourceFolder, $objTargetFolder);
$z->test();


/*

breaking.bad.s03e12.720p.hdtv.x264-ctu.mkv
touch.102.hdtv-lol.mp4
Touch.S01E01.HDTV.XviD-LOL.avi
 */

?>

END