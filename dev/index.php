<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Beat Machine</title>
	<meta name="description" content="Beat Machine">
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
		<div class="machine-wrapper">
			<div class="heading-wrapper">
				<h1>Beat <span>.</span> Machine</h1>
			</div>
			<div class="beat-tempo">
				<div class="beat-bar">
					<?php foreach(range(1,16) as $j) { ?>
						<div class="tempo-button <?php echo $j ?>"></div>
					<?php } ?>
				</div>
			</div>
			<div class="beat-wrapper">
				<?php foreach(range(1,4) as $h) { ?>
					<div class="beat-block" data-sound="sound<?php echo $h ?>">
						<div class="beat-bar">
							<?php foreach(range(1,16) as $j) { ?>
								<div class="beat-button beat-button-<?php echo $j ?>"></div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="tempo-wrapper">
				<button class="decrement">+</button>
				<input type="number" class="tempo-display" value="130" min="0" max="220" step= "5" maxlength="3"/>
				<button class="increment">-</button>
			</div>
		</div>
	</main>
	<script>

				// Event listeners
				const tempoButtons = document.querySelectorAll('.beat-tempo .tempo-button');
				const beatBlocks = document.querySelectorAll('.beat-block');
				beatBlocks.forEach(function(block) {
					var beatButtons = block.querySelectorAll('.beat-button');
					beatButtons.forEach(beatButton => beatButton.addEventListener('click', function() {
						this.classList.toggle('active');
					}));
				});

				// Consts for timing calculations
				var tempo = 80;
				var maxTempo = 240;

				// Tempo controls
				const tempoDisplay = document.querySelector('.tempo-display');
				tempoDisplay.value = tempo;
				const tempoControls = document.querySelectorAll('.tempo-wrapper button');
				tempoControls.forEach(function(button) {
					button.addEventListener('click', function() {
					tempo = this.classList.value === "decrement" ? tempo + 5 : tempo - 5;
						tempoDisplay.value = tempo;
					});
				});
				const tempoInput = document.querySelector('.tempo-wrapper input');
				tempoInput.addEventListener('input', function() {
					if (tempoInput > maxTempo) return false;
					tempo = this.value;
				});
				// Variables for timing calculations
				var lastTime = new Date().getTime();
				var tempoActivePos = 0;

				// Howler setup
				var sound1 = new Howl({
					src: ['kick.wav']
				});
				var sound2 = new Howl({
					src: ['tom.wav']
				});
				var sound3 = new Howl({
					src: ['snare.wav']
				});
				var sound4 = new Howl({
					src: ['hihat.wav']
				});

				animateBeat();

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
					// For each block, if a button has 'active', get sound from data atr and eval()
					beatBlocks.forEach(function(block) {
						var sound = block.getAttribute('data-sound');
						var button = block.querySelectorAll('.beat-button-'+parseInt(tempoActivePos+1));
						if (button[0].classList.value.includes('active')) {
							eval(sound).play();
						}
					});
					// Tempo cycles
					tempoButtons[tempoActivePos].classList.add('beat');
					if (tempoActivePos > 0 ) {
						tempoButtons[(tempoActivePos-1)].classList.remove('beat');
					}
					if (tempoActivePos == 0) {
						tempoButtons[tempoButtons.length-1].classList.remove('beat');
					}
					if (tempoActivePos < tempoButtons.length-1) {
						tempoActivePos++;
					} else {
						tempoActivePos = 0;
					}
				}
				</script>
			</body>
			</html>
