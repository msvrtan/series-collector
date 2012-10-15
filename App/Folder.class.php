<?php

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
}

?>
