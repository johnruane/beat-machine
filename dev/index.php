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
			<div class="beat-row beat-tempo">
				<?php foreach(range(1,4) as $j) { ?>
					<div class="beat-bar">
						<div class="beat-button"></div>
						<div class="beat-button"></div>
						<div class="beat-button"></div>
						<div class="beat-button"></div>
					</div>
				<?php } ?>
			</div>
			<?php foreach(range(1,4) as $i) { ?>
				<div class="beat-row beat-buttons beat-row-<?php echo $i ?>">
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
	const beatButtons = document.querySelectorAll('.beat-buttons .beat-button');
	const tempoBar = document.querySelectorAll('.beat-tempo .beat-button');

	beatButtons.forEach(beatButton => beatButton.addEventListener('click', function() {
		this.classList.toggle('active');
	}));

	var lastTime = new Date().getTime();
	var tempo = 40;

	function animateBeat(timestamp){
		const delay = 60000 / tempo;
		const oneSixteenth = delay / 4;
		var currentTime = new Date().getTime();
		if (currentTime >= lastTime + oneSixteenth) {
			updateTempoBar();
			lastTime = currentTime;
		}
		// if (currentTime >= lastTime + delay) {
		// 	lastTime = currentTime;
		// }
		requestAnimationFrame(animateBeat); // call requestAnimationFrame again to animate next frame
	}

	var tempoActive = 0;
	function updateTempoBar() {
		if (tempoActive > 0 ) {
			tempoBar[tempoActive-1].classList.remove('active');
		}
		if (tempoActive == 0) {
			tempoBar[15].classList.remove('active');
		}
		tempoBar[tempoActive].classList.add('active');
		if (tempoActive < 15) {
			tempoActive++;
		} else {
			tempoActive = 0;
		}
	}
	animateBeat();

</script>
