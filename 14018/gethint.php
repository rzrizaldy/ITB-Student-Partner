<?php
    include("config.php");

    $sql = "SELECT nama, nim FROM member";
    $result = mysqli_query($db,$sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $a[] = $row["nama"].  " - " . $row["nim"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    // get the q parameter from URL
    $q = $_REQUEST["q"];

    $hint = "";

    // lookup all hints from array if $q is different from "" 
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($a as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = $name;
                } else {
                    $hint .= "$name";
                }
            }
        }
    }

    echo $hint === "" ? "Nama Mahasiswa Tidak Ditemukan" : $hint;
?>