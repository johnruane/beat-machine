<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Blue Monday</title>
	<meta name="description" content="Blue Monday">
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
		<p>Press to <button class="play-button">START</button></p>

		<div class="machine-wrapper">
			<div class="beat-tempo">
				<div class="beat-bar">
					<?php foreach(range(1,8) as $j) { ?>
						<div class="tempo-button"></div>
						<?php } ?>
					</div>
				</div>
				<?php foreach(range(1,4) as $h) { ?>
					<div class="beat-block">
						<div class="beat-bar">
							<?php foreach(range(1,8) as $j) { ?>
								<div class="beat-button"></div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</main>
				<script>

				// Event listeners
				const tempoButtons = document.querySelectorAll('.beat-tempo .tempo-button');
				const beatButtons = document.querySelectorAll('.beat-bar .beat-button');
				const playButton = document.querySelector('.play-button');
				playButton.addEventListener('click', function() {
					var playing = this.classList.value.includes('playing');
					if (playing) {
						pause = true;
						sound.stop();
						this.classList.remove('playing');
						this.innerText = "START"
					} else {
						pause = false;
						animateBeat();
						this.classList.add('playing');
						this.innerText = "STOP"
					}
				});

				// Consts for timing calculations
				const beatsPerBar = 8;
				const tempo = 130;

				// Variables for timing calculations
				var lastTime = new Date().getTime();
				var tempoActivePos = 0;

				// Howler setup
				var sound = new Howl({
					src: ['DMXKick02.wav']
				});

				var pause = false;

				// Auto start if non-touch device
				const device = document.querySelector('html');
				if (device.classList.value.includes('no-touchevents')) {
					animateBeat();
				}

				// Auto select required beats for song
				const buttons = [3,7,11,12,13,14,15,16,17,18,19,23,27,31];
				buttons.forEach(function(buttonPos) {
					beatButtons[buttonPos].classList.add('active');
				});

				function animateBeat(timestamp){
					const delay = 60000 / tempo;
					const oneSixteenth = delay / 4;
					var currentTime = new Date().getTime();
					if (currentTime >= lastTime + oneSixteenth) {
						updateBeat();
						lastTime = currentTime;
					}
					if (pause) return;
					requestAnimationFrame(animateBeat);
				}
				function updateBeat() {
					// Beat button cycles
					if (tempoActivePos > 0 ) {
						beatButtons[tempoActivePos-1].classList.remove('beat');
					}
					if (tempoActivePos == 0) {
						beatButtons[beatButtons.length -1].classList.remove('beat');
					}
					// Tempo cycles
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
				</script>
			</body>
			</html>
