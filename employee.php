<?php
  include('includes/header.php');
  include('includes/connect.php');
?>

<!-- Will display a message depending on the action you made and the result of this action -->
<?php
if(isset($_SESSION['message'])){ ?>
<div class="alert alert-<?php echo $_SESSION['msg_type'];?>">
  <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
   ?>

</div>

<?php } ?>

<br>

<!-- Form -->
<!-- The value corresponds to an empty string when "add" form, and to the employee's info when "edit" form -->
<form method="post" action="includes/connect.php" class="container">
  <!-- This hidden input will give us the id of the element we are updating so we know WHERE to UPDATE -->
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputFirstName">First Name</label>
      <input type="text" class="form-control" id="inputFirstName" name="firstName" value="<?php echo $firstName; ?>" placeholder="Required" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputLastName">Last Name</label>
      <input type="text" class="form-control" id="inputLastName" name="lastName" value="<?php echo $lastName; ?>" placeholder="Required" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputCompany">Company</label>
      <input type="text" class="form-control" id="inputCompany" name="companyName" value="<?php echo $companyName; ?>" placeholder="Required" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail">Email</label>
      <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPhone">Phone</label>
      <input type="tel" class="form-control" id="inputPhone" name="phone" value="<?php echo $phone; ?>">
    </div>
  </div>

  <!-- Change the button of the form depending on the value of $update
  (true means we clicked on the edit button from the list of employee), initially $update==false -->
  <div class="form-group">
    <?php if($update){ ?>
      <button type="submit" class="btn btn-outline-primary" name="update" value="update">Update</button>
    <?php } else { ?>
      <button type="submit" class="btn btn-primary" name="add" value="add">Add to the table</button>
    <?php } ?>
  </div>
</form>

<br>

<!-- List of all employees' info with buttons edit and delete for each employee -->
<div class="container">
  <h2>List of Employees</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Company</th>
        <th>Email</th>
        <th>Phone</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query_select_all = "SELECT * FROM employee";
        $run_query_select_all = mysqli_query($connection,$query_select_all);
        while($result = mysqli_fetch_assoc($run_query_select_all)){
          ?>
          <tr>
            <td><?php echo $result['firstName']; ?></td>
            <td><?php echo $result['lastName']; ?></td>
            <td><?php echo $result['companyName']; ?></td>
            <td><?php echo $result['email']; ?></td>
            <td><?php echo $result['phone']; ?></td>
            <td><a href="employee.php?edit=<?php echo $result['id']; ?>" class="btn btn-outline-primary">Edit</a>
                <a href="includes/connect.php?delete=<?php echo $result['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include('includes/footer.php'); ?>
