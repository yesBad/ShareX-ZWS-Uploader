<?php
   ob_start();
   session_start();
?>

<?
   $password = 'badisactuallygood';
?>

<html lang = "en">
   
   <head>
      <title>Login</title>
      <style>* {background-color: #777;}</style>
   </head>
	
   <body>
      <?php if (!$_POST['password'] == $password) { ?>
      <h2>Pass</h2>
      <div class = "container form-signin">
         <?php } ?>
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['password'])) {
				
               if ($_POST['password'] == $password) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'Bad';
                  
                  $mp4 = glob('./*.{mp4}', GLOB_BRACE);
                  $images = glob('./*.{jpeg,jpg,png}', GLOB_BRACE);

                  echo "<style>#image {border: 3px solid #000;}</style>";
                  echo "<style>#video {border: 3px solid #000;min-height: 50px;min-width: 50px;}</style>";
                  echo "<style>button {color: #000 !important; background-color: #fff !important;padding: 10px 20px;font-size: 18px;}</style>";
                  echo "<style>b {color: #fff;font-size: 18px;}</style>";
                  echo "<style>#owo {position: fixed;top: 0;right: 50%;border: 3px solid #000;}</style>";
                  echo "<div id='owo'>";
                  echo "<button onclick='imagefunc()'>Images</button>";
                  echo "<button onclick='videofunc()'>Videos</button>";
                  echo "<a href='logout.php' title ='Logout'><b>Logout</b></a>";
                  echo "</div>";
                  echo "<div id='fuckingimages'>";
                  foreach ($images as $image) {
                     echo "<img id='image' src='$image'>";
                  }
                  echo "</div>";
                  echo "<br>";
                  echo "<div id='fuckingvideos'>";
                  foreach ($mp4 as $video) {
                     echo "<video id='video' src='$video' controls></video>";
                  }
                  echo "</div>";
                  echo "<script>function imagefunc() {var x = document.getElementById('fuckingimages');if (x.style.display === 'none') {x.style.display= 'block';} else {x.style.display = 'none';}}</script>";
                  echo "<script>function videofunc() {var x = document.getElementById('fuckingvideos');if (x.style.display === 'none') {x.style.display= 'block';} else {x.style.display = 'none';}}</script>";
               }else {
                  $msg = 'Wrong';
               }
            }
         ?>
      <?php if (!$_POST['password'] == $password) { ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "Pass" required autofocus>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
         <?php } ?>
      </div> 
      
   </body>
</html>