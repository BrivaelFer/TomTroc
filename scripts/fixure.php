<?php
require_once('../services/Tools.php');
function generateLoremIpsum(int $size){
    $words = ['lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit', 'praesent', 'interdum', 'dictum', 'mi', 'non', 'egestas', 'nulla', 'in', 'lacus', 'sed', 'sapien', 'placerat', 'malesuada', 'at', 'erat', 'etiam', 'id', 'velit', 'finibus', 'viverra', 'maecenas', 'mattis', 'volutpat', 'justo', 'vitae', 'vestibulum', 'metus', 'lobortis', 'mauris', 'luctus', 'leo', 'feugiat', 'nibh', 'tincidunt', 'a', 'integer', 'facilisis', 'lacinia', 'ligula', 'ac', 'suspendisse', 'eleifend', 'nunc', 'nec', 'pulvinar', 'quisque', 'ut', 'semper', 'auctor', 'tortor', 'mollis', 'est', 'tempor', 'scelerisque', 'venenatis', 'quis', 'ultrices', 'tellus', 'nisi', 'phasellus', 'aliquam', 'molestie', 'purus', 'convallis', 'cursus', 'ex', 'massa', 'fusce', 'felis', 'fringilla', 'faucibus', 'varius', 'ante', 'primis', 'orci', 'et', 'posuere', 'cubilia', 'curae', 'proin', 'ultricies', 'hendrerit', 'ornare', 'augue', 'pharetra', 'dapibus', 'nullam', 'sollicitudin', 'euismod', 'eget', 'pretium', 'vulputate', 'urna', 'arcu', 'porttitor', 'quam', 'condimentum', 'consequat', 'tempus', 'hac', 'habitasse', 'platea', 'dictumst', 'sagittis', 'gravida', 'eu', 'commodo', 'dui', 'lectus', 'vivamus', 'libero', 'vel', 'maximus', 'pellentesque', 'efficitur', 'class', 'aptent', 'taciti', 'sociosqu', 'ad', 'litora', 'torquent', 'per', 'conubia', 'nostra', 'inceptos', 'himenaeos', 'fermentum', 'turpis', 'donec', 'magna', 'porta', 'enim', 'curabitur', 'odio', 'rhoncus', 'blandit', 'potenti', 'sodales', 'accumsan', 'congue', 'neque', 'duis', 'bibendum', 'laoreet', 'elementum', 'suscipit', 'diam', 'vehicula', 'eros', 'nam', 'imperdiet', 'sem', 'ullamcorper', 'dignissim', 'risus', 'aliquet', 'habitant', 'morbi', 'tristique', 'senectus', 'netus', 'fames', 'nisl', 'iaculis', 'cras', 'aenean'];
    $lorem = '' ;
    while ($size > 0){
        $randomWord = array_rand($words) ;
        $lorem .= ($size > 1)? $words[$randomWord].' ': $words[$randomWord] ;
        $size = $size - strlen($words[$randomWord]) ;
    }
    return ucfirst($lorem) ;
}
function connect(): PDO
{
    try{
        $db = new PDO('mysql:host=localhost;dbname=tomtroc_p6;charset=utf8','root','',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(\Exception $e){
        die('Erreur: '.$e->getMessage());
    }
    return $db;
}
function sharPw(string $pw): string
{
    return Tools::hash($pw);
}
$conn = connect();
$listTables = [
    "message",
    "book",
    "usr"
];
foreach($listTables as $table){
    $conn->prepare("
    SET FOREIGN_KEY_CHECKS = 0;
    TRUNCATE TABLE $table;
    SET FOREIGN_KEY_CHECKS = 1;
    ")->execute();
}
for($i = 0; $i < 7; $i++)
{
    $name = generateLoremIpsum(1) . $i;
    $email = strtolower($name . "@" . generateLoremIpsum(1) . ".com");
    $pw = sharPw("pass" . $i);
    $img = null;
    $q = $conn->prepare("INSERT INTO usr (email, `password`, `name`) VALUE ('$email','$pw','$name')");
    $q->execute();
}
for($i = 0; $i < 20; $i++)
{
    $u1 = random_int(1,7);
    $u2 = random_int(1,7);
    while($u1 == $u2) $u2 = random_int(1,7);
    $message = generateLoremIpsum(random_int(5,200));
    $conn->prepare("INSERT INTO `message` (writer_id, reader_id, content) VALUE ($u1 , $u2 ,'$message')")->execute(); 
}
for($i = 0; $i < 30; $i++)
{
    $u = random_int(1,7);
    $t = generateLoremIpsum(random_int(1,20));
    $summ = generateLoremIpsum(random_int(100, 600));
    $dis = random_int(0,1);
    $author = generateLoremIpsum(random_int(1,20));
    $conn->prepare("INSERT INTO book (usr_id,title,summary,dispo,author) VALUE ($u,'$t','$summ',$dis,'$author')")->execute();
}
