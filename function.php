<?php

$var = 123;

function test() {
    global $var;

    echo $var * 2;
}

test();