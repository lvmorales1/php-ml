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
use Phpml\ModelManager;

require "vendor/autoload.php";

$data = new CsvDataset("data/iris.csv", 4, true);

$dataSet = new StratifiedRandomSplit($data, 0.2, 156);

// $classifier = new KNearestNeighbors(3);
// $classifier->train($dataSet->getTrainSamples(), $dataSet->getTrainLabels());

$modelManager = new ModelManager();
$classifier = $modelManager->restoreFromFile('models/classifier');

$predicted = $classifier->predict($dataSet->getTestSamples());

$accuracy = Accuracy::score($dataSet->getTestLabels(), $predicted);
echo "Accuracy: $accuracy\n";