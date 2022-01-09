<?php
include "Services.php";
$data = $_POST['table'];
$text = '';
for ($i = 0; $i < count($data); $i++) {
    if ($i == 0) {
        $text .= $data[$i];
    } else {
        $text .= ',' . $data[$i];
    }
}
enregistre_data($text);
$result = get_data();
$result = json_decode($result);
$tab = '';
foreach ($result as $table) {
    $tab .= "<tr>";
    for ($i = 1; $i < count($table); $i++) {
        $tab .= '<td>' . $table[$i] . '</td>';
    }
    $tab .= "</tr>";
}

echo $tab;

//echo $text;
