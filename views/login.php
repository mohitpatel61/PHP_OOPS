<?php
require_once 'views/common/header.php';
?>
<?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    <section id="contact" class="contact section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Login</h2>
        <div><span>Check Our</span> <span class="description-title">Contact</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-4">
            

          </div>

          <div class="col-lg-12">
            <!-- <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200"> -->
            <form id="loginForm" method="POST" class="php-email-form" action="/user-login">
              <div class="row gy-4">
            
                <div class="col-md-6">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Your email" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required="">
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"><?php if (isset($message)) { echo "<p>$message</p>"; } ?>
                  </div>

                  <button type="submit">Login</button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    
    <?php foreach ($this->getScripts() as $script) { ?>
    <script src="<?php echo $script; ?>" defer></script>
    <?php } ?>
 
<?php
require_once 'views/common/footer.php';
?>
