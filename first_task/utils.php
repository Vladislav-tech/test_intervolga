<?php

declare(strict_types=1);

/**
 * Сформировать HTML таблицу из данных
 * @param array<array> $data Данные для формирования таблицы в виде ассоциативных массивов
 * @return string Сформированная строчка
 */
function generateTableString(array $data): string
{
    $scoreSum = [];
    $subjects = [];

    foreach ($data as [$name, $subject, $score]) {
        $scoreSum[$name][$subject] = ($scoreSum[$name][$subject] ?? 0) + $score;
        $subjects[$subject] = true;
    }

    ksort($scoreSum);
    $subjects = array_keys($subjects);

    $tableString = '<table>';
    $tableString .= '<tr><th> </th>';

    foreach ($subjects as $subject) {
        $tableString .= '<th>' . $subject . '</th>';
    }

    $tableString .= '</tr>';

    foreach ($scoreSum as $name => $scores) {
        $tableString .= '<tr><td>' . $name . '</td>';

        foreach ($subjects as $subject) {
            $score = $scores[$subject] ?? ' ';
            $tableString .= '<td>' . $score . '</td>';
        }

        $tableString .= '</tr>';
    }

    $tableString .= '</table>';

    return $tableString;
}
