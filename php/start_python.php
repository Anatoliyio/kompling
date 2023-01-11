<?php require_once 'header.php';?>

<div class="container">
    <p class="py-2"> <a href="/index.php">Новости</a></p>
    <p class="py-2"> <a href="/second.php">Анализ личностей и достопримечательностей</a></p>
</div>

<?php
if (!empty($_GET))
{
    $scrypt_ind = $_GET['scrypt'];

    if ($scrypt_ind == 1) //парсинг
    {
        
    }
    elseif ($scrypt_ind == 2) //обработка данных
    {

    }
    elseif ($scrypt_ind == 3) //анализ тональности
    {
        
    }
}
?>