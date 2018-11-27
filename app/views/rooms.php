<?php 
include '../page/header.php';
?>
	<div id="page" class="container">
	<table class='roomstable'>	
<?php
$rooms  = getRooms();
foreach ($rooms as $room) {
?>
	<tr class="room">
		<td><img  class="image-left" src="../../images/<?php echo $room['roomid'] ?>.jpg" /></td>
		<td class="roomtext">Room Type : <?php echo $room['type']?>
							<br/> <br/>
							Room Description : <?php echo $room['description']?>
							<br/> <br/>
		</td>
	</tr>
<?php
}
?>
	</table>
	</div>
<?php
include '../page/footer.php';      
