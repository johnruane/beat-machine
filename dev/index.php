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
						<?php foreach(range(1,4) as $k) { ?>
							<div class="beat-button <?php echo $k ?>"></div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
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
	<audio data-key="boom" src="sounds/boom.wav"></audio>
	<script>
		const beatButtons1 = document.querySelectorAll('.beat-row-1 .beat-button');
		const beatButtons2 = document.querySelectorAll('.beat-row-2 .beat-button');
		const beatButtons3 = document.querySelectorAll('.beat-row-3 .beat-button');
		const beatButtons4 = document.querySelectorAll('.beat-row-4 .beat-button');
		const tempoBar = document.querySelectorAll('.beat-tempo .beat-button');

		const boom = document.querySelector(`audio[data-key="boom"]`);

		beatButtons1.forEach(beatButton => beatButton.addEventListener('click', function() {
			this.classList.toggle('active');
		}));

		var lastTime = new Date().getTime();
		var tempo = 120;
		var tempoActivePos = 0;

		function animateBeat(timestamp){
			const delay = 60000 / tempo;
			const oneSixteenth = delay / 4;
			var currentTime = new Date().getTime();
			if (currentTime >= lastTime + oneSixteenth) {
				updateTempoBar();
				lastTime = currentTime;
			}
			requestAnimationFrame(animateBeat);
		}
		function updateTempoBar() {
			if (tempoActivePos > 0 ) {
				tempoBar[tempoActivePos-1].classList.remove('active');
			}
			if (tempoActivePos == 0) {
				tempoBar[15].classList.remove('active');
			}
			tempoBar[tempoActivePos].classList.add('active');

			if (beatButtons1[tempoActivePos].classList.contains('active')) {
				boom.currentTime = 0;
				boom.play();
			}

			if (tempoActivePos < 15) {
				tempoActivePos++;
			} else {
				tempoActivePos = 0;
			}
		}
		animateBeat();

	</script>
	<script src="//localhost:35729/livereload.js"></script>
</body>
</html>
