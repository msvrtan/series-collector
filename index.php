<?php
ini_set("display_errors", 1);

include 'App/Folder.class.php';
include 'App/FolderReader.class.php';
include 'App/File.class.php';


echo '<pre>';
$folderPath = '/vagrant/serije/';


$objFolder       = new Folder($folderPath);
$objFolderReader = new FolderReader($objFolder);
$arr             = $objFolderReader->getFileList();

$objFile = $arr[0];

//var_dump($objFile);

class EpisodeFile
{

    protected $seriesName;
    protected $seasonNumber;
    protected $episodeNumber;
    protected $extra;
    protected $fileType;

    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = $episodeNumber;
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
        $this->seasonNumber = $seasonNumber;
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

class Decorator
{
    protected $objFile;
    protected $objEpisodeFile;

    public function __construct($objFile)
    {
        $this->objFile        = $objFile;
        $this->objEpisodeFile = new EpisodeFile();

        $this->doWork();
    }


    public function doWork()
    {
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

    }
}


$decorator = new Decorator($objFile);

var_dump($decorator);







/*

breaking.bad.s03e12.720p.hdtv.x264-ctu.mkv
touch.102.hdtv-lol.mp4
Touch.S01E01.HDTV.XviD-LOL.avi
 */

?>

END