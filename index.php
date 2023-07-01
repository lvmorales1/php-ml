<?php

use Phpml\CrossValidation\RandomSplit;
use Phpml\Dataset\CsvDataset;
use Phpml\Metric\Regression;
use Phpml\Regression\LeastSquares;

require "vendor/autoload.php";

$data = new CsvDataset("data/insurance.csv", 1, true);

$dataSet = new RandomSplit($data, 0.2, 156);

$regression = new LeastSquares();
$regression->train($dataSet->getTrainSamples(), $dataSet->getTrainLabels());

$predict = $regression->predict($dataSet->getTestSamples());

$score = Regression::r2Score($dataSet->getTestLabels(), $predict);

echo "R2 Score: " . $score . "\n";