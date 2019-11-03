<html>
<head>
<title>Distress Call</title>
    <link rel="stylesheet" href="/css/grid.css" />
    <link rel="stylesheet" href="/css/header.css" />
    <link rel="stylesheet" href="/css/command.css" />
    <link rel="stylesheet" href="/css/flipclock.css" />
    <link rel="stylesheet" href="/css/distress.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="/js/flipclock.min.js"></script>
    <script type="text/javascript" src="/js/intercom.min.js"></script>

    <script>
        var clock;

        $(document).ready(function () {

            clock = $(".unity-clock").FlipClock(3600, {
                clockFace: 'MinuteCounter',
                autoStart: false,
                countdown: true,
                callbacks: {
                    interval: function() {
                        var time = clock.getTime().time;
                        //alert(time);
                        if (time == 3540) {
                            // Incoming threat detected, battle stations
                        } else if (time == 2640) {
                            // Threat neutralized, warp drive malfunction
                        } else if (time == 1800) {
                            // 30 minutes until Gorgonite reinforcements arrive
                        } else if (time == 900) { 
                            // 15 minutes until Gorgonite reinforcements arrive
                        } else if (time == 300) {
                            // 5 minutes until Gorgonite reinforcements arrive
                        }
                    }
                }
            });

            console.log(clock.getTime().time);

            var intercom = Intercom.getInstance();

            intercom.on('player', function (data) {
                //console.log(data.message);
                if (data.message == "start") {
                    clock.start();
                    var ajaxurl = 'functions.php',
                    data = { 'action': "start_timer"};
                    $.post(ajaxurl, data, function (response) {
                        //alert("success");
                        console.log("started timer");
                    });
                } else if (data.message == "stop") {
                    clock.stop();
                    var ajaxurl = 'functions.php',
                    data = { 'action': "stop_timer"};
                    $.post(ajaxurl, data, function (response) {
                       //alert("success");
                       console.log("stopped timer");
                    });
                }
            });

            // Assign button functions	
            $("input[id$='btnStartTimer']").click(function () {
                clock.start();
                intercom.emit("player", { message: "start" });
            });

            $("input[id$='btnStopTimer']").click(function () {
                clock.stop();
                intercom.emit("player", { message: "stop" });
            });

            $("input[id$='btnStartAmbient']").click(function () {
                intercom.emit("sound", { message: "play" });
            });

            $("input[id$='btnStopAmbient']").click(function () {
                intercom.emit("sound", { message: "stop" });
            });

            $("input[id$='btnMovie']").click(function () {
                var ajaxurl = 'functions.php',
                data = { 'action': "opening"};
                $.post(ajaxurl, data, function (response) {
                   //alert("success");
                   console.log("opening");
                });
                intercom.emit("movie", { message: "opening" });
            });

            $("input[id$='btnSend']").click(function () {
                var msg = $("#txtComm").val();
                intercom.emit("notice", { message: msg });
                intercom.emit("sound", { message: "clue" });
                $(".messages").prepend("<p>" + $("#txtComm").val() + "</p>");
                $("#txtComm").val("");
                incrementClueCounter();
            });

            $("input[id$='btn1']").click(function () {
                intercom.emit("sound", { message: "" });
            });

            $("input[id$='btn2']").click(function () {
                intercom.emit("sound", { message: "" });
            });

            $("input[id$='btn3']").click(function () {
                intercom.emit("sound", { message: "" });
            });

            $("input[id$='btn4']").click(function () {
                intercom.emit("sound", { message: "" });
            });

            $("input[id$='btn5']").click(function () {
                intercom.emit("sound", { message: "" });
            });

            $("input[id$='btn6']").click(function () {
                intercom.emit("sound", { message: "" });
            });

            $("input[id$='btnClear']").click(function () {
                $("#txtComm").val("");
            });

            $("input[id$='btnComplete']").click(function () {
                postData();
            });

            $("input[id$='btnReset']").click(function () {
                alert("Reset");
            });

            // Clues

            $("#clue1").on("click", function () {
                //$("#txtComm").val("");
                intercom.emit("movie", { message: "light" });
            });

            $("#clue2").on("click", function () {
                //$("#txtComm").val("");
                intercom.emit("movie", { message: "jumper" });
            });

            $("#clue3").on("click", function () {
                //$("#txtComm").val("");
                intercom.emit("movie", { message: "maintenance" });
            });

            $("#clue4").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue5").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue6").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue7").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue8").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue9").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue10").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue11").on("click", function () {
                $("#txtComm").val("");
            });

            $("#clue12").on("click", function () {
                var ajaxurl = 'functions.php',
                data = { 'action': "jumper"};
                $.post(ajaxurl, data, function (response) {
                   //alert("success"); 
                });
            });

        });
        
        function postData() {

            //alert($("#gameDate").val());

            if ($("#gameMaster").val() == "" || $("#teamName").val() == "" || $("#gameDate").val() == "") {
                alert("Please make sure all fields are filled in");
                return;
            }

            var notes = "";
            if ($("#gameNotes").val() == "") {
                notes = "NA";
            } else {
                notes = $("#gameNotes").val();
            }

            var data = { "room": "Kitchen", "gamedt": $("#gameDate").val(), "gamemaster": $("#gameMaster").val(), "teamname": $("#teamName").val(), "teamtime": clock.getTime().time, "clues": $("#clueCount").val(), "notes": notes }

            $.ajax({
                url: 'https://j56vj1hyk3.execute-api.us-west-1.amazonaws.com/Development/entries',
                type: 'POST',
                crossDomain: true,
                contentType: 'application/json',
                data: JSON.stringify(data),
                dataType: 'json',
                success: function (data) {
                    //success stuff. data here is the response, not your original data
                    //alert("good");
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //error handling stuff
                    alert("Data did not save. Let Shaun know in the Shift Issues channel");
                }
            });
        }

        function incrementClueCounter() {
            var cnt = $("#clueCount").val();

            cnt = parseInt(cnt) + 1;

            $("#clueCount").val(cnt);
        }
    </script>
