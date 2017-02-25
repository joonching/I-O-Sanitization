<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$territories_result = find_territory_by_id($_GET['id']);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);
$_sid = $territory['state_id'];
    $err_arr = [];
     if(isset($_POST['submit'])) {
        if (isset($_POST['name'])) {
		$territory['name'] = $_POST['name'];
        }
        if (isset($_POST['state_id'])) {
            $territory['state_id'] = $_POST['state_id'];
        }
        if (isset($_POST['position'])) {
            $territory['position'] = $_POST['position'];
        }
        $status = update_territory($territory);
        if ($status === true) {
            redirect_to('show.php?id=' . $territory['id']);
        }
        else {
            $err_arr = $status;
        }
     }



?>
<?php $page_title = 'Staff: Edit Territory ' . $territory['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/show.php?id=<?php echo $_sid ?>">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo $territory['name']; ?></h1>
    <?php echo display_errors($err_arr); ?>
    
    Name:<br/><input type="text" name="name" value="<?php echo $territory['name']; ?>" /><br />
  	State ID:<br /><input type="number" name="state_id" value="<?php echo $territory['state_id']; ?>" /><br />
  	Position:<br /><input type="number" name="position" value="<?php echo $territory['position']; ?>" /><br /><br />
  	<input type="submit" name="submit" value="Edit" />

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
