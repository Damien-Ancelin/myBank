<?php

function parseDate(?string $dateStr, ?bool $getTime = null) : string {
  if(empty($dateStr)) return "";

  $parseDate = new DateTime($dateStr);

  if($getTime) {
    return $parseDate->format('d F Y à H:i');
  } else {
    return $parseDate->format('d F Y');
  }
}

?>