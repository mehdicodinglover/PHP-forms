<?php

    $conn = mysqli_connect('localhost','root','','test');

    if(!$conn):
        echo 'connection failed!'. mysqli_connect_error();
    else:
        $result = mysqli_query($conn,'SELECT * FROM pizzas ORDER BY created_at');
        print_r($result);
        echo '<br/>';
        $pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);

        mysqli_free_result($result);
        mysqli_close($conn);

        foreach ($pizzas as $pizza) {
            echo 'the pizza properties are as below : '.'</br>';
            print_r($pizza);
            echo '<br/>';
        }

        foreach ($pizzas as $pizza) {
            echo 'pizza number '.$pizza['id'].' ingredients are : '.'</br>';
            $ingredients = explode(',', $pizza['ingredients']);
            foreach ($ingredients as $ingredient )
            echo $ingredient.'<br/>';
        }
    endif;
?>




