<?php
// for debug
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( -1 );

// include libraries
include("FlatJson.class.php");
include("InflateJson.class.php");

// if no json input, show the form and exit
if ( !isset($_POST["jsonString"])){
	include ("form.view.php");
	return;
}else{
	$jsonString = $_POST["jsonString"];
}

// flat the json to array
$flatJson = new FlatJson($jsonString);
$flatList = $flatJson -> flatToArray();
if($flatList == false){

	echo "<h2>".$flatJson -> errorMessage."</h2>";
	include ("form.view.php");
	return;
}

// flat the json to json format
$flattenJson = $flatJson -> flatToJson();

// inflate the json
$inflateJson = new InflateJson($flattenJson);

// test inflate to fail
$inflateResult = $inflateJson->inflate();

if($inflateResult == false){

	echo "<h2>".$inflateJson -> errorMessage."</h2>";
	include ("form.view.php");
	return;
}
include("form.view.php");

// print out the result
include("result.view.php");
?>
