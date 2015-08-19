<?php
/*

  [+] AUTOR:        Cleiton Pinheiro / Nick: googleINURL
  [+] EMAIL:        inurlbr@gmail.com
  [+] Blog:         http://blog.inurl.com.br
  [+] Twitter:      https://twitter.com/googleinurl
  [+] Fanpage:      https://fb.com/InurlBrasil
  [+] Pastebin      http://pastebin.com/u/Googleinurl
  [+] GIT:          https://github.com/googleinurl
  [+] PSS:          http://packetstormsecurity.com/user/googleinurl
  [+] EXA:          http://exploit4arab.net/author/248/Cleiton_Pinheiro
  [+] YOUTUBE:      http://youtube.com/c/INURLBrasil
  [+] PLUS:         http://google.com/+INURLBrasil


*/
error_reporting(1);
set_time_limit(0);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
ini_set('allow_url_fopen', 1);
ob_implicit_flush(true);
ob_end_flush();
$c = __OS();

$op_ = getopt('f:t:', array('help::', 'xpl:', 'range:', 'range-rand:', 'thread:'));
echo "{$c['c1']}\n\t\t
\t\t\t\t  _____ 
\t\t\t\t (_____)   
\t\t\t\t (() ())  
\t\t\t\t  \   /    
\t\t\t\t   \ /      
\t\t\t\t   /=\     
\t\t\t\t  [___]
\n
\n\t\t[ I N U R L  -  B R A S I L ] - [ By GoogleINURL ]\n\t\tNeither war between hackers, nor peace for the system\n
\n\t{$c['c2']}[+] [SCRIPT]: AutoXPL 1.0 / EXECUTE COMMAND\n\t[+] [ help ]: --help\n\n{$c['c0']}";
$menu = "{$c['c1']}
    -t             : SET TARGET.
    -f             : SET FILE TARGETS.
    --range        : SET RANGE IP.
    --range-rand   : SET NUMBE IP RANDOM.
    --xpl          : SET COMMAND XPL.
    Execute:
                  php AutomatedXPL.php -t target   --xpl './xpl _TARGET_'
                  php AutomatedXPL.php -f targets.txt  --xpl './xpl _TARGET_'
                  php AutomatedXPL.php --range '200.1.10.1,200.1.10.255' --xpl './xpl _TARGET_'
                  php AutomatedXPL.php --range-rand 20 --xpl './xpl _TARGET_'
\n{$c['c0']}";
echo isset($op_['help']) ? exit($menu) : NULL;
$params = array(
    'target' => not_isnull_empty($op_['t']) ? $op_['t'] : NULL,
    'file' => !not_isnull_empty($op_['t']) && not_isnull_empty($op_['f']) ? $op_['f'] : NULL,
    'xpl' => not_isnull_empty($op_['xpl']) ? $op_['xpl'] : exit("{$menu}\t{$c['c12']}[X] [ ERRO ] DEFINE XPL COMMAND!\n{$c['c0']}"),
    'range' => not_isnull_empty($op_['range']) ? $op_['range'] : NULL,
    'range-rand' => not_isnull_empty($op_['range-rand']) ? $op_['range-rand'] : NULL,
    'c' => $c,
    'thread' => not_isnull_empty($op_['thread']) ? $op_['thread'] : 1,
    'line' => "--------------------------------------------------------------"
);

not_isnull_empty($params['target']) &&
        not_isnull_empty($params['range']) &&
        not_isnull_empty($params['range-rand']) &&
        not_isnull_empty($params['file']) ?
                exit("{$menu}\t{$c['c12']}[X] [ ERRO ] DEFINE TARGET OR OR RANGES/RAND OR FILE TARGET\n{$c['c0']}") : NULL;

function not_isnull_empty($valor = NULL) {
    RETURN !is_null($valor) && !empty($valor) ? TRUE : FALSE;
}

function __plus() {

    ob_flush();
    flush();
}

################################################################################
#GENERATOR RANGE IP#############################################################

function __generatorRangeIP($range) {

    $ip_ = explode(',', $range);
    if (is_array($ip_)) {
        $_ = array(0 => ip2long($ip_[0]), 1 => ip2long($ip_[1]));
        while ($_[0] <= $_[1]) {
            $ips[] = long2ip($_[0]);
            $_[0] ++;
        }
    } else {

        return FALSE;
    }

    return $ips;
}

################################################################################
#GENERATOR RANGE IP RANDOM######################################################

function __generatorIPRandom($cont) {

    $cont[0] = 0;
    while ($cont[0] < $cont[1]) {

        $bloc[0] = rand(0, 255);
        $bloc[1] = rand(0, 255);
        $bloc[2] = rand(0, 255);
        $bloc[3] = rand(0, 255);
        $ip[] = "{$bloc[0]}.{$bloc[1]}.{$bloc[2]}.{$bloc[3]}";
        $cont[0] ++;
    }
    return array_unique($ip);
}

