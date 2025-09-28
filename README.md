# nook5plugin
#简介
一个为了 nook glowlight plus (NGP)打造的浏览器网页  
主要目的就是通过这个中转网页可以访问开源阅读和开源阅读web版本的reader3  
需要**gedoor的legado开启web服务，或者使用hectorqin的reader**  
因为这两个神器的web版面都不支持安卓4.4.2的浏览器内核，这个内核太老了，大概是chrome30.0的水平。  
内核老的程度可以媲美opera12.18，也就是opera最后一个Presto内核的版本。  
代码是php的，思路借鉴了cyx7788414的kabi-novel，我也根据它的代码调整了一版html版本在另外一个仓库。  
神奇的是我是个稍微懂一丢丢技术的外行，然后在chatgpt的帮助下顺利完成了所有的代码。  
哈哈我真是个大聪明！！  
主要说明：  
index.php:书架页面  
这条没用了，chatgpt给整合进api.php里了。     config.php：服务器等内容在这里配置  
api.php：一些中转给reader3的  
# 安装方法  
搭建一个PHP环境，把文件丢进去，记得修改api.php里的地址  
大功告成！  
zt.txt 是保存字体大小的，如果是linux系统记得给权限，直接在zt.txt中填写数字就行，我填了30
