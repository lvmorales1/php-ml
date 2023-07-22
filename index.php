<?php

use Phpml\CrossValidation\RandomSplit;
use Phpml\Dataset\CsvDataset;
use Phpml\Metric\Regression;
use Phpml\Regression\LeastSquares;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Regression\SVR;
use Phpml\Metric\Accuracy;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Clustering\KMeans;

require "vendor/autoload.php";

$data = new CsvDataset("data/iris.csv", 4, true);

$clustering = new KMeans(3);
$clusters = $clustering->cluster($data->getSamples());

$file = fopen("clustered_data.csv", "w");
foreach($clusters as $key => $cluster) {
    foreach($cluster as $data) {
        $dataToWrite = [...$data, $key];
        fputcsv($file, $dataToWrite);
    }
}

fclose($file);

