<?php
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];
// var_dump($hotels);

// foreach ($hotels as $cur_elem) {
//     foreach ($cur_elem as $key => $content) {
//         echo "<p>{$key}: {$content}";
//     }
// }

// var_dump($_GET);
$parking_filter = null;
$vote_filter = null;

// var_dump($parking_filter);
// var_dump($_GET["parking"]);

if (isset($_GET["parking"])) {
    $parking_filter = $_GET["parking"];
    $parking_filter = ($parking_filter === "true") ? true : false;
}

// var_dump($parking_filter);


if (isset($_GET["vote"])) {
    $vote_filter = $_GET["vote"];
}
// var_dump($parking_filter);

// inizializzo l'array filtrato
$hotels_filtered = [];

// filtro i risultati in base ai parametri impostati
foreach ($hotels as $cur_hotel) {
    // se la variabile $parking_filter è uguale alla chiave parking (true o false) OPPURE se la variabile è null 
    if (($cur_hotel["parking"] === $parking_filter || $parking_filter === null)) {

        // se la variabile $vote_filter è maggiore/uguale alla chiave vote (number) OPPURE se la variabile è null 
        if ($cur_hotel["vote"] >= $vote_filter || $vote_filter === null) {
            $hotels_filtered[] = $cur_hotel;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <h1 class="text-center mt-3 mb-5 fw-bold">Elenco Hotels</h1>

    <div class="container">

        <div class="py-4 row justify-content-center">

            <form action="index.php" method="GET">
                <div class="col">
                    <span class="pe-3 fw-bold">Filtra per parcheggio:</span>

                    <div class="d-inline-block form-check me-3">
                        <input class="form-check-input" type="radio" value="true" id="park_yes" name="parking">
                        <label class="form-check-label" for="park_yes">
                            SI
                        </label>
                    </div>
                    <div class="d-inline-block form-check">
                        <input class="form-check-input" type="radio" value="false" id="park_no" name="parking">
                        <label class="form-check-label" for="park_no">
                            NO
                        </label>
                    </div>

                    <span class="ps-5 pe-3 fw-bold">Filtra per voto:</span>

                    <div class="d-inline-block form-check pe-4">
                        <input class="form-check-input" type="radio" value="1" id="vote_1" name="vote">
                        <label class="form-check-label" for="vote_1">
                            ★
                        </label>
                    </div>
                    <div class="d-inline-block form-check pe-4">
                        <input class="form-check-input" type="radio" value="2" id="vote_2" name="vote">
                        <label class="form-check-label" for="vote_2">
                            ★★
                        </label>
                    </div>

                    <div class="d-inline-block form-check pe-4">
                        <input class="form-check-input" type="radio" value="3" id="vote_3" name="vote">
                        <label class="form-check-label" for="vote_3">
                            ★★★
                        </label>
                    </div>

                    <div class="d-inline-block form-check pe-4">
                        <input class="form-check-input" type="radio" value="4" id="vote_4" name="vote">
                        <label class="form-check-label" for="vote_4">
                            ★★★★
                        </label>
                    </div>

                    <div class="d-inline-block form-check pe-4">
                        <input class="form-check-input" type="radio" value="5" id="vote_5" name="vote">
                        <label class="form-check-label" for="vote_5">
                            ★★★★★
                        </label>
                    </div>

                    <button class="d-inline-block btn btn-primary badge rounded-pill ms-3" type="submit">Filtra</button>
                </div>
            </form>


            <table class="table table-primary table-striped-columns mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Voto</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ciclo tutti gli elementi dell'array e prelevo anche l'index per usarlo come identificativo della row della table -->
                    <?php foreach ($hotels_filtered as $index => $cur_elem) { ?>
                        <?php if ($cur_elem["parking"] === true) ?>
                        <?php $index++ ?>
                        <tr>
                            <th scope="row"><?php echo $index ?></th>

                            <!-- determino se è presente il parcheggio e assegno l'icona (emoji) alla variabile -->
                            <?php
                            $parking;
                            if ($cur_elem["parking"]) {
                                $parking = "✅";
                            } else {
                                $parking = "❌";
                            }
                            ?>

                            <!-- determino il punteggio per stampare l'icona delle stelle al posto del numero -->
                            <?php
                            $vote_avg = "";
                            for ($i = 0; $i < $cur_elem["vote"]; $i++) {
                                $vote_avg .= "★";
                            }
                            for ($y = 0; $y < (5 - $cur_elem["vote"]); $y++) {
                                $vote_avg .= "☆";
                            }
                            ?>

                            <?php echo "<td>{$cur_elem["name"]}</td>" ?>
                            <?php echo "<td>{$cur_elem["description"]}</td>" ?>
                            <?php echo "<td>$parking</td>" ?>
                            <?php echo "<td>$vote_avg</td>" ?>
                            <?php echo "<td>{$cur_elem["distance_to_center"]} km</td>" ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
</body>

</html>