<?php

class FormattedEpisodeFile
{
    protected $objEpisodeFile;
    protected $separator;

    public function __construct($objEpisodeFile, $seperator = '.')
    {
        $this->objEpisodeFile = $objEpisodeFile;
        $this->separator      = $seperator;
    }

    public function get()
    {
        $str = '';
        $arr = array(


            $this->getSeriesName(),
            $this->separator,
            $this->getSeasonString(),
            $this->getEpisodeString(),
            '.',
            $this->objEpisodeFile->getFileType()
        );
        $str = implode('', $arr);

        return $str;
    }

    protected function getSeriesName()
    {
        $string = ucwords($this->objEpisodeFile->getSeriesName());
        $string = str_replace( ' ' , $this->separator , $string);

        return $string;

    }


    protected function getSeasonString()
    {

        return 'S' . sprintf('%02d', $this->objEpisodeFile->getSeasonNumber());

    }

    protected function getEpisodeString()
    {

        return 'E' . sprintf('%02d', $this->objEpisodeFile->getEpisodeNumber());

    }
}

?>
