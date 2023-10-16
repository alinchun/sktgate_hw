<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idNumber'])) {
    $idNumber = $_POST['idNumber'];
    $isValid = validateID($idNumber);
    var_dump($idNumber);
    var_dump($isValid);
}


function validateID($id)
{
    $id = strtoupper(preg_replace('/\s/', '', $id));

    // 验证身份证号码的长度是否为10位
    if (strlen($id) !== 10) {
        return false;
    }
    // var_dump($id); // 檢查輸入的身份證號碼

    $area_codes = array(
        'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14,
        'F' => 15, 'G' => 16, 'H' => 17, 'I' => 34, 'J' => 18,
        'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22, 'O' => 35,
        'P' => 23, 'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27,
        'U' => 28, 'V' => 29, 'W' => 32, 'X' => 30, 'Y' => 31,
        'Z' => 33
    );
    // var_dump($area_codes); // 檢查輸入的身份證號碼


    $first_char = $id[0];

    // 验证地区码是否有效
    if (!array_key_exists($first_char, $area_codes)) {
        var_dump($first_char);
        return false;
    }

    $weight_factors = array(1, 9, 8, 7, 6, 5, 4, 3, 2, 1);

    var_dump($weight_factors);

    $gender_code = intval($id[1]);
    if ($gender_code !== 1 && $gender_code !== 2) {
        return false;
    }
    var_dump($gender_code);





    $checksum = 0;
    for ($i = 0; $i < 9; $i++) {
        $checksum += intval($id[$i + 1]) * $weight_factors[$i];
    }

    $remainder = $checksum % 10;
    if ($remainder === 0) {
        $checksum_digit = 0;
    } else {
        $checksum_digit = 10 - $remainder;
    }

    $isValid = $checksum_digit === intval($id[9]);
    var_dump($isValid); // 检查验证结果
    return $isValid;



    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>身份證號碼驗證</title>
</head>

<body>
    <h1>身份證號碼驗證</h1>
    <form method="post">
        <label for="idNumber">輸入身份證代號: </label>
        <input type="text" id="idNumber" name="idNumber" required>
        <button type="submit">驗證</button>
    </form>
    <h2>
        <?php
        if (isset($isValid)) {
            if ($isValid) {
                echo "身份證代號有效。";
            } else {
                echo "身份證代號無效。";
            }
        }
        var_dump($idNumber); // 檢查輸入的身份證號碼
        var_dump($isValid); // 檢查驗證結果
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        ?>

    </h2>
</body>

</html>