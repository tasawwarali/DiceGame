
<?php
require_once('header.php');
require_once('model.php');
 
 
if( isset($_SESSION['user_id']) && !empty($_SESSION['username']) ) { ?>

<div class="topnav">
  <a href="home.php">Game Home</a>
  <a class="active" href="score.php">Score Board</a>
  <a href="logout.php">Logout</a>

  <p>Hi, <?php echo $_SESSION['username']; ?></p>

</div>


<?php } else {
	header('Location: login.php');
}?>

<table id="customers">
		<tr>
			<th>Opponent Id</th>
			<th>Your Score</th>
			<th>Opponent Score</th>
			<th>Your Status</th>
			<th>Opponent Status</th>
			<th>Date</th>
		</tr>
		<?php $players = get_scores();
		while($row = $players->fetch_assoc()) { 
			if( $row['p1_id'] == $_SESSION["user_id"] ) {
				$temp = '1';
				$temp2 = '2';
			} else {
				$temp = '2';
				$temp2 = '1';
			}
		 ?>
			<tr>
				<td><?php echo $row['p'.$temp2.'_id']; ?></td>
				<td><?php echo $row['p'.$temp.'_score']; ?></td>
				<td><?php echo $row['p'.$temp2.'_score']; ?></td>
				<td><?php echo $row['p'.$temp.'_status']; ?></td>
				<td><?php echo $row['p'.$temp2.'_status']; ?></td>
				<td><?php echo $row['created']; ?></td>
			</tr>
		<?php } ?>
	</table>


<?php
require_once('footer.php');
?>