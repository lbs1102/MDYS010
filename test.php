<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "123456";
$dbname = "testmdys";

// $db = mysqli_connect($hostname, $username, $password) or die("html>script language='JavaScript'>alert('無法連線至資料庫！請稍後再重試一次。'),history.go(-1)/script>/html>");


// mysqli_query($db, 'SET NAMES "utf8"');
// mysqli_query($db, 'SET @@sql_mode = ""');
// mysqli_select_db($db, $dbname) or die('無法連線資料庫');
$conn = new mysqli($hostname, $username, $password, $dbname);
// $test = mysqli_query($db, $sSQL);
// $_Res = 0;
// $rRes = $_Res != 0 ? $_Res : $test;
// $updata = [];
// $cnt = 0;
// while ($aRow = mysqli_fetch_assoc($rRes)) {
//     // $cnt++;
//     $updata[$aRow["vod_id"]] = $aRow;
//     // echo $aRow["vod_play_url"] . "</br>";
//     // $reples = str_replace("http://162.251.93.83", "https://video.cckgame.com", $aRow["vod_pic"]);
//     // $id = $aRow["vod_id"];
//     // $updata .= "UPDATE mac_vod SET vod_pic = '$reples' WHERE vod_id = $id;";
// }

// $string = file_get_contents("vodvilist.json");
// $json_a = json_decode($string, true);
// $arr_b = [];
// $sql = "";
// foreach ($json_a as $k => $v) {

//     $name = str_replace('"', "\\\"", $v["vod_name"]);
//     $name = str_replace('#', "\#", $name);
//     $name = str_replace('-', "\-", $name);
//     $name = str_replace('~', "\~", $name);
//     $id = $v["vod_id"];
//     $sql .= " UPDATE `mac_vod` SET `vod_vi`=\"" . $name . "\" WHERE `vod_id`= $id; ";
//     // echo " UPDATE `mac_vod` SET `vod_vi`=\"" . $name . "\" WHERE `vod_id`= $id;" . "</br>";
// }
$sSQl = "SELECT vod_id,vod_name,vod_play_url FROM `mac_vod`";
$test = 1;
$result = $conn->query($sSQl);
$arr = [];
while ($row = $result->fetch_assoc()) {
    $arr[] = $row;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// $path_json = dirname(__file__) . "/json_vod.json";
// $string = file_get_contents($path_json);
// $ids = json_decode($string, true);
// $arr_2 = [];
// $arr_3 = [];
// foreach ($ids as $key => $value) {
//     $domain = substr($value['rpath'], 0, 1) == '/' ? "https://video.cckgame.com" : "https://video.cckgame.com" . '/';
//     $vod_path = "$" . $domain . $value['rpath'] . "/index.m3u8";
//     $arr_2[] = $vod_path;
//     $arr_3[$vod_path] = $value;
// };
// $arr_4 = [];
// foreach ($arr_2 as $key => $value) {
//     if (!in_array($value, $arr)) {
//         $arr_4[] = $arr_3[$value];
//     }
// }
// echo json_encode($arr_4, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// if ($conn->query($sql) === FALSE) {
//     echo "Error updating record: " . $conn->error . " vod_id = " . $id . "</br>";
// }
// echo json_encode($arr_b);
// $test = 1;
// excel($updata, ['vod_id', 'vod_name', 'vod_en']);
// echo json_encode($updata, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

/**
 * 匯出excel
 *@param $data     要匯出的資料，是一個二維陣列
 *@param $title    匯出excel表格裡的標題，是一個數組
 *@param $filename 下載的檔名
 *@examlpe 
 */
function excel($data = array(), $title = array(), $filename = 'report')
{
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition:attachment;filename=" . $filename . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    $re = "<table border='1'><thead>";
    if (!empty($title)) {  //先迴圈出標題放入html的table表裡
        $re .= "<tr>";
        foreach ($title as $k => $v) {
            // $re .= "<th style='background-color:rgb(189,215,238);'>" . iconv("UTF-8", "GBK//IGNORE", $v) . "</th>";
            $re .= "<th style='background-color:rgb(189,215,238);'>" .  $v . "</th>";
        }
    }
    $re .= "</tr></thead><tbody>";
    if (!empty($data)) {  //迴圈出資料放入html的table表裡
        foreach ($data as $key => $val) {
            $re .= "<tr>";
            foreach ($val as $ck => $cv) {
                // $cv = charsetToUTF8($cv);
                // $re .= "<td>" . iconv("UTF-8", "GBK//IGNORE", $cv) . "</td>";
                $re .= "<td>" .  $cv . "</td>";
            }
            $re .= "</tr>";
        }
        $re .= "</tbody></table>";
    }
    echo $re;
}

function charsetToUTF8($mixed)
{
    if (is_array($mixed)) {
        foreach ($mixed as $k => $v) {
            if (is_array($v)) {
                $mixed[$k] = charsetToUTF8($v);
            } else {
                $encode = mb_detect_encoding($v, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
                if ($encode == 'EUC-CN') {
                    $mixed[$k] = iconv('GBK', 'UTF-8', $v);
                }
            }
        }
    } else {
        $encode = mb_detect_encoding($mixed, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
        if ($encode == 'EUC-CN') {
            $mixed = iconv('GBK', 'UTF-8', $mixed);
        }
    }
    return $mixed;
}
// $menus = include './application/admin/common/auth.php';
// $test = mac_extra_lang_get($menus);
// $new_arr_2 = [];
// foreach ($test as $k1 => $v1) {
//     $new_arr = [];
//     foreach ($v1 as $k2 => $v2) {
//         if (is_array($v2)) {
//             $new_arr_3 = [];
//             foreach ($v2 as $k3 => $v3) {
//                 $new_arr_3[] = $v3;
//             }
//             $new_arr[$k2] = $new_arr_3;
//         } else {
//             $new_arr[$k2] = $v2;
//         }
//     }
//     $new_arr_2[] = $new_arr;
// };
// echo json_encode($new_arr_2, JSON_UNESCAPED_UNICODE);

// function mac_extra_lang_get(&$new)
// {
//     if (is_array($new)) {
//         foreach ($new as $key => &$val) {
//             if (is_array($val)) {
//                 if ($key != "sub") {
//                     $new[$key]["index"] = $key;
//                 }
//                 mac_extra_lang_get($val);
//             }
//         }
//     }
//     return $new;
// }
// echo phpinfo();
