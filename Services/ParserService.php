<?php

namespace app\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\Html;

class ParserService
{
    public static function toTable($array)
    {
        $tableHtml = '<table border="1" style="border-collapse: collapse; width: 100%;">';
        $tableHtml .= '<tr><th>id</th><th>email</th><th>weather_id</th><th>is_send</th></tr>'; // Заголовки таблицы

        // Наполняем таблицу данными
        foreach ($array as $row) {
            $tableHtml .= '<tr>';
            $tableHtml .= '<td>' . htmlspecialchars($row['id']) . '</td>';
            $tableHtml .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $tableHtml .= '<td>' . htmlspecialchars($row['weather_id']) . '</td>';
            $tableHtml .= '<td>' . htmlspecialchars($row['is_send']) . '</td>';
            $tableHtml .= '</tr>';
        }

        $tableHtml .= '</table>';
        return $tableHtml;
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