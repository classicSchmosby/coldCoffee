<?php
	include('session.php');

	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "mycycle";

	$conn = mysqli_connect($server, $username, $password, $database);
	if (mysqli_connect_errno() ) {
		// display the following. - problems displaying?
		$noConn = ("Connection to <strong>" . $server . "</strong> failed, due to the following error: <strong>" . mysqli_connect_error() . "</strong>");
	} else {
		// problems display?
		$yesConn = ("Successfully Connected! You're logged into: <strong>" . $server . "</strong>");
	}

	$reviewCountQuery = mysqli_query($conn, 
		"SELECT COUNT(*) AS counter FROM rating WHERE FK_locationId = 69");
	$reviewCountDisp = mysqli_fetch_assoc($reviewCountQuery);
	$reviewCounter = $reviewCountDisp['counter'];

	// creating variables for divider widths
	$fiveRating = mysqli_query($conn, 
		"SELECT COUNT(*) AS fiveStar FROM rating WHERE (ratingOverall = 5)");
	$fiveRatingDisp = mysqli_fetch_assoc($fiveRating);
	$five_num_rows = $fiveRatingDisp['fiveStar'];
	$fiveDivider = (($five_num_rows / $reviewCounter) * 100);

	$fourRating = mysqli_query($conn, 
		"SELECT COUNT(*) AS fourStar FROM rating WHERE (ratingOverall = 4)");
	$fourRatingDisp = mysqli_fetch_assoc($fourRating);
	$four_num_rows = $fourRatingDisp['fourStar'];
	$fourDivider = (($four_num_rows / $reviewCounter) * 100);

	$threeRating = mysqli_query($conn, 
		"SELECT COUNT(*) AS threeStar FROM rating WHERE (ratingOverall = 3)");
	$threeRatingDisp = mysqli_fetch_assoc($threeRating);
	$three_num_rows = $threeRatingDisp['threeStar'];
	$threeDivider = (($three_num_rows / $reviewCounter) * 100);

	$twoRating = mysqli_query($conn, 
		"SELECT COUNT(*) AS twoStar FROM rating WHERE (ratingOverall = 2)");
	$twoRatingDisp = mysqli_fetch_assoc($twoRating);
	$two_num_rows = $twoRatingDisp['twoStar'];
	$twoDivider = (($two_num_rows / $reviewCounter) * 100);

	$oneRating = mysqli_query($conn, 
		"SELECT COUNT(*) AS oneStar FROM rating WHERE (ratingOverall = 1)");
	$oneRatingDisp = mysqli_fetch_assoc($oneRating);
	$one_num_rows = $oneRatingDisp['oneStar'];
	$oneDivider = (($one_num_rows / $reviewCounter) * 100);
