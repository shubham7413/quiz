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
        var ques = "a";
        var option_1 = "";
        var option_2 = "";
        var option_3 = "";
        var option_4 = "";
        var ans = "";
        var ques_no = 0;
        var ques_serial_no = [];
        var timer;
        var time_left;
        var status = 1;
        var score = 0;
        var arr = ['5000', '10000', '20000', '40000', '80000', '160000', '320000', '640000', '1250000', '2500000', '5000000', '1 Crore', '3 Crore', '5 Crore', '7 Crore'];

        function get_ques(mycallback) {
            //using random() to get a ques_serial_no

            let total_ques = 6;
            let temp = ((Math.random()) * total_ques) + 1;
            temp = parseInt(temp);
            while (!(ques_serial_no.indexOf(temp))) {
                temp = ((Math.random()) * total_ques) + 1;
            }
            ques_serial_no.push(temp);

            //get the ques
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "ques.php?id=" + temp, true);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    // window.show = this.responseText;
                    // show = JSON.parse(show);
                    // document.getElementById('ques').innerHTML = show.ans;
                    // console.log(show);
                    mycallback(this);
                }
            };

            xhttp.send();

        }

        function game_start() {
            get_ques(display_ques);

        }

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
                <button onclick="game_start()">Play Again</button>
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


    <audio hidden id="ques_presenting_audio">
        <source src="audio/kbc_ ques.mp3" type="audio/mpeg">
    </audio>
    <script>
        function output(id, value) {
            document.getElementById(id).innerHTML = value;
        }

        function display_ques(xhttp) {
            // 
            window.myobj = xhttp.responseText;
            myobj = JSON.parse(myobj);
            document.getElementById('game-start').style.display = "none";
            ques = myobj.ques;
            option_1 = myobj.option_1;
            option_2 = myobj.option_2;
            option_3 = myobj.option_3;
            option_4 = myobj.option_4;
            ans = myobj.ans;
            ques_no += 1;

            output('ques', ques);
            output('option-1', option_1);
            output('option-2', option_2);
            output('option-3', option_3);
            output('option-4', option_4);

            document.getElementById('ques_presenting_audio').play();

            // code for timer
            if (ques_no <= 5)
                time_left = 45;
            else if (ques_no > 5 && ques_no <= 10)
                time_left = 60;
            else
                time_left = null;

            timer = setInterval(countdown_timer, 1000);
            if (time_left == 0) {
                wrong("Time's Up");
                clearInterval(timer);
            }
        }

        // function reset() {
        //     clearInterval(timer);
        //     document.getElementById(option).style.backgroundColor = 'rgb(0, 2, 73)';
        // }

        function countdown_timer() {
            time_left -= 1;
            if (time_left < 0)
            {    
            time_left = 0;
            clearInterval(timer);
            }
            output('time', time_left);
        }

        function correct() {
            score = arr[(ques_no - 1)];
            setTimeout(function(){
                for (let i = 1; i <= 4; i++) {
                let option = 'option-button-' + i;
                document.getElementById(option).style.backgroundColor = '#000249';
            }
                get_ques(display_ques);
                
            },2000);
        }

        function wrong(detail) {
            console.log('inside');
            document.getElementById('game-end').style.display = 'block';
            setTimeout(function(){
                output('score', score);
            output('game-end-detail', detail);
            },2000);
        }

        function check_ans(option_no) {
            let option = 'option-button-' + option_no;

            if (ans == option_no) {
                document.getElementById(option).style.backgroundColor = 'Green';
                clearInterval(timer);
                correct();
            } else {
                document.getElementById(option).style.backgroundColor = 'Red';
                clearInterval(timer);
                wrong('Wrong Ans');
            }
        }
    </script>

</body>

</html>