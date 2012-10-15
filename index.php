<?php

class Folder
{
    protected $folderPath;

    public function __construct($folderPath)
    {
        $this->folderPath = $folderPath;

    }
}

class File
{
    protected  $filePath;
    
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
}

?>
