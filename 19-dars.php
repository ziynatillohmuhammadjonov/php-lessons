<?php
// Mavzu: isset() va empty()

// isset() - o'zgeruvchi e'lon qilinganmi yoki yo'qmi shuni bool da qaytaradi

$var = ""; // o'zgaruvchi qiymat berilsa ya'ni teng qo'yilsagina e'lon qilingan bo'ladi

if (isset($var)) {
    echo 'O\'zagruvchi e\'lon qilngan';
} else {
    echo 'O\'zagruvchi e\'lon qilnmagan';
}

echo '<hr/>';
// empty() - o'zgaruvchini qiymati yo'qligini tekshiradi. isset dan farqli ravishda o'zgaruvchini qiymati bilan qiziqadi.
if (empty($var)) {
    echo "O'zgaruvchi qiymati berilmagan";
} else {
    echo "O'zgaruvchi qiymati berilgan";
}
