<?php
namespace App\System;

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
        $iterator    = new DirectoryIterator($this->objFolder->getFolderPath());

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
