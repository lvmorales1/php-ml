<?php

use Phpml\CrossValidation\RandomSplit;
use Phpml\Dataset\CsvDataset;
use Phpml\Metric\Regression;
use Phpml\Regression\LeastSquares;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Regression\SVR;
use Phpml\Metric\Accuracy;

require "vendor/autoload.php";

$data = new CsvDataset("data/wine.csv", 13, true);

// $dataSet = new RandomSplit($data, 0.2, 156);
$dataSet = new RandomSplit($data, 0.2, 156);

// $regression = new LeastSquares();
$regression = new SVR();
$regression->train($dataSet->getTrainSamples(), $dataSet->getTrainLabels());

$predict = $regression->predict($dataSet->getTestSamples());

$score = Regression::r2Score($dataSet->getTestLabels(), $predict);
echo "R2 Score: " . $score . "\n";

foreach ($predict as &$target) {
    $target = round($target, 0);
}

$accurace = Accuracy::score($dataSet->getTestLabels(), $predict);
echo "Accuracy: " . $accurace . "\n";