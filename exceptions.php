<?php

class MyException extends Exception {
    //...
}


try {
    //...
    throw new MyException('Exception');
} catch (\MyException $exception) {
    echo $exception->getMessage();
}