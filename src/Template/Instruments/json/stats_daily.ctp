<?php 
foreach ($data as &$d) {
    $d->date = $d->date->i18nFormat('yyyy-MM-dd');
}

echo json_encode($data, JSON_PRETTY_PRINT);
