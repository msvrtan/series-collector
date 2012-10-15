<?php
ini_set("display_errors", 1);

include 'App/Folder.class.php';
include 'App/File.class.php';

class FolderReader
{
    protected $objFolder;

    public function __construct(Folder $objFolder)
    {
        $this->objFolder = $objFolder;
    }

    public function getFileList()
    {
        $arrFileList = array();
        $iterator = new DirectoryIterator($this->objFolder->getFolderPath());

        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {
                $arrFileList[] = $fileinfo->getFilename();
            }
        }

        return $arrFileList;

    }
}

$folderPath = '/home/msvrtan/Desktop/serije/season 3/';
$folderPath = '/vagrant/serije/';


$objFolder       = new Folder($folderPath);
$objFolderReader = new FolderReader($objFolder);
$arr             = $objFolderReader->getFileList();

var_dump($arr);

/*

breaking.bad.s03e12.720p.hdtv.x264-ctu.mkv
touch.102.hdtv-lol.mp4
Touch.S01E01.HDTV.XviD-LOL.avi
 */

?>

END