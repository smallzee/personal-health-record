<?php

define( 'TIMEBEFORE_NOW','now' );
define( 'TIMEBEFORE_MINUTE','{num} minute ago' );
define( 'TIMEBEFORE_MINUTES','{num} minutes ago' );
define( 'TIMEBEFORE_HOUR', '{num} hour ago' );
define( 'TIMEBEFORE_HOURS', '{num} hours ago' );
define( 'TIMEBEFORE_YESTERDAY', 'yesterday' );
define( 'TIMEBEFORE_FORMAT',  '%e %b' );
define( 'TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y' );

define( 'TIMEBEFORE_DAYS',    '{num} days ago' );
define( 'TIMEBEFORE_WEEK',    '{num} week ago' );
define( 'TIMEBEFORE_WEEKS',   '{num} weeks ago' );
define( 'TIMEBEFORE_MONTH',   '{num} month ago' );
define( 'TIMEBEFORE_MONTHS',  '{num} months ago' );

date_default_timezone_set("Africa/Lagos");
ini_set("memory_limit","2048M");

function login()
{
    if(!isset($_SESSION['user'])){
        return false;
    }else{
        return true;
    }
}

function admin()
{
    if(!isset($_SESSION['admin'])){
        return false;
    }else{
        return true;
    }
}

function is_hospital(){
    if (isset($_SESSION['transferred'])){
        return true;
    }else{
        return false;
    }
}

function set_flash($msg,$type)
{
    $_SESSION['flash'] = "<div class='alert alert-".$type."'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
}

function flash()
{
    if(isset($_SESSION['flash']))
    {
        echo $_SESSION['flash'];
        unset($_SESSION['flash']);
    }
}





function admin_role($n)
{
    if($n == 0)
    {
        return "Moderator";
    }
    
    elseif ($n == 1) 
    {
        return "Global Admin";
    }
        elseif ($n == 2) 
    {
        return "Support";
    }
}


function time_ago($time)
{
    $out    = ''; // what we will print out
    $now    = time(); // current time
    $diff   = $now - $time; // difference between the current and the provided dates

    if( $diff < 60 ) // it happened now
        return TIMEBEFORE_NOW;

    elseif( $diff < 3600 ) // it happened X minutes ago
        return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

    elseif( $diff < 3600 * 24 ) // it happened X hours ago
        return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

    elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
        return TIMEBEFORE_YESTERDAY;

    elseif( $diff < 3600 * 24 * 7 )
        return str_replace( '{num}', round( $diff / ( 3600 * 24 ) ), TIMEBEFORE_DAYS );

    elseif( $diff < 3600 * 24 * 7 * 4 )
        return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 ) ) ), $out == 1 ? TIMEBEFORE_WEEK : TIMEBEFORE_WEEKS );

    elseif( $diff < 3600 * 24 * 7 * 4 * 12 )
        return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 * 4 ) ) ), $out == 1 ? TIMEBEFORE_MONTH : TIMEBEFORE_MONTHS );


    else // falling back on a usual date format as it happened later than yesterday
        return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
}

function settings($name)
{
    global $db;
    $set = $db->prepare('SELECT value FROM settings WHERE name = :name');
    $set->execute(array('name' => $name));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['value'];
    $set->closeCursor();
}



function my_curl($data)
{
    $post_str = "";

    foreach ($data as $key => $value) {
        $post_str .= $key."=".urlencode($value)."&";
    }

    $post_str = substr($post_str, 0, -1);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://cheapglobalsms.com/api_v1');
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($ch);

    curl_close($ch);
}


function alert($msg,$type,$close = false)
{
    if($close == false){
        $msg = "<div class='alert alert-".$type."'>".$msg."</div>";
    }else{
        $msg = "<div class='alert alert-".$type."'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
    }

    echo $msg;
}


function doctor($id,$field)
{
    global $db;
    $set = $db->prepare('SELECT * FROM doctor WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs[$field];
    $set->closeCursor();
}


function msg_status($s){
    if($s == 0){
        return "unread";
    }else{
        return "read";
    }
}


function send_email($subject,$to,$message,$cc = FALSE)
{
    //require_once "lib/PHPMailer/PHPMailerAutoload.php";
    $email_tmp = file_get_contents("email.html");
    $message2 = str_replace("{{TITLE}}", $subject, $email_tmp);

    $message = str_replace("{{TEXT}}", $message, $message2);

    //str_replace(search, replace, subject)

    $full_name = "Quantum Global";
    $email_from = "swp@quantumdonorsandprojects.us";

    $from = "$full_name <$email_from>";
    $headers = 'From:'.$full_name.'<'.$email_from.'>'."\r\n";
    if($cc != FALSE)
    {
        $headers .= 'BCC: '. implode(",", $cc) . "\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    //$headers .= "Return-Path: no-reply@quantumdonorsandprojects.us";

    @mail($to, $subject, $message, $headers);
    


}



    function no_of_questions($game_id)
    {
        global $db;
        $sql = $db->prepare("SELECT NULL FROM questions WHERE category_id = :game_id");
        $sql->execute(array(
                'game_id' => $game_id
            ));

        $c = $sql->rowCount();

        $sql->closeCursor();

        return $c;
    }


    function cat_name($id){
        global $db;
        $sql = $db->prepare("SELECT category FROM category WHERE id = :game_id");
        $sql->execute(array(
                'game_id' => $id
            ));

        $c = $sql->rowCount();
        $rs = $sql->fetch(PDO::FETCH_ASSOC);

        $sql->closeCursor();

        return $rs['category'];
    }


    function get_hospital($id,$value){
        global $db;
        $sql = $db->query("SELECT * FROM hospital WHERE id='$id'");
        $rs = $sql->fetch(PDO::FETCH_ASSOC);
        return $rs[$value];
    }

function get_patient($value){
    global $db;
    $id = $_SESSION['transferred'];
    $sql = $db->query("SELECT * FROM patient WHERE id='$id'");
    $rs = $sql->fetch(PDO::FETCH_ASSOC);
    return $rs[$value];
}



?>