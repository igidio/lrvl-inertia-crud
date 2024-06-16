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