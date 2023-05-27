<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="referrer" content="origin-when-crossorigin" id="meta_referrer">
	<title>Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://kit.fontawesome.com/ab35033b19.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="header">
		<div class="container">
			<nav>
				<img src="images/logo.png" class="logo">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</nav>
			<div class="header-text">
				<p>Santa Cruz Marinduque</p>
				<h1>The Mystery Spot's</h1>
			</div>
		</div>
	</div>
	<!-- About -->
	<div id="About">
		<div class="container">
			<div class="row">
				<div class="about-col-1">
					<img src="images/user.jpg">
				</div>
				<div class="about-col-2">
					<h1 class="sub-title">Top Destination's</h1>

					<div class="tab-titles">
						<p class="tab-links active-link" onclick="opentab('Beaches')">Beaches</p>
						<p class="tab-links" onclick="opentab('Events')">Events</p>
						<p class="tab-links" onclick="opentab('Restaurants')">Restaurants</p>
					</div>
					<div class="tab-contents active-tab" id="Beaches">
						<ul>
							<li><span>Maniwaya Island</span><br></li>
							<li><span>Bathala Island</span><br></li>
							<li><span>Palad Sandbar</span><br></li>
							<li><span>Wawies Beach Resort</span><br></li>
							<li><span>3 Brothers Beach</span><br></li>
						</ul>
					</div>
					<div class="tab-contents" id="Events">
						<ul>
							<li><span>Senakulo</span><br></li>
							<li><span>Flores de Mayo / SantaCruzan</span><br></li>
							<li><span>Semana Santa</span><br></li>
							<li><span></span><br></li>
							<li><span></span><br></li>
						</ul>
					</div>
					<div class="tab-contents" id="Restaurants">
						<ul>
							<li><span>Lhiams Place Restaurant</span><br></li>
							<li><span>Rico's Inn</span><br></li>
							<li><span>Dewey Hotel / Restaurants</span><br></li>
							<li><span>Brewista Coffee PH</span><br></li>
							<li><span></span><br></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Services -->
<div id="services">
    <div class="container">
        <h1 class="sub-title">List Destinations in Santa Cruz</h1>
        <div class="services-List">
            <div>
                <i class="fa-solid fa-umbrella-beach"></i>
                <h2>Beaches</h2>
                <?php
                // Replace the placeholder values with your beach data
                $beachImagePath1 = "images/background.jpg";
                $beachImagePath2 = "images/bathala.jpg";
                $beachImagePath3 = "images/malindig.jpg";
                ?>
                <img src="<?php echo $beachImagePath1; ?>" alt="Beach Image 1">
				<h3>Maniwaya</h3>
                <img src="<?php echo $beachImagePath2; ?>" alt="Beach Image 2">
				<h3>Bathala</h3>
                <img src="<?php echo $beachImagePath3; ?>" alt="Beach Image 3">
				<h3>Mt. Malindig</h3>
            </div>
            <div>
                <i class="fa-regular fa-calendar-days"></i>
                <h2>Events</h2>
                <?php
                // Replace the placeholder values with your event data
                $eventImagePath1 = "images/Event1.jpg";
                $eventImagePath2 = "images/Event2.jpg";
                $eventImagePath3 = "images/Event3.jpg";
                ?>
                <img src="<?php echo $eventImagePath1; ?>" alt="Event Image 1">
				<h3>SantaCruzan</h3>
                <img src="<?php echo $eventImagePath2; ?>" alt="Event Image 2">
				<h3>Ati-Atihan</h3>
                <img src="<?php echo $eventImagePath3; ?>" alt="Event Image 3">
				<h3>Senakulo</h3>
            </div>
            <div>
                <i class="fa-solid fa-utensils"></i>
                <h2>Restaurants</h2>
                <?php
                // Replace the placeholder values with your restaurant data
                $restaurantImagePath1 = "images/Res1.jpg";
                $restaurantImagePath2 = "images/Res2.jpg";
                $restaurantImagePath3 = "images/Res3.jpg";
                ?>
                <img src="<?php echo $restaurantImagePath1; ?>" alt="Restaurant Image 1">
				<h3>Lhiams Place Restaurant</h3>
                <img src="<?php echo $restaurantImagePath2; ?>" alt="Restaurant Image 2">
				<h3>Rico's Inn Restaurant</h3>
                <img src="<?php echo $restaurantImagePath3; ?>" alt="Restaurant Image 3">
				<h3>Dewey Hotel / Restaurants</h3>
            </div>
        </div>
    </div>
</div>

	<!-- Contact -->
	<div id="contact">
		<div class="container">
			<h1 class="sub-title">Contact Us</h1>
			<form method="POST" action="send_email.php">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" required><br><br>
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" required><br><br>
				<label for="message">Message:</label>
				<!-- Add the closing tag for the input field here -->
				<textarea name="message" id="message" required></textarea><br><br>
				<input type="submit" value="Send">
			</form>
		</div>
	</div>

	
	<script>
		var tablinks = document.getElementsByClassName("tab-links");
		var tabcontents = document.getElementsByClassName("tab-contents");

		function opentab(tabname) {
			for (tablink of tablinks) {
				tablink.classList.remove("active-link");
			}
			for (tabcontent of tabcontents) {
				tabcontent.classList.remove("active-tab");
			}
			event.currentTarget.classList.add("active-link");
			document.getElementById(tabname).classList.add("active-tab");
		}
	</script>
	<footer>
		<p>&copy; 2023 Mystery Spot's in Marinduque</p>
	</footer>
</body>
</html>
