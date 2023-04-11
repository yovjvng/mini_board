<?php
    // 절대 주소 넣는 대신 define 
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    include_once( URL_DB );

    // Request Method를 획득
    $http_method = $_SERVER["REQUEST_METHOD"];

    // GET 일때
    if( $http_method === "GET")
    {
        $board_no = 1;
        if ( array_key_exists( "board_no", $_GET ) ) 
        {
            $board_no = $_GET["board_no"];
        }

        $result_info = select_board_info_no( $board_no );
    }
    // POST 일때
    else
    {
        $arr_post = $_POST;
        $arr_info = 
            array(
                "board_no" => $arr_post["board_no"]
                ,"board_title" => $arr_post["board_title"]
                ,"board_contents" => $arr_post["board_contents"]
            );

        // update
        $result_cnt = update_board_info_no( $arr_info );

        // select
        $result_info = select_board_info_no( $arr_post["board_no"] );
    }


 ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <title>게시판</title>
    <style>
        *
        {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
        }
        .wrap
        {
            text-align: center;
        }
        h1
        {
            text-transform: uppercase;
        }
        form{
            padding: 30px 0;
        }
        form input
        {
            width: 400px;
        }
        #contents
        {
            height: 500px;
        }
        a
        {
            text-decoration: none;
            color: #ffffff;
        }
        a:hover
        {
            color: #333;
        }
        label
        {
            vertical-align: top;
        }
        .btn_con
        {
            display: flex;
            width: 500px;
            /* background-color: aquamarine; */
            margin: 0 auto;
        }
        .btn_fix
        {
            width: 70px;
            border-radius: 25px;
            background-color: #333;
            color: #ffffff;
            margin: 0 50px;
            /* justify-content: space-between; */
        }
        .btn_fix:hover
        {
            background-color: #ffffff;
            color: #333;
        }
        
    </style>
</head>
<body>
    <div class="wrap">
        <h1>edit post</h1>
        <form method="post" action="board_update.php">
            <label for="bno">게시글 번호 : </label>
            <input type="text" name="board_no" id="bno" value="<?php echo $result_info['board_no'] ?>" readonly>
            <br>
            <br>
            <label for="title">게시글 제목 : </label>
            <input type="text" name="board_title"  id="title" value="<?php echo $result_info['board_title'] ?>">
            <br>
            <br>
            <label for="contents">게시글 내용 : </label>
            <input type="text" name="board_contents"  id="contents" value="<?php echo $result_info['board_contents'] ?>">
            <br>
            <br>
            <div class="btn_con">
                <button class="btn_fix" type="submit">FIX</button>
                <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a>
            </div>
        </form>
    </div>
</body>
</html>