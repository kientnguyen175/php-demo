<?php
    function handle_input($data) {
        $data = trim($data); //xoá tất cả khoảng trống thừa, xoá chuỗi chỉ có khoảng trắng
        $data = strip_tags($data);
        $data = stripslashes($data); // biến đổi tất cả các kí tự đặc biệt \t, \n, \\ .....
        $data = htmlspecialchars($data);
        
        return $data;
    }

    function handle_input2($data) {
        $data = str_replace(
            array('<',"'",'>','?','/',"\\",'--','eval(','<php','"','-'),
            array(' ',' ',' ',' ',' ',' ',' ',' ',' ',' ', ' ' ),
            $data
            // htmlspecialchars(addslashes(strip_tags($data)))
            // addslashes thêm các dấu \ vào trước dấu ', ", \
            // strip_tags sẽ loại bỏ các thẻ HTML và PHP 

        );
        return $data;
    }
    
    


    

?>