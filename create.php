<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "POST"){
    
    $inputData = json_decode(file_get_content("php://input"),true);
    
    if(empty($inputData)){
        
        $storehorizonStu = horizonStu($_POST);
        
    }else{
        $storehorizonStu = horizonStu($inputData);   
    }
    
    echo $storehorizonStu;

}
else{
    $data = [
        'status' => 405,
        'message' => $requestMethod. 'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>