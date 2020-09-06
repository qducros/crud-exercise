<?php
  include('includes/header.php');
  include('includes/connect_company.php');
?>

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
<form method="post" action="includes/connect_company.php" class="container">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name; ?>" placeholder="Required" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail">Email</label>
      <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo $email; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputLogo">Logo</label>
      <input type="url" class="form-control" id="inputLogo" name="logo" value="<?php echo $logo; ?>" placeholder="Enter logo's url">
      <small id="logoInfo" class="form-text text-muted">Resized if less than 100x100 pixels.</small>
    </div>
    <div class="form-group col-md-6">
      <label for="inputWebsite">Website</label>
      <input type="url" class="form-control" id="inputWebsite" name="website" value="<?php echo $website; ?>" placeholder="Enter website's url">
    </div>
  </div>

  <div class="form-group">
    <?php if($update){ ?>
      <button type="submit" class="btn btn-outline-primary" name="update" value="update">Update</button>
    <?php } else { ?>
      <button type="submit" class="btn btn-primary" name="add" value="add">Add to the table</button>
    <?php } ?>
  </div>
</form>

<br>

<div class="container">
  <h2>List of Companies</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Logo</th>
        <th>Website</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query_select_all = "SELECT * FROM company";
        $run_query_select_all = mysqli_query($connection,$query_select_all);
        while($result = mysqli_fetch_assoc($run_query_select_all)){
          ?>
          <tr>
            <td><?php echo $result['name']; ?></td>
            <td><?php echo $result['email']; ?></td>
            <td><?php if($result['logo']){ ?><img src="<?php echo $result['logo']; ?>" alt="logo" style="min-width:100px;min-height:100px;"><?php } ?></td>
            <td><?php if($result['website']){ ?><a href="<?php echo $result['website']; ?>">Link to <?php echo $result['name']; ?></a><?php } ?></td>
            <td><a href="company.php?edit=<?php echo $result['id']; ?>" class="btn btn-outline-primary">Edit</a>
                <a href="includes/connect_company.php?delete=<?php echo $result['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include('includes/footer.php'); ?>