################################################################################
#OPEN FILE TARGETS##############################################################

function __listTarget($params) {

    $tgt_ = array_unique(array_filter(explode("\n", file_get_contents($params['file']))));


    if (!is_array($tgt_)) {

        return NULL;
    }

    foreach ($tgt_ as $url) {

        $tgt[] = $url;
        __plus();
    }
    return $tgt;
}

################################################################################
#EXECUTE XPL COMMAND############################################################

function __exec($params) {
    echo "{$params['c']['c1']}[+][{$params['count']}/{$params['total']}]{$params['line']}\n";
    echo "{$params['c']['c1']}[+][ TARGET ]:: {$params['c']["c7"]}{$params['target']}\n";
    echo "{$params['c']['c1']}[+]|__\n";
    $cmd = str_replace("_TARGET_", $params['target'], $params['xpl']);
    echo "      |[ COMMAND XPL ]:: {$cmd}\n";
    echo "[+]|__\n";
    echo "      |[P R O C E S S]\n\n";
    echo $params['c']['c2'];
    system($cmd);
    echo $params['c']['c0'];
}

################################################################################
#VALIDATE OPERATING SYSTEM AND COLOR SYSTEM#####################################

function __OS() {

    $sistema = strtoupper(PHP_OS);
    if (substr($sistema, 0, 3) == "WIN") {
        $i = 0;
        system("cls");
        $_["os"] = 1;
        while ($i <= 17) {
            $_["c{$i}"] = NULL;
            $i++;
        }
    } else {
        system("command clear");
        //DEFINING COLORS
        $_["c0"] = "\033[0m";      // END OF COLOR
        $_["c1"] = "\033[1;37m";   // WHITE
        $_["c2"] = "\033[1;33m";   // YELLOW
        $_["c3"] = "\033[1;31m";   // RED LIGHT
        $_["c4"] = "\033[0;32m";   // GREEN
        $_["c5"] = "\033[1;32m";   // GREEN LIGHT
        $_["c6"] = "\033[0;35m";   // PURPLE
        $_["c7"] = "\033[1;30m";   // DARK GREY
        $_["c8"] = "\033[0;34m";   // BLUE
        $_["c9"] = "\033[0;37m";   // LIGHT GREY
        $_["c10"] = "\033[0;33m";  // BROWN
        $_["c11"] = "\033[1;35m";  // LIGHT PURPLE
        $_["c12"] = "\033[0;31m";  // RED
        $_["c13"] = "\033[1;36m";  // LIGHT CYAN
        $_["c14"] = "\033[0;36m";  // CIANO
        $_["c15"] = "\033[1;34m";  // LIGHT BLUE
        $_["c16"] = "\033[02;31m"; // DARK RED
    }
    return $_;
}

################################################################################
#PROCESS HOME###################################################################

function __main($params) {

    if (not_isnull_empty($params['target']))
        $params['targets'] = $params['target'];

    if (not_isnull_empty($params['range']))
        $params['targets'] = __generatorRangeIP($params['range']);

    if (not_isnull_empty($params['range-rand']))
        $params['targets'] = __generatorIPRandom(array(1 => $params['range-rand']));

    if (not_isnull_empty($params['file']))
        $params['targets'] = __listTarget($params);



    $params['total'] = count($params['targets']);
    $cont = 1;
    echo "\t{$params['c']['c2']}[!] [ INFO ]: TOTAL TARGETS LOADED : {$params['total']}\n{$params['c']['c0']}";
    echo "\t{$params['c']['c2']}[!] [ INFO ]: XPL COMMAND : {$params['xpl']}\n\n\n{$params['c']['c0']}";

    $out = 0;
    $thr = $params['thread'];
    $ini = 0;
    $fin = $thr - 1;

    while (1) {
        $childs = array();

        for ($count = $ini; $count <= $fin; $count++) {
            if (empty($params['targets'][$count])) {
                $out = 1;
                continue;
            }

            $pid = pcntl_fork();

            if ($pid == -1) {
                echo "Fork error\n";
                exit(1);
            } else if ($pid) {
                array_push($childs, $pid);
            } else {
                $n = $count + 1;
                $params['count'] = $count;
                $params['target'] = $params['targets'][$count];
                __exec($params);
                echo "\n\n";
                exit(0);
            }
        }

        foreach ($childs as $key => $pid) {
            pcntl_waitpid($pid, $status);
        }

        if ($out == 1) {
            echo "\t{$params['c']["c1"]}[!] [ INFO ]: [ End of process AutoXPL 1.0 at [" . date("d-m-Y H:i:s") . "]\n\n";
            echo "\n\t\t[ I N U R L  -  B R A S I L ] - [ By GoogleINURL ]\n{$params['c']["c0"]}";
            return;
        }

        $ini = $fin + 1;
        $fin = $fin + $thr;
    }
}

__main($params);
