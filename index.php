<?php
ini_set("display_errors", 1);

include 'App/Folder.class.php';
include 'App/FolderReader.class.php';
include 'App/File.class.php';
include 'App/Series/EpisodeFile.class.php';
include 'App/Series/Decorator.class.php';
include 'App/Series/FormattedEpisodeFile.class.php';
include 'App/Series/FormattedSeasonFolder.class.php';


class Worker
{
    protected $objSourceFolder;
    protected $objTargetFolder;

    public function __construct($objSourceFolder, $objTargetFolder)
    {
        $this->objSourceFolder = $objSourceFolder;
        $this->objTargetFolder = $objTargetFolder;

    }

    protected function getFileList()
    {
        $objFolderReader = new FolderReader($this->objSourceFolder);

        return $objFolderReader->getFileList();
    }

    public function test()
    {
        foreach ($this->getFileList() as $objFile) {

            try {

                $decorator                = new Decorator($objFile);
                $objEpisodeFile           = $decorator->getObjEpisodeFile();
                $objFormattedEpisodeFile  = new FormattedEpisodeFile($objEpisodeFile);
                $objFormattedSeasonFolder = new FormattedSeasonFolder($objEpisodeFile, $this->objTargetFolder);

                if (file_exists($objFormattedSeasonFolder->getSeriesFolder()) === false) {

                    //mkdir($objFormattedSeasonFolder->getSeriesFolder());
                    mkdir($objFormattedSeasonFolder->getSeriesFolder(), 0777);
                    chmod($objFormattedSeasonFolder->getSeriesFolder(), 0777);
                }
                if (file_exists($objFormattedSeasonFolder->getSeasonFolder()) === false) {
                    //mkdir($objFormattedSeasonFolder->getSeasonFolder());
                    mkdir($objFormattedSeasonFolder->getSeasonFolder(), 0777);
                    chmod($objFormattedSeasonFolder->getSeasonFolder(), 0777);

                }


                $source = $objFile->getFilePath();
                $target = $objFormattedSeasonFolder->getSeasonFolder() . $objFile->getFileName();

                echo $source . ' ' . $target;
                echo '<br>';
                //copy()
                rename($source, $target);

            } catch (Exception $e) {
                echo $e->getMessage();
            }


        }

    }
}

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