<?php
	session_start();
	if(!isset($_SESSION['turn']))
	{
		$_SESSION['turn'] = 1;
	}
	if(!isset($_SESSION['win']))
	{
		$_SESSION['win'] = 0;
	}
	$winArray = array(array(1,2,3),array(4,5,6),array(7,8,9),array(1,4,7),array(2,5,8),array(3,6,9),array(1,5,9),array(3,5,7));
?>
<script type="text/javascript">
	function disable()
	{
		var elems = document.getElementsByClassName("button");
		for(var i = 0; i < elems.length; i++) {
    	elems[i].disabled = true;
		}
	}
</script>
<form method="GET" action="ticTacToeSession.php">
<center>

<h3>
	Player 1 = O<br>
	Player 2 = X
</h3>
	<table>
		<tr>
		<?php
			for($i=1;$i<=9;$i++)
			{
				echo "<td>";
				$str = "button".strval($i);
				printButton($str);
				echo "</td>";
				if($i==3 || $i==6 || $i==9){
					echo "</tr> <tr>";
				}
			}
		?>
		</tr>
	</table>
<br>
<?php
	if($_SESSION['turn']<=10)
	{
		for($i=0;$i<count($winArray);$i++)
		{
			for($j=0;$j<count($winArray[$i]);$j++)
			{
				$str = "button";
				checkwin($str.strval($winArray[$i][$j]),
						$str.strval($winArray[$i][$j+1]),
						$str.strval($winArray[$i][$j+2]));
				break;
			}
		}
		if($_SESSION['win'] == 0)
		{
			if($_SESSION['turn']%2==0){
				echo "<span> Player 2's Turn </span><br>";
			}
			else{
				echo "<span> Player 1's Turn </span><br>";
			}
		}	
	}
	else
	{
		if($_SESSION['turn']>9 and $_SESSION['win'] == 0)
		{
			echo "<span> It's Draw </span><br>";
		}
	}
?>
<br>
<br>
<input type="submit" name="newGame" value="NEW GAME" class="example_a">

<?php	
	
?>
</center>
</form>
<?php
	for($i=1;$i<=9;$i++)
	{
		$str = "button".strval($i);
		if(isset($_GET[$str])){
		updateButton($str);
		}
	}
	
	if(isset($_GET['newGame'])){
		session_destroy();
		header("Location: " . $_SERVER['PHP_SELF']);
	}
?>
<?php
		function printButton($name)
		{
			if(isset($_SESSION[$name]))
			{
				if($_SESSION[$name]=="X"){
					echo '<input type="submit" class="button" value="X" disabled="">';
				}
				else
				{
					if($_SESSION[$name]=="O"){
						echo '<input type="submit" class="button" value="O" disabled="">';
					}
				}
			}
			else
			{
				if($_SESSION['win'] == 1){
					echo '<input type="submit" name=' . $name . ' class="button" value="" disabled="">';
				}
				else{
					echo '<input type="submit" name=' . $name . ' class="button" value="">';
				}
			}
		}
		function updateButton($name)
		{
			if($_SESSION['turn']%2 == 0){
				$_SESSION[$name]="X";
				$_SESSION['turn'] = $_SESSION['turn'] + 1;
				header("Location: " . $_SERVER['PHP_SELF']);
			}
			else
			{
				$_SESSION[$name]="O";
				$_SESSION['turn'] = $_SESSION['turn'] + 1;
				header("Location: " . $_SERVER['PHP_SELF']);
			}
		}


	function checkWin($a,$b,$c)
	{
		if(isset($_SESSION[$a]) and isset($_SESSION[$b]) and isset($_SESSION[$c]))
		{
			if($_SESSION[$a] == $_SESSION[$b] and $_SESSION[$a] == $_SESSION[$c] and $_SESSION['win'] == 0)
			{
				if($_SESSION['turn']%2 == 0)
				{
					echo "<br><br><span class='text'>Player 1 Wins<br></span>";	
					$_SESSION['win'] = 1;
					echo "<SCRIPT LANGUAGE='javascript'>disable();</SCRIPT>";
				}
				else
				{
					echo "<br><br><span class='text'>Player 2 Wins<br></span>";
					$_SESSION['win'] = 1;
					echo "<SCRIPT LANGUAGE='javascript'>disable();</SCRIPT>";
				}
			}
		}
	}
?>

<style type="text/css">
	.button
	{
		width: 100px;
		height: 100px;
		background-color: #4CAF50;
  		color: white;	
  		text-align: center;
  		display: inline-block;
  		font-size: 50px;

	}
   .text
   {
   		background-color: cyan;
   		font-size: 50px;
   		align-content: center;
   }
   .example_a
   {
		color: #fff !important;
		text-transform: uppercase;
		text-decoration: none;
		background: #ed3330;
		padding: 20px;
		border-radius: 5px;
		display: inline-block;
		border: none;
		transition: all 0.4s ease 0s;
		font-family: "Trebuchet MS", Verdana, sans-serif;
		font-weight: bolder;
	}
	.example_a:hover 
	{
		background: #434343;
		letter-spacing: 1px;
		-webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
		-moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
		box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
		transition: all 0.4s ease 0s;
	}
	h3 {
  	font-family: "Trebuchet MS", Verdana, sans-serif;
	}
	span{
	font-family: "Trebuchet MS", Verdana, sans-serif;
	font-size: 25px;
	}
</style>