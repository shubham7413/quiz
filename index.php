<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAUN BANEGA CROREPATI</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
    <script>
        
        <?php
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        // if (!isset($_SESSION['status'])) {
        //     $_SESSION['status'] = '1';
        // }
        ?>
        
        var score = 0;
        function game_start() {
            console.log('start_game_executed');
            document.getElementById('game-start').style.display = 'block';
            <?php
            $_SESSION['score'] = '1';
            ?>
            window.location.reload();
        }

        function play_again() {
            <?php
            $_SESSION['score'] = '1';
            ?>
            window.location.reload();

        }
        if ((<?php echo $_SESSION['status']; ?>) == 0)
            game_start();
    </script>
    <div class="main">
        <div class="logo-container row">
            <div class="logo">
                <img src="image/logo.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="section">
        <div class="ques-timer-container row">
            <div class="timer-container">
                <div class="timer">
                    <p id="time"></p>
                </div>
            </div>
            <div class="ques-container">
                <p id="ques">
                </p>
            </div>
        </div>
        <div class="option-container row">
            <div class="option-column-container">
                <div class="col-5 first">
                    <div class="option-a"><button class="option-button" id="option-button-1" onclick="check_ans('1')"><span class="no">A:</span><span id="option-1"></span></button></div>
                    <div class="option-c"><button class="option-button" id="option-button-3" onclick="check_ans('3')"><span class="no">C:</span><span id="option-3"></span></button></div>
                </div>
                <div class="col-5 second">
                    <div class="option-b"><button class="option-button" id="option-button-2" onclick="check_ans('2')"><span class="no">B:</span><span id="option-2"></span></button></div>
                    <div class="option-d"><button class="option-button" id="option-button-4" onclick="check_ans('4')"><span class="no">D:</span><span id="option-4"></span></button></div>
                </div>
            </div>
        </div>
    </div>
    <div id="game-end" class="game-end-container">
        <div class="details-container">
            <p id="game-end-detail"></p>
            <p id="jita">AAPNE JITA: <span id="score"></span></p>
            <div class="play-again-container">
                <button onclick="play_again()">Play Again</button>
            </div>
        </div>
    </div>
    <div id="game-start" class="game-start-container">
        <div class="start-container">
            <p id="kbc">KAUN BANEGA CROREPATI</p>
            <div class="play-container">
                <button onclick="game_start()">Play</button>
            </div>
        </div>
    </div>
    <?php
    include_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
        or die('Failed to connect to server');

    $total_ques = 6;
    $ques_no_php = (int)((rand(1, $total_ques)));


    $query = "SELECT * FROM quiz WHERE id =" . $ques_no_php . " ";
    $result = mysqli_query($dbc, $query)
        or die('error in quering dB');
    while ($row = mysqli_fetch_array($result)) {
        setcookie('ques', $row['ques']);
        setcookie('option_1', $row['option_1']);
        setcookie('option_2', $row['option_2']);
        setcookie('option_3', $row['option_3']);
        setcookie('option_4', $row['option_4']);
        setcookie('ans', $row['ans']);
        break;
    }
    ?>

    <audio hidden id="ques_presenting_audio">
        <source src="audio/kbc_ ques.mp3" type="audio/mpeg">
    </audio>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script>

        function output(id, value) {
            document.getElementById(id).innerHTML = value;
        }

        function countdown_timer(t) {
            if (t == 60 || t == 45) {
                var time_left = t;
                var timer = setInterval(function() {

                    time_left -= 1;
                    output('time', time_left);
                    if (time_left <= 0) {
                        status = 0;
                        wrong("Time's Up");
                        if (time_left < 0)
                            output('time', '0')
                        clearInterval(timer);
                    }

                }, 1000)
            }
        }

        function correct() {
            <?php
            $_SESSION['score'] += '10';
            ?>
            window.location.reload();
        }

        function wrong(detail) {
            output('game-end-detail', detail);
            document.getElementById('game-end-detail').style.color = 'red';
            output('score', <?php echo $_SESSION['score']; ?>);
            document.getElementById('game-end').style.display = 'block';
        }

        function check_ans(option_no) {
            let option = 'option-button-' + option_no;

            if (ans == option_no) {
                document.getElementById(option).style.backgroundColor = 'Green';
                correct()
            } else {
                document.getElementById(option).style.backgroundColor = 'Red';
                wrong('Wrong Ans');
            }
        }

            var ques = Cookies.get('ques');
            var option_1 = Cookies.get('option_1');
            var option_2 = Cookies.get('option_2');
            var option_3 = Cookies.get('option_3');
            var option_4 = Cookies.get('option_4');
            var ans = Cookies.get('ans');

            document.getElementById('ques').innerHTML = ques;
            document.getElementById('option-1').innerHTML = option_1;
            document.getElementById('option-2').innerHTML = option_2;
            document.getElementById('option-3').innerHTML = option_3;
            document.getElementById('option-4').innerHTML = option_3;

            var status = 1;
            if (status == 1) {

                // code for timer
                // if (i <= 5)
                var total_time = 45;
                // else if (i > 5 && i <= 10)
                // var total_time = 60;
                // else
                // var total_time = null;

                countdown_timer(total_time);
            }

            document.getElementById('ques_presenting_audio').play();
    </script>

</body>

</html>