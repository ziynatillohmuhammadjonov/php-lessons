<?php
// Assotsiativ massivlar

$students = array('ism' => 'Ziynatillo', 'yoshi' => 15, 'Oilaviy holati' => false); //Assotsiativ massivlar;
$students['Malumoti'] = 'Oliy'; //Oddiy indekslangan massivlarda yangi elemnt qo'shilsa oxiriga boradi agar elemnt indeksi ko'rsatib qo'shilsa shu indekga yoziladi yoki yangilanadi
print_r($students);
echo $students['ism'];
