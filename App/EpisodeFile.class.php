<?php

class EpisodeFile
{

    protected $seriesName;
    protected $seasonNumber;
    protected $episodeNumber;
    protected $extra;
    protected $fileType;

    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = (int)$episodeNumber;
    }

    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    public function getExtra()
    {
        return $this->extra;
    }

    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
    }

    public function getFileType()
    {
        return $this->fileType;
    }

    public function setSeasonNumber($seasonNumber)
    {
        $this->seasonNumber = (int)$seasonNumber;
    }

    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    public function setSeriesName($seriesName)
    {
        $this->seriesName = $seriesName;
    }

    public function getSeriesName()
    {
        return $this->seriesName;
    }


}

?>
