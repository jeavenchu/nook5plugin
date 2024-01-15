<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Chapter List</title>
    <script src="jquery-3.1.1.min.js"></script>
    <style>
        #chapter-container {
            display: flex;
            flex-wrap: wrap;
			padding-bottom: 60px; /* 调整这个值以确保足够的空间 */
        }
        #chapter-container ul {
            width: 50%;
            list-style-type: none;
            padding: 0;
        }
        #chapter-container li {
            margin-bottom: 10px;
        }
        #sort-buttons {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f8f8; /* 您可以根据需求调整背景颜色 */
        border-top: 1px solid #ddd;
        padding: 10px 0;
        box-sizing: border-box;
        text-align: center; /* 确保按钮水平居中 */
        }
        #sort-buttons button {
        margin: 0 2%; /* 在按钮之间添加间距 */
        width: 10%; /* 每个按钮的宽度 */
        padding: 8px 0; /* 按钮的垂直填充 */
        font-size: 30px; /* 字体大小，可根据需要调整 */
        }
    </style>
</head>
<body>
    <div id="chapter-container">
            <ul id="chapter-list-1"></ul>
			<ul id="chapter-list-2"></ul>
    </div>

    <div id="sort-buttons">
        <button id="sort-asc">正序</button>
		<button id="back-to-home">书架</button>
        <button id="sort-desc">倒序</button>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var bookUrl = getQueryParam('bookUrl');
            var originalChapters = [];

            getChapterList(bookUrl);
			getFontSizeFromServer()
            $('#sort-asc').click(function() {
                updateChapterList(originalChapters);
            });

            $('#sort-desc').click(function() {
                var reversedChapters = originalChapters.slice().reverse(); // 使用 slice() 复制数组再倒序
                updateChapterList(reversedChapters);
            });
			$('#back-to-home').click(function() {
            window.location.href = '/'; // 修改为您的首页地址
        });
            function getChapterList(bookUrl) {
                $.ajax({
                    url: 'api.php?action=getChapterList',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ "url": bookUrl }),
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.isSuccess) {
                            originalChapters = response.data;
                            updateChapterList(originalChapters);
                        }
                    }
                });
            }

            function updateChapterList(chapters) {
    var halfLength = Math.ceil(chapters.length / 2);
    var firstHalf = chapters.slice(0, halfLength);
    var secondHalf = chapters.slice(halfLength);

    updateChapterListInUl('#chapter-list-1', firstHalf);
    updateChapterListInUl('#chapter-list-2', secondHalf);
}
	function updateChapterListInUl(ulSelector, chapters) {
    var listHtml = '';
    for (var i = 0; i < chapters.length; i++) {
        var chapterLink = 'book.php?bookUrl='+ encodeURIComponent(chapters[i].bookUrl) + '&chapterIndex=' + chapters[i].index;
	listHtml += '<li><a href="' + chapterLink + '">' + chapters[i].title + '</a></li>';
		}
		$(ulSelector).html(listHtml);
		}

        function getQueryParam(name) {
            var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results == null) {
                return null;
            }
            return decodeURIComponent(results[1]) || 0;
        }
		    // 获取字体大小
        function getFontSizeFromServer() {
            // 获取服务器保存的字体大小
            $.get('api.php?action=getFontSize', function(response) {
                defaultFontSize = parseInt(response, 10) || 30; // 默认字体大小为 30px
                $('body').css('font-size', defaultFontSize + 'px');
            });
        }
    });
</script>
</body>
</html>
