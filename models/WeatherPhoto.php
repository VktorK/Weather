<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class WeatherPhoto extends Model
{
    public $weatherPhoto;

    public function rules(): array
    {
        return [
            [['weatherPhoto'], 'required'],
            [['weatherPhoto'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {

        $this->weatherPhoto = $file;

        if($this->validate()) {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
        return false;
    }

    public function getFolders(): string
    {
        return Yii::getAlias('@web') . 'uploads/' . Yii::$app->user->email . '/';
    }

    public function generateFileName(): string
    {
        return strtolower(md5(uniqid($this->weatherPhoto->baseName))) . Yii::$app->user->email . '.' . $this->weatherPhoto->extension;
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
        $this->weatherPhoto->saveAs($this->getFolders() . $filename);

        return $filename;
    }

}