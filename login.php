<!DOCTYPE html>
<!-- Include config.php: useful for database connection -->
<?php require_once 'config/config.php'; ?>

<html lang="en">
<head>
    <!-- Include header.php: useful for meta tags, stylesheets, or scripts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <?php include_once 'includes/header.php'; ?>
    
</head>
<body class="bg-light">
    <!-- Include navbar.php: contains the navigation bar/menu -->
    <?php include_once 'includes/nav.php'; ?>

    <!-- login forn: -->
    <?php include_once 'auth/login.php'; ?>
    
    <!-- Include footer.php: contains the footer section -->
    <?php include_once 'includes/footer.php'; ?>

     <style type="text/css">
        :root {
            --font-default: "Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --font-primary: "Amatic SC", sans-serif;
            --font-secondary: "Inter", sans-serif;

            /* Colors */
            --color-default: #3a003d;
            --color-primary: #7b1fa2;
            --color-secondary: #9c27b0;

            scroll-behavior: smooth;
        }
           
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



        .footer {
            font-size: 14px;
            background-color: #1f1f24;
            padding: 50px 0;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 25rem;
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
/*--------------------------------------------------------------
# form icon
--------------------------------------------------------------*/
   .form-group  input[type=text]
	{
		padding-left: 40px;
	}
	.form-group  input[type=email]
	{
		padding-left: 40px;
	}
	.form-group  input[type=tel]
	{
		padding-left: 40px;
	}
	.form-group  input[type=password]
	{
		padding-left: 40px;
	}
	.form-group
	{
		position: relative;

	}
	.form-group i
	{
		position: absolute;
		left: 8px;
		top: 15px;
		color: grey;

	}
	.form-group input[type=text]:focus + i
	{
		color: dodgerblue;
	}
	.form-group input[type=tel]:focus + i
	{
		color: dodgerblue;
	}
	.form-group input[type=email]:focus + i
	{
		color: dodgerblue;
	}
	.form-group input[type=password]:focus + i
	{
		color: dodgerblue;
	}
	.btn-primary
	{
		/*background-color: gray;*/
		border-radius: 15px;
	}
	/*.form-group input[type=submit]{
		width: 410px
	}
*/
     
    </style>

</body>
</html>

