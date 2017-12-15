<?php

function getPageWithProxy($url,$proxy,$proxypwd,$use_proxy,$counter,$end_counter,$start_counter){

    if($use_proxy == "false"){
        $proxy = '';
        $proxypwd = '';
    }else{
        if($counter < $end_counter){
            $proxy = rotateProxyChanger($counter);
            $counter++;
        }else{
            $counter = $start_counter;
        }
    }

//    echo '$proxy = '.$proxy.'<br>';
//    echo '$counter = '.$counter.'<br>';
//    echo '======================<br>';

    $str = get( $url, $proxy,$proxypwd, $closeSession = "false" );

    $h = 0;
    while(strlen($str)<10000 and $h < 5){

        echo '<span style="color: red">'.$url.' >> failed '.($h+1).' $proxy = '.$proxy.'</span><br>';

        if($use_proxy == "false"){
            $proxy = '';
            $proxypwd = '';
        }else{
            if($counter < $end_counter){
                $proxy = rotateProxyChanger($counter);
                $counter++;
            }else{
                $counter = $start_counter;
            }
        }
        $str = get( $url, $proxy,$proxypwd, $closeSession = "false" );

        $h++;
    }

//    echo 'strlen($str) = '.strlen($str).'<br>';

    $result = array();
    $result[0] = $str;
    $result[1] = $counter;
    return $result;

}

function postPageWithProxy($url,$param,$proxy,$proxypwd,$use_proxy,$counter,$end_counter,$start_counter){

    if($use_proxy == "false"){
        $proxy = '';
        $proxypwd = '';
    }else{
        if($counter < $end_counter){
            $proxy = rotateProxyChanger($counter);
            $counter++;
        }else{
            $counter = $start_counter;
        }
    }

//    echo '$proxy = '.$proxy.'<br>';
//    echo '$counter = '.$counter.'<br>';
//    echo '======================<br>';

    $str = post($url, $param, $proxy,$proxypwd, $closeSession = "false" );

    $h = 0;
    while(strlen($str)<10000 and $h < 5){

        echo '<span style="color: red">'.$url.' >> failed '.($h+1).' $proxy = '.$proxy.'</span><br>';

        if($use_proxy == "false"){
            $proxy = '';
            $proxypwd = '';
        }else{
            if($counter < $end_counter){
                $proxy = rotateProxyChanger($counter);
                $counter++;
            }else{
                $counter = $start_counter;
            }
        }
        $str = post($url, $param, $proxy,$proxypwd, $closeSession = "false" );

        $h++;
    }

    echo 'strlen($str) = '.strlen($str).'<br>';



    $result = array();
    $result[0] = $str;
    $result[1] = $counter;
    return $result;

}

?>