<?php
include_once('config.php');
include_once('functions.php');
include_once('find_token.php');

if(!isset($_GET['type'])){
    echo ajax_echo(
        "Ошибка!", 
        "Нет GET параметра type",
        true,
        "ERROR",
        null
    );
    exit();
}


if(preg_match_all("/^register_user$/ui", $_GET['type'])){

        if(!isset($_GET['login'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр login!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['password'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр password!",
                "ERROR",
                null
            );
            exit;
        }
        

        $query = "INSERT INTO `users`(`login`, `password`) VALUES ('".$_GET['login']."','".$_GET['password']."')";
        
        $res_query = mysqli_query($connection, $query);
        
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                null
            );
            exit;
        }
        
        echo ajax_echo(
            "Успех!",
            "Новый пользователь был добавлен в базу данных!",
            false,
            "SUCCESS"
        );
        exit;
}

else if(preg_match_all("/^show_users$/ui", $_GET['type'])){
        $query = "SELECT `id`, `login` FROM `users`";
        $res_query = mysqli_query($connection,$query);

        if(!$res_query){
                echo ajax_echo(
                "Ошибка!", 
                "Ошибка в запросе!",
                true,
                "ERROR",
                null
                );
                exit();
        }

        $arr_res = array();
        $rows = mysqli_num_rows($res_query);

        for ($i=0; $i < $rows; $i++){
                $row = mysqli_fetch_assoc($res_query);
                array_push($arr_res, $row);
        }
        echo ajax_echo(
                "Успех!", 
                "Список пользователей!",
                false,
                "SUCCESS",
                $arr_res
        );
        exit();
}

else if(preg_match_all("/^buy_ticket$/ui", $_GET['type'])){

        if(!isset($_GET['user_id'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр user_id!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['route_id'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр route_id!",
                "ERROR",
                null
            );
            exit;
        }
        
        if(!isset($_GET['kassa_id'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр kassa_id!",
                "ERROR",
                null
            );
            exit;
        }
        $query = "INSERT INTO `Sold tickets`(`user_id`, `route_id`, `kassa_id`) VALUES ('".$_GET['user_id']."',".$_GET['route_id'].", ".$_GET['kassa_id'].")";
        
        $res_query = mysqli_query($connection, $query);
        
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                null
            );
            exit;
        }
        
        echo ajax_echo(
            "Успех!",
            "Билет успешно продан!",
            false,
            "SUCCESS"
        );
        exit;
    }

else if(preg_match_all("/^return_ticket$/ui", $_GET['type'])){

        if(!isset($_GET['id'])){
        echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр id!",
                "ERROR",
                null
        );
        exit;
        }
        
        $query = "DELETE FROM `Sold tickets` WHERE `id` = ".$_GET['id']."";
        
        $res_query = mysqli_query($connection, $query);
        
        if(!$res_query){
        echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                null
        );
        exit;
        }
        
        echo ajax_echo(
        "Успех!",
        "Билет был аннулирован!",
        false,
        "SUCCESS"
        );
        exit;
}

else if(preg_match_all("/^show_tickets$/ui", $_GET['type'])){

        if(!isset($_GET['fromcity'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр fromcity!",
            "ERROR",
            null
        );
        exit;
        }

        if(!isset($_GET['tocity'])){
                echo ajax_echo(
                    "Ошибка!",
                    "Вы не указали GET параметр tocity!",
                    "ERROR",
                    null
                );
                exit;
                }
        $query = "SELECT `fromcity`, `fromdate`, `tocity`, `todate`FROM `Routes` WHERE `fromcity` = ".$_GET['fromcity']." AND `tocity` = ".$_GET['tocity']."";
        $res_query = mysqli_query($connection,$query);
    
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!", 
                "Ошибка в запросе!",
                true,
                "ERROR",
                null
            );
            exit();
        }
    
        $arr_res = array();
        $rows = mysqli_num_rows($res_query);
    
        for ($i=0; $i < $rows; $i++){
            $row = mysqli_fetch_assoc($res_query);
            array_push($arr_res, $row);
        }
        echo ajax_echo(
            "Успех!", 
            "Список билетов!",
            false,
            "SUCCESS",
            $arr_res
        );
        exit();
}
    
