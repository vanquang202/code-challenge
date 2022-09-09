#!/bin/bash

compiler=$1
file=$2
output1=$3
output2=$4
c++ main.cpp -o HAHA
if [ -z "$output2" ]
then

    START=$(date +%s.%4N)
    if $compiler $file > $output1
    then
    END=$(date +%s.%4N)
    runtime=$(echo "$END - $START" | bc)
    echo $runtime
    else
    echo false
    fi

else

    START=$(date +%s.%4N)
    if $compiler $file ./b.out
    then
    END=$(date +%s.%4N)
    runtime=$(echo "$END - $START" | bc)
    echo $runtime
    chmod 777 $output1
    $output1 > $output2
    else
    echo false
    fi


fi

