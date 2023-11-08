<?php

function csvToJson($csvUrl) {
    $csvData = [];

    if (($handle = fopen($csvUrl, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = [];

    foreach ($csvData as $row) {
        $jsonArrayItem = []; // Perbaikan: harus ada tanda kurung kotak kosong
        for ($i = 0; $i < count($headers); $i++) { // Perbaikan: tambahkan tanda "=" dan kondisi "for" yang benar
            $jsonArrayItem[$headers[$i]] = $row[$i];
        }
        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

$csvUrl = 'https://kylabelvaqueena.alwaysdata.net/W9/datapribadi.csv';
$jsonData = csvToJson($csvUrl);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
