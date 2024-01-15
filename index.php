<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>书架</title>
<style type="text/css">
    .bookshelf {
        display: flex;
        flex-wrap: wrap;
    }
    .book {
        width: 48%; /* 留出一些空间以避免边框或间隙问题 */
        height: 350px; /* 设置方格的高度 */
        box-sizing: border-box;
        padding: 10px;
        margin: 1%; /* 简单的间隙 */
        border: 1px solid #ddd; /* 方格边框 */
        overflow: hidden; /* 隐藏溢出的内容 */
		font-size: 30px;
    }
    .book-cover {
        max-width: 100px;
        height: auto;
        margin-bottom: 10px;
    }
    h3, p {
        margin: 5px 0; /* 调整间距 */
        overflow: hidden; /* 隐藏溢出的文本 */
        text-overflow: ellipsis; /* 显示省略号 */
        white-space: nowrap; /* 防止文本换行 */
    }
</style>

    <!-- 引入 jQuery 3.1.1 -->
    <script src="jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            loadBookshelf();
			loadFontSize();
            function loadBookshelf() {
                $.ajax({
                    url: "api.php?action=getBookshelf",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        displayBooks(response.data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to load bookshelf: " + error);
                    }
                });
            }
			function loadFontSize() {
                $.get("api.php?action=getFontSize", function(fontSize) {
                    $('body').css('font-size', fontSize + 'px');
					$('.book').css('font-size', fontSize + 'px');
                });
            }
            function displayBooks(books) {
                var html = '';
                for (var i = 0; i < books.length; i++) {
                    html += '<div class="book">';
                    html += '<a href="book.php?bookUrl=' + encodeURIComponent(books[i].bookUrl) + '&chapterIndex=' + books[i].durChapterIndex + '">';
                    html += '<img class="book-cover" src="' + books[i].coverUrl + '" alt="Cover">';
                    html += '<h3>' + books[i].name + '</h3>';
                    html += '<p>作者: ' + books[i].author + '</p>';
                    html += '<p>最新章节: ' + books[i].latestChapterTitle + '</p>';
                    html += '<p>阅读进度: ' + books[i].durChapterTitle + '</p>';
                    html += '</a>';
                    html += '</div>';
                }
                $("#bookshelf").html(html);
            }
        });
    </script>
</head>
<body>
    <h1>我的书架</h1>
    <div id="bookshelf" class="bookshelf">
        <!-- 书籍信息将在这里显示 -->
    </div>
</body>
</html>
