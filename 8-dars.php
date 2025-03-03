<?php
// Mavzu: PHP da increment va dicrement amallar

//Increment ikki xil bo'ladi - post va pre increment
$son =  45;

echo ++$son; //pre increment qiymatni ekranga chiqarishdan avval yangilaydi
echo $son++; // post increment qiymatni ekranga chiqarib bo'lgandan keyin oshiradi

// Dexrement o'zgaruvchini qiymatini birga kamaytirib beradi
// U ham ikki xil: post va pre decrementlarga bo'linadi.
$son--;
++$son;
