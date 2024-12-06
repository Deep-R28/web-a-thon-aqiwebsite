<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="airstyle.css">
    <title>GreenBreeze</title>
  </head>
  <body>
    <header>
      <a href="#" class="logo"> GreenBreeze </a>
      <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#team">Our Team</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
      <div class="top-btn">
      <?php 
               if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                echo  '<div class="user-menu">
                    <div class="icon">
                        <span>' . $_SESSION['username'] . '  </span> &#9660;
                    </div>
                    <div class="dropdown">
                        <a href="logout.php"><p style="color:red">Log Out</p></a>
                        <p>Login Count: ' . $_SESSION['loggedtimes'] .'</p>
                    </div>
                </div>';
            } else 
            {
                echo '<a href="signin.php" class="nav-btn">Sign In</a>';
            }
        ?>
      </div>
    </header>
    
    <section class="home" id="home">
    <?php
        if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] ){
          echo '<section class="aqi" data-aos="zoom-up">
          <a href="signin.php">Know Your Weather</a>
        </section>';
        }
        else
        {
          echo '<section class="aqi" data-aos="zoom-up">
          <a href="./aqi/portal.html">Know Your Weather</section>';
        }
        ?>
      <div class="home-content" data-aos="zoom-in">
        <h3>"Breathe Better</h3>
        <h1>Live Better"</h1>
        <h3><span class="multiple-text">Stay Safe</span></h3>      
      </div>
      <div class="home-img" data-aos="zoom-in">
        <img src="/Users/deepraja28/Documents/Web DA/air1.jpg" alt="Air">
      </div>
    </section>

    <section class="services" id="services" >
    </section>

    <section class="about" id="about">
      <div class="image-hover" data-aos="zoom-in">
      </div>

      <div class="about-content">
        <h2 data-aos="zoom-in-up">About <span>Us</span></h2><br><br>
        <p data-aos="zoom-in-down">Welcome to GreenBreeze, your comprehensive resource for air quality awareness and protection. At GreenBreeze, we believe that clean air is a fundamental right and a cornerstone of a healthy, thriving community. With the growing challenges of air pollution and environmental hazards, understanding the air we breathe has never been more essential. Our mission is to empower individuals, families, and communities with real-time air quality insights so they can make informed decisions to protect their health and well-being.

          Our team of dedicated environmental scientists, data analysts, and technology experts have developed an innovative portal designed to deliver precise and timely information on air quality levels across regions. Whether you’re monitoring your local Air Quality Index (AQI) for health reasons, making travel decisions, or seeking ways to improve indoor air safety, GreenBreeze provides the tools and data you need to stay informed and take action.
          
          At GreenBreeze, we are committed to promoting transparency, education, and proactive steps toward healthier air. Our interactive tools allow users to check real-time AQI data for their specific area, understand the factors affecting air quality, and learn practical steps to mitigate pollution exposure. We also collaborate with industry experts, healthcare professionals, and environmental organizations to raise awareness on air pollution’s impact on public health and advocate for cleaner, greener urban spaces.
          
          Join us on our journey to breathe better and live better. Together, we can create a future where everyone has access to cleaner, safer air, and where communities are empowered with the knowledge to protect their health and the environment.</p><br><br>
        <div><a href="#" class="book">Grab Your Spot Now!!</a></div>
    </section>

  <section class="team" id="team">
    <h2 class="des" data-aos="zoom-in-down">Our <span id="sub">Team</span></h2>
    <div class="plans-content" data-aos="zoom-in-up">
      <div class="box">
        <h3>Pedalli Jashwanth Ram</h3><br>
        <h2><span> 23MIS0128</span></h2><br><br>
        <ul>
          <li>BackEnd Developer</li>
          <li>PHP, MySQL, AJAX</li>
        </ul> <br><br><br><br><br>
        <a href="#https://www.instagram.com/jashwanthpedelly/">
          My Profile
          <i class='bx bxs-right-arrow-alt'></i>
        </a>
      </div>
      <div class="box">
        <h3>Deep P Raja</h3><br>
        <h2><span>23MIS0409 </span></h2> <br><br>
        <ul>
          <li>FrontEnd Developer</li>
          <li>HTML, CSS, JavaScript</li>
        </ul>  <br><br><br> <br><br>
        <a href="#https://www.instagram.com/deepraja28/">
          My Profile
          <i class='bx bxs-right-arrow-alt'></i>
        </a>
      </div>
      <div class="box">
        <h3>Sai Kalyan Ram</h3><br>
        <h2><span>23MIS0259 </span></h2> <br><br>
        <ul>
          <li>Mixed Developer</li>
          <li>HTML, CSS, JQuery</li>
        </ul> <br><br><br> <br><br>
        <a href="https://www.instagram.com/kalyan_ram09/">
          My Profile
          <i class='bx bxs-right-arrow-alt'></i>
        </a>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="social">
    <a href="#"><i class='bx bxl-facebook-circle'></i></a>
    <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
    <a href="#"><i class='bx bxl-twitter' ></i></a>
    <a href="#"><i class='bx bxl-linkedin' ></i></a>
  </div>
    <p class="copy">
      &copy; GreenBreeze 2024 - All Right Reserved
    </p>
  </footer>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset: 300,
      duration: 1400,

    });
  </script>

  <script src="script.js"></script>
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</body>
  </html>