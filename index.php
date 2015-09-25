<?php
// front controller
spl_autoload_register( 'autoload' );

function autoload( $files ) {

    require_once '/Classes/'.$files.'.php';
}
require_once 'config.php';

$quiz=new Quiz();
$test=$quiz->getQuiz_test();
foreach ($test as $variant) {
    $question=$variant->get_Variant();
    $answer=$variant->get_Answer();
    echo '<p>',json_encode($question),'</p>';
    echo "<b>$answer</b>";
}

?>