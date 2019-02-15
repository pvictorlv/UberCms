<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Hotel em Manutenção</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="%www%/web-gallery/maintenance/js/jquery.tweet.js"></script>

    <link href="%www%/web-gallery/maintenance/style/maintenance.css" rel="stylesheet" type="text/css"/>

    <style type="text/css">
        #container {
            margin-top: 20px;
        }

        h1 span {
            height: 49px !important;
            width: 200px !important;
            background-image: url('%www%/web-gallery/maintenance/images/logo.png') !important;
        }
    </style>

</head>
<body>

<div id="container">
    <div id="content">
        <div id="header" class="clearfix">
            <h1><span></span></h1>
        </div>
        <div id="process-content">

            <div class="fireman">

                <h1>Pausa para manutenção!</h1>

                <p>Sentimos muito mas não é possível acessar o Habbo no momento<br/>
                    <br>
                    Volaremos pronto!</p>

                <p> Por enquanto,</p>
                <p>Fique ligado nas últimas notícias</p>

                <p>Facebook</p></div>

            <div class="tweet-container">

                <h2>O que está acontecendo?</h2>

                <center><h3> [twitter] </h3></center>

            </div>

            <div id="footer">
                <p class="copyright"> Hretro &copy; 2017</p>
            </div>

        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $(".tweet").tweet({
            username: "uberHotel",
            count: 5
        });
    });
</script>

</body>
</html> 