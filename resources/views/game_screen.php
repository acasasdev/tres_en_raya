<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Tres en raya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>


<div class="layout">
    <h1>Tres en raya</h1>
    <h2 id="currentPlayerMsg">Turno jugador <span id="currentPlayer">1</span></h2>
    <div class="board" id="board" data-id="">
        <?php for($i = 0; $i < 9; $i++):?>
            <div class="box" data-box="<?php echo $i;?>">
                <div class="mark circle"></div>
                <div class="mark cross"></div>
            </div>
        <?php endfor;?>
    </div>
    <a id="playAgain" class="playAgain" href="/">volver a jugar</a>
</div>



<script src="/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="/js/app.js"></script>

</body>

</html>
