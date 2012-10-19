<?php

class Decorator
{
    protected $objFile;
    protected $objEpisodeFile;

    public function __construct($objFile)
    {
        $this->objFile = $objFile;

    }


    public function getObjEpisodeFile()
    {
        $this->objEpisodeFile = new EpisodeFile();

        $fileName = $this->objFile->getFileName();
        $fileName = strtolower($fileName);
        $fileName = str_replace('.', ' ', $fileName);

        //echo $fileName;
        //echo '<br>';

        $arrRegex = array(
            '(?<seriesName>.*)',
            's(?<seasonNumber>[0-9]{2})e(?<episodeNumber>[0-9]{2})',
            '(?<extra>.*)',
            '(?<fileType>[a-zA-Z0-9]*)'
        );

        $regex = '|^' . implode(' ', $arrRegex) . '$|';

        //echo $regex;
        //echo '<br>';

        if (preg_match($regex, $fileName, $arr)) {

            $this->objEpisodeFile->setSeriesName($arr['seriesName']);
            $this->objEpisodeFile->setSeasonNumber($arr['seasonNumber']);
            $this->objEpisodeFile->setEpisodeNumber($arr['episodeNumber']);
            $this->objEpisodeFile->setExtra($arr['extra']);
            $this->objEpisodeFile->setFileType($arr['fileType']);

            //var_dump($arr);

        } else {
            throw new Exception('preg failed' . $fileName);

        }

        return $this->objEpisodeFile;

    }
}

?>
