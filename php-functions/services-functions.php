<?php 

function create_service_card($title, $cost, $has_points_cost, $points_cost, $points_earned, $description_id, $id) {
    switch ($description_id) {
        case 1:
            $description = "Uses massage oils to facilitate smooth, gliding strokes over the entire body for the purpose of relaxation.";
            break;
        case 2:
            $description = "Acupressure and massage to the ears, hands and feet.";
            break;
        case 3:
            $description = "Therapy specifically tailored for the expectant mother's needs. It is also called pre-natal massage.";
            break;
        case 4:
            $description = "Massage with deeper pressure using techniques such as trigger point.";
            break;
        case 5:
            $description = "Exfoliation of the entire body using a salt or sugar scrub and dry brushing. Short shower afterwards to rinse off product. Leaves your skin feeling soft, smooth, and glowing!";
            break;
        case 6:
            $description = "Full body exfoliation with salt/sugar scrub and dry brushing. After exfoliating, a quick rinse off and a relaxing massage which will hydrate the skin and leave you feeling amazing!";
            break;
    }

    if ($has_points_cost) {
        $points_cost = '<p class="points-cost">or ' . $points_cost . ' points</p>';
    } else {
        $points_cost = '';
    }

    return '
    <div class="service-card img-bg-white">
        <div>
            <div class="title-cost">
                <p class="title bold">' . $title . '</p>
                <div class="cost-div semi-bold">
                    <p class="cost">$' . $cost . '.00</p>
                    ' . $points_cost . '
                </div>
            </div>
            <div class="points-div pad-top">
                <p class="semi-bold">Earned Points: ' . $points_earned . '</p>
            </div>
            <div class="description-div pad-top">
                <p class="semi-bold">' . $description . '</p>
            </div>
        </div>
        <div class="book-btn-div pad-top">
            <a href="book.php?sid=' . $id . '" class="btn-link bold">Book Now</a>
        </div>
    </div>';
}

?>