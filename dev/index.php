<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The Beat Machine</title>
  <meta name="description" content="The Beat Machine">
  <meta name="author" content="SitePoint">
  <meta name="viewport" content="width=device-width; initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no;" />

  <link rel="stylesheet" href="styles.css?v=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
	<main>
        <h1>Blue Monday</h1>
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
	</main>
	<audio data-key="boom" src="DMXKick02.wav"></audio>
	<script>
		const tempoButtons = document.querySelectorAll('.beat-tempo .tempo-button');
		const beatButtons1 = document.querySelectorAll('.beat-bar .beat-button');
		const boom = document.querySelector(`audio[data-key="boom"]`);

		beatButtons1.forEach(beatButton => beatButton.addEventListener('click', function() {
			this.classList.toggle('active');
		}));

		var lastTime = new Date().getTime();
		var tempoActivePos = 0;
		const beats = 8;
		const tempo = 130;

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
				beatButtons1[tempoActivePos-1].classList.remove('beat');
			}
			if (tempoActivePos == 0) {
				beatButtons1[beatButtons1.length -1].classList.remove('beat');
			}
			if (tempoActivePos % beats > 0 ) {
				tempoButtons[(tempoActivePos % beats) - 1].classList.remove('beat');
			}
			if (tempoActivePos % beats == 0) {
				tempoButtons[beats - 1].classList.remove('beat');
			}
			beatButtons1[tempoActivePos].classList.add('beat');
			tempoButtons[tempoActivePos % beats].classList.add('beat');
				if (beatButtons1[tempoActivePos].classList.contains('active')) {
				boom.currentTime = 0;
				boom.play();
			}
			if (tempoActivePos < beatButtons1.length -1) {
				tempoActivePos++;
			} else {
				tempoActivePos = 0;
			}
		}
        function blueMonday() {
            //const buttons = [0,4,8,9,10,11,12,13,14,15,16,20,24,28];
            const buttons = [3,7,11,12,13,14,15,16,17,18,19,23,27,31];
            buttons.forEach(buttonPos => beatButtons1[buttonPos].classList.add('active'));
        }
		animateBeat();
        blueMonday();
	</script>
	<script src="//localhost:35729/livereload.js"></script>
</body>
</html>
