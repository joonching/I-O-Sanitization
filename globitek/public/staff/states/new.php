<?php
    require_once('../../../private/initialize.php');

    $err_arr = [];
    $state_vals = array('name' => '', 'code' => '', 'country_id' => NULL);
    
     if(isset($_POST['submit'])) {
        if (isset($_POST['name'])) {
            $state_vals['name'] = $_POST['name'];
        }
        if (isset($_POST['code'])) {
            $state_vals['code'] = $_POST['code'];
        }
        if (isset($_POST['country_id'])) {
            $state_vals['country_id'] = $_POST['country_id'];
        }
        $status = insert_state($state_vals);
        if ($status === true) {
            $new_id = db_insert_id($db);
            redirect_to('show.php?id=' . $new_id);
        }
        else {
            $err_arr = $status;
        }
     }

?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="#add_a_url">Back to States List</a><br />

  <h1>New State</h1>
    <?php echo display_errors($err_arr); ?>
  <form action="new.php" method="post">
      Name:
      <br/>
      <input type="text" name="name" value="<?php echo $state_vals['name']; ?>" />
      <br/>
      Code:
      <br/>
      <input type="text" name="code" value="<?php echo $state_vals['code']; ?>" />
      <br/>
      Country ID:
      <br/>
      <input type="number" name="country_id" value="<?php echo $state_vals['country_id']; ?>" />
      <br/>
      <input type="submit" name="submit" value="Submit" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
