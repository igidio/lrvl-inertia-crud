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