<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des chaussures</title>
</head>
<body>
    <h1>Liste des chaussures</h1>
    <ul>
    @php
        $shoes = ["Tappette", "Sandale"];
        foreach ($shoes as $value) {
            echo "<li>".$value."</li>";
        }
    @endphp
    </ul>
</body>
</html>
