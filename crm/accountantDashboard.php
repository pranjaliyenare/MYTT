<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php
    include 'header.php';
    include 'database.php';
if ($_SESSION['ROLE'] == "accountant") {
    ?>
<style>
/* .smile {
  margin: 30px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background:
    radial-gradient(circle closest-side,#42bd56 99%,transparent) 
       -35px 42px/calc(100% - 15px) 15px repeat-x,
    linear-gradient(#fff,#fff) top/100% 50px no-repeat,
    radial-gradient(farthest-side,transparent calc(99% - 15px),#42bd56 calc(100% - 15px));
  position: relative;
}

.smile:before,
.smile:after{
    content: "";
    position: absolute;
    width:100%;
    top: calc(50% - 7px);
    height: 15px;
    background:radial-gradient(circle closest-side,#42bd56 99%,transparent) -7.5px 0/200% 100%;
    transform:rotate(calc(var(--o,0deg) - 50deg));
    
}
.smile:after {
  --o:-80deg;
}

.smile:hover {
  animation: rotateS 1.2s linear;
}
.smile:hover:before,
.smile:hover:after{
  animation: inherit;
  animation-name:rotateE;
}

@keyframes rotateS {
  50% {
    transform: rotate(360deg);
    background-size: calc(90% - 15px) 15px,100% 30px,auto;
    background-position:-25px 22px,top,0 0;
  }
  100% {
    transform: rotate(720deg);
  }
}


@keyframes rotateE {
  30%,70% {
    transform:rotate(calc(var(--o,0deg) - 180deg));
  }
} */

/* main container */
.container{
	top:0px;
	background:#fff;
	width:100%;
	height:100%;
	position:absolute;
	left:0%;
/* 	background:#1E1E20 url(http://premiumcoding.com/CSSTricks/fallingLeaves/autumn.jpg) center top no-repeat; */
  background-size: cover;
}

.loader {
    text-align: center;
}
.loader span {
    display: inline-block;
    
   
	  margin: -280px 40px 54px  -34px;
         background:url("https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/India_new_500_INR%2C_MG_series%2C_2016%2C_obverse.jpg/800px-India_new_500_INR%2C_MG_series%2C_2016%2C_obverse.jpg");
  background-size: contain;
    
    -webkit-animation: loader 10s infinite  linear;
    -moz-animation: loader 10s infinite  linear;
}
.loader span:nth-child(5n+5) {

    -webkit-animation-delay: 1.3s;
    -moz-animation-delay: 1.3s;
}
.loader span:nth-child(3n+2) {

    -webkit-animation-delay: 1.5s;
    -moz-animation-delay: 1.5s;
}
.loader span:nth-child(2n+5) {

    -webkit-animation-delay: 1.7s;
    -moz-animation-delay: 1.7s;
}

.loader span:nth-child(3n+10) {

    -webkit-animation-delay: 2.7s;
    -moz-animation-delay: 2.7s;
}
.loader span:nth-child(7n+2) {

    -webkit-animation-delay: 3.5s;
    -moz-animation-delay: 3.5s;
}
.loader span:nth-child(4n+5) {

    -webkit-animation-delay: 5.5s;
    -moz-animation-delay: 5.5s;
}
.loader span:nth-child(3n+7) {

    -webkit-animation-delay: 8s;
    -moz-animation-delay: 8s;
}
@-webkit-keyframes loader {
  0% {
    width: 80px;
    height: 80px;
    opacity: 1;

	-webkit-transform: translate(0, 0px) rotateZ(0deg);
  }
  75% {
    width: 80px;
    height: 80px;
    opacity: 1;

	-webkit-transform: translate(100px, 600px) rotateZ(270deg); 
  }
  100% {
    width: 80px;
    height: 80px;
    opacity: 0;

	-webkit-transform: translate(150px, 800px) rotateZ(360deg);
  }
}
@-moz-keyframes loader {
  0% {
    width: 80px;
    height: 80px;
    opacity: 1;
    
	-webkit-transform: translate(0, 0px) rotateZ(0deg);
  }
  75% {
    width: 80px;
    height: 80px;
    opacity: 1;
   
	-webkit-transform: translate(100px, 600px) rotateZ(270deg); 
  }
  100% {
    width: 80px;
    height: 80px;
    opacity: 0;
    
	-webkit-transform: translate(150px, 800px) rotateZ(360deg);
  }
}
</style>
<html>
    <body>   
    <div class="app-main__outer">
         <div class="app-main__inner">
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                             <i class="fas fa-home">
                            </i>
                        </div>
                        <div>Accountant Dashboard
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-11">
                    <div class="main-card mb-3 card">
                            <!-- <div class="smile"></div> -->
                            <div class="container">
                                <div class="loader">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
<?php
} 
//include 'footer.php';
 ?>