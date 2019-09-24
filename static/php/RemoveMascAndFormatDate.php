<?php
function removeMascAndFormatDate($datewhitMasc)
{
    $day = substr($datewhitMasc, -10, 2);
    $mouth = substr($datewhitMasc, -7, 2);
    $year = substr($datewhitMasc, -4, 4);

    return $year.'-'.$mouth.'-'.$day;
}

function formatDateApresentation($formatDate)
{
  $day = substr($formatDate, 8, 2);
  $mouth = substr($formatDate, 5, 2);
  $year = substr($formatDate, 0, 4);

  return $day.'/'.$mouth.'/'.$year;
}

?>
