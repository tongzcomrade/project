<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agency - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/agency/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency/css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/agency/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">BSRU Fitness</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">ข่าวสาร</a>
                    </li>
                    <!-- <li>
                        <a class="page-scroll" href="#portfolio">Tips & Tricks</a>
                    </li> -->
                    <!-- <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li> -->
                    <li>
                        <a class="page-scroll" href="#team">ผู้จัดทำ</a>
                    </li>
                    
                    <?php if (!empty(Yii::app()->session['User']['id'])) : ?>
                    <li>
                        <a class="page-scroll" href="#portfolioModal1" data-toggle="modal"> ข้อมูลส่วนตัว </a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolioModal3" data-toggle="modal"> ลืมรหัสผ่าน </a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?r=site/logout"> ออกจากระบบ </a>
                    </li>
                    <?php else : ?>
                    <li>
                        <a class="page-scroll" href="#contact"> ลงทะเบียน </a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolioModal2" data-toggle="modal"> เข้าสู่ระบบ </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty(Yii::app()->session['User']['id']) && !empty(Yii::app()->session['User']['backOffice'])) : ?>
                    <li>
                        <a class="page-scroll" href="index.php?r=site/registerUser"> เข้าหลังบ้าน </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To BSRU Fitness!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <a href="#services" class="page-scroll btn btn-xl">Information</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Information</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">E-Commerce</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Responsive Design</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Web Security</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <!-- <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="css/agency/img/portfolio/roundicons.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Round Icons</h4>
                        <p class="text-muted">Graphic Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="css/agency/img/portfolio/startup-framework.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Startup Framework</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="css/agency/img/portfolio/treehouse.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Treehouse</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="css/agency/img/portfolio/golden.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Golden</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="css/agency/img/portfolio/escape.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Escape</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="css/agency/img/portfolio/dreams.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- About Section -->
    <!-- <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="css/agency/img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2009-2011</h4>
                                    <h4 class="subheading">Our Humble Beginnings</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="css/agency/img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>March 2011</h4>
                                    <h4 class="subheading">An Agency is Born</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="css/agency/img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>December 2012</h4>
                                    <h4 class="subheading">Transition to Full Service</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="css/agency/img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>July 2014</h4>
                                    <h4 class="subheading">Phase Two Expansion</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-2">
                    <div class="team-member">
                        <img src="css/agency/img/team/4.jpg" class="img-responsive img-circle" alt="" style="width: 225px; height: 225px;">
                        <h4>Diana Pertersen</h4>
                        <p class="text-muted">Lead Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="css/agency/img/team/4.jpg" class="img-responsive img-circle" alt="" style="width: 225px; height: 225px;">
                        <h4>Sumittra Naksaing</h4>
                        <p class="text-muted">ผู้จัดทำเอกสาร (The Documents)</p>
                        <ul class="list-inline social-buttons">
                            <li>
                              <a href="https://www.facebook.com/Naksaing.S"><i class="fa fa-facebook"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="css/agency/img/logos/envato.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="css/agency/img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="css/agency/img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="css/agency/img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>
    
    <!-- Contact Section -->
    <form action="index.php?r=site/postUser" method="post">
      <section id="contact">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <h2 class="section-heading"> ลงทะเบียนสมาชิก </h2>
                      <h3 class="section-subheading text-muted"></h3>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-12">
                      <form name="sentMessage" id="contactForm" novalidate>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <input name="fname" type="text" class="form-control" placeholder="ชื่อ *" id="name" required data-validation-required-message="Please enter your name.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <input name="email" type="email" class="form-control" placeholder="อีเมล์ *" id="email" required data-validation-required-message="Please enter your email address.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <input name="username" type="text" class="form-control" placeholder="ขื่อผู้ใช้ *" id="email" required data-validation-required-message="Please enter your username.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน *" id="phone" required data-validation-required-message="Please enter your password.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <input name="re_password" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน *" id="phone" required data-validation-required-message="Please enter your re-password.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <input name="lname" type="text" class="form-control" placeholder="นามสกุล *" id="phone" required data-validation-required-message="Please enter your last name.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <input name="tel" type="tel" class="form-control" placeholder="เบอร์โทรศัพท์ * (0811234567)" id="phone" required data-validation-required-message="Please enter your phone number.">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <input name="image" type="file" class="form-control" placeholder="รูปประจำตัว *" id="image" required data-validation-required-message="Please upload your photo profile">
                                      <p class="help-block text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                      <textarea name="address" class="form-control" placeholder="ที่อยู่ *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                      <p class="help-block text-danger"></p>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-lg-12 text-center">
                                  <div id="success"></div>
                                  <input name="is_employee" type="hidden" value="false">
                                  <input name="position" type="hidden" value="6">
                                  <button type="submit" class="btn btn-xl"> Submit </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </section>
    </form>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Your Website 2014</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <img src="css/agency/img/team/4.jpg" class="img-responsive img-circle img-profile" alt="">

                            <!-- model -->
                            <?php
                            $id = 0;
                            $member = array();
                            if (!empty(Yii::app()->session['User']['id'])) {
                              $id = Yii::app()->session['User']['id'];
                              $sql = 'SELECT *
                                      FROM users
                                      WHERE id = '.$id;

                              $member = Yii::app()->db->createCommand($sql)->queryAll();
                              $member = $member[0];
                            }
                            ?>
                            <!-- Project Details Go Here -->
                            <h2> ข้อมูลส่วนตัว </h2>
                            <p class="item-intro text-muted"></p>
                            <hr>
                            <?php if (!empty($member)) : ?>
                            <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                <div class="row">
                                  <div class="col-md-3" style="text-align: right"><label class="control-label">ชื่อ - นามสกุล : </label></div>
                                  <div class="col-md-9" style="text-align: left">
                                    <label class="control-label"><?=$member['fname'].' '.$member['lname']?></label>
                                  </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                  <div class="col-md-3" style="text-align: right"><label class="control-label">อีเมล์ : </label></div>
                                  <div class="col-md-9" style="text-align: left">
                                    <label class="control-label"><?=$member['email']?></label>
                                  </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                  <div class="col-md-3" style="text-align: right"><label class="control-label">เบอร์ติดต่อ : </label></div>
                                  <div class="col-md-9" style="text-align: left">
                                    <label class="control-label"><?=$member['tel']?></label>
                                  </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                  <div class="col-md-3" style="text-align: right"><label class="control-label">ที่อยู่ : </label></div>
                                  <div class="col-md-9" style="text-align: left">
                                    <label class="control-label"><?=$member['address']?></label>
                                  </div>
                                </div>

                                <div class="row" style="padding-top: 15px">
                                  <div class="col-md-3" style="text-align: right"><label class="control-label">เงินคงเหลือ : </label></div>
                                  <div class="col-md-9" style="text-align: left">
                                    <label class="control-label"><?=$member['credit']?> บาท</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endif; ?>
                            
                            <div style="padding-top: 25px;"></div>

                            <h2> เปลี่ยนรหัสผ่าน </h2>
                            <p class="item-intro text-muted"></p>
                            <hr>
                            <form action="index.php?r=site?changePassword" method="post">
                              <div class="row">
                                <div class="col-md-offset-3">
                                  <div class="row">
                                    <div class="col-md-9">
                                      <div class="form-group">
                                        <input name="currPassword" type="password" class="form-control " placeholder="รหัสผ่านปัจจุบัน" required>
                                      </div>

                                      <div class="form-group">
                                        <input name="newPassword" type="password" class="form-control " placeholder="รหัสผ่านใหม่" required>
                                      </div>

                                      <div class="form-group">
                                        <input name="re_newPassword" type="password" class="form-control " placeholder="ยืนยันรหัสผ่านใหม่" required>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-primary">
                                ตกลง 
                              </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2> เข้าสู่ระบบ </h2>
                            <p class="item-intro text-muted"></p>
                            <form action="index.php?r=site/login" method="post">
                              <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                  <div class="form-group">
                                    <input name="username" type="text" class="form-control " placeholder="ชื่อผู้ใช้" required>
                                  </div>

                                  <div class="form-group">
                                    <input name="password" type="password" class="form-control " placeholder="รหัสผ่าน" required>
                                  </div>
                                </div>
                              </div> 
                              <button type="submit" class="btn btn-primary">
                                ตกลง
                              </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-responsive img-centered" src="css/agency/img/portfolio/treehouse-preview.png" alt="">
                            <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-responsive img-centered" src="css/agency/img/portfolio/golden-preview.png" alt="">
                            <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-responsive img-centered" src="css/agency/img/portfolio/escape-preview.png" alt="">
                            <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-responsive img-centered" src="css/agency/img/portfolio/dreams-preview.png" alt="">
                            <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="css/agency/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="css/agency/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="css/agency/js/classie.js"></script>
    <script src="css/agency/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="css/agency/js/jqBootstrapValidation.js"></script>
    <script src="css/agency/js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="css/agency/js/agency.js"></script>

</body>

</html>
