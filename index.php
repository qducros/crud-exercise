<?php
  include('includes/header.php');
  include('includes/connect.php');
?>

<div style="margin-left:5%;">
  <h1>Welcome in my solution for the CRUD exercise</h1>
  <h3>Company Menu</h3>
  <ul>
    <li>Four columns : name, email, logo and website.</li>
    <li>Only the name feature is required.</li>
    <li>To input logos or websites, the url is needed.</li>
    <li>The logo will be resized if smaller than 100x100 px.</li>
    <li>If a company is deleted, all the related employees will be <br>
      deleted aswell.</li>
    <li>When you edit a company name, the change also occurs in the <br>
      employee menu.</li>
    <li>The menu allows to have several companies with the same name. <br>
      If so and if you want to delete one of them, it will also delete all <br>
      the employees from both companies.</li>
  </ul>
  <h3>Employee Menu</h3>
  <ul>
    <li>Five columns : first name, last name, company name, email and phone.</li>
    <li>Only the first name, last name and company name are required.</li>
    <li>You can't add an employee if the related company doesn't exist in <br>
      the company menu.</li>
    <li>You can't edit the related company if there is no such company in <br>
      the corresponding menu.</li>
  </ul>
</div>

<?php include('includes/footer.php'); ?>
