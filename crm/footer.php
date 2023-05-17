
        <style>
        /* body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
        } */

        #myBtn {
        display: none;
        height: 7%;
        position: fixed;
        bottom: 2px;
        right: 20px;
        z-index: 99;
        /* font-size: 18px; */
        border: none;
        outline: none;
        /* background-color: red; */
        color: white;
        cursor: pointer;
        padding: 7px;
        border-radius: 10%;
        }

        /* #myBtn:hover {
        background-color: #555;
        } */
        </style>
  
                    <div class="app-wrapper-footer" style="position: scroll; width: 100%;">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item" style="color: white;">
                                            <!-- <a href="javascript:void(0);" class="nav-link"> -->
                                            MyThink Tank &#169 2021 All Rights Reserved
                                            <!-- </a> -->
                                        </li>
                                    </ul>                                    
                                </div><button class="btn btn-primary" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up" style="font-size:26px"></i></button>
                            </div>
                        </div>
                    </div>    
                    

                </div>
        </div>    

        <script>
                //Get the button
                var mybutton = document.getElementById("myBtn");

                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {scrollFunction()};

                function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
                }

                // When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                }
        </script>   
    </body>
</html>