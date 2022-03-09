<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Slishy.com is a crafting calculator for the free MMORPG game Albion Online">
    <meta name="author" content="Slishy">
    <title>Albion Online | Crafting Calculator</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/dark-theme.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<?php
    if ( isset( $_GET[ "location" ] ) ) {
    $location = $_GET[ "location" ];
} else {
$location = "Lymhurst";
}
    ?>
    
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form autocomplete="off" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo $_SERVER["PHP_SELF"] . '?'.http_build_query($_GET); ?>">
                        <div class="input-group">
                            <form method="GET">
                                <input type="hidden" name="location" value="<?php echo $location; ?>" />                                
</form>
                            <input list="items" type="search" name="inputItem" class="form-control bg-light border-0 small" placeholder="Search for item" aria-label="Search" aria-describedby="basic-addon2">
                            <?php require_once("api/itemList.php"); ?>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search fa-sm"></i> </button>
                            </div>
                        </div>
                    </form>
                    
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                        <form autocomplete="off" class="d-sm-none" action="index.php">
                        <div class="input-group">
                            <form method="GET">
   <input type="hidden" name="location" value="<?php echo $location; ?>" />
</form>
                            <input list="items" type="search" name="inputItem" class="form-control bg-light border-0 small" placeholder="Search for item" aria-label="Search" aria-describedby="basic-addon2" action="index.php">
                            <?php require_once("api/itemList.php"); ?>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search fa-sm"></i> </button>
                            </div>
                        </div>
                        </form>
                        </li>
                        <li>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="darkSwitch" />
                        <label class="custom-control-label" for="darkSwitch">Dark Mode </label>
                    </div>
                    <script src="js/dark-mode-switch.min.js"></script>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Craft Calculator</h1>
                    <?php if (empty( $_GET['inputItem'])): ?>
                    <p class="mb-2">Search for an item at the top of your screen to calculate the ingredients, costs and (focus) profit to craft an item within Albion Online.</p>
                    <?php else: ?>
<?php
require("api/call.php");
require("api/functions.php");
?>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card shadow mb-2">
                                    <a href="#collapseCardOne" class="card-header py-3 border-left-success<?php if ( isset( $_GET[ "location" ] )) { echo " collapsed"; } ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php include_once("api/cardOneHeaderCustom.php"); ?></h6>
                                    </a>
                                <div class="collapse<?php if ( !isset( $_GET[ "location" ] ) || (!in_array($location, $cities))) { echo " show"; } ?>" id="collapseCardOne">
                                <div class="card-body">
                                    <?php
                                    include( "api/cardOne.php" );
                                    ?>
                                </div>
                                </div>
                                <div class="card shadow mb-6">
                                    <a href="#collapseCardFour" class="card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                    <h6 class="m-0 font-weight-bold text-primary">Item to craft</h6>
                                    </a>
                                <div class="collapse show" id="collapseCardFour">
                                <div class="card-body">
                                    <?php include( "api/cardFour.php" ); ?>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card shadow mb-2">
                                <a href="#collapseCardTwo" class="card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                    <h6 class="m-0 font-weight-bold text-primary">Select the tier</h6>
                                </a>
                                <div class="collapse show" id="collapseCardTwo">
                                <div class="card-body">
                                    <?php
            include( "api/cardTwo.php" );
            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-4">
                            <div class="card shadow mb-2">
                                    <a href="#collapseCardFive" class="card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                        <h6 class="m-0 font-weight-bold text-primary">Profit</h6>
                                    </a>
                        <div class="collapse show" id="collapseCardFive">
                                <div class="d-flex flex-row">
                                    <?php
            //include( "api/cardSeven.php" );
            ?>
                                </div>
                            </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card shadow mb-2"> <a href="#collapseCardThree" class="card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                    <h6 class="m-0 font-weight-bold text-primary">Materials and costs</h6>
                                </a>
                                <?php include("api/cardThreeConcept.php"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card shadow mb-2">
                            <a href="#collapseCardSix" class="card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                <h6 class="m-0 font-weight-bold text-primary">Customization</h6>
                            </a>
                            <div class="collapse show" id="collapseCardSix">
                                <div class="card-body">
                            <?php include("api/cardSix.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow mb-2">
                            <a href="#collapseCardSeven" class="card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                                <h6 class="m-0 font-weight-bold text-primary">Price construction</h6>
                            </a>
                            <div class="collapse show" id="collapseCardSeven">
                                <div class="card-body">
                            <?php include("api/cardFive.php");
                            mysqli_close( $conn );
                            endif;
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto"><span>Crafted by Slishy :)<br>Prices are provided by the <a href="https://www.albion-online-data.com/" title="Albion Data Project">Albion Data Project</a></span></div>
            </div>
        </footer>

    </div>
    <a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/priceUpdate.js"></script>
    <script src="js/clipboard.min.js"></script>
    <script src="js/custom.js"></script>
    
</body>
</html>