?>
<?php
	if(isset($_POST['reviewPost'])) {
		date_default_timezone_set('Europe/London');
		$date = date('Y-m-d H:i:s', time());

		$reviewTitle = ($_POST['reviewTitle']);
		$reviewDesc = ($_POST['reviewDesc']);

		$submitRating = $_POST['rating'];
		if ($submitRating == '1') {
			$submitRatingVal = '1';
		}
		if ($submitRating == '2') {
			$submitRatingVal = '2';
		}
		if ($submitRating == '3') {
			$submitRatingVal = '3';
		}
		if ($submitRating == '4') {
			$submitRatingVal = '4';
		}
		if ($submitRating == '5') {
			$submitRatingVal = '5';
		}

		$reviewPostQuery = mysqli_query($conn,
			"INSERT INTO rating (ratingOverall, ratingTitle, ratingDescription, datePosted, FK_username, FK_locationId) VALUES('$submitRatingVal','$reviewTitle', '$reviewDesc', '$date', '$login_session', '69')");

		header("Location: reviewLocation.php");
	}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Review Location</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/reviewBootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/reviewLocation.css" type="text/css">
    <!-- JS -->
    <script type="text/javascript" href="assets/js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
  <body>
  <?php 
  	$userQuery = mysqli_query($conn, 
  		"SELECT * FROM users WHERE (username = '$login_session') LIMIT 1");
  	$userQueryDisp = mysqli_fetch_assoc($userQuery);
  	$currentUserId = ($userQueryDisp["userId"]);
  ?>
    <div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="rating-block" style="height:padding:10px;">

					<h4>
						<i id="globeIcon" class="glyphicon glyphicon-user" title="Find on the Map" onclick="findMap()"></i> - <a href="logout.php">Logout</a>
					</h4>
					<h4><?php echo($userQueryDisp["username"]); ?></h4>
					<h4><?php echo($userQueryDisp["email"]); ?></h4>
					<h4>Password</h4>
					<h5>Other</h5>
					<div id="profilePiccyWrapper">
						<?php
							$profilePicture = ($userQueryDisp["userImg"]);
							$profilePictureString = ("downloads/upload/" . $profilePicture);
						?>
						<img class="profilePiccy" onclick="profilePiccy()" src="<?php echo($profilePictureString) ?>">

						<i id="profilePiccyAdd" class="glyphicon glyphicon-plus"></i>
						<i id="profilePiccyEdit" class="glyphicon glyphicon-pencil"></i>
						<i id="profilePiccyRemove" class="glyphicon glyphicon-trash"></i>
					</div>
					<br />
					<h5>
						<strong>
							<?php
								$reviewCountQuery = mysqli_query($conn, 
									"SELECT COUNT(*) AS counter FROM rating WHERE FK_username = '$login_session'");
								$reviewCountDisp = mysqli_fetch_assoc($reviewCountQuery);
								$reviewCounter = $reviewCountDisp['counter'];
								echo($reviewCounter);
							?>
						</strong>
						Total Ratings
					</h5>
				</div> <!-- rating-block -->
			</div> <!-- .col-sm-3 -->

			<div class="col-sm-3" style="margin-left:10px;">
				<h4>Rating breakdown</h4>
				<div class="pull-left">
					<div class="pull-left" style="width:35px;line-height:1;">
						<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div id="progressBarFive" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width:<?php echo($fiveDivider); ?>%">
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<span id="fiveStar" name="fiveStar">
							<?php  
								echo($five_num_rows);
							?>
						</span>
					</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div id="progressBarFour" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width:<?php echo($fourDivider); ?>%">
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<span id="fourStar" name="fourStar">
							<?php  
								echo($four_num_rows);
							?>
						</span>
					</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div id="progressBarThree" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width:<?php echo($threeDivider); ?>%">
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<span id="threeStar" name="threeStar">
							<?php
								echo($three_num_rows);
							?>
						</span>	
					</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div id="progressBarTwo" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width:<?php echo($twoDivider); ?>%">
						  </div>
						</div>
					</div>

					<div class="pull-right" style="margin-left:10px;">
						<span id="twoStar" name="twoStar">
							<?php
								echo($two_num_rows);
							?>
						</span>
					</div>

				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div id="progressBarOne" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width:<?php echo($oneDivider); ?>%">
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<span id="oneStar" name="oneStar">
							<?php
								echo($one_num_rows);
							?>
						</span>
					</div>
				</div>
			</div> <!-- col-sm-3 -->
		</div><!-- .row -->
		
		<div class="row">
			<div class="col-sm-7">
				<hr/>
				<!-- <FORMAREA> -->

				<div class="review-block">
					<form id="postReviewForm" action="" method="post">
						<!-- <button type="button" id="star1" name="star1" class="btn btn-default btn-grey btn-sm" aria-label="Left Align" onclick="btn1()" title="Just Bad - 1 Star">
						  <span class="glyphicon glyphicon-star2" aria-hidden="true"></span>
						</button>
						<button type="button" id="star2" name="star2" class="btn btn-default btn-grey btn-sm" aria-label="Left Align" onclick="btn2()" title="Quite Poor - 2 Stars">
						  <span class="glyphicon glyphicon-star2" aria-hidden="true"></span>
						</button>
						<button type="button" id="star3" name="star3" class="btn btn-default btn-grey btn-sm" aria-label="Left Align" onclick="btn3()" title="Alright - 3 Stars">
						  <span class="glyphicon glyphicon-star2"></span>
						</button>
						<button type="button" id="star4" name="star4" class="btn btn-default btn-grey btn-sm" aria-label="Left Align" onclick="btn4()" title="Pretty Good - 4 Stars">
						  <span class="glyphicon glyphicon-star2" aria-hidden="true"></span>
						</button>
						<button type="button" id="star5" name="star5" class="btn btn-default btn-grey btn-sm" aria-label="Left Align" onclick="btn5()" title="Awesome - 5 Stars">
						  <span class="glyphicon glyphicon-star2" aria-hidden="true"></span>
						</button> -->

						<input type="radio" id="star1" name="rating" value="1" />
						<input type="radio" id="star2" name="rating" value="2" />
						<input type="radio" id="star3" name="rating" value="3" />
						<input type="radio" id="star4" name="rating" value="4" />
						<input type="radio" id="star5" name="rating" value="5" />

					<!-- BLUE POST BUTTON -->
						<button id="reviewPost" name="reviewPost" method="post" type="submit" title="Post!" class="btn btn-info btn-sm" aria-label="Left Align">
					  		<span class="glyphicon glyphicon-ok2" aria-hidden="true"></span>
						</button>
					
						<!-- RED RESTART BUTTON -->
						<button id="reviewClear" type="button" title="Restart" class="btn btn-danger btn-sm" aria-label="Left Align">
						  <span class="glyphicon glyphicon-remove2" aria-hidden="true"></span>
						</button>

					<br /><br />
					<div class="input-group">
  						<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-tag"></i></span>

  						<input id="reviewTitle" name="reviewTitle" type="text" class="form-control" placeholder="(optional) Add a title!" aria-describedby="basic-addon1" autocomplete="off" />
					</div>
					<p></p>

					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-comment"></i></span>

  						<textarea id="reviewDesc" name="reviewDesc" type="text" class="form-control" placeholder="(optional) Add a comment!" aria-describedby="basic-addon1" autocomplete="off"></textarea>
					</div>
				</form>
					<!-- </FORMAREA> -->
				<hr/>

				<?php
				$reviewQuery = mysqli_query($conn,
					"SELECT * FROM rating WHERE (FK_username = '$login_session') ORDER BY datePosted DESC LIMIT 3");
				while ($reviewQueryDisp = mysqli_fetch_assoc($reviewQuery)): ?>
					<div class="row">
						<div class="col-sm-3" style="text-align:center;">
							<div id="reviewPiccyWrapper">
								<img class="profilePiccy" onclick="profilePiccy()" src="<?php echo($profilePictureString) ?>">
							</div>
							<div class="review-block-name">
								<span id="userPosted" name="userPosted">
									<a href="#" title="Posted By: <?php echo($reviewQueryDisp['FK_username']); ?>">
										<?php echo($reviewQueryDisp['FK_username']); ?>
									</a>
								</span>
							</div>
							<div class="review-block-date">
								<span id="datePosted" name="datePosted" title="Date Posted: <?php echo($reviewQueryDisp['datePosted']); ?>">
									<?php echo($reviewQueryDisp['datePosted']); ?>
								</span>
							</div>
						</div>
						<div class="col-sm-9">

							<div class="review-block-rate">
								<button name="userRatingOne" type="button" class="userRatingOne btn btn-default btn-grey btn-xs">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>
								<button name="userRatingTwo" type="button" class="userRatingTwo btn btn-default btn-grey btn-xs">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>
								<button name="userRatingThree" type="button" class="userRatingThree btn btn-default btn-grey btn-xs">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>
								<button name="userRatingFour" type="button" class="userRatingFour btn btn-default btn-grey btn-xs">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>
								<button name="userRatingFive" type="button" class="userRatingFive btn btn-default btn-grey btn-xs">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>
							</div>

							<div class="review-block-title">
								<span id="reviewTitleSet" name="reviewTitleSet">
									<?php
									$userReviewTitle = ($reviewQueryDisp['ratingTitle']);
									$userReviewScore = ($reviewQueryDisp['ratingOverall']);
									echo($userReviewScore . ' - ' . $userReviewTitle); ?>
								</span>
							</div>

							<div class="review-block-description">
								<span id="reviewDescSet" name="reviewDescSet">
									<?php echo($reviewQueryDisp['ratingDescription']); ?>
								</span>
							</div>
						</div>
					</div><!-- row -->
					<hr/>
					<?php
						if ($userReviewScore >= 1) {
							echo("<script type='text/javascript'>");
								echo("$('.userRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
							echo("</script>");
						}
						if ($userReviewScore >= 2) {
							echo("<script type='text/javascript'>");
								echo("$('.userRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
							echo("</script>");
						}
						if ($userReviewScore >= 3) {
							echo("<script type='text/javascript'>");
								echo("$('.userRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingThree').removeClass('btn-default btn-grey').addClass('btn-warning');");
							echo("</script>");
						}
						if ($userReviewScore >= 4) {
							echo("<script type='text/javascript'>");
								echo("$('.userRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingThree').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingFour').removeClass('btn-default btn-grey').addClass('btn-warning');");
							echo("</script>");
						}
						if ($userReviewScore >= 5) {
							echo("<script type='text/javascript'>");
								echo("$('.userRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingThree').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingFour').removeClass('btn-default btn-grey').addClass('btn-warning');");
								echo("$('.userRatingFive').removeClass('btn-default btn-grey').addClass('btn-warning');");
							echo("</script>");
						}						
					?>
					<?php endwhile; ?>
					<div id="readMoreWrapper">
						<button id="readMoreBtn" name="readMoreBtn">Read More!</button>
					</div>
					<br />
				</div> <!-- review-block -->
			</div> <!-- col-sm-7 -->
		</div> <!-- .row -->
	</div> <!-- /container -->

    <!-- <?php
    if ($averageRatingSet >= 1) {
		echo("<script type='text/javascript'>");
			echo("$('#setRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
		echo("</script>");
	}
	if ($averageRatingSet >= 2) {
		echo("<script type='text/javascript'>");
			echo("$('#setRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
		echo("</script>");
	}
	if ($averageRatingSet >= 3) {
		echo("<script type='text/javascript'>");
			echo("$('#setRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingThree').removeClass('btn-default btn-grey').addClass('btn-warning');");
		echo("</script>");
	}
	if ($averageRatingSet >= 4) {
		echo("<script type='text/javascript'>");
			echo("$('#setRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingThree').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingFour').removeClass('btn-default btn-grey').addClass('btn-warning');");
		echo("</script>");
	}
	if ($averageRatingSet >= 5) {
		echo("<script type='text/javascript'>");
			echo("$('#setRatingOne').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingTwo').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingThree').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingFour').removeClass('btn-default btn-grey').addClass('btn-warning');");
			echo("$('#setRatingFive').removeClass('btn-default btn-grey').addClass('btn-warning');");
		echo("</script>");
	}
    ?> -->
  </body>

<script type="text/javascript">
var ratings = [3, 5, 3, 2, 3, 2, 5, 3, 2, 1, 1, 5, 2, 3, 4];
$(document).ready(function() {
	var total = 0;
	var totalOne = 0;
	var totalTwo = 0;
	var totalThree = 0;
	var totalFour = 0;
	var totalFive = 0;
	for (var i = 0; i < ratings.length; i++) {
		if (ratings[i] == 1) {
			totalOne++;
		}
		if (ratings[i] == 2) {
			totalTwo++;
		}
		if (ratings[i] == 3) {
			totalThree++;
		}
		if (ratings[i] == 4) {
			totalFour++;
		}
		if (ratings[i] == 5) {
			totalFive++;
		}
		total += ratings[i];
	}
	var length = (ratings.length).toFixed(0);
	var avg = (total / ratings.length).toFixed(2);
	document.getElementById('averageRating').innerHTML = avg;
	document.getElementById('totalRating').innerHTML = " " + length;

	// display each total for each ID.
	document.getElementById('totalOne').innerHTML = totalOne;
	document.getElementById('totalTwo').innerHTML = totalTwo;
	document.getElementById('totalThree').innerHTML = totalThree;
	document.getElementById('totalFour').innerHTML = totalFour;
	document.getElementById('totalFive').innerHTML = totalFive;

});

function profilePiccy() {
	alert('alert');
}

</script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('.btn-default, .btn-warning').hover(function(){
  			$(this).css('color','#ffffff');
  		});
  	});
  </script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#star5').click(function(){
  			$('#star1, #star2, #star3, #star4, #star5').removeClass('btn-default btn-grey').addClass('btn btn-warning btn-sm');
  		});
  	});
  </script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#star4').click(function(){
  			$('#star1, #star2, #star3, #star4').addClass('btn btn-warning btn-sm').removeClass('btn-default btn-grey');
  		});
  	});
  </script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#star3').click(function(){
  			$('#star1, #star2, #star3').addClass('btn btn-warning btn-sm').removeClass('btn-default btn-grey');
  		});
  	});
  </script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#star2').click(function(){
  			$('#star1, #star2').addClass('btn btn-warning btn-sm').removeClass('btn-default btn-grey');
  		});
  	});
  </script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#star1').click(function(){
  			$('#star1').addClass('btn btn-warning btn-sm').removeClass('btn-default btn-grey');
  		});
  	});
  </script>
  <script type="text/javascript">
  	$(document).ready(function(){
		$('#reviewPost').click(function(){
			$('#reviewDesc').val('');
		});
	});
  </script>
  <script type="text/JavaScript">
  	$(document).ready(function(){
  		$('#reviewPost').click(function(){
  			$('#reviewTitle').val('');
  		});
  	});
  </script>
  <script type="text/javascript">
  		$(document).ready(function(){
			$('#reviewPost').click(function(){
				$('#star1, #star2, #star3, #star4, #star5').addClass('btn btn-default btn-grey').removeClass('btn-warning');
			});
		});
	</script>
  <script type="text/javascript">
  	$(document).ready(function(){
		$('#reviewClear').click(function(){
			$('#reviewDesc').val('');
		});
	});
  </script>
  <script type="text/JavaScript">
  	$(document).ready(function(){
  		$('#reviewClear').click(function(){
  			$('#reviewTitle').val('');
  		});
  	});
  </script>
  <script type="text/javascript">
  		$(document).ready(function(){
			$('#reviewClear').click(function(){
				$('#star1, #star2, #star3, #star4, #star5').addClass('btn btn-default btn-grey').removeClass('btn-warning');
			});
		});
	</script>
</html>