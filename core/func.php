<?php
define( 'TIMEBEFORE_NOW','Just now' );
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


function admin()
{
    if(!isset($_SESSION['fpe_admin'])){
        return false;
    }else{
        return true;
    }
}

function set_flash($msg,$type = "info")
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
    if($n == 0){
        return "Moderator";
    }elseif ($n == 1) {
        return "Global Admin";
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


function getSlug($name)
{
    $name = trim($name);
    $slug = str_replace(" ", "-", $name);
    //$slug = str_replace(",", "-", $name);
    $slug = str_replace("_", "-", $slug);
    $slug = str_replace("/", "", $slug);
    $slug = str_replace(".", "", $slug);
    $slug = str_replace("*", "", $slug);
    $slug = str_replace("+", "", $slug);
    $slug = str_replace("&", "", $slug);
    $slug = str_replace("--", "-", $slug);
    return strtolower($slug);
}

function stars($n)
{
    $t = 5;
    $r = $t - $n;

    $msg = "<span title='$n / 5'>";
    for ($i=0; $i < $n ; $i++) {
        $msg .= "<i class='fa fa-star'></i>";
    }
    for ($j=0; $j < $r ; $j++) {
        $msg .= "<i class='fa fa-star-o'></i>";
    }
    $msg .= "</span>";

    return $msg;
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


function user_field($id,$field)
{
    global $db;

    $sql = $db->prepare("SELECT * FROM users WHERE id = :id");
    $sql->execute(array(
        'id' => $id
    ));

    $rs = $sql->fetch(PDO::FETCH_ASSOC);

    $sql->closeCursor();

    return $rs[$field];
}

function user($field)
{
    global $db;

    $id = $_SESSION['user'];
    $sql = $db->prepare("SELECT * FROM users WHERE id = :id");
    $sql->execute(array(
        'id' => $id
    ));

    $rs = $sql->fetch(PDO::FETCH_ASSOC);

    $sql->closeCursor();

    return $rs[$field];
}


function category($field,$id){
     global $db;
    
    $sql = $db->prepare("SELECT * FROM category WHERE id = :id");
    $sql->execute(array(
        'id' => $id
    ));

    $rs = $sql->fetch(PDO::FETCH_ASSOC);

    $sql->closeCursor();

    return $rs[$field];
}

function status($status)
{
    if($status == 0){
        return "Pending Confirmation";
    }else{
        return "Active Listing";
    }
}

function watermark($water,$image,$filename)
{
    $stamp = imagecreatefrompng($water);

    $src2 = explode(".",$image);
    if(strtolower(end($src2)) == "png") {
        $im = imagecreatefrompng($image);
    }else{
        $im = imagecreatefromjpeg($image);
    }

    //$im = imagecreatefromjpeg($image);

    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    // Copy the stamp image onto our photo using the margin offsets and the photo
    // width to calculate positioning of the stamp.
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    // Output and free memory
    //header('Content-type: image/png');
    //imagepng($im);
    //imagedestroy($im);
    //

    //$filename = '/foo/bar.png';
    imagepng($im, $filename);
    imagedestroy($im);

}





function make_thumb($src, $dest, $desired_width) {

    /* read the source image */
    $src2 = explode(".",$src);
    if(strtolower(end($src2)) == "png") {
        $source_image = imagecreatefrompng($src);
    }else{
        $source_image = imagecreatefromjpeg($src);
    }
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    if(imagejpeg($virtual_image, $dest)){
        return true;
    }else{
        return false;
    }
}


function paginate ($base_url, $query_str, $total_pages, $current_page, $paginate_limit)
{
    // Array to store page link list
    $page_array = array ();
    // Show dots flag - where to show dots?
    $dotshow = true;
    // walk through the list of pages
    for ( $i = 1; $i <= $total_pages; $i ++ )
    {
        // If first or last page or the page number falls
        // within the pagination limit
        // generate the links for these pages
        if ($i == 1 || $i == $total_pages ||
            ($i >= $current_page - $paginate_limit &&
                $i <= $current_page + $paginate_limit) )
        {
            // reset the show dots flag
            $dotshow = true;
            // If it's the current page, leave out the link
            // otherwise set a URL field also
            if ($i != $current_page)
                $page_array[$i]['url'] = $base_url . "" . $query_str .
                    "" . $i;
            $page_array[$i]['text'] = strval ($i);
        }
        // If ellipses dots are to be displayed
        // (page navigation skipped)
        else if ($dotshow == true)
        {
            // set it to false, so that more than one
            // set of ellipses is not displayed
            $dotshow = false;
            $page_array[$i]['text'] = "...";
        }
    }
    // return the navigation array
    return $page_array;
}


    function star($n)
    {
        $t = 5;
        $r = $t - $n;

        $msg = "<span>";
        for ($i=0; $i < $n ; $i++) { 
            $msg .= "<i class='fa fa-star'></i>";
        }
        for ($j=0; $j < $r ; $j++) { 
            $msg .= "<i class='fa fa-star-o'></i>";
        }
        $msg .= "</span>";

        return $msg;
    }


    
    

?>