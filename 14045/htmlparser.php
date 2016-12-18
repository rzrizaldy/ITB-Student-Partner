<?php

    include 'simple_html_dom.php';

    function parsehtml($obj) {
        $html = str_get_html($obj);
        echo $html;

        //$html = file_get_html('C:\xampp\htdocs\progif\debug\six.html');

        $classes = $html->find("table tr td.kolom");

        $i = 4;
        $r = 1;

        while ($i <= 50){
            $results[$r] = $classes[$i]->plaintext;
            $r = $r + 1;
            $i = $i + 1;
            $results[$r] = $classes[$i]->plaintext;

            $words = explode(" ", $results[$r]);
            $results[$r - 2] = "";

            foreach ($words as $w) {
                $results[$r - 2] .= $w[0];
            }

            $r = $r + 2;
            $i = $i + 3;
        }

        return $results;
    }

    /*$classes = parsehtml();

    $i = 0;
    while ($i <= 22){
        echo "<div class='classes col-3'>";
            echo "<td>" . $classes[$i] . "</td>";
            $i = $i + 1;
            echo "<td>" . $classes[$i] . "</td>";
            $i = $i + 1;
            echo "<td>" . $classes[$i] . "</td>";
            $i = $i + 1;
        echo "</div>";
}*/
?>
