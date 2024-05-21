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

        <table class="table table-primary table-striped-columns">
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
                <?php foreach ($hotels as $index => $cur_elem) { ?>
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
    <!-- ★☆ -->

</body>

</html>