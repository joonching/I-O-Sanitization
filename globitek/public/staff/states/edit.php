<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);
    $err_arr = [];

     if(isset($_POST['submit'])) {
        if (isset($_POST['name'])) {
            $state['name'] = $_POST['name'];
        }
        if (isset($_POST['code'])) {
            $state['code'] = $_POST['code'];
        }
        if (isset($_POST['country_id'])) {
            $state['country_id'] = $_POST['country_id'];
        }
        $status = insert_state($state);
        if ($status === true) {
            $new_id = db_insert_id($db);
            redirect_to('show.php?id=' . $new_id);
        }
        else {
            $err_arr = $status;
        }
     }

?>
<?php $page_title = 'Staff: Edit State ' . $state['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
    <a href="index.php">Back to States List</a><br />

    <h1>Edit State: <?php echo $state['name']; ?></h1>
    <?php echo display_errors($err_arr); ?>
    
    <form action="edit.php?id=<?php echo $state['id']; ?>" method="post">
  	Name:
    <br/>
  	     <input type="text" name="name" value="<?php echo $state['name']; ?>" />
    <br/>
  	Code:
    <br/>
  	     <input type="text" name="code" value="<?php echo $state['code']; ?>" /><br />
  	Country ID:
    <br />
  	     <input type="number" name="country_id" value="<?php echo $state['country_id']; ?>" /<br />
  	<br />
  	<input type="submit" name="submit" value="Edit" />
    
    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
