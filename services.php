<?php 
$page = "services";

// Set page title and include head
$page_title = "Lunar Energy : Services";
include("includes/head.php");
include("php-functions/services-functions.php");

?>

<!-- Start HTML Content -->
    <div id="body">
    <main id="services" class="main img-bg-black">
        <div class="heading">
            <h1 class="txt-green">SERVICES</h1>
        </div>
        <section id="servicesDisplay">
            <div class="dropdown-head" id="massagesDD">
                <h2>Massage</h2>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <div id="massages">
                <div class="card-row">
                    <?php
                    echo create_service_card("Swedish Massage - 30 Minutes", 30, true, 350, 5, 1, 1);
                    echo create_service_card("Swedish Massage - 60 Minutes", 60, true, 450, 10, 1, 2);
                    ?>
                </div>
                <div class="card-row">
                    <?php 
                    echo create_service_card("Swedish Massage - 90 Minutes", 90, true, 550, 15, 1, 3); 
                    echo create_service_card("Reflexology Massage - 25 Minutes", 30, false, 0, 5, 2, 4);
                    ?>
                </div>
                <div class="card-row">
                    <?php
                    echo create_service_card("Pregnancy Massage - 60 Minutes", 60, false, 0, 10, 3, 5);
                    echo create_service_card("Pregnancy Massage - 90 Minutes", 90, false, 0, 15, 3, 6);
                    ?>
                </div>
                <div class="card-row">
                    <?php
                    echo create_service_card("Deep Tissue Massage - 60 Minutes", 70, true, 550, 15, 4, 7);
                    echo create_service_card("Deep Tissue Massage - 90 Minutes", 100, true, 650, 20, 4, 8);
                    ?>
                </div>
            </div>
            <div class="dropdown-head" id="skinDD">
                <h2>Skin Treatments</h2>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <div id="skinTreatments">
                <div class="card-row">
                    <?php 
                    echo create_service_card("Full Body Scrub", 60, false, 0, 10, 5, 9);
                    ?>
                    <div class="filler-service-card service-card"></div>
                </div>
            </div>
            <div class="dropdown-head" id="bundlesDD">
                <h2>Service Bundles</h2>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <div id="bundles">
                <div class="card-row">
                    <?php 
                    echo create_service_card("Body Scrub with 60 Minute Massage", 110, false, 0, 20, 6, 10);
                    echo create_service_card("Body Scrub with 90 Minute Massage", 140, false, 0, 25, 6, 11);
                    ?>
                </div>
            </div> 
        </section>
        <?php include("includes/footer.html"); ?>
    </main>
    </div>
    <script src="services.js"></script>
</body>