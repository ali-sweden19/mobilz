<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="buy mobile cards online sweden, Online recharge mobile phones sweden, recharge voip calls sweden, GT mobile cards sweden, Lyca mobile cards sweden, Telenor mobile cards sweden, Comviq mobile cards sweden, voip sweden refill">
    <meta content="Mobile Cards,Phone Cards,Calling Cards,Cheap Calls,Sweden, Sweden SIM card, Sweden SIM cards, Sweden SIM chip, Sweden SIM chips, Vodafone, Sweden prepaid SIM chip, Sweden sim, Sweden prepaid sim card, Sweden cell phone, Sweden cell phone rental, prepaid Sweden sim, Sweden sim, Sweden sim chip, Sweden cellular phone, Sweden prepaid phone rental, sim card, sim chip, Sweden mobile phone" name="keywords">
	<link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl .'/images/favicon.png'; ?>">
    <title>Mobilz - Buy mobiles and accessories online</title>
    
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" media="screen, projection" />
    <!-- Add custom CSS here -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.css" media="screen, projection" />
    <script type="text/javascript">
      var PAYMILL_PUBLIC_KEY = '29006429487df92eae0ba378589e7b7a';
  </script>
  </head>

  <body>
    <!-- Fixed Navigation bar with drop down box
    ================================================== -->
    <div class="navbar shadow-bot navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header"> <!-- nav header -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo $this->createUrl('product/index'); ?>" class="navbar-brand">Mobilz</a>
            </div>   
            <div class="navbar-collapse collapse"> <!-- nav body -->
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $this->createUrl('product/index'); ?>">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <?php if(Yii::app()->user->isGuest){
                        $url = $this->createUrl('site/login');
                        $text = 'Login';
                    } else {
                        $url = $this->createUrl('site/logout');
                        $text = 'Logout';
                    }  ?>
                    <li><a href="<?php echo $url; ?>"><?php echo $text; ?></a></li>
                    <li><a href="<?php echo $this->createUrl('site/contact'); ?>">Contact</a></li>
                </ul>
                
                <div class="col-md-3 pull-right">
                    <form action="" class="navbar-form navbar-right">
                    <div class="input-group">
                        <input type="Search" placeholder="Search..." class="form-control" />
                        <div class="input-group-btn">
                            <button class="btn btn-info">
                            <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Wrapper
    ================================================= -->
    <div id="wrap">        
        
        <?php echo $content; ?>
        
    </div> <!-- wrap -->
    
    <br /><br />
        
    <!-- Footer and Modal -->
    <div id="footer" class="shadow-top">
        <!-- Font Awesome 
    =================================== -->
            <div class="col-md-12">
                <br /><br />
                <div class="well" style="text-align: center; border: none;">
                    <a href="#"> <i class="icon-lg fa fa-linkedin"></i></a>
                    <a href="#"> <i class="icon-lg fa fa-android"></i></a>
                    <a href="#"> <i class="icon-lg fa fa-twitter"></i></a>
                    <a href="#"> <i class="icon-lg icon-lg fa fa-youtube"></i></a>
                    <a href="#"> <i class="icon-lg fa fa-skype"></i></a>
                    <a href="#"> <i class="icon-lg fa fa-google-plus"></i></a>
                    <a href="#"> <i class="icon-lg fa fa-apple"></i></a>
                </div>
            </div>
        
            <!-- Modal -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright &COPY; SoftHem Tuts.
                            <a id="login-modal" data-toggle="modal"  href="#terms">Terms & Conditions</a>
                        </p>
                        <!-- Modal -->
                        <div class="modal fade" id="terms" role="dialog" aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog" style="width: 430px;">
                                <div class="modal-content">
                                    <i id="pty_close" data-dismiss="modal" class="fa fa-times-circle-o icon-md pull-right"></i>
                                    <div class="modal-header" style="padding: 10px;">
                                        <img class="col-xs-3 col-sm-2 col-md-2 img-circle img-responsive" src="<?php echo Yii::app()->baseUrl . '/images/login-icon.png'; ?>" alt="Login here">
                                        <h3>You need to login</h3>
                                    </div>
                                    <div class="modal-body" style="padding: 20px 0 0;">
                                        <?php $this->widget('Modallogin'); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
    </div> <!-- Footer -->
    
    <!-- Java Script -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script>

  </body>
</html>