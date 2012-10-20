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

            $z = new miro1($objFile, $this->objTargetFolder);
            $z->doWork();

        }

    }

}

class miro1
{
    protected $objFile;
    protected $objTargetFolder;

    public function __construct($objFile, $objTargetFolder)
    {
        $this->objFile         = $objFile;
        $this->objTargetFolder = $objTargetFolder;
    }

    public function doWork()
    {
        try {

            $decorator                = new Decorator($this->objFile);
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


            //$source = $this->objFile->getFilePath();
            //$target = $objFormattedSeasonFolder->getSeasonFolder() . $objFile->getFileName();

            $objTargetFile = new \App\System\File($objFormattedSeasonFolder->getSeasonFolder() . $this->objFile->getFileName());

            $this->objFile->move($objTargetFile);

            //echo $source . ' ' . $target;
            echo PHP_EOL;

            //rename($source, $target);

        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }
}

?>
