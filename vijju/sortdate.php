<?php
$data = array(
    array(
        "title" => "Another title",
        "date"  => "2015-08-25"
    ),
    array(
        "title" => "My title",
        "date"  => "2015-08-24"
    ),
        array(
        "title" => "My title",
        "date"  => "2015-08-27"
    )
);

function sortFunction( $a, $b ) {
    return strtotime($a["date"]) - strtotime($b["date"]);
}
usort($data, "sortFunction");
echo "<pre>";
var_dump($data);

?>