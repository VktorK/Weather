<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class WeatherPhotoImage extends Model
{
    public $weather_photo;

    public function rules()
    {
        return [
            [['weather_photo'], 'safe'],
            [['weather_photo'], 'file', 'extensions' => 'jpg,png,jpeg', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    public function attributeLabels()
    {
        return [
            'weather_photo' => 'Фотография товара',
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {

        $this->weather_photo = $file;

        if($this->validate()) {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
        return false;
    }

    public function getFolders(): string
    {
        return Yii::getAlias('@web') . 'uploads/weather_photo/';
    }

    public function generateFileName(): ?string
    {
        return strtolower(md5(uniqid($this->weather_photo->baseName))) . '.' . $this->weather_photo->extension;
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
        $this->weather_photo->saveAs($this->getFolders() . $filename);

        return $filename;
    }
}