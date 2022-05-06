<?php

/**
 * Formats the given date string.
 *
 * @param string $date
 * @param string $date_format
 * @return void
 */
function changeDateFormate($date, $date_format='Y-m-d H:i:s')
{
    $createdAt = \Carbon\Carbon::parse($date);
    return $createdAt->format($date_format);
}

/**
 * Formats the given date string according to the timezone.
 *
 * @param string $date
 * @param string $date_format
 * @param string $timeZone
 * @return void
 */
function changeDateFormateTimeZone($date, $date_format='Y-m-d H:i:s', $timeZone="UTC")
{
    $date = \Carbon\Carbon::createFromFormat($date_format, $date);
    return $date->setTimezone($timeZone);
}

/**
 * prints and die the array with a pre function.
 *
 * @param array $array
 * @return void
 */
function prd($array)
{
    echo "<br/>";
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    echo "<br/>";
    die;
}
