<?php

require "vendor/autoload.php";

$data = new \Phpml\Dataset\CsvDataset("/data/insurance.csv", 1, true);

$dataSet = new \Phpml\CrossValidation\RandomSplit($data, 0.2, 156);

// $dataSet->getTrainSamples();
// $dataSet->getTrainLabels();
// $dataSet->getTestSamples();
// $dataSet->getTestLabels();