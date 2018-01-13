<?php
/*
| -------------------------------------------------------------------
| EMAIL
| -------------------------------------------------------------------
|
| Developing and testing Email class
|
| -------------------------------------------------------------------
*/
use phplibrary\Email as email;
use phplibrary\Format as format;

$email      = 'Zlatan.Stajic@guerrillamail.com';
$mailto     = email::mailto($email);
$validated  = empty(email::validate($email)) ? 'Invalid' : 'Valid';

format::pre($mailto, 1);
format::pre($validated, 1);
