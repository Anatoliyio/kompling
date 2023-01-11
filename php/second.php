<?php require_once 'header.php';?>
<?php
require_once 'header.php';
require __DIR__.'/vendor/autoload.php'; // include Composer's autoloader
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->lingvist->tomita;

$result = $collection->find(); //fix /home/alex/nlp/sema/php/vendor/mongodb/mongodb/src/Operation/Find.php:317

$start_index = 0;
$step = 30;

// get count of data in data base
$count_of_record = 0;
foreach($result as $item)
    $count_of_record++;

$result = $collection->find(); //fix /home/alex/nlp/sema/php/vendor/mongodb/mongodb/src/Operation/Find.php:317


    
if (!empty($_GET))
{
    $start_index = $_GET['count'];

    if ($start_index < 0)
        $start_index = 0;
    elseif (($start_index + $step) > $count_of_record) 
        $start_index = $count_of_record - $step;


    // Поиск записи по ID
    if (isset($_GET['id']) ? $_GET['id'] : '' > 0)
    {
        
        $result = $collection->find(); //fix /home/alex/nlp/sema/php/vendor/mongodb/mongodb/src/Operation/Find.php:317
        
        $step = 0;
        $i = 0;
        foreach($result as $item)
        {
            if ($item['_id'] == $_GET['id'])
            {
                $start_index = $i;
                $step = 1;
            }
            $i++;
        }

        $result = $collection->find(); //fix /home/alex/nlp/sema/php/vendor/mongodb/mongodb/src/Operation/Find.php:317
        
    }
}

?>

<div class="container">
    <p class="py-2"> <a href="index.php">Все новости</a></p>
    <!--<p class="py-2"> <a href="/php/start_python.php?scrypt=2">Запустить обработку новостей</a></p>-->
</div>

<!-- db data 2 -->
<div class="container">

    <p class="py-2"> Всего записей: <?php print_r($count_of_record) ?></p>


    <div class="container text-center mt-3">
    <?php if(count($result) > 0):?>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Номер</th>
                    <th scope="col">ID</th>
                    <th scope="col">Текст</th>
                    <th scope="col">Тональность</th>
                </tr>
                </thead>

                <tbody>
                <?php $cnt = 0; foreach($result as $item):?>
                    <tr>
                        <?php if ($cnt >= $start_index && $cnt < $start_index + $step):?>
                            <td><?php print_r($cnt) ?></td>
                            <td>
                            <form action="index.php" method="GET">
                                <div class="col-md-12 text-center ">
                                    <div class="form-group">
                                        <input type="text" hidden name="id" id="id" value="<?php print_r((string)$item['_id']) ?>"
                                        class="form-control">
                                        <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm login-btn">Новость</button>
                                    </div>
                                </div>
                                </form>
                            </td>
                            <td><?php print_r($item['text']) ?></td>
                            <td><?php print_r($item['tonality']) ?></td>
                        <?php endif;?> 
                <?php $cnt++; endforeach;?>
                </tbody>
            </table>
    <?php endif;?>
    </div>

</div>

<form action="second.php" method="GET">

    <div class="col-md-12 text-center ">
        <div class="form-group">
            <input type="text" hidden name="count" id="count" value="<?php print_r($start_index - $step) ?>"
             class="form-control">
            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm login-btn">Назад</button>
        </div>
    </div>
</form>

<form action="second.php" method="GET">

    <div class="col-md-12 text-center ">
        <div class="form-group">
            <input type="text" hidden name="count" id="count" value="<?php print_r($start_index + $step) ?>" 
            class="form-control">
            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm login-btn">Вперед</button>
        </div>
    </div>
</form>

</body>
</html>