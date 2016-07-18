<?php include("header-home.php"); ?>
<div class="inner-content">

    <div class="container">
        <div class="traingle"><img src="dist/img/traingle.png" alt="" style="width: 100%;"></div>
        <div class="col-sm-12">
            <h2 class="inner-page-title"><div class="step-text">Step <span>01</span></div><div class="page-title-text">Select Account Type</div></h2>
        </div>

        <div class="col-sm-12">

            <form>
                <div class="account-form">
                    <div class="step-rediobtn">
                        <ul>
                            <li><a href="javascript:;"><span class="check-box active"><i class="fa fa-check" aria-hidden="true"></i></span>&nbsp; Entreprenets Cycles</a></li>
                            <li><a href="javascript:;"><span class="check-box">&nbsp;</span>&nbsp; Entreprents Direct</a></li>
                            <li><a href="javascript:;"><span class="check-box">&nbsp;</span>&nbsp; DropShip</a></li>
                        </ul>
                    </div>
                    <div class="ac-form-field">
                        <div class="col-sm-6" style="padding-left: 0;">
                            <input type="text" name="" value="" placeholder="Sponsore ID" class="input-style">
                        </div>
                        <div class="col-sm-6" style="padding-right: 0;">
                            <input type="text" name="" value="" placeholder="Transaction Authorization Code" class="input-style">
                        </div>
                    </div>
                </div>
                <div class="proceed-sec">
                    <a href="index-new.php" class="back-btn">BACK</a>
                    <a href="step-2.php" class="proceed-btn">Proceed to Next &nbsp &nbsp <img src="dist/img/double-arrow.png" alt=""></a>
                </div>
            </form>

        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('.check-box').click(function(){
        $('.check-box').removeClass('active');
        $('.check-box').html('&nbsp;');
        $(this).addClass('active');
        $(this).html('<i class="fa fa-check" aria-hidden="true"></i>');
    });
});
</script>
<?php include("footer-home.php"); ?>