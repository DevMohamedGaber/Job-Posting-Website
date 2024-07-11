<?php require_once('./handlers/index.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./static/images/logo.png" />
    <title>The Quite Storm</title>
    <link rel="stylesheet" href="./static/css/index.css"/>
    <link rel="stylesheet" href="./static/css/style.css" />
    <link rel="stylesheet" href="./static/css/navbar_and_footer.css" />
    <link rel="stylesheet" href="./static/css/navbar_and_footer.css" />
    <link rel="stylesheet" href="./static/css/create_post.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@400;600&display=swap"/>
  </head>
  <body>
    <nav class="navbar">
      <div class="nav-container">
        <div class="navbar-header">
          <div>
            <img src="./static/images/logo.jpg" alt="" class="nav-logo-img" />
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
              <a href="./index.php"><span class="icon-home"></span>Home</a>
            </li>
            <li>
              <a href="./profile.php"><span class="icon-user"></span>Profile</a>
            </li>
            
            <li>
              <a href="#" onclick="return Logout()"><span class="icon-user"></span>Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--navbar close-->

    <div class="container">
      <div class="left-sidebar">
        <div class="sidebar-profile-box">
          <img src="./static/images/banner.jpg" width="100%" />
          <div class="sidebar-profile-info">
            <!-- <img src="./static/images/my profile.png" /> -->
            <h1>Om Jaju</h1>
            <h3>
              Frontend developer | ReactJS | JavaScript | Python | Redux | HTML
              | CSS | NextJS | Cybersecurity |
            </h3>
          </div>
        </div>
        <div class="sidebar-activity" id="sidebar-activity">
          <h3>RECENT</h3>
          <a href="#"><img src="./static/images/recent.png" />Web Development</a>
          <a href="#"><img src="./static/images/recent.png" />User Interface</a>
          <a href="#"><img src="./static/images/recent.png" />Online Learning</a>
          <a href="#"><img src="./static/images/recent.png" />Learn Online</a>
          <a href="#"><img src="./static/images/recent.png" />Code Better</a>
          <a href="#"><img src="./static/images/recent.png" />Group Learning</a>
          <h3>GROUPS</h3>
          <a href="#"><img src="./static/images/group.png" />Web Design Group</a>
          <a href="#"><img src="./static/images/group.png" />HTML & CSS Learners</a>
          <a href="#"
            ><img src="./static/images/group.png" />Python & JavaScript Group</a
          >
          <a href="#"><img src="./static/images/group.png" />Learn Coding Online</a>
          <h3>HASHTAG</h3>
          <a href="#"><img src="./static/images/hashtag.png" />wbdevelopment</a>
          <a href="#"><img src="./static/images/hashtag.png" />userinterface</a>
          <a href="#"><img src="./static/images/hashtag.png" />onlinelearning</a>
          <div class="discover-more-link">
            <a href="#">Discover more</a>
          </div>
        </div>
        <p id="showMoreLink">Show more</p>
      </div>
      <div class="main-content">
        <div class="add-post" >
          <img
            src="https://placehold.co/70x70?text=img"
            alt=""
            id="add-post-prof-img"
          />
          <button id="openPopup" onclick="openCreatePostPopup()">Add Post</button>
        </div>
        <div class="sort-by">
          <hr />
          <p>
            Sort by: <span>top <img src="./static/images/down-arrow.png" /></span>
          </p>
        </div>
        <div id="PostsList">
          <?php 
            for ($i = 0; $i < count($posts); $i++): 
              $post = $posts[$i];
          ?>
            <div class="job-listing" id="job-post-<?php echo $i?>">
              <div class="job-header">
                <div class="job-header-data">
                  <h2 class="postPosition"><?php echo $post['position'] ?></h2>
                  <p class="company">
                    Company Name
                    <span class="location">- <?php echo $post['location'] ?></span>
                  </p>
                  <p class="posted"><?php echo $post['created_at'] ?></p>
                  <p class="applicants-num"><?php echo $post['applicants_count'] ?> Applicants</p>
                  <div class="buttons">
                    <button class="apply-btn" onclick="OpenModal(<?php echo $post['id'];?>)">Apply For Job</button>
                    <button class="details-btn" onclick="toggleDetails(<?php echo $i?>)">Show Details</button>
                  </div>
                </div>
                <div class="job-header-img"></div>
              </div>
      
            <!-- start job description   -->
      
            <div class="job-details" id="job-details-<?php echo $i?>">
              <div class="job-info">
                <div>
                  <h3>Salary</h3>
                  <p class="salary-value"><?php echo $post['salary']; ?></p>
                </div>
                <div>
                  <h3>Industry</h3>
                  <p class="industry-value"><?php echo $post['industry']; ?></p>
                </div>
                <div>
                  <h3>Job Description</h3>
                  <p class="description"><?php echo $post['description']; ?></p>
                </div>
              </div>
            </div>
      
            <!-- start interaction-section -->
      
            <div class="interaction-section">
              <div class="interaction-header">
                <div class="likes-count">
                  <span>👍 <?php echo $post['reactions_count']; ?> Likes</span>
                </div>
                <div class="comments-count">
                  <span><?php echo $post['comments_count']; ?> comments</span>
                </div>
              </div>
              <div class="interaction-buttons">
                <span class="<?php echo $post['is_liked'] ? 'liked' : ''; ?>" onclick="LikePost(event, <?php echo $post['id'] ?>)">Like</span>
                <span class="comments-show" onclick="ShowComments(<?php echo $post['id'] .','. $i ?>)">Comments</span>
              </div>
      
              <!-- strat toggleable comments section -->
      
              <div id="comments-container" style="display: none">
                <div class="add-comment">
                  <img
                    src="https://placehold.co/40x40?text=img"
                    alt="User Avatar"
                    class="user-avatar"
                  />
                  <input
                    id="addCommentInput"
                    type="text"
                    placeholder="Add a comment..."
                    class="comment-input"
                    onkeypress="return AddComment(event, <?php echo $post['id'] .','. $i?>)"
                  />
                </div>
                <div class="comments-section"></div>
              </div>
            </div>
          
          </div>
          <?php endfor;?>
        </div>
        
    
        <!-- upload resume popup -->
    
        <div id="applyModal" class="modal">
          <div class="modal-content">
            <span class="close" onsubmit="closeModal()">&times;</span>
            <h2>Upload Resume</h2>
            <form id="applyForm" onsubmit="Apply(event)">
              <input type="text" id="resume" name="content" placeholder="CV URL here"/>
              <button type="submit">Submit Application</button>
            </form>
            <p class="msg"></p>
          </div>
        </div>
      </div>
      <div class="right-sidebar">

        <div class="sidebar-ad">
          <div>
            <!-- <img src="./static/images/my profile.png" /> -->
            <img src="./static/images/web logo.png" />
          </div>
          <b>Technical Enthusiast</b>
        </div>

        <div class="sidebar-useful-links">
          <a href="#">About</a>
          <a href="#">Accessibility</a>
          <a href="#">Help Center</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Advertising</a>
          <a href="#">Get the App</a>
          <a href="#">More</a>

          <div class="copyright-msg">
            <img src="./static/images/logo.png" />
            <p>LINKEDIN OJ &#169; 2023</p>
          </div>
        </div>
      </div>
    </div>
    <div id="popup" class="popup">
      <div class="popup-content">
        <span class="close" onclick="closeCreatePostPopup()">&times;</span>
        <form onsubmit="AddPost(event)">
          <div class="form-row">
            <label for="position">Position</label>
            <input type="text" id="title" name="position" />
          </div>

          <div class="form-row">
            <label for="company">Company</label>
            <input type="text" id="company" name="company" />
          </div>
          <div class="form-row">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" />
          </div>
          <div class="form-row">
            <label for="salary">Salary</label>
            <input type="text" id="salary" name="salary" />
          </div>
          <div class="form-row">
            <label for="industry">Industry</label>
            <input type="text" id="industry" name="industry" />
          </div>
          <div class="form-row">
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
          </div>
          <p id="createPostErroe"></p>
          <div class="form-row">
            <button type="submit">Post</button>
          </div>
        </form>
      </div>
    </div>
    <script>
      const user = <?php echo json_encode($_SESSION['user'], true);?>
    </script>
    <script src="./static/js/index.js"></script>
  </body>
</html>
