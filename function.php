<?php

require 'dbConn.php';

function error422($message){
    
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocesable Entity");
    echo json_encode($data);
    exit();
}

function storehorizonStu($StudentIn){
    
    global $conn;
    
    $ino = mysqli_real_escape_string($conn, $StudentIn['index_no']);
    $fName = mysqli_real_escape_string($conn, $StudentIn['first_name']);
    $lName = mysqli_real_escape_string($conn, $StudentIn['last_name']);
    $city = mysqli_real_escape_string($conn, $StudentIn['city']);
    $district = mysqli_real_escape_string($conn, $StudentIn['district']);
    $province = mysqli_real_escape_string($conn, $StudentIn['province']);
    $email = mysqli_real_escape_string($conn, $StudentIn['email_address']);
    $phone = mysqli_real_escape_string($conn, $StudentIn['mobile_number']);

        
    if(empty(trim($ino))){
        return error422('Enter your index number');
    }elseif(empty(trim($fName))){
        return error422('Enter your first name');
    }elseif(empty(trim($lName))){
        return error422('Enter your last name');
    }elseif(empty(trim($city))){
        return error422('Enter your city');
    }elseif(empty(trim($district))){
        return error422('Enter your district');
    }elseif(empty(trim($province))){
        return error422('Enter your province');
    }elseif(empty(trim($email))){
        return error422('Enter your email');
    }elseif(empty(trim($phone))){
        return error422('Enter your phone number');
    }else{
        $query = "INSERT INTO horizonstudents (index_no, first_name, last_name, city, district, province, email_address, mobile_number) VALUES ($ino, $fName, $lName, $city, $district, $province, $email, $phone) ";
        $result = mysqli_query($conn, $query);
        
        if($result){
            $data = [
                'status' => 201,
                'message' => 'Customer Created Successfully',
            ];
            header("HTTP/1.0 201 Customer Created Successfully  ");
            echo json_encode($data);
            
            
        }else{
            $data = [
        'status' => 500,
        'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error ");
        echo json_encode($data);
        }
    }
}

function getHorizonStu(){
    
    global $conn;
    
    $query = "SELECT * FROM horizonstudents";
    $query_run = mysqli_query($conn,$query);
    
    if($query_run){
        if(mysqli_num_rows($query_run) > 0){
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            
            $data = [
                'status' => 200,
                'message' => 'Student List Display Successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
            
        }else{
            $data = [
                'status' => 404,
                'message' => 'No Customer Found',
            ];
            header("HTTP/1.0 404 No Customer Found");
            return json_encode($data);
        }
    }else{
       $data = [
                'status' => 500,
                'message' => 'Internal Srever Error',
            ];
            header("HTTP/1.0 500 Internal Srever Error");
            return json_encode($data); 
    }
} 

function updatehorizonStu($StudentIn, $stuParam){
    
    global $conn;
    
    if(isset($stuParam['id'])){
        return error422("Student ID not found in URL");
    }elseif($stuParam['id']== null ){
        return error422("Enter the Student ID");
    }
    
    $id = mysqli_real_escape_string($conn, $stuParam['id']);
    
    $ino = mysqli_real_escape_string($conn, $StudentIn['index_no']);
    $fName = mysqli_real_escape_string($conn, $StudentIn['first_name']);
    $lName = mysqli_real_escape_string($conn, $StudentIn['last_name']);
    $city = mysqli_real_escape_string($conn, $StudentIn['city']);
    $district = mysqli_real_escape_string($conn, $StudentIn['district']);
    $province = mysqli_real_escape_string($conn, $StudentIn['province']);
    $email = mysqli_real_escape_string($conn, $StudentIn['email_address']);
    $phone = mysqli_real_escape_string($conn, $StudentIn['mobile_number']);

        
    if(empty(trim($ino))){
        return error422('Enter your index number');
    }elseif(empty(trim($fName))){
        return error422('Enter your first name');
    }elseif(empty(trim($lName))){
        return error422('Enter your last name');
    }elseif(empty(trim($city))){
        return error422('Enter your city');
    }elseif(empty(trim($district))){
        return error422('Enter your district');
    }elseif(empty(trim($province))){
        return error422('Enter your province');
    }elseif(empty(trim($email))){
        return error422('Enter your email');
    }elseif(empty(trim($phone))){
        return error422('Enter your phone number');
    }else{
        $query = "UPDATE horizonstudents index_no='$ino', first_name='$fName', last_name='$lName', city='$city', district='$district', province='$province', email_address='$email', mobile_number='$phone' WHERE id='$id' LIMIT 1 ";
        $result = mysqli_query($conn, $query);
        
        if($result){
            $data = [
                'status' => 200,
                'message' => 'Customer Update Successfully',
            ];
            header("HTTP/1.0 200 Customer Update Successfully  ");
            echo json_encode($data);
            
            
        }else{
            $data = [
        'status' => 500,
        'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error ");
        echo json_encode($data);
        }
    }
}



function deletehorizonStu($stuParam){
    global $conn;
    
    if(isset($stuParam['id'])){
        return error422("Student ID not found in URL");
    }elseif($stuParam['id']== null ){
        return error422("Enter the Student ID");
    }
    
    $id = mysqli_real_escape_string($conn, $stuParam['id']);
    
    $query = "DELETE FROM horizonstudents WHERE id='$index_no' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if($result){
        $data = [
            'status' =>200,
            'message' => 'Student Delet Successfully',
        ];
        header("HTTP/1.0 200 Deleted Data");
        return json_encode($data);
        
    }else{
        $data = [
            'status' =>404,
            'message' => 'Student Not Found',
        ];
        header("HTTP/1.0 404 Not Found");
        return json_encode($data);
    }
}


?>