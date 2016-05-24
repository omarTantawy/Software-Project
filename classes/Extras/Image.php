<?php

/**
 * @author yehia
 * @copyright 2010
 */

class Image{

    static public $mimeTable = array(
        'image/pjpeg' => 'jpg',
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif',
        'image/png' => 'png'
    );
    
    private $extension;
    private $src;
    private $imageInfo = array();
    private $originalWidth;
    private $originalHeight;
    private $mime;
    private $resource;
    private $processable = true;
    
    static public function nameWithoutExtension($name){
        return substr($name, 0, strpos($name, '.'));
    }
    static public function extractExtension($name){
        return File::getExtension($name);
    }
    static public function locateThumbnailOf($photo){
    	if(strpos($photo, '.') !== false)
    		$name = Image::nameWithoutExtension($photo);
    	else
    		$name = $photo;;
		return $name.'.jpg';
    }
    
    public function __construct($src){
        $this->src = $src;
        $this->imageInfo = @getimagesize($src);
        if($this->isImage()){
            $this->originalWidth = $this->imageInfo[0];
            $this->originalHeight = $this->imageInfo[1];
            $this->mime = $this->imageInfo['mime'];
            $this->extension = Image::$mimeTable[$this->mime];
        }
    }
    
    public function isImage(){
         return ($this->imageInfo && $this->imageInfo[0] != 0);
    }
    public function getExtension(){
        return $this->extension;
    }
    public function saveOriginal($destination){
        if($this->isImage()){
            return File::copyAndConfirm($this->src, $destination);
        }
    }
    public function saveClone($destination){
        if($this->isProcessable()){
            $newWidth = $this->originalWidth;
            $newHeight =$this->originalHeight ;        
            $myimage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $myimage, $this->resource, 0, 0, 0, 0, 
                $newWidth, $newHeight, $this->originalWidth, $this->originalHeight
            );
            return $this->write($myimage, $destination);
        }
    }
    public function saveWidthHeight($destination, $width, $height){
        if($this->isProcessable()){
            $newWidth = $width;     
            $newHeight = $height; 
            $myimage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $myimage, $this->resource, 0, 0, 0, 0, 
                $newWidth, $newHeight, $this->originalWidth, $this->originalHeight
            );
            return $this->write($myimage, $destination);
        }
    }
    public function saveWidthHeightRatio($destination, $width, $height){
        if($this->isProcessable()){
            $wratio = $width/$this->originalWidth;
            $hratio = $height/$this->originalHeight;
            $widthIsBigger = ($wratio <= $hratio);
            if($widthIsBigger){
                $newWidth = $width;
                $newHeight = $wratio*$this->originalHeight;
            }else{
                $newWidth = $hratio*$this->originalWidth;
                $newHeight = $height;
            }
            $myimage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $myimage, $this->resource, 0, 0, 0, 0, 
                $newWidth, $newHeight, $this->originalWidth, $this->originalHeight
            );
            return $this->write($myimage, $destination);
        }
    }
    public function saveWidth($destination, $width){
        if($this->isProcessable()){
            $newWidth = $width;
            $newHeight = ($newWidth/$this->originalWidth)*$this->originalHeight;        
            $myimage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $myimage, $this->resource, 0, 0, 0, 0, 
                $newWidth, $newHeight, $this->originalWidth, $this->originalHeight
            );
            return $this->write($myimage, $destination);
        }
    }
    public function saveHeight($destination, $height){
        if($this->isProcessable()){
            $newWidth = ($newHeight/$this->originalHeight)*$this->originalWidth; 
            $newHeight = $height;     
            $myimage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $myimage, $this->resource, 0, 0, 0, 0, 
                $newWidth, $newHeight, $this->originalWidth, $this->originalHeight
            );
            return $this->write($myimage, $destination);
        }
    }
    
    private function isProcessable(){
        if($this->processable){
            return ($this->getResource());
        }else
            return false;
    }
    private function getResource(){
        if(!$this->resource)
            $this->createResource();
        return $this->resource;
    }
    private function createResource(){
        switch($this->extension){
            case 'jpg' : 
                $resource = @imagecreatefromjpeg($this->src);
            break;
            case 'gif' :
                $resource = @imagecreatefromgif($this->src);
            break;
            case 'png':
                $resource = @imagecreatefrompng($this->src);
            break;
        }
        if($resource){
            $this->resource = $resource;
        }else{
            $this->processable = false;
        }
    }
    private function write($myimage, $destination){
        $result = imagejpeg($myimage, $destination);
        imagedestroy($myimage);
        return ($result && is_file($destination));
    }
    
}

?>