<?php

use League\Csv\Reader;

require './csv-9.1.4/autoload.php';

$inputCsv = Reader::createFromPath('./formdata-19.csv');
$inputCsv->setDelimiter(';');
$inputCsv->setEncodingFrom("iso-8859-15");
$inputCsv->setLimit(30); //we are limiting the convertion to the first 31 rows
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Using the toHTML() method</title>
    <link rel="stylesheet" href="example.css">
</head>
<body>
<?=$inputCsv->toHTML('table-csv-data with-header');?>
</body>
</html>
