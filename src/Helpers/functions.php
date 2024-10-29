<?php
namespace DP\Helpers;

function response(mixed $data):void {
	echo json_encode($data);
}