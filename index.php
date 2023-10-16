<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        td {
            border: 1px solid #ccc;
            padding: 3px 9px;
        }
    </style>
</head>

<body>
    <h1>
        題目一:寫出一個99乘法表
    </h1>
    <h2>
        <?php
        echo "<table>";
        for ($j = 1; $j <= 9; $j++) {
            echo "<tr>";
            for ($i = 1; $i <= 9; $i++) {
                echo "<td>";
                echo $j . ' * ' . $i . ' = ' . ($j * $i);
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </h2>
    <hr>

    <h1>
        題目二:有1、2、3、4個數字，能組成多少個互不相同且無重複數字的三位元數？都是多少？
        (EX: 123 => OK , 112 => 1有重複)
    </h1>
    <h2>


        <?php
        $numbers = [1, 2, 3, 4];
        $count = 0;
        echo "<table>";
        echo "<tr>";

        for ($i = 1; $i <= 4; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                for ($k = 1; $k <= 4; $k++) {
                    if ($i != $j && $j != $k && $i != $k) {
                        $number = $numbers[$i - 1] * 100 + $numbers[$j - 1] * 10 + $numbers[$k - 1];


                        echo "<td>" . $number . " => OK</td>";
                        $count++;


                        if ($count % 3 === 0) {
                            echo "<tr></tr>";
                        }
                    }
                }
            }
        }

        echo "</tr>";
        echo "</table>";
        ?>

</h2>
<br>
    <hr>
    <br>
    <h1>
        題目三:輸入三個整數x,y,z，請把這三個數由小到大輸出。

    </h1>
<h2>


    <form method="get" action="validate.php">
        <label for="input_numbers">輸入三個整數（用","逗號分隔）:</label>
        <input type="text" name="input_numbers" id="input_numbers"><br>
        <input type="submit" value="排序">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["input_numbers"])) {


        $input = $_GET["input_numbers"];
        $numbers = explode(',', $input);


        foreach ($numbers as &$number) {
            $number = intval($number);
        }


        sort($numbers);


        echo "從小到大的排序結果: ";
        echo implode(' ', $numbers);
    }
    ?>

</h2>
<br>
    <hr>
    <br>
    <h1>
        題目四:請設計一程式檢查輸入的身份證代號是否正確.
    </h1>
        <h2>

            身份證代號共10碼(XS1234567C),檢查規則如下:
            X: 地區碼,範圍A-Z,所代表縣市,和其編碼數字如下:
            A 台北市 10 J 新竹縣 18 S 高雄縣 26 I 嘉義市 34
            B 台中市 11 K 苗栗縣 19 T 屏東縣 27 O 新竹市 35
            C 基隆市 12 L 台中縣 20 U 花蓮縣 28
            D 台南市 13 M 南投縣 21 V 台東縣 29
            E 高雄市 14 N 彰化縣 22 X 澎湖縣 30
            F 台北縣 15 P 雲林縣 23 Y 陽明山 31
            G 宜蘭縣 16 Q 嘉義縣 24 W 金門 32
            H 桃園縣 17 R 台南縣 25 Z 馬祖 33
            S: 性別碼,1表男性,2表女性
            1234567: 流水編號7碼
            C: 檢查碼,欄位1-9乘上加權數之總和,除以10之餘數,以10減之,即檢查碼.
        </h2>
        <h2>身份驗證

        
        <?php
         // 記得啟動 session
         if (isset($_POST['submit'])) { // 检查"verify" 按钮
            $idNumber = $_POST['idNumber'];
            $isValid = validateID($idNumber);
        
            if ($isValid) {
                $_SESSION['validationResult'] = "身份證代號有效。";
            } else {
                $_SESSION['validationResult'] = "身份證代號無效。";
            }
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idNumber'])) {
            $idNumber = $_POST['idNumber'];
            $isValid = validateID($idNumber);
        }
       
        
        
        
        
        
        



function validateID($id) {
    $id = strtoupper(preg_replace('/\s/', '', $id));

    // 驗證身份證號碼的長度是否為10位
    if (strlen($id) !== 10) {
        return false;
    }

    // 地區碼和對應的編碼數字
    $area_codes = array(
        'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14,
        'F' => 15, 'G' => 16, 'H' => 17, 'I' => 34, 'J' => 18,
        'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22, 'O' => 35,
        'P' => 23, 'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27,
        'U' => 28, 'V' => 29, 'W' => 32, 'X' => 30, 'Y' => 31,
        'Z' => 33
    );

    $first_char = $id[0];

    // 驗證地區碼是否有效
    if (!array_key_exists($first_char, $area_codes)) {
        return false;
    }

    $weight_factors = array(1, 9, 8, 7, 6, 5, 4, 3, 2, 1);

    $gender_code = intval($id[1]);
    if ($gender_code !== 1 && $gender_code !== 2) {
        return false;
    }

    $checksum = 0;
    for ($i = 0; $i < 9; $i++) {
        $checksum += intval($id[$i + 1]) * $weight_factors[$i];
    }

    $remainder = $checksum % 10;
    $checksum_digit = (10 - $remainder) % 10;

    return $checksum_digit === intval($id[9]);
}
?>


    <h1>身份證號碼驗證</h1>
    <form method="post">
    <label for="idNumber">輸入身份證代號: </label>
    <input type="text" id="idNumber" name="idNumber" required>
    <button type="submit" name="submit">驗證</button>
</form>
    <h2>
        <?php
        if (isset($_SESSION['validationResult'])) {
            echo $_SESSION['validationResult'];
            unset($_SESSION['validationResult']); // 清除驗證結果
        }
        ?>
    </h2>
    




    



</body>

</html>