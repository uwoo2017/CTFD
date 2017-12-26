<?php 

sampleCsv();


function sampleCsv() {

	try {

		//CSV形式で情報をファイルに出力のための準備
		$csvFileName = '/tmp/' . time() . rand() . '.csv';
		$res = fopen($csvFileName, 'w');
		if ($res === FALSE) {
			throw new Exception('ファイルの書き込みに失敗しました。');
		}

		// データ一覧。この部分を引数とか動的に渡すようにしましょう
		$dataList = array(
			array('hogehoge','mogemoge','mokomoko','aaa'),
			array('ddd','sss','eeeeee','ffff'),
		);

		// ループしながら出力
		foreach($dataList as $dataInfo) {

			// 文字コード変換。エクセルで開けるようにする
			mb_convert_variables('SJIS', 'UTF-8', $dataInfo);

			// ファイルに書き出しをする
			fputcsv($res, $dataInfo);
		}

		// ハンドル閉じる
		fclose($res);

		// ダウンロード開始
		header('Content-Type: application/octet-stream');

		// ここで渡されるファイルがダウンロード時のファイル名になる
		header('Content-Disposition: attachment; filename=sampaleCsv.csv'); 
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($csvFileName));
		readfile($csvFileName);

	} catch(Exception $e) {

		// 例外処理をここに書きます
		echo $e->getMessage();

	}
}
?>