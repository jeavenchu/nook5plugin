<?php

$action = $_GET['action'] ?? '';
$timestamp = time();

switch ($action) {
    case 'getBookshelf':
        $url = "http://地址:端口/reader3/getBookshelf?refresh=0&v=$timestamp";
        echo file_get_contents($url);
        break;

    case 'getChapterList':
        $url = "http://地址:端口/reader3/getChapterList?v=$timestamp";
        echo sendPostRequest($url, file_get_contents('php://input'));
        break;

    case 'saveBookProgress':
        $url = "http://地址:端口/reader3/saveBookProgress?v=$timestamp";
        echo sendPostRequest($url, file_get_contents('php://input'));
        break;

    case 'getBookContent':
        $url = "http://地址:端口/reader3/getBookContent?v=$timestamp";
        echo sendPostRequest($url, file_get_contents('php://input'));
        break;
    case 'saveNumberToTxt':
        $number = $_POST['number'] ?? '';
        saveNumberToTxt($number);
        break;
	case 'getFontSize':
        // 读取 zt.txt 文件并返回内容
        echo file_get_contents('zt.txt');
        break;

    case 'saveFontSize':
        // 获取 POST 请求中的字体大小
        $fontSize = $_POST['fontSize'] ?? '';
        if ($fontSize) {
            // 将字体大小保存到 zt.txt
            file_put_contents('zt.txt', $fontSize);
            echo "FontSize saved";
        } else {
            echo "No fontSize provided";
        }
        break;
    default:
        echo "Invalid action";
        break;
}

function sendPostRequest($url, $data) {
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36'
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function saveNumberToTxt($number) {
    $file = 'zt.txt';
    file_put_contents($file, $number);
    echo "Number saved successfully.";
}
?>
