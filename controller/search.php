<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/search.php';

if(isset($_GET['action']) && $_GET['action'] == 'auto_input') {
	$name = isset($_GET['name']) ? $_GET['name'] : "";

	$searchModel = new SearchModel;
	$search = $searchModel->searchNameFull($name);
	echo json_encode($search);

}

if(isset($_GET['term'])) {
	$searchModel = new SearchModel;

	$search = $searchModel->searchName($_GET['term']);
	$result = array();

	foreach ($search as $key => $value) {
		array_push($result, $value['Name']);		
	}
	$result = array_unique($result);
	echo json_encode($result);
}

?>