<?php 

session_start();

$_SESSION['address1']=$_POST['address1'];

$_SESSION['address2']=$_POST['address2'];

$_SESSION['city']=$_POST['city'];

$_SESSION['state']=$_POST['state'];

$_SESSION['zip']=$_POST['zip'];

$_SESSION['mobile']=$_POST['mobile'];



?>

<!doctype html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->

<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->

<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!-->

<html class="no-js" lang="en">

<!--<![endif]-->

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    

        <title>Member Payment</title>

        <meta name="description" content="Team Vision Network." />



<script src="js/iMAWebCookie.js" type="text/javascript"></script>



                <link href="css/Styles.css" rel="stylesheet" type="text/css" />

        <script src="js/Scripts.js" type="text/javascript"></script>

    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="/Assets/Styles/ie8.css"><![endif]-->

<script type="text/javascript">

function shownext(path)

{

//alert(document.getElementById("checkbox1").checked);

	if(document.getElementById("checkbox1").checked==true)

	{

		post_to_url(path, {'place_order':'place_order'});

	}

	else

	{

		alert("You have not accept VTN Member Agreement.");

		return false;

	}

}

 function post_to_url(path, params, method) {

    method = method || "post"; // Set method to post by default if not specified.



    // The rest of this code assumes you are not using a library.

    // It can be made less wordy if you use one.

    var form = document.createElement("form");

    form.setAttribute("method", method);

    form.setAttribute("action", path);



    for(var key in params) {

        if(params.hasOwnProperty(key)) {

            var hiddenField = document.createElement("input");

            hiddenField.setAttribute("type", "hidden");

            hiddenField.setAttribute("name", key);

            hiddenField.setAttribute("value", params[key]);



            form.appendChild(hiddenField);

         }

    }



    document.body.appendChild(form);

    form.submit();

}

</script>

</head>

<body id="HOME">

    









    <script type='text/javascript'>(function (d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id; js.async = true;js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';fjs.parentNode.insertBefore(js, fjs);} (document, 'script', 'facebook-jssdk'));</script>





<!--Top Section-->

<div class="top-content">

<div class="top-container">

<!--<a href="index.html">Home</a> | 

<a href="registeration.html">Registeration</a> | 

<a href="login.html">Member Login</a>



<span>Contact us: 1-888-908-2640</span>-->

</div>

</div>

<!--Header Section-->

<?php include("includes/header.php");?>

<!--End:Header Section-->







<script type="text/javascript">



    $(function () {



        if ($('#SponsorChangedPop-Up2') != null && $('#SponsorChangedPop-Up2').length)

            $.colorbox({ inline: true, width: "650px", height: "auto", href: "#SponsorChangedPop-Up2", showClose: false, overlayClose: false });

    });



</script>











<style type="text/css">

.play_video a#link1 {

    background:url(img/transparent.gif);

   height: 184px;

    left: 0px;

    position: absolute;

    top: 256px;

    width: 445px;

    z-index: 1;

}



.play_video a#link2 {

    background: url(img/transparent.gif);

    height: 88px;

    left: 444px;

    position: absolute;

    top: 353px;

    width: 500px;

    z-index: 1;

}



</style>



<input type=hidden id= "ShareLinkYouTubeVideoId" value = ""/>

<input type=hidden id= "IsShareLinkVideoExist" value = "False" />

<input type=hidden id= "OutreachYouTubeVideoTitle" value = "" />

<div id="fb-root">

</div>

<!--Content Area-->

