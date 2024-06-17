<?php
use Carbon\Carbon;

function getTraditionalDate($fecha)
{
    Carbon::setLocale('es');
    return Carbon::parse($fecha)->translatedFormat('j \\d\\e F \\d\\e Y');
}

function getFullName($nombres, $apellidos)
{
    return $nombres . ' ' . $apellidos;
}

function transformToValidDate($isoDateTime)
{
    $dateTime = new DateTime($isoDateTime);
    return $dateTime->format('Y-m-d H:i:s');
}

function capitalizeWords($string)
{
    return ucwords(strtolower($string));
}

function sumHours($time, $minutes)
{
    $hour = new DateTime($time);
    $hour->modify("+{$minutes} minutes");
    return $hour->format('H:i:s');
}

function cutHour($originalDate)
{
    $date = new DateTime($originalDate);
    return $date->format('Y-m-d H:i');
}