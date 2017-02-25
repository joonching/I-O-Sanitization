<?php
require_once('../../../private/initialize.php');
    if(!isset($_GET['state_id'])) {
        redirect_to('../states/index.php');
    }
    $_sid = $_GET['state_id'];
    // Set default values for all variables the page needs.
    $err_arr= [];
    $territory_vals = array(
        'name' => '',
        'state_id' => $state_id,
        'position' => NULL
    );
    if (is_post_request()) {
        // Confirm that values are present before accessing them.
        if (isset($_POST['name'])) {
            $territory_vals['name'] = $_POST['name'];
        }
        if (isset($_POST['position'])) {
            $territory_vals['position'] = $_POST['position'];
        }
        $result = insert_territory($territory_vals);
        if ($result === true) {
            $new_id = db_insert_id($db);
            redirect_to('show.php?id=' . $new_id);
        }
        else {
            $err_arr = $result;
        }
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/show.php?id=<?php echo $_sid ?>">Back to State Details</a><br />

  <h1>New Territory</h1>

  <!-- TODO add form -->
    <?php echo display_errors($err_arr); ?>

      <form action="new.php?state_id=<?php echo $_sid; ?>" method="post">
        Name:<br /><input type="text" name="name" value="<?php echo $territory['name']; ?>" /><br />
        Position:<br /><input type="number" name="position" value="<?php echo $territory['position']; ?>" /><br /><br />
        <input type="submit" name="submit" value="Submit" />
      </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
