<?php require_once('./handlers/profile.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Seeker Profile</title>
    <link rel="stylesheet" href="./static/css/job_seeker_profile.css" />
    <link rel="stylesheet" href="./static/css/navbar_and_footer.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  </head>
  <body>
    <nav class="navbar">
      <div class="nav-container">
        <div class="navbar-header">
          <div>
            <img
              src="./static/images/logo.jpg"
              alt=""
              class="nav-logo-img"
            />
            <a href="./index.html" class="navbar-brand">JobPosting</a>
          </div>
          <button class="navbar-toggle" onclick="toggleMenu()">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse" id="navbarMenu">
          <ul class="nav">
            <li>
              <a href="/index.php"><span class="icon-home"></span>Home</a>
            </li>
            <li>
              <a href="/profile.php"><span class="icon-user"></span>Profile</a>
            </li>
            
            <li>
              <a href="#" onclick="return Logout()"><span class="icon-user"></span>Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="profile-container">
      <div class="profile-header">
        <img src="./static/images/avatar-7.webp" alt="Profile Picture" class="profile-pic" />
        <div class="profile-info">
          <h1 id="profile-name"><?php echo $user['first_name'] ." ". $user['last_name']; ?></h1>
          <h2 id="profile-title"><?php echo $user['title']; ?></h2>
        </div>
      </div>
      <div class="info-card">
        <div class="info-section">
        <div class="info-item">
          <span class="info-label">Address:</span>
          <span class="info-value" id="address"><?php echo $user['address']; ?></span>
        </div>
          <div class="info-item">
            <span class="info-label">Email:</span>
            <span class="info-value" id="email"><?php echo $user['email']; ?></span>
          </div>
        </div>
        <div class="info-section">
          <div class="info-item">
            <span class="info-label">Phone:</span>
            <span class="info-value" id="phone"><?php echo $user['phone']; ?></span>
          </div>
          <div class="info-item">
            <span class="info-label">Industry</span>
            <span class="info-value" id="industry"><?php echo $user['industry']; ?></span>
          </div>
        </div>
      </div>
      <div class="about-section">
        <h3>About</h3>
        <p id="about-data"><?php echo $user['about'] ?? "No data found"; ?></p>
      </div>
      <div class="experience-section">
        <h3>Experience</h3>
        <div id="exp-list">
          <?php foreach ($exps as $exp): ?>
          <div class="experience">
            <h4 class="exp-title">Chair Man</h4>
            <p class="company-period"></p>
            <p class="exp-desc"></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="skills-section">
        <h3>Skills</h3>
        <div id="skill-list">
        <?php foreach ($skills as $skill): ?>
          <div class="skill"><?php echo $skill['skill'] ?></div>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
    <script src="./static/js/profile.js"></script>
  </body>
</html>

