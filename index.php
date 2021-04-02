<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAUN BANEGA CROREPATI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
                    <div id="option-1" class="option-a">A: Kolar</div>
                    <div id="option-3" class="option-c">C: Surat</div>
                </div>
                <div class="col-5 second">
                    <div id="option-2" class="option-b">B: Dhanbad</div>
                    <div id="option-4" class="option-d">D: Kanyakumari</div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script> -->

        <!-- // function countdown_timer(t)
        // {
        //     if( t == 60 || t == 45)
        //     {
        //         var time_left = t;
        //         var timer = setInterval(function(){

        //             if (time_left <= 0) {
        //                 status = 0;
        //                 clearInterval(timer);
        //             }
        //             time_left -= 1;
        //             document.getElementById("time").innerHTML = time_left;
        //         },1000)
        //     }
        // }

        // var ques_arr = [];
        // var status = 1;
        // for(var i = 1; i <= 1; i++)
        // {
            
            // if (status == 1) {
                
                //code for timer
                // if (i <= 5)
                //     var total_time = 45;
                // else if(i > 5 && i <= 10)
                //     var total_time = 60;
                // else
                //     var total_time = null;
                    
                // countdown_timer(total_time);
                
                var total_ques = 1;
                // var ques_no = parseInt(((Math.random()) * total_ques) + 1);

                // while (!(ques_arr.indexOf(ques_no))) {
                //     ques_no = parseInt(((Math.random()) * total_ques) + 1);
                // }
                // remove below line
            //     var ques_no = total_ques;
            //     console.log(ques_no);
            //     window.location.href = '?id=' + ques_no;
            // } 
        // }        -->
    <!-- </script> -->
                <?php
                    include_once('connectvars.php');
                    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)
                        or die('Failed to connect to server');

                        $total_ques = 6;
                        $ques_no_php = (int)((rand( 1,$total_ques)));
                    
                        
                        $query = "SELECT * FROM quiz WHERE id =" . $ques_no_php . " ";
                        $result = mysqli_query($dbc,$query)
                                or die('error in quering dB');
                        while($row = mysqli_fetch_array($result))
                        {
                            setcookie('ques',$row['ques']);
                            setcookie('option_1',$row['option_1']);
                            setcookie('option_2',$row['option_2']);
                            setcookie('option_3',$row['option_3']);
                            setcookie('option_4',$row['option_4']);
                            setcookie('ans',$row['ans']);
                            break;
                        }
                   
                ?>   
                <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>        
                <script>
                    var ques = Cookies.get('ques');
                    var option_1 = Cookies.get('option_1');
                    var option_2 = Cookies.get('option_2');
                    var option_3 = Cookies.get('option_3');
                    var option_4 = Cookies.get('option_4');
                    var ans = Cookies.get('option_5');
                
                    document.getElementById('ques').innerHTML = ques;
                    document.getElementById('option-1').innerHTML = option_1;
                    document.getElementById('option-2').innerHTML = option_2;
                    document.getElementById('option-3').innerHTML = option_3;
                    document.getElementById('option-4').innerHTML = option_3;
                </script>
    
</body>

</html>