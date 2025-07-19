<!DOCTYPE html>
<!-- Include config.php: useful for database connection -->
<?php require_once 'config/config.php';

?>

<?php
// Kumbuka kuweka config yako ya connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kids_welfare';

// Connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Children currently allocated to foster care
$sql_children = "SELECT COUNT(DISTINCT child_id) AS total_children FROM allocations";
$result_children = $conn->query($sql_children);
$children_count = $result_children->fetch_assoc()['total_children'] ?? 0;


// Foster care centers (foster_name za kipekee)
$sql_centers = "SELECT COUNT(DISTINCT foster_name) AS total_centers FROM fostercare";
$result_centers = $conn->query($sql_centers);
$center_count = $result_centers->fetch_assoc()['total_centers'] ?? 0;

// 3. Successful adoptions based on available_for_adoption = 'No'
$sql_adoptions = "SELECT COUNT(*) AS total_adoptions 
FROM children 
WHERE available_for_adoption = 'No'";
$result_adoptions = $conn->query($sql_adoptions);
$adoption_count = $result_adoptions->fetch_assoc()['total_adoptions'] ?? 0;
?>


<html lang="en">
<head>
    <!-- Include header.php: useful for meta tags, stylesheets, or scripts -->
    <?php include_once 'includes/header.php'; ?>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
 .hero {
  background: url('pages/assets/img/background.jpg') no-repeat center center;
  background-size: cover;
  color: white;
  text-align: center;
  padding: 140px 20px 100px;
}
</style>
</head>
<body class="bg-light">

    <!-- Include navbar.php: contains the navigation bar/menu -->
    <?php include_once 'includes/navbar.php'; ?>

    <!-- Include hero.php: typically contains a hero banner or welcome section -->
    <?php include_once 'includes/hero.php'; ?>

    <!-- Include home.php: the main content of the homepage -->
    <?php include_once 'includes/home.php'; ?>

    <!-- Include footer.php: contains the footer section -->
    <?php include_once 'includes/footer.php'; ?>
    
    <!-- scroll to top button -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    <!-- logout script after 60sec -->

    <!-- bootstrap js -->
    <script type="text/javascript" src="assets/js/jquery-3.4.1.slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/wow.js"></script>
    <script type="text/javascript">
      new WOW().init();
    </script>

    <!-- Scripts -->
<script>
  const messages = [
    "Jenga Familia Imara",
    "Pokea Upendo Mpya",
    "Anza Safari ya Malezi",
    "Tengeneza Nyumbani Yenye Furaha"
  ];
  let msgIndex = 0;

  setInterval(() => {
    msgIndex = (msgIndex + 1) % messages.length;
    document.getElementById('changing-title').innerText = messages[msgIndex];
  }, 5000);

  function toggleLanguage() {
    const label = document.getElementById('lang-label');
    label.innerText = label.innerText === 'EN' ? 'SW' : 'EN';
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav-link[href^='#']");

  navLinks.forEach(link => {
    link.addEventListener("click", function () {
      navLinks.forEach(l => l.classList.remove("active"));
      this.classList.add("active");
    });
  });
});
</script>

</body>
  <style>
     /* General Styling */
    body {
      font-family: 'Segoe UI', sans-serif;
    }

     /* Nav link default style */
        /* Normal nav link */
.nav-link {
  border-radius: 10px !important;
  padding: 8px 16px;
  font-weight: 500;
  transition: all 0.3s ease-in-out;
  color: #333;
  display: flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
}

/* Icon ya ndani ya nav-link */
.nav-link i {
  color: #333;
  transition: color 0.3s ease-in-out;
}

/* Active nav link - inayoonyesha ukurasa uliofunguliwa */
.nav-link.active {
  background-color: #e6f0ff !important;  /* soft light blue background */
  color: #3366cc !important;             /* soft blue text */
  border-radius: 25px !important;        /* curved corners */
  box-shadow: 0 4px 10px rgba(51, 102, 204, 0.25); /* light shadow */
  transform: scale(1.01);                /* kidogo kuinuka */
}

/* Icon ya active nav link */
.nav-link.active i {
  color: #3366cc !important;             /* soft blue icon */
}

/* Hover effect (optional) */
.nav-link:hover {
  background-color: #f5f9ff;
  color: #3366cc;
  text-decoration: none;
}

.nav-link:hover i {
  color: #3366cc;
}


    /* Hero Section */
    .hero {
      background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://source.unsplash.com/1600x600/?children,family') no-repeat center center/cover;
      color: white;
      padding: 120px 0;
      text-align: center;
    }

    /* Section Padding */
    .section-padding {
      padding: 60px 0;
    }
    
      .stat-card {
      border-radius: 30px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    }
    .icon-box {
      display: inline-block;
      padding: 10px;
      border-radius: 10px;
      color: white;
    }

    /* How to Apply Section */
    .apply-card {
      background-color: #fff;
      border: 1px solid #eee;
      border-radius: 12px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .apply-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .number-circle {
      background: linear-gradient(135deg, #3b82f6, #9333ea);
      color: #fff;
      font-weight: bold;
      font-size: 1rem;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Contact Cards */
    .contact-card {
      background-color: #fff;
      border: 1px solid #eee;
      border-radius: 12px;
      transition: all 0.3s ease;
      text-align: center;
    }

    .contact-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .contact-card i {
      font-size: 30px;
      padding: 15px;
      border-radius: 12px;
      color: white;
      margin-bottom: 15px;
    }

    .phone-icon {
      background-color: #3b82f6;
    }
    .email-icon {
      background-color: #10b981;
    }
    .location-icon {
      background-color: #a855f7;
    }
    .hours-icon {
      background-color: #f97316;
    }

     .scroll-top {
    position: fixed;
    visibility: hidden;
    opacity: 0;
    right: 15px;
    bottom: 15px;
    z-index: 99999;
    background: var(--color-primary);
    width: 44px;
    height: 44px;
    border-radius: 50px;
    transition: all 0.4s;
  }
  
  .scroll-top i {
    font-size: 24px;
    color: #fff;
    line-height: 0;
  }
  
  .scroll-top:hover {
    background: #ec2727;
    color: #fff;
  }
  
  .scroll-top.active {
    visibility: visible;
    opacity: 1;
  }

    /* Footer */
    .footer {
            font-size: 14px;
            background-color: #1f1f24;
            padding: 50px 0;
            color: rgba(255, 255, 255, 0.7);
            margin-top: rem;
        }

        .footer .icon {
            margin-right: 15px;
            font-size: 24px;
            line-height: 0;
        }

        .footer h4 {
            font-size: 16px;
            font-weight: bold;
            position: relative;
            padding-bottom: 5px;
            color: #fff;
        }

        .footer .footer-links {
            margin-bottom: 30px;
        }

        .footer .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer .footer-links ul li {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .footer .footer-links ul li:first-child {
            padding-top: 0;
        }

        .footer .footer-links ul a {
            color: rgba(255, 255, 255, 0.6);
            transition: 0.3s;
            display: inline-block;
            line-height: 1;
        }

        .footer .footer-links ul a:hover {
            color: #fff;
        }

        .footer .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
            margin-right: 10px;
            transition: 0.3s;
        }

        .footer .social-links a:hover {
            color: #fff;
            border-color: #fff;
        }

        .footer .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer .credits {
            padding-top: 4px;
            text-align: center;
            font-size: 13px;
        }

        .footer .credits a {
            color: #fff;
        }
  </style>
</html>