<?php
ini_set("display_errors", 1);

include 'App/Folder.class.php';
include 'App/FolderReader.class.php';
include 'App/File.class.php';
include 'App/EpisodeFile.class.php';
include 'App/Decorator.class.php';
include 'App/FormattedEpisodeFile.class.php';
include 'App/FormattedSeasonFolder.class.php';


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

            try
            {

            $decorator                = new Decorator($objFile);
            $objEpisodeFile           = $decorator->getObjEpisodeFile();
            $objFormattedEpisodeFile  = new FormattedEpisodeFile($objEpisodeFile);
            $objFormattedSeasonFolder = new FormattedSeasonFolder($objEpisodeFile, $this->objTargetFolder);
            var_dump($objFormattedSeasonFolder->getSeriesFolder());
            var_dump($objFormattedSeasonFolder->getSeasonFolder());

            if (file_exists($objFormattedSeasonFolder->getSeriesFolder()) === false) {

                //mkdir($objFormattedSeasonFolder->getSeriesFolder());
                mkdir($objFormattedSeasonFolder->getSeriesFolder(), 777);
                chmod($objFormattedSeasonFolder->getSeriesFolder(), 777);
            }
            if (file_exists($objFormattedSeasonFolder->getSeasonFolder()) === false) {
                //mkdir($objFormattedSeasonFolder->getSeasonFolder());
                mkdir($objFormattedSeasonFolder->getSeasonFolder(), 777);
                chmod($objFormattedSeasonFolder->getSeasonFolder(), 777);

            }
            }catch (Exception $e)
            {
                echo $e->getMessage();
            }

        }

    }
}

echo '<pre>';
$sourcePath = '/vagrant/serije/';
$targetPath = '/vagrant/serije/new/';

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