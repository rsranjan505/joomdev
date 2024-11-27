<?php
include('config.php');

// Fetch records from database
$sql = "SELECT id, start_time, stop_time, notes, description FROM tasks";
$result = $conn->query($sql);


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=tasks.csv');

$output = fopen('php://output', 'w');

// Output the column headings
$fields = array('ID', 'Start Time', 'Stop Time', 'Notes', 'Description');
fputcsv($output, $fields);

// Fetch the records and output them
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
