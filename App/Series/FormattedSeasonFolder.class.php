<?php
namespace App\Series;

class FormattedSeasonFolder
{
    protected $objEpisodeFile;
    protected $objTargetFolder;
    protected $separator = '.';


    public function __construct($objEpisodeFile, $objTargetFolder, $seperator = '.')
    {
        $this->objEpisodeFile  = $objEpisodeFile;
        $this->objTargetFolder = $objTargetFolder;
        $this->separator       = $seperator;
    }

    public function getSeriesFolder()
    {
        $str = '';
        $arr = array(
            $this->objTargetFolder->getFolderPath(),
            $this->getSeriesName(),
            DIRECTORY_SEPARATOR
        );
        $str = implode('', $arr);

        return $str;
    }

    public function getSeasonFolder()
    {
        $str = '';
        $arr = array(
            $this->getSeriesFolder(),
            $this->getSeriesName(),
            '-',
            $this->getSeasonString(),
            DIRECTORY_SEPARATOR
        );
        $str = implode('', $arr);

        return $str;
    }

    protected function getSeriesName()
    {
        $string = ucwords($this->objEpisodeFile->getSeriesName());
        $string = str_replace(' ', $this->separator, $string);

        return $string;

    }


    protected function getSeasonString()
    {

        return 'Season' . $this->separator . sprintf('%02d', $this->objEpisodeFile->getSeasonNumber());

    }

}

?>
