<?php

session_start();

$connection = mysqli_connect("localhost","root","","crud_exercise");

//Default Value so doesn't display error while updating the record
$firstName = '';
$lastName = '';
$companyName = '';
$email = '';
$phone = '';
$update = false;
$id = 0;

/////////Add an employee to the list
 if(isset($_POST['add'])){
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $companyName = $_POST['companyName'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   $query_select = "SELECT * FROM company WHERE name='$companyName'";
   $run_query_select = mysqli_query($connection,$query_select);
   $result = mysqli_fetch_assoc($run_query_select);

   //If the related company exist in the company menu, the record can be saved
   if($result['name']==$companyName){
     $query_insert = "INSERT INTO employee(id,firstName,lastName,companyName,email,phone)
         VALUES('NULL','$firstName','$lastName','$companyName','$email','$phone')";
     $run_query_insert = mysqli_query($connection,$query_insert);

     $_SESSION['message'] = "Record has been saved!";
     $_SESSION['msg_type'] = "success";
   //If not, the record can't be saved
   } else{
     $_SESSION['message'] = "We have no corresponding company, impossible to save the record.";
     $_SESSION['msg_type'] = "warning";
   }


   header("location: ../employee.php");
 }

 /////////Delete an employee from the list
 if(isset($_GET['delete'])){
   $id = $_GET['delete'];

   $query_delete = "DELETE FROM employee WHERE id='$id'";
   $run_query_delete = mysqli_query($connection,$query_delete);

   $_SESSION['message'] = "Record has been deleted!";
   $_SESSION['msg_type'] = "danger";

   header("location: ../employee.php");
 }

 /////////Change the "add" form into an "edit" form so we can update the record
 if(isset($_GET['edit'])){
   $id = $_GET['edit'];

   $query_edit = "SELECT * FROM employee WHERE id='$id'";
   $run_query_edit = mysqli_query($connection,$query_edit);

   $result = mysqli_fetch_assoc($run_query_edit);
   $firstName = $result['firstName'];
   $lastName = $result['lastName'];
   $companyName = $result['companyName'];
   $email = $result['email'];
   $phone = $result['phone'];
   $update = true;
 }

 /////////Update an employee's info from the list
 if(isset($_POST['update'])){
   $id = $_POST['id'];
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $companyName = $_POST['companyName'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   $query_select = "SELECT * FROM company WHERE name='$companyName'";
   $run_query_select = mysqli_query($connection,$query_select);
   $result = mysqli_fetch_assoc($run_query_select);

   //If we want to update the company name and it exists in the company menu, update the record
   if($result['name']==$companyName){
     $query_update = "UPDATE employee SET firstName='$firstName', lastName='$lastName', companyName='$companyName', email='$email', phone='$phone' WHERE id='$id'";
     $run_query_update = mysqli_query($connection,$query_update);

     $_SESSION['message'] = "Record has been updated!";
     $_SESSION['msg_type'] = "success";

   //If we want to update the company name but it doen't exist in the company menu, don't update the record
   } else{
     $_SESSION['message'] = "We have no corresponding company, impossible to update the record.";
     $_SESSION['msg_type'] = "warning";
   }

   header("location: ../employee.php");
 }
  ?>
