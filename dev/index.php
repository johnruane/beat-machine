<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Beat Machine</title>
  <meta name="description" content="The Beat Machine">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="styles.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
	<main>
		<div class="machine-wrapper">
			<?php foreach(range(1,4) as $i) { ?>
				<div class="beat-row beat-row-<?php echo $i ?>">
					<?php foreach(range(1,4) as $j) { ?>
						<div class="beat-bar">
							<div class="beat-button"></div>
							<div class="beat-button"></div>
							<div class="beat-button"></div>
							<div class="beat-button"></div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</main>
<script src="//localhost:35729/livereload.js"></script>
</body>
</html>

<script>
	const beatButtons = document.querySelectorAll('.beat-button');
	beatButtons.forEach(beatButton => beatButton.addEventListener('click', function() {
		this.classList.toggle('active');
	}));
</script>
