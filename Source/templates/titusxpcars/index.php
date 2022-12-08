<?php
defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/reset.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/grid.css" type="text/css" media="screen"/>

<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Vegur_500.font.js" type="text/javascript"></script>
<script src="js/FF-cash.js" type="text/javascript"></script>
<script src="js/tms-0.3.js" type="text/javascript"></script>
<script src="js/tms_presets.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.equalheights.js" type="text/javascript"></script>

</head>
<body id="page1">
<div class="main-bg">
  <div class="bg">
    <!--==============================header=================================-->
    <header>
      <div class="main">
        <div class="wrapper">
          <img src="images/logo.png" alt="The Multipurpose support Association. Click for home" width="192" height="170">
          <jdoc:include type="modules" name="company_title" style="xhtml" />

        </div>
        
        <div class="slider-wrapper">
          <jdoc:include type="modules" name="slide-show" style="xhtml" />
        </div>
        <nav>
          <jdoc:include type="modules" name="main-menu" style="xhtml" />
        </nav>
    </header>
    <!--==============================content================================-->
    <section id="content">
      <div class="main">
        <div class="container_12">
          <div class="wrapper p5">
            <article class="breadcrumbs">
              <div class="wrapper">
                <div class="extra-wrap">
                    <jdoc:include type="modules" name="user1" style="xhtml" />
                </div>
              </div>
            </article>
           
           
          </div>
          <div class="container-bot">
            <div class="container-top">
              <div class="container">
                <div class="wrapper">
                  <article class="grid_8">
                    <div class="indent-left">
                     
                           <jdoc:include type="message" />
                           <jdoc:include type="component" />
                    </div>
                    <div class="wrapper">
                      <jdoc:include type="modules" name="right" style="xhtml" />
                    </div>
                  </article>
                  <article class="grid_4">
                    <div class="indent-left2 indent-top">

                            <jdoc:include type="modules" name="right-bottom" style="xhtml" />

                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--==============================footer=================================-->
    <footer>
      <div class="main">
          <jdoc:include type="modules" name="footer" style="xhtml" />
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">Cufon.now();</script>
<script type="text/javascript">
$(window).load(function () {
    $('.slider')._TMS({
        duration: 1000,
        easing: 'easeOutQuint',
        preset: 'simpleFade',
        slideshow: 7000,
        banners: false,
        pauseOnHover: true,
        pagination: false,
        pagNums: false,
        nextBu: '.next',
        prevBu: '.prev'
    });
});
</script>
</body>
</html>