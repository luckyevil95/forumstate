<?php
	use app\views\widget\MenuWidget;

	global $config;
	global $currentUser;
	
	if ($currentUser)
		$menuItems = $config["menu"]["user"];
	else
		$menuItems = $config["menu"]["guest"];
?>

<html>
	<head>
		<title><?php echo $metaData["title"]; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="<?php echo $metaData["keywords"]; ?>"> 
		<meta name="description" content="<?php echo $metaData["description"]; ?>">
		<link href='https://fonts.googleapis.com/css?family=PT+Serif|Bad+Script&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			<nav class="topNavbar">
				<center><?php $mainMenu = new MenuWidget($menuItems, "mainMenu"); ?></center>
			</nav>
		</header>
		<article>
			<?php require_once $content; ?>
		</article>
	</body>
</html>