<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function dateConvertFormtoDB($date)
{
    if (!empty($date)) {
        return Carbon::parse($date)->format('Y-m-d');
    }
}

function dateConvertDBtoForm($date)
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }
}

function dateTimeConvertDBtoForm($date)
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}

function dateConvertDBtoFormCsv($date)
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}


function dateTimeConvertDBtoFormCsv($date)
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}


if (!function_exists('dbDate')) {
    function dbDate($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}


if (!function_exists('dbDateTime')) {
    function dbDateTime($date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('removeArrayValues')) {
    function removeArrayValues($originalArray, $removeValueArray)
    {
        return array_diff($originalArray, $removeValueArray);
    }
}

if (!function_exists('calculateAchievements')) {
    function calculateAchievements($target, $sales)
    {
        if ($target <= 0) {
            return $achievement = 0;
        }
        $achievement = ($sales / $target) * 100;

        return number_format($achievement, 2, '.', '');
    }
}


if (!function_exists('csvExport')) {
    function csvExport($data, $filename)
    {
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        $fp = fopen('php://output', 'w');

        function prettyString($string)
        {
            $val = str_replace("_", " ", $string);
            return ucwords($val);
        }

        $header = array_keys($data[0]);
        $header = array_map('prettyString', $header);

        fputcsv($fp, $header);
        foreach ($data as $row) {
            //$fp = fopen('php://output', 'a');
            fputcsv($fp, $row);
        }
        fclose($fp);
        exit;
    }
}

function msisdn($mobile_no, $with880 = true)
{
    if ($with880) {
        return '880' . substr($mobile_no, -10);
    } else {
        return substr($mobile_no, -11);
    }
}

if (!function_exists('calculateAchievements')) {
    function calculateAchievements($target, $sales)
    {
        if ($target <= 0) {
            return 0;
        }
        $achievement = ($sales / $target) * 100;

        return number_format($achievement, 2, '.', '');
    }
}

//Random password generate
function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }

    return implode($pass); //turn the array into a string
}
