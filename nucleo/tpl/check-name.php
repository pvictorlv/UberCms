<?php
global $users;
$rlname = $users->GetUserVar(USER_ID, 'real_name');
if (empty($rlname)) {
    ?>
    <style>
        .jjpoverly .box {
            position: relative;
            top: 10px;
            left: 0px;
            width: 500px;
            height: 250px;
            background: url(/images/overly/box.png) top center no-repeat;
            text-align: left;
            color: white;
            z-index: 9999
        }

        .jjpoverly .box .text {
            padding: 5px;
        }
    </style>
    <script src="https://github.com/kvz/phpjs/raw/master/functions/filesystem/file_get_contents.js"
            type="text/javascript" language="javascript"></script>
    <script>
        function changerlname(name) {
            var succes = file_get_contents("%www%/changeRLname/" + name + "/code/139742685");
            if (succes == "true") {
                document.getElementById('jjpoverly').style.display = "none";
                document.getElementById('name').innerHTML = name;
            }
            else
                alert("Your name is not changed.");
        }
    </script>

    <div class="jjpoverly" id="jjpoverly" style="display: block;">
        <center>
            <div class="box">
                <div class="text">
                    <center><img src="/images/logo.png"></center>
                    <br><br>
                    We see that your real name have not yet completed.<br>
                    <br>
                    We like that you should enter here, to proceed.<br>
                    <br>
                    Thank you for your cooperation.<br>
                    <br>
                    Name: <input type="text" id="rlname" value=""/>
                    <a href="javascript:changerlname(document.getElementById('rlname').value);"><span>Done</span></a><br>
                    <span style="font-size: 10px; color: darkred;">After you clicked on 'Done', There is no way to changes it!</span><br>
                    <br>
                    Habbo staff.<br>
                    <br>
                    <br>
                </div>
            </div>
        </center>
    </div>

    <?php
}


?>