</head>

<body>
<div id="suiteBarLeft">
        <div class="ms-table ms-fullWidth">
            <div class="ms-tableRow">
                <div class="ms-tableCell ms-verticalAlignMiddle">

                </div>
                <div class="ms-core-deltaSuiteLinks" id="DeltaSuiteLinks">

                    <div id="suiteLinksBox">

                    </div>

                </div>
            </div>
        </div>

        <div>
            <a href="/index.html">
                <span class="unity-header-img-left" nowrap="">
                    <img src="/img/header.png" height="105" />
                </span>
            </a>
            <a href="/index.html" style="display:none">
                <span class="unity-header-img-right" nowrap="">
                    <img src="/img/header.png" height="70" />
                </span>
            </a>
        </div>
    </div>

    <header>
        <div>
            <div class="navbar-header-left">
                <h2>Distress Call - Admin</h2>
            </div>
        </div>
    </header>

    <div class="section group controls">
        <div class="col span_9_of_9" controls>
            <div id="main" style="padding-top:20px" class="rcorners2">
                <div class="section group">
                    <div class="col span_9_of_9 modules-header">
                        <table id="tblButtons" class="tblMain">
                            <tr class="tr-header">
                                <td><input type="button" id="btnStartAmbient" value="Play Ambient" />
                                    <input type="button" id="btnStopAmbient" value="Stop Ambient" />
                                </td>
                                <td><input type="button" id="btnMovie" value="Play Movie" /></td>
                                <td><input type="button" id="btnComplete" value="Complete" /></td>
                                <td><input type="button" id="btnReset" value="Reset" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="section group">
                    <div class="col span_3_of_9 modules">
                        <table id="gameData" class="tblMain">
                            <tr class="tr-header">
                                <td colspan="4">Game Data</td>
                            </tr>
                            <tr>
                                <td><label for="gameMaster">Game Master</label></td>
                                <td colspan="3">
                                    <select id="gameMaster">
                                        <option value="">---Select---</option>
                                        <option value="Brad Parrish">Brad Parrish</option>
                                        <option value="Christina Parrish">Christina Parrish</option>
                                        <option value="Issac Moreno">Issac Moreno</option>
                                        <option value="Kari Nieves">Kari Nieves</option>
                                        <option value="Kathryn McClain">Kathryn McClain</option>
                                        <option value="Keenan Billimoria">Keenan Billimoria</option>
                                        <option value="Mary Parrish">Mary Parrish</option>
                                        <option value="Mathew Koontz">Mathew Koontz</option>
                                        <option value="Shaun Nieves">Shaun Nieves</option>
                                        <option value="Steven Parrish">Steven Parrish</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="teamName">Team Name</label></td>
                                <td><input type="text" id="teamName" size="27"/></td>
                            </tr>
                            <tr>
                                <td><label for="clueCount">Clues</label></td>
                                <td><input type="text" id="clueCount" value="0" size="3" style="text-align:center" /></td>
                            </tr>
                            <tr>
                                <td><label for="gameDate">Game Date/Time</label></td>
                                <td colspan="3"><input type="datetime-local" id="gameDate" /></td>
                            </tr>
                            <tr>
                                <td><label for="gameNotes">Game Notes</label></td>
                                <td colspan="3"><textarea id="gameNotes" rows="4" cols="50"></textarea></td>
                            </tr>
                        </table>                        
                    </div>
                    <div class="col span_3_of_9 modules" style="background-color: dimgray">
                        <table id="tblTime" class="tblMain">
                            <tr class="tr-header">
                                <td>Time Remaining</td>
                            </tr>
                            <tr class="tr-content">
                                <td>
                                    <div id="countdown-timer" class="unity-clock"></div>
                                </td>
                            </tr>
                            <tr class="tr-content">
                                <td>
                                    <input type="button" id="btnStartTimer" value="Start" />
                                    <input type="button" id="btnStopTimer" value="Stop" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col span_3_of_9 modules" style="background-color: dimgrey">
                        <table id="tblClues" class="tblMain" style="border:0">
                            <tr class="tr-header">
                                <td colspan="12">Clues</td>
                            </tr>
                            <tr class="tr-content">
                                <td><img src="/img/key.png" width="50" id="clue1" title="Jumper Cables" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue2" title="Light Pattern" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue3" title="Maintenance Guide" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue4" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue5" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue6" title="" style="cursor: pointer;" /></td>
                            </tr>
                            <tr class="tr-content">
                                <td><img src="/img/key.png" width="50" id="clue7" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue8" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue9" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue10" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue11" title="" style="cursor: pointer;" /></td>
                                <td><img src="/img/key.png" width="50" id="clue12" title="" style="cursor: pointer;" /></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="tr-header">Sounds</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="btn-snd"><input type="button" id="btn1" value="" /></td>
                                <td colspan="2" class="btn-snd"><input type="button" id="btn2" value="" /></td>
                                <td colspan="2" class="btn-snd"><input type="button" id="btn3" value="" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="btn-snd"><input type="button" id="btn4" value="" /></td>
                                <td colspan="2" class="btn-snd"><input type="button" id="btn5" value="" /></td>
                                <td colspan="2" class="btn-snd"><input type="button" id="btn6" value="" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="section group">
                    <div class="col span_9_of_9 modules" style="background-color: dimgrey">
                        <table id="tblComm" class="tblMain">
                            <tr class="tr-header">
                                <td>Room Communication</td>
                            </tr>
                            <tr class="tr-content">
                                <td><input type="text" id="txtComm" maxlength="150" size="100" /></td>
                            </tr>
                            <tr class="tr-content">
                                <td>
                                    <input type="button" id="btnSend" value="Send" />
                                    <input type="button" id="btnClear" value="Clear" />
                                </td>
                            </tr>
                            <tr class="tr-content">
                                <td>
                                    <div id="txtMessages" class="messages"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
