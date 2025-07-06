<link rel="stylesheet" href="%www%/web-gallery/v2/styles/style.css" type="text/css" />
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/boxes.css" type="text/css" />
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/tooltips.css" type="text/css" />
<script src="%www%/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/common.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/fullcontent.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/faq.js" type="text/javascript"></script>

<!--[if IE 8]>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/ie6.css" type="text/css" />
<script src="%www%/web-gallery/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
    try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
    body { behavior: url(%www%/web-gallery/js/csshover.htc); }
</style>
<![endif]-->
<meta name="build" content="%www%" />
</head>
<body id="faq" class="plain-template">
<div id="faq" class="clearfix">
    <div id="faq-header" class="clearfix"><img src="%www%/web-gallery/v2/images/faq/faq_header.png" /><form method="post" action="%www%/help/faqsearch" class="search-box"><h2 style="color: white; margin-top: 20px;"> FAQ's - Tire suas dúvidas </h2></form></div>
    <div id="faq-container" class="clearfix">
        <div id="faq-category-list">
            <ul class="faq">
                <?php
                $id = FilterText($_GET['id']);

$sql = mysql_query("SELECT * FROM cms_faq WHERE type = 'cat' ORDER BY id ASC") or die(mysql_error());
while($row = mysql_fetch_assoc($sql)){
?>
                <li><a href="%www%/help/<?php echo $row['id']; ?>" name=""><span class="faq-link <?php if($id == $row['id'] || $id == "".$row['id'].".php/".$row['id'].""){ ?>selected<?php } ?>"><?php echo HoloText($row['title']); ?></span></a></li>
                <?php } ?>
            </ul>
        </div>