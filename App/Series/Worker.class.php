<?php
namespace App\Series;

use App\System\FolderReader;

class Worker
{
    protected $objSourceFolder;
    protected $objTargetFolder;

    public function __construct($objSourceFolder, $objTargetFolder)
    {
        $this->objSourceFolder = $objSourceFolder;
        $this->objTargetFolder = $objTargetFolder;

    }


    public function test()
    {
        foreach ($this->objSourceFolder->getFileList() as $objFile) {

            $this->doWork($objFile);


        }

    }

    protected function doWork($objFile)
    {
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
            echo PHP_EOL;

            rename($source, $target);

        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }
}

?>
