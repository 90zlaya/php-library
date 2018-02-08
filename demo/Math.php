<?php
/*
| -------------------------------------------------------------------
| MATH
| -------------------------------------------------------------------
|
| Developing and testing MATH class
|
| -------------------------------------------------------------------
*/
use phplibrary\Math as math;
use phplibrary\Format as format;

$percentage = math::percentage(30, 50);
format::pre($percentage);

for ($i=0; $i<10; $i++)
{
    echo math::iterate();
    echo '. ';
    echo math::even_or_odd('first', 'second');
    echo '<br/>';
}

echo 'Number of items: ' . math::$iterator . '<br/>';
echo 'After reset: ' . math::iterate(TRUE) . '<br/>';
