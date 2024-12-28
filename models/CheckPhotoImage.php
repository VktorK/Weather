<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class CheckPhotoImage extends Model
{
    public $check_photo;

    public function rules(): array
    {
        return [
            [['check_photo'], 'safe'],
            [['check_photo'], 'file', 'extensions' => 'jpg,png,jpeg', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    public function attributeLabels()
    {
        return [
            'check_photo' => 'Фотография чека',
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
        return Yii::getAlias('@web') . 'uploads/check_photo/';
    }

    public function generateFileName(): string
    {
        return strtolower(md5(uniqid($this->check_photo->baseName))) . '.' . $this->check_photo->extension;
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