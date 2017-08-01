<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>The Beat Machine</title>
	<meta name="description" content="The Beat Machine">
	<meta name="author" content="SitePoint">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />

	<link rel="stylesheet" href="styles.css?v=1.0">
	<link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700" rel="stylesheet">
	<script src="modernizr-custom.js"></script>
	<script src="howler.js"></script>

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->
</head>

<body>
	<main>
		<h1>Blue Monday</h1>
		<p>Press <button class="play-button">PLAY</button> to start</p>

		<div class="machine-wrapper">
			<div class="beat-tempo">
				<div class="beat-bar">
					<?php foreach(range(1,8) as $j) { ?>
						<div class="tempo-button <?php echo $j ?>"></div>
						<?php } ?>
					</div>
				</div>
				<?php foreach(range(1,4) as $h) { ?>
					<div class="beat-block">
						<div class="beat-bar">
							<?php foreach(range(1,8) as $j) { ?>
								<div class="beat-button <?php echo $j ?>"></div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
					<p>Tempo: 130 BPM</p>
				</main>

				<script>
				const tempoButtons = document.querySelectorAll('.beat-tempo .tempo-button');
				const beatButtons = document.querySelectorAll('.beat-bar .beat-button');
				const playButton = document.querySelector('.play-button');

				const boom = document.querySelector('audio[data-key="boom"]');
				const beatsPerBar = 8;
				const tempo = 130;

				beatButtons.forEach(beatButton => beatButton.addEventListener('click', function() {
					this.classList.toggle('active');
				}));

				playButton.addEventListener('click', function() {
					start();
				});

				var lastTime = new Date().getTime();
				var tempoActivePos = 0;
				var sound = new Howl({
				  src: ['DMXKick02.wav']
				});

				const device = document.querySelector('html');
				if (device.classList.value.includes("no-touchevents")) {
					start();
				}

				function animateBeat(timestamp){
					const delay = 60000 / tempo;
					const oneSixteenth = delay / 4;
					var currentTime = new Date().getTime();
					if (currentTime >= lastTime + oneSixteenth) {
						updateBeat();
						lastTime = currentTime;
					}
					requestAnimationFrame(animateBeat);
				}
				function updateBeat() {
					if (tempoActivePos > 0 ) {
						beatButtons[tempoActivePos-1].classList.remove('beat');
					}
					if (tempoActivePos == 0) {
						beatButtons[beatButtons.length -1].classList.remove('beat');
					}
					if (tempoActivePos % beatsPerBar > 0 ) {
						tempoButtons[(tempoActivePos % beatsPerBar) - 1].classList.remove('beat');
					}
					if (tempoActivePos % beatsPerBar == 0) {
						tempoButtons[beatsPerBar - 1].classList.remove('beat');
					}
					beatButtons[tempoActivePos].classList.add('beat');
					tempoButtons[tempoActivePos % beatsPerBar].classList.add('beat');
					if (beatButtons[tempoActivePos].classList.contains('active')) {
						sound.play();
					}
					if (tempoActivePos < beatButtons.length -1) {
						tempoActivePos++;
					} else {
						tempoActivePos = 0;
					}
				}
				function blueMonday() {
					//const buttons = [0,4,8,9,10,11,12,13,14,15,16,20,24,28];
					const buttons = [3,7,11,12,13,14,15,16,17,18,19,23,27,31];
					buttons.forEach(function(buttonPos) {
						beatButtons[buttonPos].click();
					});
				}
				function start() {
					blueMonday();
					animateBeat();
				}

				</script>
			</body>
			</html>