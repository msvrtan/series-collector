<?php
ini_set("display_errors", 1);

include 'App/Folder.class.php';
include 'App/FolderReader.class.php';
include 'App/File.class.php';
include 'App/EpisodeFile.class.php';
include 'App/Decorator.class.php';
include 'App/FormattedEpisodeFile.class.php';
include 'App/FormattedSeasonFolder.class.php';


echo '<pre>';
$folderPath = '/vagrant/serije/';
$targetPath = '/vagrant/serije/new/';

$objFolder       = new Folder($folderPath);
$objTargetFolder = new Folder($targetPath);
$objFolderReader = new FolderReader($objFolder);
$arr             = $objFolderReader->getFileList();

$objFile = $arr[0];

//var_dump($objFile);

$decorator = new Decorator($objFile);

//var_dump($decorator);

$objEpisodeFile = $decorator->getObjEpisodeFile();

//var_dump($objEpisodeFile);

$objFormattedEpisodeFile = new FormattedEpisodeFile($objEpisodeFile);

var_dump($objFormattedEpisodeFile->get());

$objFormattedSeasonFolder = new FormattedSeasonFolder($objEpisodeFile, $objTargetFolder);

var_dump($objFormattedSeasonFolder->getSeriesFolder());
var_dump($objFormattedSeasonFolder->getSeasonFolder());



/*

breaking.bad.s03e12.720p.hdtv.x264-ctu.mkv
touch.102.hdtv-lol.mp4
Touch.S01E01.HDTV.XviD-LOL.avi
 */

?>

END