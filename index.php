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
    <div>

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
                    echo $i . ' * ' . $j . ' = ' . ($i * $j);
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </h2>
    </div>
    <hr>
    <div>
        <h1>
            題目二:有1、2、3、4個數字，能組成多少個互不相同且無重複數字的三位元數？都是多少？
            (EX: 123 => OK , 112 => 1有重複)
        </h1>
        <h2>解法一(展志)：用字串相接，判斷皆不等於即成立。</h2>
        <h2>

            <?php
            // 用三個迴圈
            // $i-百位數字，取值 1 到 4。
            // $j-十位數字，取值 1 到 4。
            // $k-個位數字，取值 1 到 4。
            // 用if判斷$i、$j 和 $k 是否都互不相同-没有重複

            $numbers = [1, 2, 3, 4];
            $count = 0;
            echo "<table>";

            for ($i = 0; $i < 4; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 4; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        if ($i != $j && $j != $k && $i != $k) {
                            $number = $numbers[$i] . $numbers[$j] . $numbers[$k];
                            echo "<td>" . $number . " => OK</td>";
                            $count++;
                        }
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<br>";
            echo "共有 " . $count . " 個組合。";
            ?>

        </h2>
        <h2>解法二：取值，
            $numbers[0]-對應1。
            $numbers[1] 對應2。
            $numbers[2] 對應3。
            $numbers[3] 對應4。

            $i =1，$numbers[$i - 1] ，即 $numbers[0]->1。用if判斷$i、$j 和 $k 是否都互不相同-没有重複
        </h2>
        <h2>





            <?php
            // 用三個迴圈
            // $i-百位數字，取值 1 到 4。
            // $j-十位數字，取值 1 到 4。
            // $k-個位數字，取值 1 到 4。
            // 用if判斷$i、$j 和 $k 是否都互不相同-没有重複

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
            echo "<br>";
            echo "共有 " . $count . " 個組合。";
            ?>

        </h2>
    </div>
    <br>
    <hr>
    <br>
    <div>

        <h1>
            題目三:輸入三個整數x,y,z，請把這三個數由小到大輸出。

        </h1>
        <h2>


            <form method="get" action="">
                <label for="input_numbers">輸入三個整數（用","逗號分隔）:</label>
                <input type="text" name="input_numbers" id="input_numbers"><br>
                <input type="submit" value="排序">
            </form>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["input_numbers"])) {


                $input = $_GET["input_numbers"];
                // explode -PHP函數，將字串按照指定的分隔符號拆分
                $numbers = explode(',', $input);

                // intval -PHP函數，數值轉換為整數
                foreach ($numbers as &$number) {
                    $number = intval($number);
                }

                // 使用sort函數進行排序
                sort($numbers);

                // implode -PHP函數，元素合併成一個字符
                echo "從小到大的排序結果: ";
                echo implode(' ', $numbers);
            }
            ?>

        </h2>
    </div>
    <br>
    <hr>
    <br>
    <h1>
        題目四:請設計一程式檢查輸入的身份證代號是否正確.
    </h1>
    <h3>

        身份證代號共10碼(XS1234567C),檢查規則如下:<br>
        X: 地區碼,範圍A-Z,所代表縣市,和其編碼數字如下:<br>
        A 台北市 10 J 新竹縣 18 S 高雄縣 26 I 嘉義市 34<br>
        B 台中市 11 K 苗栗縣 19 T 屏東縣 27 O 新竹市 35<br>
        C 基隆市 12 L 台中縣 20 U 花蓮縣 28<br>
        D 台南市 13 M 南投縣 21 V 台東縣 29<br>
        E 高雄市 14 N 彰化縣 22 X 澎湖縣 30<br>
        F 台北縣 15 P 雲林縣 23 Y 陽明山 31<br>
        G 宜蘭縣 16 Q 嘉義縣 24 W 金門 32<br>
        H 桃園縣 17 R 台南縣 25 Z 馬祖 33<br>
        S: 性別碼,1表男性,2表女性<br>
        1234567: 流水編號7碼<br>
        C: 檢查碼,欄位1-9乘上加權數之總和,除以10之餘數,以10減之,即檢查碼.<br>
    </h3>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idNumber'])) {
        $idNumber = $_POST['idNumber'];
        $isValid = validateID($idNumber);
        // var_dump 是一個用於計算長度和輸出變數的函数
        // var_dump($idNumber);
        // var_dump($isValid);
    }


    function validateID($id)
    {
        // strtoupper 將字串轉換大寫字母的函數
        // preg_replace是用於執行替換的函數，preg_replace(要被替換的字元, 要替換的字元, 要搜索的字串)
        // 當使用 preg_replace 函數時，\s 通常表達為空白字元
        $id = strtoupper(preg_replace('/\s/', '', $id));
        // 驗證$id長度是否為10個字元

        if (strlen($id) !== 10) {
            return false;
        }
        // 宣告陣列$area_codes以參照地區字母轉換為數字
        $area_codes = array(
            'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14,
            'F' => 15, 'G' => 16, 'H' => 17, 'I' => 34, 'J' => 18,
            'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22, 'O' => 35,
            'P' => 23, 'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27,
            'U' => 28, 'V' => 29, 'W' => 32, 'X' => 30, 'Y' => 31,
            'Z' => 33
        );
        // 宣告陣列$weight_factors作為$id位數之權重加分
        $weight_factors = array(1, 9, 8, 7, 6, 5, 4, 3, 2, 1);
        // var_dump($weight_factors);

        $first_char = $id[0];

        // 驗證地區碼是否有效
        if (!array_key_exists($first_char, $area_codes)) {
            // var_dump($first_char);
            return false;
        } else {
            // 如果地區字母符合參照表，將地區字母轉換為數字，並更改$id資料
            $id = $area_codes[$first_char] . substr($id, 1, 9);
            // echo $id."<br>";
            // var_dump($id);
        }
        // 驗證性別
        $gender_code = intval($id[2]);
        if ($gender_code !== 1 && $gender_code !== 2) {
            return false;
        }
        // var_dump($gender_code);

        $checksum = 0;
        for ($i = 0; $i <= 9; $i++) {
            $checksum += intval($id[$i]) * $weight_factors[$i];
            // echo "<br>";
            // echo intval($id[$i]);
            // echo "*";
            // echo $weight_factors[$i];
            // echo "=";
            // echo intval($id[$i]) * $weight_factors[$i];
            // echo "(" . $checksum . ")";
            // echo "<br>";
        }

        $remainder = $checksum % 10;
        if ($remainder === 0) {
            $checksum_digit = 0;
        } else {
            $checksum_digit = 10 - $remainder;
        }

        $isValid = $checksum_digit === intval($id[10]);
        // var_dump($isValid); 
        return $isValid;
    }

    ?>




    <div style="text-align: center;">
        <div>
            <h2>身份證號碼驗證</h2>
        </div>

        <form method="post">
            <div>
                <label for="idNumber">
                    <h3>請輸入身份證號碼</h3>
                </label>
            </div>
            <div>
                <h3><input type="text" id="idNumber" name="idNumber" required>
                    <button type="submit">驗證</button>
                </h3>
            </div>
        </form>
        <div>
            <h3>驗證結果</h3>
        </div>
        <div>
            <?php
            if (isset($isValid)) {
                if ($isValid) {
                    echo "<h3>身份證代號 " . $idNumber . " <span style='color:blue;'>有效</span>。</h3>";
                } else {
                    echo "<h3>身份證代號 " . $idNumber . " <span style='color:red;'>無效</span>。</h3>";
                }
            }

            //var_dump($idNumber); // 檢查輸入的身份證號碼
            //var_dump($isValid); // 檢查驗證結果
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            ?>
        </div>
    </div>






</body>

</html>