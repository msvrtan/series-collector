<?php

class File
{
    protected $filePath;

    protected $objFolder;

    protected $fileName;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;

        $regex = '|(?<folderPath>.*)/(?<fileName>.*)|';

        if (preg_match($regex, $filePath, $arr)) {
            $this->objFolder = new Folder($arr['folderPath']);
            $this->fileName  = $arr['fileName'];
        } else {
            throw new Exception('preg failed' . $filePath);

        }


    }

    public function getFileName()
    {
        return $this->fileName;
    }
}

?>
