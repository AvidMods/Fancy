<?php
require 'steam.php';

// Must use a valid Steam Web API key
if ( STEAM_APIKEY == '') {
	echo "No API key set!<br />";
	echo "See STEAM_APIKEY in steam.php<br />";
	echo "<a href='http://steamcommunity.com/dev/apikey'>Get an API key here</a>";
	return;
}

// Check if 'steamid' GET variable is set
if ( isset($_GET['steamid']) ) {
	// Request player info from Steam
	$playerinfo = getPlayerSummary($_GET['steamid']);

	if ( $playerinfo ) {
		$playerinfo = $playerinfo['response']['players'][0];
		$lastonline = date( "F jS, Y", $playerinfo['lastlogoff'] );
	}

	// TODO: Query MySQL database for game server player details
	// This can be expected in Fancy Loading Screen V3
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Loading...</title>
	<link rel="stylesheet" type="text/css" href="common.css" />
	<link rel="stylesheet" type="text/css" href="example-steam-profile.css" />
</head>
<body>

	<div class="content-container vertical box">

		<header class="vertical">
			<img src="logo.png" />
		</header>

		<section class="horizontal box">

			<!-- Left container -->
			<section class="vertical box">

				<!-- Rules board -->
				<div class="board">

					<div class="header">
						<p>RULES</p>
					</div>

					<div class="content">
						<ol>
							<li>No RDM'ing (Random Deathmatch)</li>
							<li>No ghosting</li>
							<li>No chat/mic spam</li>
							<li>No prop killing</li>
							<li>No bad mouthing</li>
							<li>No hacking</li>
							<li>Respect the admins</li>
						</ol>
					</div>

				</div>

			</section>

			<!-- Right container -->
			<section class="vertical box">

				<!-- Server Info board -->
				<div class="board">

					<div class="content">
						
							<img id="map-icon" class="mapicon" align="left" />

							<p class="boardinfo">
								<img src="asset://garrysmod/materials/icon16/information.png" class="icon16" />
								<span id="server-name"></span>
							</p>

							<p class="boardinfo">
								<img src="asset://garrysmod/gamemodes/base/icon24.png" id="gamemode-icon" class="gamemodeicon" onerror="GamemodeIconFallback();" />
								<span id="gamemode-name"></span>
							</p>

							<p class="boardinfo">
								<img src="asset://garrysmod/materials/icon16/map.png" class="icon16" />
								<span id="map-name"></span>
							</p>

							<p class="boardinfo">
								<img src="asset://garrysmod/materials/icon16/group.png" class="icon16" />
								<span id="max-players"></span>
							</p>

					</div>

				</div>

				<? if ( isset($playerinfo) ) { ?>

				<!-- Player Info board -->
				<div class="board">

					<div class="content">
							
							<img src="<?= $playerinfo['avatarfull']; ?>" id="map-icon" class="mapicon" align="left" />

							<p class="boardinfo">
								<img src="asset://garrysmod/materials/icon16/user.png" class="icon16" />
								<span id="server-name"><?= $playerinfo['personaname']; ?></span>
							</p>

							<p class="boardinfo">
								<img src="asset://garrysmod/materials/icon16/key.png" class="icon16" />
								<span id="server-name"><?= convertSteamID($playerinfo['steamid']); ?></span>
							</p>

							<? if ( isset($money) ) { ?>
							<p class="boardinfo">
								<img src="asset://garrysmod/materials/icon16/money.png" class="icon16" />
								<span id="server-name"><?= $money ?></span>
							</p>
							<? } ?>

							<p class="boardinfo" style="font-size: 10pt;">
								<img src="asset://garrysmod/materials/icon16/calendar.png" class="icon16" />
								<span id="server-name">Last seen <?= $lastonline ?></span>
							</p>

					</div>

				</div>

				<? } ?>

			</section>

		</section>

		<footer>
			<div id="status-history"></div>
		</footer>

	</div>

	<div id="download-count"></div>

	<script type="text/javascript" src="loading.js"></script>

</body>
</html>