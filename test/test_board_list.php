<?php

include_once( "C:/Apache24/htdocs/mini_board/test/test_db_common.php" );

$arr = array(
        "limit_num" => 5
        ,"offset" => 0
);
$result = board_list( );



?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <table>
            <thead>
                <tr>
                    <th>게시물 번호</th>
                    <th>게시물 제목</th>
                    <th>작성일자</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $recode) {
                ?>
                <tr>
                    <td><?php echo $recode['board_no'] ?></td>
                    <td><?php echo $recode['board_title'] ?></td>
                    <td><?php echo $recode['board_write_date'] ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    
</body>
</html>