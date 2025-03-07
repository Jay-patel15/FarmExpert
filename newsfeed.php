<!DOCTYPE html>
<html lang="en">
<head>

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<script src="js/jquery.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<title>Agriculture News & Services</title>

<!-- Web Fonts -->
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>

<style>
.jumbotron{
    background-color: #153449;   
}
.jumbotron h1, h4{
    color: white;   
}
body{
    background-color:whitesmoke;
}
.imgclass{
	width:calc(100% - 20px);
    height: 250px;
    margin: 10px;
}
.newsgrid{
    margin: 10px;
    border: 1px solid lightgray;
    padding: 10px;
}
.container-fluid{
    width: 90%;
}
.tab-container {
    margin: 20px;
}
.tab {
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
    background: #153449;
    color: white;
    border-radius: 5px;
    margin: 5px;
}
.tab.active {
    background: #ff9800;
}
.tab-content {
    display: none;
    margin-top: 20px;
}
.tab-content.active {
    display: block;
}
</style>

<script>
$(document).ready(function(){
    $(".tab").click(function(){
        $(".tab").removeClass("active");
        $(".tab-content").removeClass("active");
        $(this).addClass("active");
        $("#" + $(this).data("target")).addClass("active");
    });
});
</script>

</head>
<body>

<!-- Header -->
<div class="header-banner" style="min-height:210px">
    <div class="container">
        <div class="header-top">
            <div class="social-icons">
                <div id="google_translate_element"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages: 'bn,en,gu,hi,kn,mr,ta,te'}, 'google_translate_element');
                    }
                </script>
            </div>
            <span class="menu"><img class="imgclass" src="images/nav.png" alt=""/></span>
            <div class="top-menu">
                <ul>
                    <nav class="cl-effect-13">
                        <li><a href="farmer_index.php">Home</a></li>
                        <li><a href="php/logout.php">Logout</a></li>
                    </nav>
                </ul>
            </div>
            <script>
                $("span.menu").click(function() {
                    $(".top-menu ul").slideToggle(300);
                });
            </script>
            <div class="clearfix"></div>
        </div>
        <div class="banner-info text-center">
            <h1><a href="newsfeed.php">News & Government Services</a></h1>
        </div>
    </div>
</div>

<!-- Tab Navigation -->
<div class="tab-container text-center">
    <div class="tab active" data-target="news-section">Agriculture News</div>
    <div class="tab" data-target="gov-services">Government Services</div>
</div>

<!-- News Section -->
<div id="news-section" class="tab-content active">
    <?php
        $url='http://newsapi.org/v2/everything?country=in&apiKey=80ce5c2ef1a2456780cf1d50990ae2e7';
        $response=file_get_contents($url);
        $newsdata= json_decode($response);
    ?>
    <div class="container-fluid">
        <?php foreach($newsdata->articles as $news) { ?>
        <div class="row newsgrid">
            <div class="col-md-3">
                <img class="imgclass" src="<?php echo $news->urlToImage ?>" alt="News thumbnail">
            </div>
            <div class="col-md-9">
                <h2><?php echo $news->title ?></h2>
                <h5><?php echo $news->description ?></h5>
                <h5><a href="<?php echo $news->url ?>" target="_blank">Read More</a></h5>
                <p><?php echo $news->content ?></p>
                <h6>Author: <?php echo $news->author ?></h6>
                <h6>Published: <?php echo $news->publishedAt ?></h6>
            </div>
        </div>
        <?php } ?>   
    </div>
</div>

<!-- Government Services Section -->
<div id="gov-services" class="tab-content">
    <div class="container-fluid">
        <h2>Government Agriculture Services</h2>
        <iframe src="https://services.india.gov.in/service/listing?cat_id=98&ln=en" width="100%" height="600px" style="border:none;"></iframe>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="copyright text-center">
            <p>&copy; 2024 Agriculture Portal. All rights reserved | Design by NHITM</p>
        </div>
    </div>
</div>

<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
