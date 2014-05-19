<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" ng-app="packupApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="packupApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="packupApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="packupApp" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>My AngularJS App</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1>Packup4.me - <small>helping you getting stuff packed</small></h1>
          <div class="navbar navbar-inverse">
            <div class="navbar-header">
              <a href="#/main" class="navbar-brand">Home</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#/contact">Contact</a></li>
                <li><a href="#/something">Something else here</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <div ng-view></div>

  <!-- <?php echo $sf_content ?> -->
  

  <!-- In production use:
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/x.x.x/angular.min.js"></script>
  -->
    

  </div>
  <?php include_javascripts() ?>
</body>
</html>
