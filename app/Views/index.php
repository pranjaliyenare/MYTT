<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="title" content="MYTT - MyThink Tank Multimedia Pvt. Ltd.">
  <meta name="keyword" content="">
  <meta name="description" content="">
  <title>MyThink Tank Multimedia Pvt. Ltd.</title>
  <link rel="stylesheet" type="text/css" href="style.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script charset="UTF-8" src="//web.webpushs.com/js/push/33afcb8e235c0ebba4304795ae39758d_1.js" async></script>
</head>

<style>
        * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
.slowFade {
    display: flex;
    align-items: flex-start;
    background: #fff;
    height: 100vh;
    overflow: hidden;
    position: relative;
}
.slowFade .slide img {
    position: absolute;
    min-width: 100%;
    min-height: 100%;
    height: auto;
    background: #000;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    opacity: 0;
    transform: scale(1.5) rotate(15deg);
    -webkit-animation: slowFade 32s infinite;
            animation: slowFade 32s infinite;
}
@media all and (max-width: 499px) {
    #ifMobile1 {
        background-image: url(/assets/images/upload_image/home_slide_mobile.jpg);
        position: absolute;
        min-width: 100%;
        min-height: 100%;
        height: auto;
        width: 10px;
        height: 10px;
        background: #000;
        -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
        opacity: 0;
        transform: scale(1.5) rotate(15deg);
        -webkit-animation: slowFade 32s infinite;
                animation: slowFade 32s infinite;
    }
}

.slowFade .slide:nth-child(3) img {
    -webkit-animation-delay: 2s;
            animation-delay: 2s;
}
.slowFade .slide:nth-child(2) img {
    -webkit-animation-delay: 4s;
            animation-delay: 4s;
}
.slowFade .slide:nth-child(1) img {
    -webkit-animation-delay: 8s;
            animation-delay: 8s;
}
@keyframes slowFade {
    25% {
        opacity: 1;
        transform: scale(1) rotate(0);
    }
    40% {
        opacity: 0;
    }
}
@-webkit-keyframes slowFade {
    25% {
        opacity: 1;
        transform: scale(1) rotate(0);
    }
    40% {
        opacity: 0;
    }
}
</style>

    <body class="/ home_variant_08 nexelit_version_3.1.3 not_verified apps_key_NB2GLtODUjYOc9bFkPq2pKI8uma3G6WX ">
        <div class="slides slowFade">
            <div class="slide">
                <img class="preview" src="<?php echo base_url().'/assets/images/upload_image/home_slide.jpg'; ?>" alt="MYTT"/>
            </div>
            <div class="slide">
                <img class="preview" src="<?php echo base_url().'/assets/images/upload_image/home_slide.jpg'; ?>" alt="MYTT"/>
            </div>
            <div class="slide">
                <img class="preview" src="<?php echo base_url().'/assets/images/upload_image/home_slide.png'; ?>" alt="MYTT"/>
            </div>
            <div class="slide">
                <img class="preview" src="<?php echo base_url().'/assets/images/upload_image/home_slide.jpg'; ?>" alt="MYTT"/>
            </div>
        </div>
        <script>
            setTimeout(function(){
             window.location.href = 'https://mytt.in/index';
            }, 7000);
        </script>
    </body>
</html>