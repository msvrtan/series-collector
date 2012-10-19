<?php
namespace App\System;

use DirectoryIterator;

class Folder
{
    protected $folderPath;

    public function __construct($folderPath)
    {
        $this->folderPath = $folderPath;
    }

    public function getFolderPath()
    {
        return $this->folderPath;
    }

    public function getFileList()
    {
        $arrFileList = array();
        $iterator    = new DirectoryIterator($this->getFolderPath());

        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {
                $arrFileList[] = new File($fileinfo->getPathname());
                //$arrFileList[] = $fileinfo;
            }
        }

        return $arrFileList;

    }
}

?>
