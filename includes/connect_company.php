<?php

session_start();

$connection = mysqli_connect("localhost","root","","crud_exercise");

//Default Value so doesn't display error while updating the record
$name = '';
$email = '';
$logo = '';
$website = '';
$update = false;
$id = 0;

/////////Add a company to the list
 if(isset($_POST['add'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $logo = $_POST['logo'];
   $website = $_POST['website'];

   $query_insert = "INSERT INTO company(id,name,email,logo,website)
       VALUES('NULL','$name','$email','$logo','$website')";
   $run_query_insert = mysqli_query($connection,$query_insert);

   $_SESSION['message'] = "Record has been saved!";
   $_SESSION['msg_type'] = "success";

   header("location: ../company.php");
 }

 /////////Delete a company from the list
 if(isset($_GET['delete'])){
   $id = $_GET['delete'];

   //First delete related employees from database (care if several companies have the same name)
   $query_select = "SELECT * FROM company WHERE id='$id'";
   $run_query_select = mysqli_query($connection,$query_select);
   $result = mysqli_fetch_assoc($run_query_select);
   $name = $result['name'];

   $query_delete = "DELETE FROM employee WHERE companyName='$name'";
   $run_query_delete = mysqli_query($connection,$query_delete);

   //Then delete the company from database
   $query_delete = "DELETE FROM company WHERE id='$id'";
   $run_query_delete = mysqli_query($connection,$query_delete);

   $_SESSION['message'] = "Record and related employees have been deleted!";
   $_SESSION['msg_type'] = "danger";

   header("location: ../company.php");
 }

 /////////Change the "add" form into an "edit" form so we can update the record
 if(isset($_GET['edit'])){
   $id = $_GET['edit'];

   $query_edit = "SELECT * FROM company WHERE id='$id'";
   $run_query_edit = mysqli_query($connection,$query_edit);

   $result = mysqli_fetch_assoc($run_query_edit);
   $name = $result['name'];
   $email = $result['email'];
   $logo = $result['logo'];
   $website = $result['website'];
   $update = true;
 }

 /////////Update a company's info from the list
 if(isset($_POST['update'])){
   $id = $_POST['id'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $logo = $_POST['logo'];
   $website = $_POST['website'];

   //First update related employees
   $query_select = "SELECT * FROM company WHERE id='$id'";
   $run_query_select = mysqli_query($connection,$query_select);
   $result = mysqli_fetch_assoc($run_query_select);
   $name_old = $result['name'];

   $query_update = "UPDATE employee SET companyName='$name' WHERE companyName='$name_old'";
   $run_query_update = mysqli_query($connection,$query_update);

   //Then update the company
   $query_update = "UPDATE company SET name='$name', email='$email', logo='$logo', website='$website' WHERE id='$id'";
   $run_query_update = mysqli_query($connection,$query_update);

   $_SESSION['message'] = "Record has been updated!";
   $_SESSION['msg_type'] = "info";

   header("location: ../company.php");
 }
  ?>
