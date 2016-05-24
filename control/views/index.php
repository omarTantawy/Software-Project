<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="css/air.css">
    <link rel="stylesheet" href="css/fonts.global.1.0.0.css">
    <link rel="stylesheet" href="css/styles2.css">


</head>
<body>
<br>
<br><br><br>

<?php if (Globals::session_started()) { ?>

    <ul class="nav nav-tabs">
        <li></li>
        <li><a href="index.php?p=default">Home</a></li>

        <?php if ($_SESSION['user'] == "patient") { ?>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">Reservation <span class="caret"></span> </a>
            <ul class="dropdown-menu">
                <li><a href="index.php?p=reservationAdd">Add Reservation</a></li>
                <li><a href="index.php?p=reservationShow">My Reservation</a></li>
            </ul>
        </li>
        <?php } ?>
        <?php if ($_SESSION['user'] == "secretary") { ?>
            <li class="dropdown"><a href="index.php?p=patientAdd">Add patient account </a></li>
            <li class="dropdown"><a href="index.php?p=patientDelete">Delete patient </a></li>
            <li class="dropdown"><a href="index.php?p=dependentAdd">Add Dependent </a></li>
            <li class="dropdown"><a href="index.php?p=dependentDelete">Delete Dependent </a></li>

            <br>
        <?php } ?>
        <?php if ($_SESSION['user'] == "doctor") { ?>

            <li class="dropdown"><a href="index.php?p=secretaryAdd">Add secretary</a></li>
            <li class="dropdown"><a href="index.php?p=secretaryDelete">Show secretary</a></li>
            <li><a href="index.php?p=reservationsShow">Reservations</a></li>
        <?php } ?>
        <li class="dropdown"><a href="index.php?p=profileEdit">edit profile </a></li>
        <ul class="navbar-right">
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </ul>
<?php } ?>


<div class="boody">
    <div style="text-align: center;">
        <?php
        if ($errors) {
            ?>
            <ul class="alert alert-danger display">
                <?php
                foreach ($errors as $val) {
                    ?>
                    <li>
                        <?php echo $val ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        } elseif ($success) {
            ?>
            <?php echo $success ?>
            <?php
        }
        ?></div>
    <?php
    if (!$success || !$successOnly) {
        if ($noRecords) {
            ?>
            <div style="text-align: center;" class="alert alert-danger display"><?php echo $noRecords ?></div>
            <?php
        } else
            include $module;
    }
    ?>
</div>


<footer class="footer-navbar-wrapper footer-default ng-scope" role="contentinfo">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row links-section">
                    <div class="col-md-3">
                        <p><a href="">About Us</a></p>

                    </div>
                    <div class="col-md-3">
                        <p><a href="">Community</a></p>
                    </div>
                    <div class="col-md-3">
                        <p><a href="">Terms of Service</a></p>
                    </div>
                    <div class="col-md-3">
                        <p><a href="">Cookie Policy</a>
                        </p>
                    </div>
                </div>
                <div class="row service-code-section">
                    <div class="col-md-3">
                        <div class="display-inline-block ng-scope">
                            <div class="service-code"><a
                                    href=""
                                    class="ng-binding service-code-label">Service Code</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="social-icons-wrapper text-center">
                    <a href="https://plus.google.com/107040851368295259701"><i
                            class="glyphicon glyphicon-lg air-icon-social-google-plus"></i></a>
                    <a href="https://twitter.com/Upwork"><i
                            class="glyphicon glyphicon-lg air-icon-social-twitter"></i></a>
                    <a href="https://www.facebook.com/upwork"><i
                            class="glyphicon glyphicon-lg air-icon-social-facebook"></i></a>
                    <a href="https://www.linkedin.com/company/upwork"><i
                            class="glyphicon glyphicon-lg air-icon-social-linkedin"></i></a>
                </div>
                <p class="text-center copyright">
                    Yasta.com
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>