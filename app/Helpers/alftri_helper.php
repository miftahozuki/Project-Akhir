<?php

function colorRole($string)
{
    if ($string == 'admin') {
        $make_color = 'primary';
    } else if ($string ==  'petugas') {
        $make_color = 'warning';
    } else {
        $make_color = 'danger';
    }

    return $make_color;
}

function getEnum($table, $column)
{
    $type = DB::select(DB::raw('SHOW COLUMNS FROM ' . $table . ' WHERE Field = "' . $column . '"'))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enums = [];
    foreach (explode(',', $matches[1]) as $enum) {
        $enums[] = trim($enum, "'");
    }
    return $enums;
}

function idr($val)
{
    $idr = "Rp " . number_format($val, 0, ',', '.');
    return $idr;
}
