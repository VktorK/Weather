<?php

namespace app\Services;

use DateTime;
use DateTimeZone;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\Html;

class ParserService
{
    public static function toTable($array)
    {
        // создает таблицу и заголовки колонок
        $tableHtml = '<table border="1" style="border-collapse: collapse; width: 100%;">';
        $tableHtml .= '<tr><th>id</th><th>email</th><th>weather_id</th><th>is_send</th></tr>'; // Заголовки таблицы

        //наполняет таблицу данными
        foreach ($array as $row) {
            $tableHtml .= '<tr>';
            $tableHtml .= '<td>' . htmlspecialchars($row['id']) . '</td>';
            $tableHtml .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $tableHtml .= '<td>' . htmlspecialchars($row['weather_id']) . '</td>';
            $tableHtml .= '<td>' . htmlspecialchars($row['is_send']) . '</td>';
            $tableHtml .= '</tr>';
        }

        $tableHtml .= '</table>';
        return $tableHtml; // возвращает таблицу в виде строки
    }


    public static function toXl($mails)
    {

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
            $sheet->setCellValue('D' . $row, $item['is_send'] ? 'Yes' : 'No');
            $row++;
        }

        // Получение пути для сохранения файла
        $filePath = self::instalPath();

        // Сохранение файла
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        return $filePath;
    }

    public static function instalPath()
    {
        $timezone = new DateTimeZone('Europe/Moscow');
        $dateTime = new DateTime('now', $timezone);
        $timeStamp = $dateTime->format('d-m-Y H:i:s');
        return 'uploads/report' . '_' . $timeStamp . '.xlsx';
    }
}