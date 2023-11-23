<?php

use Gedmo\Uploadable\FileInfo\FileInfoInterface;

class CustomFileInfo implements FileInfoInterface
{
    protected $path;
    protected $name;
    protected $size;
    protected $type;
    protected $filename;
    protected $error = 0;

    public function __construct($path)
    {
        $this->path = $path;

        // Now, process the file and fill the rest of the properties.
    }

    // This returns the actual path of the file
    public function getTmpName()
    {
        return $this->path;
    }

    // This returns the filename
    public function getName()
    {
        return $this->name;
    }

    // This returns the file size in bytes
    public function getSize()
    {
        return $this->size;
    }

    // This returns the mime type
    public function getType()
    {
        return $this->type;
    }

    public function getError()
    {
        // This should return 0, as it's only used to return the codes from PHP file upload errors.
        return $this->error;
    }

    // If this method returns true, it will produce that the extension uses "move_uploaded_file" function to move
    // the file. If it returns false, the extension will use the "copy" function.
    public function isUploadedFile()
    {
        return false;
    }
}
