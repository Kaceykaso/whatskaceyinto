<?php 
session_start();
require_once("twitterauth/twitteroauth.php"); //Path to twitteroauth library
 
$twitteruser = "kaceykaso";
//$twitteruser = html_entity_decode($_POST['screenname']);
$notweets = 30;

// add twitter auth keys here
$consumerkey = "2s4Gtm7h7cA4Gs2ddqB0qvuJZ";
$consumersecret = "ESZ9V0mlIoelFeQVt6PRNQWauVDyedQjLedZu4ETurxesozbhM";
$accesstoken = "6277712-KZjaGXSrMKXN4krKrjkEMu3YvNt9EaUPotYk0TrMF6";
$accesstokensecret = "LTlokQ3YKmgp2MFGPvQNkUIrIUpYR5ObCJfbqGIjRc2td";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
 
$encode = json_encode($tweets);

//Parse request
$response = json_decode($encode);

//Global vars
$time = '';
$tweets = array();
//Go through tweets
foreach($response as $tweet)
{
  $tweets[] = "{$tweet->text}"; //Store tweet text
  $hashtags[] = "{$tweet->entities->hashtags->text}"; //Store hashtags
}



?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inquiring mind want to know! What's Kacey Coughlin into TODAY?</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <!-- CUSTOM -->
        <link rel="stylesheet" href="css/custom.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="wrapper">
            <aside class="menu">
                <div class="picture"></div>
                <div class="about">
                    <h2>Who</h2>
                    <p>
                        My name is Kacey Coughlin, and I am a UI/UX Designer/Developer/Rapid Prototyper/Unicorn. I currently work full time at Mitchell1 in San Diego, CA.
                    </p>
                    <h2>What</h2>
                    <p>
                        This is a dumping ground for any and all my current fancies. They are pulled from my various social networks: Facebook, Twitter, and Google+.
                    </p>
                    <h2>Why</h2>
                    <p>
                        Because I felt like it, god!
                    </p>
                </div>
            </aside>
            <div>
                <header>
                    <nav>
                        <button class="menu fa fa-bars"></button>
                        <a href="http://www.kaceycoughlin.com/" title="www.kaceycoughlin.com">Kacey</a> 
                        is into 
                        <select>
                            <option value="random">Random</option>
                        <?php for ($i = 0; $i < count($hashtags); $i++) { ?>
                            <option value="<?php echo $hashtags[$i]; ?>"><?php echo $hashtags[$i]; ?></option>
                        <?php } ?>
                        </select>
                        <button class="search fa fa-search"></button>
                    </nav>
                </header>

                <section class="index">

                    <?php for ($i = 0; $i < count($tweets); $i++) { 
                        if ($picture == null) {
                            $background = "http://p1.pichost.me/640/31/1546367.jpg";
                        } else {
                            $background = $picture[$i][0];
                        } ?>
                        <article class="post-sm" style="background: url('<?php echo $background; ?>') no-repeat center center;">
                            <div class="title">
                                <?php echo $tweets[$i]; ?>
                            </div>
                            <button class="linkOut action"></button>
                        </article>
                    <?php } ?>

                </section>

                <footer>
                    Copyright 2014 &copy; <a href="http://www.kaceycoughlin.com/" title="www.kaceycoughlin.com">Kacey Coughlin</a>
                </footer>
            </div>
            <aside class="search">
                <div class="searchbox">
                    <input type="text" value="" placeholder="search">
                </div>
                <div class="results">
                </div>
            </aside>
        </div><!-- end .wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
