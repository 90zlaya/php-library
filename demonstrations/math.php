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
include_once '../autoload.php';

$percentage = phplibrary\Math::percentage(30, 50);
phplibrary\Format::pre($percentage);

for ($i=0; $i<10; $i++)
{
    echo phplibrary\Math::iterate() . '. ' . phplibrary\Math::even_or_odd('first', 'second') . '<br/>';
}