else if(preg_match_all("/^edit_user_info$/ui", $_GET['type'])){

        if(!isset($_GET['id'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр id!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['surname'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр surname!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['name'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр name!",
                "ERROR",
                null
            );
            exit;
        }
    
        
        $query = "UPDATE `users` SET `name`='".$_GET['name']."',`surname`='".$_GET['surname']."' WHERE `id` = ".$_GET['id'];
        
        $res_query = mysqli_query($connection, $query);
        
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                null
            );
            exit;
        }
        
        echo ajax_echo(
            "Успех!",
            "Пользователь был изменен в базе данных!",
            false,
            "SUCCESS"
        );
        exit;
}
    
else if(preg_match_all("/^show_tickets_by_user$/ui", $_GET['type'])){

        if(!isset($_GET['user_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр user_id!",
            "ERROR",
            null
        );
        exit;
        }
        $query = "SELECT `fromcity`, `fromdate`,`tocity`, `todate`  FROM `routes` WHERE `id` IN (SELECT `route_id` FROM `sold tickets` WHERE `user_id` = ".$_GET['user_id'].")";
        $res_query = mysqli_query($connection,$query);
    
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!", 
                "Ошибка в запросе!",
                true,
                "ERROR",
                null
            );
            exit();
        }
    
        $arr_res = array();
        $rows = mysqli_num_rows($res_query);
    
        for ($i=0; $i < $rows; $i++){
            $row = mysqli_fetch_assoc($res_query);
            array_push($arr_res, $row);
        }
        echo ajax_echo(
            "Успех!", 
            "Пользователь приобрел следующие билеты!",
            false,
            "SUCCESS",
            $arr_res
        );
        exit();
}

else if(preg_match_all("/^add_kassa$/ui", $_GET['type'])){

        if(!isset($_GET['title'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр title!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['email'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр email!",
                "ERROR",
                null
            );
            exit;
        }
        
        $query = "INSERT INTO `kassa`(`title`, `email`) VALUES ('".$_GET['title']."',".$_GET['email'].")";
        
        $res_query = mysqli_query($connection, $query);
        
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                null
            );
            exit;
        }
        
        echo ajax_echo(
            "Успех!",
            "Новая касса добавлена в базу данных!",
            false,
            "SUCCESS"
        );
        exit;
}

else if(preg_match_all("/^edit_kassa_info$/ui", $_GET['type'])){

        if(!isset($_GET['id'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр id!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['title'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр title!",
                "ERROR",
                null
            );
            exit;
        }
    
        if(!isset($_GET['email'])){
            echo ajax_echo(
                "Ошибка!",
                "Вы не указали GET параметр email!",
                "ERROR",
                null
            );
            exit;
        }
    
        
        $query = "UPDATE `kassa` SET `title`='".$_GET['title']."',`email`='".$_GET['email']."' WHERE `id` = ".$_GET['id'];
        
        $res_query = mysqli_query($connection, $query);
        
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                null
            );
            exit;
        }
        
        echo ajax_echo(
            "Успех!",
            "Касса была изменена в базе данных!",
            false,
            "SUCCESS"
        );
        exit;
}

else if(preg_match_all("/^show_kassa$/ui", $_GET['type'])){
        $query = "SELECT `id`, `title` , `email` FROM `kassa`";
        $res_query = mysqli_query($connection,$query);

        if(!$res_query){
                echo ajax_echo(
                "Ошибка!", 
                "Ошибка в запросе!",
                true,
                "ERROR",
                null
                );
                exit();
        }

        $arr_res = array();
        $rows = mysqli_num_rows($res_query);

        for ($i=0; $i < $rows; $i++){
                $row = mysqli_fetch_assoc($res_query);
                array_push($arr_res, $row);
        }
        echo ajax_echo(
                "Успех!", 
                "Список касс в системе!",
                false,
                "SUCCESS",
                $arr_res
        );
        exit();
}

else if(preg_match_all("/^count_sold_tickets$/ui", $_GET['type'])){

        if(!isset($_GET['kassa_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр kassa_id!",
            "ERROR",
            null
        );
        exit;
        }
        $query = "SELECT COUNT(*) FROM `sold tickets` WHERE `kassa_id` = ".$_GET['kassa_id']."";
        $res_query = mysqli_query($connection,$query);
    
        if(!$res_query){
            echo ajax_echo(
                "Ошибка!", 
                "Ошибка в запросе!",
                true,
                "ERROR",
                null
            );
            exit();
        }
        $row = $res_query->fetch_row();
        echo ajax_echo(
            "Успех!", 
            "Выбранная касса продала столько билетов!",
            false,
            "SUCCESS",
            $row[0]
        );
        exit();
}


