<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class CheckPhoto extends Model
{
    protected $check_photo;

//    public function __construct($check_photo)
//    {
//        $this->check_photo = $check_photo;
//        parent::__construct();
//    }

    public function rules(): array
    {
        return [
            [['check_photo'], 'required'],
            [['check_photo'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {

        $this->check_photo = $file;

        if($this->validate()) {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
        return false;
    }

    public function getFolders(): string
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    public function generateFileName(): string
    {
        return strtolower(md5(uniqid($this->check_photo->baseName))) . Yii::$app->user->email . '.' . $this->check_photo->extension;
    }

    public function deleteCurrentImage($currentImage): void
    {
        if ($this->imageExists($currentImage)) {
            unlink($this->getFolders() . $currentImage);
        }
    }

    public function imageExists($currentImage): string
    {
        if(!empty($currentImage) && $currentImage != null) {
            return file_exists($this->getFolders() . $currentImage);
        }
        return false;
    }

    public function saveImage(): string
    {
        $filename = $this->generateFileName();
        $this->check_photo->saveAs($this->getFolders() . $filename);

        return $filename;
    }

}