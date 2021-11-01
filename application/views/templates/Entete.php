<html>

	<head>

 		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title><?php echo $titleHeader ;?></title>
		<link rel="stylesheet" href=<?php echo css_url('style')?>>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src=<?php echo js_url('jquery-3.6.0')?>></script>
		<script type="text/javascript" src=<?php echo js_url('style')?>></script>
		<script type="text/javascript" src=<?php echo js_url('pagination')?>></script>

	</head>
	<body>
		<header class="item-rounded-background">
			<h1 class="text-center text-font-fantasy">
				<a class="link" href=<?php echo base_url('index.php/Visiteur'); ?>>Atlantik</a>
			</h1>
		</header>
		<div class="topnav item-rounded-background" id="myTopnav">

			<?php
			foreach (array_keys($navbar) as $texte) {
				$linkUrl = get_url($texte);			
			    if(str_starts_with(($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']), $linkUrl)) 
			    	echo '<a class="active" href="'.$linkUrl.'">'.$navbar[$texte].'</a>';
				else 
					echo '<a href="'.$linkUrl.'">'.$navbar[$texte].'</a>';
			}

			?>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
			    <i class="fa fa-bars"></i>
			</a>
		</div>
	