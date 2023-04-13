<?php

define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER","board_header.php" );
include_once( URL_DB );

// GET 인지 POST 인지 확인하는 방법
$http_method = $_SERVER["REQUEST_METHOD"];


    if( $http_method === "POST" )
    {
        $arr_post = $_POST;

        $result_cnt = insert_board_info( $arr_post );

        header( "Location: board_list.php" );
        exit();
    }
        
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./board.css">
    <title>게시글 작성</title>
</head>
<body>
<div class="wrap">
        <?php include_once( URL_HEADER ); ?>
        <div class="content_1">
            <h2>free board</h2>
            <h3>write a post</h3>
            <form method="post" action="board_insert.php">
                <!-- <label for="bno">NO. </label>
                <input type="text" name="board_no" id="bno" value="<?php echo $result_info['board_no'] ?>" readonly>
                <br>
                <br> -->
                <label for="title">TITLE : </label>
                <input type="text" name="board_title"  id="title">
                <br>
                <br>
                <label for="contents">내용 : </label>
                <textarea class="input_contents" name="board_contents" id="contents" spellcheck="false" cols="48" rows="15" >
                </textarea>
                <br>
                <br>
                <div class="btn_wrap">
                    <button class="btn_fix" type="submit">
                    작성
                    </button>
                    <a href="board_list.php">
                    취소
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>