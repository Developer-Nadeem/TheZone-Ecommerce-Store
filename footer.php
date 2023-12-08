<style>
  /* css styles for the footer */
.footer {
  margin-top: 0px;
  padding-top: 10px;
  position: relative;
  bottom: 0;
  width: 100%;
  /* padding: 0px 0; */
}

.footer p {
  margin: 0;
}

/* used for "About Us" text in footer */
.footer h5 a {
  text-decoration: none; 
  color: white; 
  position: relative; 
}

.footer h5 a:hover {
  text-decoration: underline; /* Add underline on hover */
}

.shopping-cart-button:hover img {
  content: url('images/shopping-cart-icon-hover.png');
}
</style>

<footer class="footer bg-dark text-white">
  <br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
      <h5><a href="aboutus.php">About Us</a></h5>

        <p>The Zone is a leading provider of high-quality clothing. <br> We strive to define street wear for
          the new generation.
        </p>
      </div>
      <div class="col-md-4">
        <h5>Contact Information</h5>
        <p>
        <a href="contact.php" style="text-decoration: none; color: white; position: relative; display: inline-block;"
    onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Contact Us Via Form!</a>
          <br>
          Address: Aston Street, The Zone<br>
          Phone: +44 123456789<br>
          Email: contactus@thezone.co.uk
        </p>
          
      </div>
      <div class="col-md-4">
        <h5>Follow Us</h5>
        <p>Stay connected with us on Instagram:</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="https://www.instagram.com/thezzoneecom/" class="text-white" style="font-size: 30px;">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <p class="text-center">
          &copy; 2023 The Zone. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</footer>