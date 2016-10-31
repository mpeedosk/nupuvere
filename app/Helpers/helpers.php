<?php


function shade1($hex){
    return different_shade($hex, -15);
}
function shade2($hex){
    return different_shade($hex, 0);
}
function shade3($hex){
    return different_shade($hex, 15);
}
function shade4($hex){
    return different_shade($hex, 30);
}

function different_shade($hex, $percentageChange)
{
    $rgb = array(
        hexdec(substr($hex, 1, 2)),
        hexdec(substr($hex, 3, 2)),
        hexdec(substr($hex, 5, 2))
    );

    $newShade = Array(
        255 - (255 - $rgb[0]) + $percentageChange,
        255 - (255 - $rgb[1]) + $percentageChange,
        255 - (255 - $rgb[2]) + $percentageChange
    );

    for ($i= 0; $i < 3; $i++){
        if ($newShade[$i] > 255)
            $newShade[$i] = 255;
        if ($newShade[$i] < 0)
            $newShade[$i] = 0;
    }

    return '#' . sprintf('%02x', $newShade[0]) . sprintf('%02x', $newShade[1]) . sprintf('%02x', $newShade[2]);
}

