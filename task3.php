<?php
function countTuesdays($startDate, $endDate) {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1D');
    $period = new DatePeriod($start, $interval, $end);

    $count = 0;
    foreach ($period as $date) {
        // 2 - вторник
        if ($date->format('N') == 2) {
            $count++;
        }
    }

    return $count;
}

$startDate = '2023-01-01';
$endDate = '2023-11-17';

$tuesdayCount = countTuesdays($startDate, $endDate);
echo "<h3>Количество вторников между $startDate и $endDate <h2>";
echo "<h1>$tuesdayCount<h2>";




