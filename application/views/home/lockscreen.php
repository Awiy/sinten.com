<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Sinten Coffee</title>

  <!-- Bootstrap core CSS -->

  <link href="<?= base_url('assets/'); ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?= base_url('assets/'); ?>fontawesome/css/all.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/'); ?>css/style-responsive.css" rel="stylesheet">
  
</head>

<body onload="getTime()">
 
  <div class="container">
    <div id="showtime"></div>
    <div class="col-lg col-lg-offset">
      <div class="lock-screen">
        <a data-toggle="modal" href="#myModal"><i class="fas fa-10x fa-unlock-alt"></i></i><p><br>UNLOCK</p></a>
        
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Welcome Back</h4>
              </div>
              <div class="modal-body">
                <p class="centered"><img class="img-circle" width="80" src="<?= base_url('assets/'); ?>img/coffee2.jpg"></p>
                <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer centered">
                <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
                <button class="btn btn-theme03" type="submit">Login</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->
      </div>
      <!-- /lock-screen -->
    </div>
    <!-- /col-lg-4 -->
  </div>
  <!-- /container -->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?= base_url('assets/'); ?>lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="<?= base_url('assets/'); ?>lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("<?= base_url('assets/'); ?>img/candi.jpg", {
      speed: 500
    });
  </script>
  <script>
    function getTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      // add a zero in front of numbers<10
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('showtime').innerHTML = h + ":" + m + ":" + s;
      t = setTimeout(function() {
        getTime()
      }, 500);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
  </script>
</body>

</html>
