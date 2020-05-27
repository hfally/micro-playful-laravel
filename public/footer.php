 <!-- Footer Section-->
  <footer class="footer-area" >
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         
          <div class="footer-nav">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="speakers">Speakers</a></li>
              <li><a href="contact-us">Contact</a></li>
            </ul>
          </div>
          <div class="footer-bottom">
            <div class="logo">
              <a href=""><img src="admin/banner/<?php echo $cp_logo; ?>" alt=""></a>
            </div>
            <div class="fb-text">
              <p> Copyright © <?php echo date('Y'); ?> <?php echo $cp_footer; ?> All Rights Reserved <?php echo $cp_dpname; ?></a></p>
            </div>
            <div class="fb-s-icon">
              <ul>
             <?php if($cp_tw!=""){ ?><li><a href="https://www.twitter.com/<?php echo $cp_tw; ?>"><i class="fab fa-twitter"></i></a></li><?php  } ?>
               <?php if($cp_fb!=""){ ?>  <li><a href="https://www.facebook.com/<?php echo $cp_fb; ?>"><i class="fab fa-facebook-f"></i></a></li><?php } ?>
               <?php if($cp_ig!=""){ ?> <li><a href="https://www.instagram.com/<?php echo $cp_ig; ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>