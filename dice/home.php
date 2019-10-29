
<?php
require_once('model.php');

require_once('header.php');
 
 
if( isset($_SESSION['user_id']) && !empty($_SESSION['username']) ) { ?>

<div class="topnav">
  <a class="active" href="home.php">Game Home</a>
  <a href="score.php">Score Board</a>
  <a href="logout.php">Logout</a>

  <p>Hi, <?php echo $_SESSION['username']; ?></p>

</div>


<?php } else {
	header('Location: login.php');
}?>



<div id="list" >
	<table id="customers">
		<tr>
			<th>Player</th>
			<th>Challenge</th>
		</tr>
		<?php $players = online_players();
		while($row = $players->fetch_assoc()) { 
 			if( $row["id"] != $_SESSION["user_id"] ) {
		 ?>
			<tr>
				<td><?php echo $row['username']; ?></td>
				<td> <button id="<?php echo $row['id']; ?>" class="cha_btn" >  Challenge </button></td>
			</tr>
		<?php } } ?>
	</table>
</div>



<div class="main" id="game_box" style="display: none" >
	<div class="header">The Game of Dice!</div>
	<div class="board">

		<div class="sub_board">
			<div class="half">
				<p> Die </p>
				<div id="die" class="num"> - </div>
			</div>

			<div class="half">
				<p> Score </p>
				<div id="score" class="num"> - </div>
			</div>
		</div>

		<div class="status">
			<button id="roll" class="button">Roll</button>
			<button id="stop" class="button">Stop</button>
		</div>

		<div id="turn" class="turn"> Your Turn </div>

	</div>
	<div class="footer">
		<div class="player">
			<p> Your Total </p>
			<p id="your_total" > 0 </p>
		</div>
		<div class="player">
			<p> Opponent Total </p>
			<p id="op_total" > 0 </p>
		</div>
	</div>
</div>


<?php
require_once('footer.php');
?>