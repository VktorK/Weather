<?php

namespace app\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\Html;

class ParserService
{
    public static function toTable($array)
    {
        $html = '<h1>Данные</h1>';
        $html .= '<table class="table table-bordered">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>id</th>';
        $html .= '<th>email</th>';
        $html .= '<th>weather_id</th>';
        $html .= '<th>is_send</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        if (!empty($array)) {
            foreach ($array as $item) {
                $html .= '<tr>';
                $html .= '<td>' . Html::encode($item['id']) . '</td>';
                $html .= '<td>' . Html::encode($item['email']) . '</td>';
                $html .= '<td>' . Html::encode($item['weather_id']) . '</td>';
                $html .= '<td>' . Html::encode($item['is_send']) . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="4">Нет данных для отображения.</td></tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Возвращаем сгенерированный HTML
        return $html;
    }


    public static function toXl($mails)
    {
        $data = [
            ['id' => 1, 'email' => 'user1@example.com', 'weather_id' => 101, 'is_send' => true],
            ['id' => 2, 'email' => 'user2@example.com', 'weather_id' => 102, 'is_send' => false],
            ];

// Создаем новый объект Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

// Установка заголовков
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Weather ID');
        $sheet->setCellValue('D1', 'Is Send');

// Заполнение данными
        $row = 2; // Начинаем со второй строки
        foreach ($mails as $item) {
            $sheet->setCellValue('A' . $row, $item['id']);
            $sheet->setCellValue('B' . $row, $item['email']);
            $sheet->setCellValue('C' . $row, $item['weather_id']);
            $sheet->setCellValue('D' . $row, $item['is_send'] ? 'Yes' : 'No'); // Преобразуем boolean в текст
            $row++;
        }

// Сохранение файла
        $filePath = 'uploads/data.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
//        var_dump($filePath);die();
        return $filePath;
    }
}