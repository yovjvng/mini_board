<?php
// 절대 주소 넣는 대신 define 
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
include_once( URL_DB );

// Request Parameter 획득(GET)
$arr_get = $_GET;

// DB에서 게시물 정보 획득
$result_info = select_board_info_no( $arr_get["board_no"] );

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <style>
    @font-face {
        font-family: 'S-CoreDream-3Light';
        src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-3Light.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    *
    {
        font-family: 'S-CoreDream-3Light';
        text-align: center;
        margin: 0;
        padding: 0;
    }
    a
    {
        color: inherit;
        display: inline-block;
        text-decoration: none;
        color: #333;
    }
    h1
    {
        font-size: 50px;
        font-family: 'Times New Roman', Times, serif;
        font-weight: bold;
        text-transform: uppercase;
    }
    h2
    {
        font-size: 18px;
        font-family: 'Times New Roman', Times, serif;
        border-bottom: 1px solid #333;
        border-top: 1px solid #333;
        width: 300px;
        margin: 0 auto;
        text-transform: uppercase;
        padding: 5px 0;
    }
    .wrap
    {
        margin: 10px;
    }
    .main
    {
        background-image: url(./paper1.jpg);
        background-size: cover;
        border: 1px solid #333;
        width: 800px;
        height: 100%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="main">
            <h1>free board</h1>
            <h2>detail page</h2>
            <div class="contents">
                <p>NO. <?php echo $result_info["board_no"] ?></p>
                <p>작성일 : <?php echo $result_info["board_write_date"] ?></p>
                <p>게시글 번호 : <?php echo $result_info["board_title"] ?></p>
                <p>게시글 내용 : <?php echo $result_info["board_contents"] ?></p>
            </div>
            <button type="button"><a href="board_update.php?board_no=<?php echo $result_info["board_no"] ?> ">
            수정 
            </a></button>
            <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a>
            <button type="button">
                <a href="board_delete.php?board_no=<?php echo $result_info["board_no"] ?>">    
                삭제
                </a>
            </button>
        </div>
    </div>
</body>

</html>