<div id="content-wrapper" class="wrapper">

    <div class="container compact clearfix">

        <div class="opportunity_wrapper">

            

            <div class="section">

        <section id="wrapper" class="tabber">



            <h1 class="title">Member Information</h1>



            <div id="v-nav">



 



                <ul>



                    <li tab="tab3" >Member Information</li>



                  <li tab="tab2">Address</li>



                    <li tab="tab1" class="first current">Review Order</li>



                    <li tab="tab4" class="last">Billing</li>



                </ul>



                <div class="tab-content">



                    <h4>Member Information</h4>

					



                   <p>

                            

                            

                            </p>



                </div>



             <div class="tab-content">



                    <h4>Address</h4>



                </div>



                <div class="tab-content" style="display:block;">



                     <h4>First time registration on the second level</h4>

                    

                    <table width="100%" align="center">

    <tr valign="middle">

     <th height="40" colspan="5" align="left">Membership Payment</th>

    </tr>
    
    <tr>
     <th height="30" align="center" valign="top" bgcolor="#009395">LEVEL</th>
     <th height="30" align="center" valign="top" bgcolor="#009395">INITIAL PAYMENT</th>
     <th height="30" align="center" valign="top" bgcolor="#009395">SUBSCRIPTION PRICING</th>
    <th height="30" align="center" valign="top" bgcolor="#009395">TRIAL PERIOD/DURATION</th>
    <th height="30" align="center" bgcolor="#009395">&nbsp;</th>
    </tr>
    
     <tr valign="middle">

     <td colspan="5" align="left">&nbsp;</td>

    </tr>
    
    <tr>
     <td height="40" align="center">Vision Team Network Monthly Membership</td>
     <td height="40" align="center">$29.99</td>
     <td height="40" align="center">$84.98 per Month</td>
    <td height="40" align="center">12 payments total.Membership expires after 1 year.</td>
    <td height="40" valign="middle"><a href="#" class="link">Select</a></td>
    </tr>
    
    <tr>
     <td height="40" align="center">Vision Team Network Membership - 3 month option</td>
     <td height="40" align="center">$29.99</td>
     <td height="40" align="center">$254.94 every 3 Months</td>
    <td height="40" align="center">12 payments total. Membership expires after 1 year.</td>
    <td height="40" valign="middle"><a href="#" class="link">Select</a></td>
    </tr>
    
    <tr>
     <td height="40" align="center">Vision Team Network Membership - 6 month option</td>
     <td height="40" align="center">$29.99</td>
     <td height="40" align="center">$509.88 every 6 Months</td>
    <td height="40" align="center">12 payments total. Membership expires after 1 year.</td>
    <td height="40" valign="middle"><a href="#" class="link">Select</a></td>
    </tr>

    
     <tr>
     <td height="40" align="center">Vision Team Network Yearly Membership</td>
     <td height="40" align="center">$29.99</td>
     <td height="40" align="center">$1,019.76 every 12 Months</td>
    <td height="40" align="center">Membership expires after 1 year.</td>
    <td height="40" valign="middle"><a href="#" class="link">Select</a></td>
    </tr>

   </table>             



                </div>



                <div class="tab-content">



                    <h4>Billing</h4>                   



                </div>



            </div>



        </section>



            </div>

        </div>

    </div>

</div>

 <script type="text/javascript" src="js/jquery.ba-hashchange.js"></script>      

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>

/*$(function () {

    var items = $('#v-nav>ul>li').each(function () {

        $(this).click(function () {

            //remove previous class and add it to clicked tab

            items.removeClass('current');

            $(this).addClass('current');



            //hide all content divs and show current one

            $('#v-nav>div.tab-content').hide().eq(items.index($(this))).show('fast');



            window.location.hash = $(this).attr('tab');

        });

    });



    if (location.hash) {

        showTab(location.hash);

    }

    else {

        showTab("tab1");

    }



    function showTab(tab) {

        $("#v-nav ul li[tab=" + tab + "]").click();

    }



    // Bind the event hashchange, using jquery-hashchange-plugin

    $(window).hashchange(function () {

        showTab(location.hash.replace("#", ""));

    })



    // Trigger the event hashchange on page load, using jquery-hashchange-plugin

    $(window).hashchange();

});*/

</script>





<!--Footer Section-->

<?php include("includes/footer.php");?>

<input type="hidden" id="redirectToSCCPUrl" value=""/>

<!--End:Footer Section-->







    

    <div id="sOverlayWrapper">

        <div id="overlay-video" class="s-overlay">

            <div class="video-o">

                

            </div>

        </div>

    </div>

    

</body>

</html>

