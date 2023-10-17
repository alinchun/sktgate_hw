<?php
// $_SERVER['REQUEST_METHOD']
// 瀏覽頁面時的請求方法。例如：「GET」、「HEAD」，「POST」，「PUT」。
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idNumber'])) {
	$idNumber = $_POST['idNumber'];
	$isValid = validateID($idNumber);
	// var_dump 是一個用於計算長度和輸出變數的函数
	// var_dump($idNumber);
	// var_dump($isValid);
}


function validateID($id)
{
	// strtoupper 是一個将字串轉換为大寫字母的函数
	// preg_replace是用於執行替换的函数，preg_replace(要被替換的字元, 要替換的字元, 要搜索的字串)
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
		echo $id."<br>";
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
		echo "<br>";
		echo intval($id[$i]);
		echo "*";
		echo $weight_factors[$i];
		echo "=";
		echo intval($id[$i]) * $weight_factors[$i];
		echo "(" . $checksum . ")";
		echo "<br>";
	}

	$remainder = $checksum % 10;
	if ($remainder === 0) {
		$checksum_digit = 0;
	} else {
		$checksum_digit = 10 - $remainder;
	}

	$isValid = $checksum_digit === intval($id[10]);
	var_dump($isValid); 
	return $isValid;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>身份證號碼驗證-展志</title>
</head>

<body>
	<div style="text-align: center;">
		<div>
			<h3>身份證號碼驗證</h3>
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
			
			// var_dump($idNumber); // 檢查輸入的身份證號碼
			// var_dump($isValid); // 檢查驗證結果
			// echo '<pre>';
			// print_r($_POST);
			// echo '</pre>';
			?>
		</div>
	</div>

</body>

</html>