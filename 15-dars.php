<?php
// Mavzu: Funksiyalar va funksiyada argument tushunchasi

function myFirstFunction(...$numbers) // bunda argumentlar numbers massivida saqlanadni
{
    print_r($numbers);
}
myFirstFunction(1, 2, 3, 4, 5, 6, 7, 8, 9);
