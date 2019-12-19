<?php

/**
 * Returns HTML escaped variable
 *
 * @access	public
 * @param	mixed
 * @return	mixed
 */
if ( ! function_exists('html_escape'))
{
	function html_escape($var)
	{
		if (is_array($var))
		{
			return array_map('html_escape', $var);
		}
		else
		{
			$str = htmlspecialchars($var, ENT_COMPAT);

			// 「&#XXXXX;」対応
			if (preg_match("/&amp;#[0-9]*;/", $str)) {
				$str = preg_replace("/&amp;#([0-9]*;)/", "&#$1", $str);
			}

			// シングルクォーテーションのエスケープをグローバル仕様に併せるため、
			// 個別に対応。htmlspecialcharsで処理すると、&#039;になる。
			// （&#039;も&#39;も意味は同じ。）
			$str = str_replace(array("'"), array("&#39;"), $str);
			return $str;
		}
	}
}

// --------------------------------------------------------------------

/**
 * Returns HTML escaped variable
 *
 * @access	public
 * @param	mixed
 * @return	mixed
 */
if ( ! function_exists('html_escape_without_amp'))
{
	function html_escape_without_amp($var)
	{
		if (is_array($var))
		{
			return array_map('html_escape_without_amp', $var);
		}
		else
		{
			$str = str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;",  '&lt;', '&gt;'), $var);
			return $str;
		}
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mailAddressFormat'))
{
	/**
	 * mailAddressFormat
	 *
	 * メールアドレス用の文字列変換処理
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function mailAddressFormat($inputStr = '')
	{
		$tmpArray = explode('@', $inputStr);
		if (count($tmpArray) != 2)
			return "";

		list($address, $domain) = explode('@', $inputStr);
		$doubleQuote = Chr(34); // ダブルクォート
		//$backslash   = Chr(92); // バックスラッシュ

		//$convertAddress = $address;

		// バックスラッシュ [ \ ] をエスケープ
		//$convertStr = str_replace($backslash, "\{$backslash}", $inputStr);
		// ダブルクォート   [ " ] をエスケープ
		$convertAddress = str_replace($doubleQuote, "\\\"", $address);

		if ( preg_match("/[()\[\]:;,\"]/", $convertAddress) ) {
				$convertAddress = '"'.$convertAddress.'"';
		}

		$convertMailAddress = $convertAddress.'@'.$domain;
		// メールヘッダー用エンコード(ISO-2022-JP)に置換
		return $convertMailAddress;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mailFormat'))
{
	/**
	 * mailFormat
	 *
	 * メール用の文字列変換処理
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function mailFormat($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 機種依存文字の置換
		$retVal = mailDependedCharConvert($inputStr);

		// Outlook用に置換(タグ系の文字変換)
		$retVal = str_replace(array('<', '>'), array('＜', '＞'), $retVal);

		// メール用エンコード(ISO-2022-JP)に置換
//		$retVal = mb_convert_encoding($retVal, "ISO-2022-JP", "UTF-8");

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mailSubjectFormat'))
{
	/**
	 * mailSubjectFomrat
	 *
	 * メール件名用の文字列変換処理
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function mailSubjectFormat($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 機種依存文字の置換
		$retVal = dependedCharConvert($inputStr);

		// Outlook用に置換(タグ系の文字変換)
		$retVal = str_replace(array('<', '>'), array('＜', '＞'), $retVal);

		// メールヘッダー用エンコード(ISO-2022-JP)に置換
//		$retVal = mb_encode_mimeheader($retVal, "UTF-8", "B");
		$retVal = mb_encode_mimeheader($retVal, "iso-2022-jp", "B");

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('utfEscape'))
{
	/**
	 * utfEscape
	 *
	 * UTF-8エンコードの文字化け対策
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function utfEscape($inputStr = '')
	{
		$utf_escape_patterns =array(

			// 波ダッシュを全角チルダ(～)へ変換
			'/\xE3\x80\x9C/' =>"\xEF\xBD\x9E",

			// 全角マイナス記号(－)の変換
			'/\xE2\x88\x92/' =>"\xEF\xBC\x8D",

			// 双柱・平行記号(∥)の変換
			'/\xE2\x80\x96/' =>"\xE2\x88\xA5",

			// セント記号(￠)の変換
			'/\xC2\xA2/' =>"\xEF\xBF\xA0",

			// ポンド記号(￡)の変換
			'/\xC2\xA3/' =>"\xEF\xBF\xA1",

			// 否定記号(￢)の変換
			'/\xC2\xAC/' =>"\xEF\xBF\xA2",
		);

		return preg_replace(
				array_keys($utf_escape_patterns),
				array_values($utf_escape_patterns),
				$inputStr
			);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('htmlSanitize'))
{
	/**
	 * htmlSanitize
	 *
	 * HTML用サニタイズ
	 *
	 * html_escape + スペースを実態参照文字に置換
	 * → 2014/09/10 仕様変更により「スペースを実態参照文字に置換」の処理がなくなる
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function htmlSanitize($inputStr = '')
	{
		return html_escape($inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('j'))
{
	/**
	 * j(JSONTextFormat)
	 *
	 * json内のvalue用に整形
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */

	function j($inputStr='')
	{
		return preg_replace(
			['/\r/','/\n/','/"/']
			,['','\\n','&quot;']
			,$inputStr
		);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('h'))
{
	/**
	 * h(htmlEditFormat)
	 *
	 * HTML用表示用に整形
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $nullVal inputStrに値がない場合に表示する文字列
	 * @param int $maxLength 省略せずに表示する文字数 (default=-1、このときは省略なし)
	 * @param boolean $isAddDot 省略後に「…」に置き換えるかどうか (true のとき置き換える)
	 * @param string $omissionHtml 省略された場合に付加するHTML文字列
	 * @return string 変換後の文字列
	 */
	function h(
			$inputStr='',
			$nullVal='',
			$maxLength=-1,
			$isAddDot=true,
			$omissionHtml=''
	) {
		// 値がなければ初期値を返す
		if($inputStr === ''){
			return htmlSanitize($nullVal);
		}


		if($maxLength <= 1){
			return htmlSanitize(dependedCharConvert($inputStr));
		}
		else{
			$convertStr = shortNameConvert(
					dependedCharConvert($inputStr),
					$maxLength,
					$isAddDot,
					0,
					FALSE,
					$isLengthOver
			);

			if($isLengthOver === TRUE){
				return htmlSanitize($convertStr) . $omissionHtml;
			}
			else{
				return htmlSanitize($convertStr);
			}
		}


		return $inputStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('hr'))
{
	/**
	 * hr(htmlEditFormatCRLF)
	 *
	 * HTML用表示用に整形(改行有効)
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $nullVal inputStrに値がない場合に表示する文字列
	 * @param int $maxLength 省略せずに表示する文字数 (default=-1、このときは省略なし)
	 * @param boolean $isAddDot 省略後に「…」に置き換えるかどうか (true のとき置き換える)
	 * @param string $omissionHtml 省略された場合に付加するHTML文字列
	 * @return string 変換後の文字列
	 */
	function hr($inputStr='',
			$nullVal='',
			$maxLength=-1,
			$isAddDot=true,
			$omissionHtml=''
	) {
		// 値がなければ初期値を返す
		if($inputStr === ''){
			return htmlSanitize($nullVal);
		}

		if($maxLength <= 1){
			$convertStr = htmlSanitize(dependedCharConvert($inputStr));
			return preg_replace("/\r\n|\r|\n/", '<br/>', $convertStr);
		}
		else{
			$convertStr = shortNameConvert(
					dependedCharConvert($inputStr),
					$maxLength,
					$isAddDot,
					0,
					FALSE,
					$isLengthOver
			);

			if($isLengthOver === TRUE){
				$convertStr = htmlSanitize($convertStr) . $omissionHtml;
				return preg_replace("/\r\n|\r|\n/", '<br/>', $convertStr);
			}
			else{
				$convertStr = htmlSanitize($convertStr);
				return preg_replace("/\r\n|\r|\n/", '<br/>', $convertStr);
			}
		}

		return $inputStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('checkGarblesCharacters'))
{
	/**
	 * Check Garbles Characters
	 *
	 * 文字化けチェック → HTML用表示用に整形
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 */
	function checkGarblesCharacters($inputStr='') {
		// 文字コード変換処理
		// UTF-8 → SJIS → UTF-8 SJISでは表示されているがUTF-8では表示できないものをあぶりだす
		$inputStr = mb_convert_encoding(mb_convert_encoding($inputStr, 'SJIS', 'UTF-8'), 'UTF-8', 'SJIS');

		return utfEscape($inputStr); // UTF-8 のマッピングを修正する
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('hdr'))
{
	/**
	 * hdr(htmlEditFormatDelCRLF)
	 *
	 * HTML用表示用に整形(改行無効)
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $nullVal inputStrに値がない場合に表示する文字列
	 * @param int $maxLength 省略せずに表示する文字数 (default=-1、このときは省略なし)
	 * @param boolean $isAddDot 省略後に「…」に置き換えるかどうか (true のとき置き換える)
	 * @param string $omissionHtml 省略された場合に付加するHTML文字列
	 * @return string 変換後の文字列
	 */
	function hdr(
			$inputStr='',
			$nullVal='',
			$maxLength=-1,
			$isAddDot=true,
			$omissionHtml=''
	) {
		// 値がなければ初期値を返す
		if($inputStr === ''){
			return htmlSanitize($nullVal);
		}


		if($maxLength <= 1){
			$convertStr = htmlSanitize(dependedCharConvert($inputStr));
			return str_replace(PHP_EOL, '', $convertStr);
		}
		else{
			$convertStr = shortNameConvert(
					dependedCharConvert($inputStr),
					$maxLength,
					$isAddDot,
					0,
					FALSE,
					$isLengthOver
			);

			if($isLengthOver === TRUE){
				$convertStr = htmlSanitize($convertStr) . $omissionHtml;
				return str_replace(PHP_EOL, '', $convertStr);
			}
			else{
				$convertStr = htmlSanitize($convertStr);
				return str_replace(PHP_EOL, '', $convertStr);
			}
		}

		return $inputStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('i'))
{
	/**
	 * i(inputTextFormat)
	 *
	 * textboxのvalue用に整形
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function i($inputStr = '')
	{
		return str_replace('&nbsp;', ' ', h($inputStr));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('ta'))
{
	/**
	 * ta(textareaFormat)
	 *
	 * textareaのvalue用に整形
	 * &nbsp;をスペースに置換
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function ta($inputStr = '')
	{
		return str_replace('&nbsp;', ' ', h($inputStr));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('dt'))
{
	/**
	 * dt(datetime)
	 *
	 * 日付表示用に整形
	 * 変換できない場合は hを通す
	 * ※ Viewで呼び出すためメソッド名は短縮した形式。
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $formatStr 表示書式の指定
	 * @param string $default 変換できなかった場合に代わりで表示したい文字列
	 *  追加
	 *	DD => 日本の曜日
	 *	DDD => 日本の曜日フル
	 * @return string 変換後の文字列
	 */
	function dt($inputStr = '', $formatStr = 'Y/m/d', $default = NULL)
	{
		$value = strtotime($inputStr);
		if ($value === false) {
			return ($default === NULL) ? h($inputStr) : h($default);
		}

		$value = date($formatStr, $value);
		$value = str_replace(
			["MonMonMon", "TueTueTue", "WedWedWed", "ThuThuThu", "FriFriFri", "SatSatSat", "SunSunSun"],
			["月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日", "日曜日"],
			$value
		);
		$value = str_replace(
			["MonMon", "TueTue", "WedWed", "ThuThu", "FriFri", "SatSat", "SunSun"],
			["月", "火", "水", "木", "金", "土", "日"],
			$value
		);

		return $value;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('dateAddDelimiter'))
{
	/**
	 * dateAddDelimiter
	 *
	 * 数字のみの日付(例: 20131225)に年、月、日の区切り文字を付加する
	 *
	 * @param string $numericDate 数字のみの日付
	 * @param string $delimiter 区切り文字
	 * @return string
	 */
	function dateAddDelimiter($numericDate = '', $delimiter = '/')
	{
		$timestamp = strtotime($numericDate);
		if ($timestamp === FALSE) {
			return $numericDate;
		} else {
			return date("Y{$delimiter}m{$delimiter}d", $timestamp);
		}
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('convertADDateJaToEn'))
{
	/**
	 * convertADDateJaToEn
	 *
	 * 年、月、日が日本語表記の西暦を英語表記(「/」区切り)の西暦に変換する
	 *
	 * @param string $japanADDate
	 * @return string
	 */
	function convertADDateJaToEn($japanADDate = '')
	{
		return preg_replace('@^(\d+)年(\d+)月(\d+)日$@', '$1/$2/$3', $japanADDate);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('convertADDateEnToJa'))
{
	/**
	 * convertADDateEnToJa
	 *
	 * 英語表記(「/」区切り)の西暦を年、月、日が日本語表記の西暦に変換する
	 *
	 * @param string $ADDate
	 * @return string
	 */
	function convertADDateEnToJa($ADDate = '')
	{
		return preg_replace('@^(\d+)/(\d+)/(\d+)$@', '$1年$2月$3日', $ADDate);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('dbConvert'))
{
	/**
	 * dbConvert
	 *
	 * DB格納用に整形
	 * rtrimしてdependedCharaConvert
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function dbConvert($inputStr = '')
	{
		return dependedCharConvert(rtrim($inputStr));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('dependedCharConvert'))
{
	/**
	 * dependedCharConvert
	 *
	 * 機種依存文字の変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function dependedCharConvert($inputStr = '')
	{
		$source = array( "ｶﾞ","ｷﾞ","ｸﾞ","ｹﾞ","ｺﾞ","ｻﾞ","ｼﾞ","ｽﾞ","ｾﾞ","ｿﾞ","ﾀﾞ","ﾁﾞ","ﾂﾞ",
						"ﾃﾞ","ﾄﾞ","ﾊﾞ","ﾋﾞ","ﾌﾞ","ﾍﾞ","ﾎﾞ","ﾊﾟ","ﾋﾟ","ﾌﾟ","ﾍﾟ","ﾎﾟ","ｱ",
						"ｲ","ｳ","ｴ","ｵ","ｶ","ｷ","ｸ","ｹ","ｺ","ｻ","ｼ","ｽ","ｾ","ｿ","ﾀ","ﾁ",
						"ﾂ","ﾃ","ﾄ","ﾅ","ﾆ","ﾇ","ﾈ","ﾉ","ﾊ","ﾋ","ﾌ","ﾍ","ﾎ","ﾏ","ﾐ","ﾑ",
						"ﾒ","ﾓ","ﾔ","ﾕ","ﾖ","ﾗ","ﾘ","ﾙ","ﾚ","ﾛ","ﾜ","ｦ","ﾝ","ｧ","ｨ","ｩ",
						"ｪ","ｫ","ｬ","ｭ","ｮ","ｯ","ｰ","ﾞ","ﾟ","･","｢","｣","､","｡","①","②",
						"③","④","⑤","⑥","⑦","⑧","⑨","⑩","⑪","⑫","⑬","⑭","⑮","⑯","⑰","⑱",
						"⑲","⑳","Ⅰ","Ⅱ","Ⅲ","Ⅳ","Ⅴ","Ⅵ","Ⅶ","Ⅷ","Ⅸ","Ⅹ","№","℡","㈱","㈲",
						"㈹","㍾","㍽","㍼","㍻");
		$dest = array("ガ","ギ","グ","ゲ","ゴ","ザ","ジ","ズ","ゼ","ゾ","ダ","ヂ","ヅ",
						"デ","ド","バ","ビ","ブ","ベ","ボ","パ","ピ","プ","ペ","ポ","ア",
						"イ","ウ","エ","オ","カ","キ","ク","ケ","コ","サ","シ","ス","セ","ソ","タ","チ",
						"ツ","テ","ト","ナ","ニ","ヌ","ネ","ノ","ハ","ヒ","フ","ヘ","ホ","マ","ミ","ム",
						"メ","モ","ヤ","ユ","ヨ","ラ","リ","ル","レ","ロ","ワ","ヲ","ン","ァ","ィ","ゥ",
						"ェ","ォ","ャ","ュ","ョ","ッ","ー","゛","゜","・","「","」","、","。","(1)","(2)",
						"(3)","(4)","(5)","(6)","(7)","(8)","(9)","(10)","(11)","(12)","(13)","(14)","(15)","(16)","(17)","(18)",
						"(19)","(20)","1","2","3","4","5","6","7","8","9","10","No.","Tel","(株)","(有)",
						"(代)","明治","大正","昭和","平成");

		return str_replace($source, $dest, utfEscape($inputStr));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mailDependedCharConvert'))
{
	/**
	 * mailDependedCharConvert
	 *
	 * 機種依存文字の変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function mailDependedCharConvert($inputStr = '')
	{
		$source = array( "ｶﾞ","ｷﾞ","ｸﾞ","ｹﾞ","ｺﾞ","ｻﾞ","ｼﾞ","ｽﾞ","ｾﾞ","ｿﾞ","ﾀﾞ","ﾁﾞ","ﾂﾞ",
			"ﾃﾞ","ﾄﾞ","ﾊﾞ","ﾋﾞ","ﾌﾞ","ﾍﾞ","ﾎﾞ","ﾊﾟ","ﾋﾟ","ﾌﾟ","ﾍﾟ","ﾎﾟ","ｱ",
			"ｲ","ｳ","ｴ","ｵ","ｶ","ｷ","ｸ","ｹ","ｺ","ｻ","ｼ","ｽ","ｾ","ｿ","ﾀ","ﾁ",
			"ﾂ","ﾃ","ﾄ","ﾅ","ﾆ","ﾇ","ﾈ","ﾉ","ﾊ","ﾋ","ﾌ","ﾍ","ﾎ","ﾏ","ﾐ","ﾑ",
			"ﾒ","ﾓ","ﾔ","ﾕ","ﾖ","ﾗ","ﾘ","ﾙ","ﾚ","ﾛ","ﾜ","ｦ","ﾝ","ｧ","ｨ","ｩ",
			"ｪ","ｫ","ｬ","ｭ","ｮ","ｯ","ｰ","ﾞ","ﾟ","･","｢","｣","､","｡","①","②",
			"③","④","⑤","⑥","⑦","⑧","⑨","⑩","⑪","⑫","⑬","⑭","⑮","⑯","⑰","⑱",
			"⑲","⑳","Ⅰ","Ⅱ","Ⅲ","Ⅳ","Ⅴ","Ⅵ","Ⅶ","Ⅷ","Ⅸ","Ⅹ","№","℡","㈱","㈲",
			"㈹","㍾","㍽","㍼","㍻");
		$dest = array("ガ","ギ","グ","ゲ","ゴ","ザ","ジ","ズ","ゼ","ゾ","ダ","ヂ","ヅ",
			"デ","ド","バ","ビ","ブ","ベ","ボ","パ","ピ","プ","ペ","ポ","ア",
			"イ","ウ","エ","オ","カ","キ","ク","ケ","コ","サ","シ","ス","セ","ソ","タ","チ",
			"ツ","テ","ト","ナ","ニ","ヌ","ネ","ノ","ハ","ヒ","フ","ヘ","ホ","マ","ミ","ム",
			"メ","モ","ヤ","ユ","ヨ","ラ","リ","ル","レ","ロ","ワ","ヲ","ン","ァ","ィ","ゥ",
			"ェ","ォ","ャ","ュ","ョ","ッ","ー","゛","゜","・","「","」","、","。","(1)","(2)",
			"(3)","(4)","(5)","(6)","(7)","(8)","(9)","(10)","(11)","(12)","(13)","(14)","(15)","(16)","(17)","(18)",
			"(19)","(20)","1","2","3","4","5","6","7","8","9","10","No.","Tel","(株)","(有)",
			"(代)","明治","大正","昭和","平成");

		return str_replace($source, $dest, $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('textNormalize'))
{
	/**
	 * textNormalize
	 *
	 * 半角カナを全角に変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function textNormalize($inputStr = '')
	{
		$source = array( "ｶﾞ","ｷﾞ","ｸﾞ","ｹﾞ","ｺﾞ","ｻﾞ","ｼﾞ","ｽﾞ","ｾﾞ","ｿﾞ","ﾀﾞ","ﾁﾞ","ﾂﾞ",
						"ﾃﾞ","ﾄﾞ","ﾊﾞ","ﾋﾞ","ﾌﾞ","ﾍﾞ","ﾎﾞ","ﾊﾟ","ﾋﾟ","ﾌﾟ","ﾍﾟ","ﾎﾟ","ｱ",
						"ｲ","ｳ","ｴ","ｵ","ｶ","ｷ","ｸ","ｹ","ｺ","ｻ","ｼ","ｽ","ｾ","ｿ","ﾀ","ﾁ",
						"ﾂ","ﾃ","ﾄ","ﾅ","ﾆ","ﾇ","ﾈ","ﾉ","ﾊ","ﾋ","ﾌ","ﾍ","ﾎ","ﾏ","ﾐ","ﾑ",
						"ﾒ","ﾓ","ﾔ","ﾕ","ﾖ","ﾗ","ﾘ","ﾙ","ﾚ","ﾛ","ﾜ","ｦ","ﾝ","ｧ","ｨ","ｩ",
						"ｪ","ｫ","ｬ","ｭ","ｮ","ｯ");
		$dest = array("ガ","ギ","グ","ゲ","ゴ","ザ","ジ","ズ","ゼ","ゾ","ダ","ヂ","ヅ",
						"デ","ド","バ","ビ","ブ","ベ","ボ","パ","ピ","プ","ペ","ポ","ア",
						"イ","ウ","エ","オ","カ","キ","ク","ケ","コ","サ","シ","ス","セ","ソ","タ","チ",
						"ツ","テ","ト","ナ","ニ","ヌ","ネ","ノ","ハ","ヒ","フ","ヘ","ホ","マ","ミ","ム",
						"メ","モ","ヤ","ユ","ヨ","ラ","リ","ル","レ","ロ","ワ","ヲ","ン","ァ","ィ","ゥ",
						"ェ","ォ","ャ","ュ","ョ","ッ");

		return str_replace($source, $dest, $inputStr);
	}
}


// ------------------------------------------------------------------------

if ( ! function_exists('asciiNormalize'))
{
	/**
	 * asciiNormalize
	 *
	 * ASCII文字の全角->半角変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function asciiNormalize($inputStr = '')
	{
		$source = array("　","！","”","＃","＄","％","＆","’","（","）","＊","＋","－","．","／",
			"０","１","２","３","４","５","６","７","８","９","：","；","＜","＝","＞","？","＠",
			"Ａ","Ｂ","Ｃ","Ｄ","Ｅ","Ｆ","Ｇ","Ｈ","Ｉ","Ｊ","Ｋ","Ｌ","Ｍ","Ｎ","Ｏ","Ｐ","Ｑ",
			"Ｒ","Ｓ","Ｔ","Ｕ","Ｖ","Ｗ","Ｘ","Ｙ","Ｚ","［","￥","］","＾","＿","｀","ａ","ｂ",
			"ｃ","ｄ","ｅ","ｆ","ｇ","ｈ","ｉ","ｊ","ｋ","ｌ","ｍ","ｎ","ｏ","ｐ","ｑ","ｒ","ｓ",
			"ｔ","ｕ","ｖ","ｗ","ｘ","ｙ","ｚ","｛","｜","｝","～","，","‐","ー","―");
		$dest = array(" ","!","\"","#","\$","%","&","'","(",")","*","+","-",".","/","0","1","2",
			"3","4","5","6","7","8","9",":",";","<","=",">","?","@","A","B","C","D","E","F","G",
			"H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","[","\\",
			"]","^","_","`","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q",
			"r","s","t","u","v","w","x","y","z","{","|","}","~",",","-","-","-");

		return str_replace($source, $dest, $inputStr);
	}
}


// ------------------------------------------------------------------------

if ( ! function_exists('telNormalize'))
{
	/**
	 * telNormalize
	 *
	 * 電話番号の正規化
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function telNormalize($inputStr = '')
	{
		$source = array("０","１","２","３","４","５","６","７","８","９","ー","－","（","）","―","‐");
		$dest = array("0","1","2","3","4","5","6","7","8","9","-","-","(",")","-","-");

		return str_replace($source, $dest, $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('zipNormalize'))
{
	/**
	 * zipNormalize
	 *
	 * 郵便番号の正規化
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function zipNormalize($inputStr = '')
	{
		$source = array("０","１","２","３","４","５","６","７","８","９","ー","－","―","‐");
		$dest = array("0","1","2","3","4","5","6","7","8","9","-","-","-","-");

		return str_replace($source, $dest, $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('numNormalize'))
{
	/**
	 * numNormalize
	 *
	 * 数字の正規化
	 * ・全角数字を半角数字に置き換える
	 * ・全角マイナスを半角マイナスに置き換える
	 * ・全角ピリオドを半角ピリオドに置き換える
	 * ・'000'の入力は''となる
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param boolean $zeroSuppress 先頭のゼロを除去する場合は TRUE
	 * @return string 変換後の文字列
	 */
	function numNormalize($inputStr = '', $zeroSuppress = TRUE)
	{
		$source = array("０","１","２","３","４","５","６","７","８","９","ー","．","－","―","‐");
		$dest = array("0","1","2","3","4","5","6","7","8","9","-",".","-","-","-");

		if($zeroSuppress){
			return preg_replace(
					'/^(-|)0+/', '$1',
					str_replace($source, $dest, $inputStr)
			);
		}

		return str_replace($source, $dest, $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('numExtraction'))
{
	/**
	 * numExtraction
	 *
	 * 半角数字以外除去
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function numExtraction($inputStr = '')
	{
		return preg_replace('/[^0-9]/', '', $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('withinIDRange'))
{
	/**
	 * withinIDRange
	 *
	 * 入力値がDB問い合わせの範囲内(0～2147483647)の整数値でなければ-1に変換する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function withinIDRange($inputStr = '')
	{
		if ($inputStr == '' || isWithinIDRange($inputStr)) {
			return $inputStr;
		}
		return -1;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('numNormalizeZeroAllowed'))
{
	/**
	 * numNormalizeZeroAllowed
	 *
	 * 数字の正規化
	 * ・全角数字を半角数字に置き換える
	 * ・全角マイナスを半角マイナスに置き換える
	 * ・全角ピリオドを半角ピリオドに置き換える
	 * ・'000'の入力は'0'となる
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param boolean $zeroSuppress 先頭のゼロを除去する場合は TRUE
	 * @return string 変換後の文字列
	 */
	function numNormalizeZeroAllowed($inputStr = '', $zeroSuppress = TRUE)
	{
		$source = array("０","１","２","３","４","５","６","７","８","９","ー","．","－","―","‐");
		$dest = array("0","1","2","3","4","5","6","7","8","9","-",".","-","-","-");

		if($zeroSuppress){
			return preg_replace(
					'/^(-|)(?:0(?=\d))+/', '$1',
					str_replace($source, $dest, $inputStr)
			);
		}

		return str_replace($source, $dest, $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('numEmSize'))
{
	/**
	 * numEmSize
	 *
	 * 数字を全角に変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function numEmSize($inputStr = '')
	{
		$source = array("0","1","2","3","4","5","6","7","8","9","-",".");
		$dest = array("０","１","２","３","４","５","６","７","８","９","－","．");

		return str_replace($source, $dest, $inputStr);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('shortNameConvert'))
{
	/**
	 * shortNameConvert
	 *
	 * 指定文字数での省略
	 *
	 *   ※ maxLength目が「…」になる。
	 *	  IsAddDot=falseの場合、maxLengthで単純に打ち切る
	 *
	 *   ※ 改行コードはカウントしない
	 *   ※ 改行コードが#Chr(13)##Chr(10)#に統一される
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $maxLength 省略せずに表示する文字数
	 * @param boolean $isAddDot 省略後の文字列を「…」に置き換えるか (trueの場合、置き換える)
	 * @param int $forceBrNum 指定個数の改行が検出された場合、それ以降を省略 (0の場合は、この処理はしない)
	 * @param boolean $isConvertBR <br>を改行として扱うか (TRUEの場合、改行として扱う)
	 * @return string 変換後の文字列
	 */
	function shortNameConvert(
			$inputStr = '',
			$maxLength = '',
			$isAddDot = TRUE,
			$forceBrNum = 0,
			$isConvertBR = FALSE,
			&$isLengthOver = FALSE
	) {
		/**
		 * TODO
		 * 改行コードの変換は必要？？
		 */

		$tempStr = '';
		$crlfCount = 0;
		$currentLength = 0;
		$splitStr = preg_split('/\r\n|\n|\r/', $inputStr, NULL);

		foreach($splitStr as $line){
			// あと何文字追加できる？
			$remainCharacter = $maxLength - $currentLength;
			// 追加できる文字を切り出す
			$addableCharacter = mb_substr($line, 0, $remainCharacter);

			// 追加！
			$tempStr .= $addableCharacter;

			// 改行コードカウントをインクリメント
			$crlfCount++;

			// 指定の改行コード数に達していたら、ループを抜ける
			if($forceBrNum !== 0 && $crlfCount >= $forceBrNum){
				if($isAddDot){
					$tempStr .= "…";
				}
				$isLengthOver = TRUE;
				break;
			}

			// 現在の文字列長(改行コードを除く)
			$currentLength += mb_strlen($addableCharacter);

			// 指定文字列長に達していたら、ループを抜ける
			if($currentLength >= $maxLength &&
			   $currentLength < mb_strlen($inputStr)
			){ // 入力文字数が最大文字数と同じ時は …　をつけない
				if($isAddDot){
					$tempStr .= "…";
				}
				$isLengthOver = TRUE;
				break;
			}

			// まだ文字列長に余裕があれば改行コードを足しておく
			$tempStr .= PHP_EOL;
		}

		return $tempStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('shortNameConvertNoneLastEOL'))
{
	/**
	 * shortNameConvertNoneLastEOL
	 *
	 * 指定文字数での省略 ---一つ上のメソッドと異なる点は最後尾に改行が入らないこと
	 *
	 *   ※ maxLength目が「…」になる。
	 *	  IsAddDot=falseの場合、maxLengthで単純に打ち切る
	 *
	 *   ※ 改行コードはカウントしない
	 *   ※ 改行コードが#Chr(13)##Chr(10)#に統一される
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $maxLength 省略せずに表示する文字数
	 * @param boolean $isAddDot 省略後の文字列を「…」に置き換えるか (trueの場合、置き換える)
	 * @param int $forceBrNum 指定個数の改行が検出された場合、それ以降を省略 (0の場合は、この処理はしない)
	 * @param boolean $isConvertBR <br>を改行として扱うか (TRUEの場合、改行として扱う)
	 * @return string 変換後の文字列
	 */
	function shortNameConvertNoneLastEOL(
			$inputStr = '',
			$maxLength = '',
			$isAddDot = TRUE,
			$forceBrNum = 0,
			$isConvertBR = FALSE,
			&$isLengthOver = FALSE
	) {
		/**
		 * TODO
		 * 改行コードの変換は必要？？
		 */

		$tempStr = '';
		$crlfCount = 0;
		$currentLength = 0;
		$splitStr = preg_split('/\r\n|\n|\r/', $inputStr, NULL);

		foreach($splitStr as $line){
			// あと何文字追加できる？
			$remainCharacter = $maxLength - $currentLength;
			// 追加できる文字を切り出す
			$addableCharacter = mb_substr($line, 0, $remainCharacter);

			// 追加！
			$tempStr .= $addableCharacter;

			// 改行コードカウントをインクリメント
			$crlfCount++;

			// 指定の改行コード数に達していたら、ループを抜ける
			if($forceBrNum !== 0 && $crlfCount >= $forceBrNum){
				if($isAddDot){
					$tempStr .= "…";
				}
				$isLengthOver = TRUE;
				break;
			}

			// 現在の文字列長(改行コードを除く)
			$currentLength += mb_strlen($addableCharacter);

			// 指定文字列長に達していたら、ループを抜ける
			if($currentLength >= $maxLength &&
			   $currentLength < mb_strlen($inputStr)
			){ // 入力文字数が最大文字数と同じ時は …　をつけない
				if($isAddDot){
					$tempStr .= "…";
				}
				$isLengthOver = TRUE;
				break;
			}

		}

		return $tempStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('crlf2br'))
{
	/**
	 * crlf2Br
	 *
	 * CRLF-><BR>
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function crlf2br($inputStr = '')
	{
		return str_replace(PHP_EOL, '<br />', dependedCharConvert($inputStr));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('hnsr'))
{
	/**
	 * hnsr(htmlEditFormatNoSanitizeCRLF)
	 *
	 * HTML表示用に整形する（改行有効＋サニタイズなし）。
	 * ・機種依存文字を変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param string $nullVal 省略せずに表示する文字数 (default=-1、このときは省略なし)
	 * @param int $maxLength 省略後に「…」に置き換えるかどうか (true のとき置き換える)
	 * @param boolean $isAddDot 省略された場合に付加するHTML文字列
	 * @param string $omissionHtml 指定個数の改行が検出された場合、それ以降を省略 (0の場合は、この処理はしない)
	 * @return string 変換後の文字列
	 */
	function hnsr(
			$inputStr='',
			$nullVal='',
			$maxLength=-1,
			$isAddDot=TRUE,
			$omissionHtml=''
	) {
		// 値がなければ初期値を返す
		if($inputStr === ''){
			return $nullVal;
		}

		if($maxLength <= 1){
			$convertStr = dependedCharConvert($inputStr);
			return str_replace(PHP_EOL, '<br />', $convertStr);
		}
		else{
			$convertStr = shortNameConvert(
					dependedCharConvert($inputStr),
					$maxLength,
					$isAddDot,
					0,
					FALSE,
					$isLengthOver
			);

			if($isLengthOver === TRUE){
				$convertStr = $convertStr . $omissionHtml;
				return str_replace(PHP_EOL, '<br />', $convertStr);
			}
			else{
				return str_replace(PHP_EOL, '<br />', $convertStr);
			}
		}


		return $inputStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('crlfCountConvert'))
{
	/**
	 * crlfCountConvert
	 *
	 * 特定の数の改行コードを残してあとは削除する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param int $forceBrNum 指定個数の改行が検出された場合、それ以降を削除 (0の場合は全削除)
	 * @return string 変換後の文字列
	 */
	function crlfCountConvert($inputStr='', $forceBrNum = 0)
	{
		$splitStr = preg_split('/\r\n|\n|\r/', $inputStr, NULL);
		$crlfCount = 0;
		$convertStr = '';

		foreach($splitStr as $line){
			// 文字列連結
			$convertStr .= $line;

			// 現在の改行回数が指定の改行回数よりも少ない場合は改行コードを連結
			if($crlfCount < forceBrNum){
				$convertStr .= PHP_EOL;
				// 改行回数インクリメント
				$crlfCount++;
			}

		}
		return $inputStr;
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('hrcd'))
{
	/**
	 * hrcd(htmlEditCRLFCountFormat)
	 *
	 * HTML表示用に整形する（＋空行削除）
	 * ・改行無効にしたうえで、指定文字数で改行する
	 * ・機種依存文字を変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param int $countBR 改行コードの挿入位置
	 * @param string $nullVal  inputStrに値がない場合に表示する文字列
	 * @param int $maxLength 省略せずに表示する文字数 (default=-1、このときは省略なし)
	 * @param boolean $isAddDot 省略後に「…」に置き換えるかどうか (TRUE のとき置き換える)
	 * @param string $omissionHtml 省略された場合に付加するHTML文字列
	 * @return string 変換後の文字列
	 */
	function hrcd(
			$inputStr='',
			$countBR=99999,
			$nullVal='',
			$maxLength=-1,
			$isAddDot=TRUE,
			$omissionHtml=''
	) {
		$inputStr = str_replace("\r\n", "\n", $inputStr);
		$inputStr = preg_replace("/\n+/", "\n", $inputStr);
		$inputStr = trim($inputStr);
		$result = hrc($inputStr, $countBR,$nullVal,$maxLength,$isAddDot,$omissionHtml);
		return $result;
	}
}

if ( ! function_exists('hrc'))
{
	/**
	 * hrc(htmlEditCRLFCountFormat)
	 *
	 * HTML表示用に整形する
	 * ・改行無効にしたうえで、指定文字数で改行する
	 * ・機種依存文字を変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param int $countBR 改行コードの挿入位置
	 * @param string $nullVal  inputStrに値がない場合に表示する文字列
	 * @param int $maxLength 省略せずに表示する文字数 (default=-1、このときは省略なし)
	 * @param boolean $isAddDot 省略後に「…」に置き換えるかどうか (TRUE のとき置き換える)
	 * @param string $omissionHtml 省略された場合に付加するHTML文字列
	 * @return string 変換後の文字列
	 */
	function hrc(
			$inputStr='',
			$countBR=99999,
			$nullVal='',
			$maxLength=-1,
			$isAddDot=TRUE,
			$omissionHtml=''
	) {
		// 値がなければ初期値を返す
		if($inputStr === ''){
			return $nullVal;
		}

		// $inputStr の改行を無効にし、1行の文字列に
		$line = preg_replace('/\r\n|\n|\r/', '', $inputStr, NULL);
		/*
		 * ------------------------------------------------
		 * 省略なし
		 * ------------------------------------------------
		 */
		if($maxLength <= 1){
			$convertStr = dependedCharConvert($line);

			$addstr = '';
			$beginIndex = 0;
			$length = 1;
			while( ($subStr = mb_substr($convertStr, $beginIndex, 1)) !== ''){
				// 切り出した1文字を追加
				$addstr .= $subStr;

				// 切り出し位置を進める
				$beginIndex++;

				// 指定文字数を追加したら改行コードを追加
				$beginIndex % $countBR == 0 ? $addstr .= PHP_EOL : '' ;
			}
			return str_replace(PHP_EOL, '<br />', htmlSanitize($addstr));
		}
		/*
		 * ------------------------------------------------
		 * 省略あり
		 * ------------------------------------------------
		 */
		else{
			$convertStr = shortNameConvert(
					dependedCharConvert($inputStr),
					$maxLength,
					$isAddDot,
					0,
					FALSE,
					$isLengthOver
			);

			$addstr = '';
			$beginIndex = 0;
			$length = 1;
			while( ($subStr = mb_substr($convertStr, $beginIndex, 1)) !== ''){
				// 切り出した1文字を追加
				$addstr .= $subStr;

				// 切り出し位置を進める
				$beginIndex++;

				// 指定文字数を追加したら改行コードを追加
				$beginIndex % $countBR == 0 ? $addstr .= PHP_EOL : '' ;
			}

			if($isLengthOver === TRUE){
				return str_replace(
						PHP_EOL, '<br />',
						htmlSanitize($addstr) . $omissionHtml
				);
			}
			else{
				return str_replace(PHP_EOL, '<br />', htmlSanitize($addstr));
			}
		}

		return $inputStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvExportFormat'))
{
	/**
	 * csvExportFormat
	 *
	 * CSVエクスポート用データに整形する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function csvExportFormat($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 機種依存文字の置換
		$retVal = dependedCharConvert($inputStr);

		// 改行を <br> に変換
		$retVal = preg_replace('/\r\n|\n|\r/', '<br>', $retVal);

		// カンマの変換
		$retVal = str_replace(',', '，', $retVal);

		// ダブルコーテーションの変換
		$retVal = str_replace('"', '”', $retVal);

		// ダブルコーテーションで括る
		$retVal = '"' . $retVal . '"';

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvImportFormat'))
{
	/**
	 * csvImportFormat
	 *
	 * CSVインポート用データに整形する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function csvImportFormat($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 機種依存文字の置換
		$retVal = dependedCharConvert($inputStr);

		// ダブルコーテーションの変換
		$retVal = str_replace('""', '"', $retVal);

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvImportFormatCRLF'))
{
	/**
	 * csvImportFormat
	 *
	 * CSVインポート用データに整形する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function csvImportFormatCRLF($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// ダブルコーテーションの変換
		$retVal = str_replace('""', '"', $inputStr);

		// 改行文字の変換
		$retVal = str_replace(
			array('<br />', '<br>', '<BR />', '<BR>', '\r\n', '\n'),
			PHP_EOL,
			$retVal
		);

		// 機種依存文字の置換
		$retVal = dependedCharConvert($retVal);

		// 各種変換後に改行文字のみ残る場合
		$retVal = preg_replace('/^[' . PHP_EOL . ']+$/u', '', $retVal);

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('fullSpaceConvert'))
{
	/**
	 * 入力変換 全角スペース → 半角スペース
	 *
	 * @access public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function fullSpaceConvert($inputStr = "")
	{
		$str = mb_convert_encoding($inputStr, 'UTF-8', 'auto');
		$str = mb_ereg_replace("　", " ", $str);

		return $str;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('zenKanaToHanKana'))
{
	/**
	 * zenKanaToHanKana
	 *
	 * 全角カタカナを半角に変換
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function zenKanaToHanKana($inputStr = '')
	{
		$source = array("ヴ","ヰ","ヱ","ガ","ギ","グ","ゲ","ゴ","ザ","ジ","ズ","ゼ","ゾ","ダ","ヂ","ヅ","デ","ド","バ","ビ","ブ","ベ","ボ","パ","ピ","プ","ペ","ポ","ア","イ","ウ","エ","オ","カ","キ","ク","ケ","コ","サ","シ","ス","セ","ソ","タ","チ","ツ","テ","ト","ナ","ニ","ヌ","ネ","ノ","ハ","ヒ","フ","ヘ","ホ","マ","ミ","ム","メ","モ","ヤ","ユ","ヨ","ラ","リ","ル","レ","ロ","ワ","ヲ","ン","ァ","ィ","ゥ","ェ","ォ","ャ","ュ","ョ","ッ","ー","゛","゜","・","「","」","、","。");
		$dest = array("ｳﾞ","ｲ","ｴ","ｶﾞ","ｷﾞ","ｸﾞ","ｹﾞ","ｺﾞ","ｻﾞ","ｼﾞ","ｽﾞ","ｾﾞ","ｿﾞ","ﾀﾞ","ﾁﾞ","ﾂﾞ","ﾃﾞ","ﾄﾞ","ﾊﾞ","ﾋﾞ","ﾌﾞ","ﾍﾞ","ﾎﾞ","ﾊﾟ","ﾋﾟ","ﾌﾟ","ﾍﾟ","ﾎﾟ","ｱ","ｲ","ｳ","ｴ","ｵ","ｶ","ｷ","ｸ","ｹ","ｺ","ｻ","ｼ","ｽ","ｾ","ｿ","ﾀ","ﾁ","ﾂ","ﾃ","ﾄ","ﾅ","ﾆ","ﾇ","ﾈ","ﾉ","ﾊ","ﾋ","ﾌ","ﾍ","ﾎ","ﾏ","ﾐ","ﾑ","ﾒ","ﾓ","ﾔ","ﾕ","ﾖ","ﾗ","ﾘ","ﾙ","ﾚ","ﾛ","ﾜ","ｦ","ﾝ","ｧ","ｨ","ｩ","ｪ","ｫ","ｬ","ｭ","ｮ","ｯ","ｰ","ﾞ","ﾟ","･","｢","｣","､","｡");

		return str_replace($source, $dest, utfEscape($inputStr));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('likeEscape'))
{
	/**
	 * likeEscape
	 *
	 * SQLのLIKE句で特別な意味を持つ文字をエスケープする。
	 * ESCAPE句ではなく文字列内のエスケープで解決する。
	 * シングルクォートなどのエスケープは行われないため、
	 * SQLとして組み立てる際はプレースホルダを使うなど別途のエスケープが必要。
	 *
	 * 典型的な使用例
	 *  $sql = "… XxxName LIKE :SearchText …";
	 *  $param['SearchText'] = '%' . likeEscape($searchText) . '%';
	 *
	 * CIのドライバでは escape_str($str, TRUE) メソッドが存在している
	 *
	 * @param string $inputStr 入力文字列
	 * @return string エスケープ後の文字列
	 */
	function likeEscape($inputStr = '')
	{
		// SQLServer専用
		return strtr($inputStr, [
			'%' => '[%]',
			'_' => '[_]',
			'[' => '[[]',
		]);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvExportFormatForASP'))
{
	/**
	 * csvExportFormatForASP
	 *
	 * CSVエクスポート用データに整形する（ASP連携用）
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param boolean $isEnquote （Optional）強制エンクォート（default=FALSE）
	 * @return string 変換後の文字列
	 */
	function csvExportFormatForASP($inputStr = '', $isEnquote = FALSE, $isHtml = FALSE)
	{
		// 変換した文字列
		$retVal = '';

		// ダブルコーテーションの変換
		$retVal = str_replace('"', '""', $inputStr);

		// 機種依存文字の置換
		$retVal = dependedCharConvert($retVal);

		// <> を＜＞に変換
		if(!$isHtml){
			$retVal = str_replace(['<', '>'], ['＜', '＞'], $retVal);
		}

		$retVal = '"' . $retVal . '"';

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvExportFormatForAlliance'))
{
	/**
	 * csvExportFormat
	 *
	 * CSVエクスポート用データに整形する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function csvExportFormatForAlliance($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 改行を <br> に変換
		$retVal = preg_replace('/\r\n|\n|\r/', '<br>', $inputStr);

		// タブの変換
		$retVal = str_replace("\t", " ", $retVal);

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvExportFormatForWorkDataTsv'))
{
	/**
	 * csvExportFormatForWorkDataTsv
	 *
	 * TSVエクスポート用データに整形する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function csvExportFormatForWorkDataTsv($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 半角ダブルクォートを全角に変換
		$retVal = str_replace("\"", "”", $inputStr);

		// タブを全角スペースに変換
		$retVal = str_replace("\t", "　", $retVal);

		// 半角ダブルクォートで囲む
		$retVal = '"' . $retVal . '"';

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('csvExportFormatForApiS'))
{
	/**
	 * csvExportFormat
	 *
	 * CSVエクスポート用データに整形する
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function csvExportFormatForApiS($inputStr = '')
	{
		// 変換した文字列
		$retVal = '';

		// 改行を \n に変換
		$retVal = preg_replace('/\r\n|\n|\r/', '\n', $inputStr);
		
		// タブを半角スペースに変換
		$retVal = str_replace("\t", " ", $retVal);

		return $retVal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('rstrim'))
{
	/**
	 * rstrim
	 *
	 * 文字列末端の全/半角スペース削除
	 *
	 * @access public
	 * @param string $str 変換対象の文字列
	 * @return string 変換後の文字列
	 */
	function rstrim($str = '')
	{
		return preg_replace('/[ 　]+$/u', '', $str);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mb_chunk_split'))
{
	/**
	 * mb_chunk_split
	 *
	 * 文字列をより小さな部分に分割する
	 * chunk_splitは日本語が入っているとうまくいかないので作成
	 *
	 * @access public
	 * @param string $body 分割したい文字列
	 * @param string $chunklen 各部分の長さ
	 * @param string end 行末の区切り
	 * @return string 変換後の文字列
	 */
	function mb_chunk_split($body = '', $chunklen = 76, $end = "\r\n" )
	{
		if(mb_strlen($body)<=$chunklen){
			return $body;
		}

		$retrunStr = '';
		$strLen = mb_strlen($body)-1;
		for($i=0; $i <= $strLen; $i+=$chunklen){
			if($i > 0){
			$retrunStr .= $end;
			}
			$retrunStr .= mb_substr($body,$i,$chunklen);
		}

		return $retrunStr;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('abbrBadgeNum'))
{
	/**
	 * abbrBadgeNum
	 *
	 * 「50+」など通知する数字を略記します
	 * （スマホサイトのバッジへの適用を想定）
	 *
	 * @access public
	 * @param integer $num 変換対象の文字列
	 * @param integer $border [OPTIONAL] 「+」表記する値。この数字を超える場合に+が付く
	 * @return string 略記数字
	 */
	function abbrBadgeNum($num, $border = 50)
	{
		if ($num > $border) {
			return $border . '+';
		} else {
			return strval($num);
		}
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('substrFormInput'))
{
	/**
	 * substrFormInput
	 *
	 * 文字列を指定された文字数でカット
	 *
	 * @access	public
	 * @param string $inputStr 変換対象の文字列
	 * @param int $val 文字数
	 * @return string 文字列
	 */
	function substrFormInput($inputStr = '', $val = 400)
	{
		if (preg_match("/[^0-9]/", $val)) {
			return FALSE;
		}
		return mb_substr($inputStr, 0, $val);
	}
}

	// ------------------------------------------------------------------------

if ( ! function_exists('fold'))
{
	/**
	 * fold
	 *
	 * 文字列を折り返す
	 *
	 * @param string $str 文字列
	 * @param int $width 文字数
	 * @param int $lineLen 行数
	 * @return string 改行された
	 */
	function fold($str, $width=0, $lineLen=0) {

		$cr = "\r\n";
		$indent = "";
		$encode = "UTF-8";

		$out = $indent;

		// 文字コードの設定
		if(!isset($encode)) {
			$encode = mb_internal_encoding();
		}

		// 改行を全角スペースに置き換えする
		$str = str_replace("\r", "", $str);
		$str = str_replace("\n", "　", $str);

		// 文字列整形（<>を＜＞に変換する）
		$str = str_replace(['<', '>'], ['＜', '＞'], $str);
		
		// 半角カナを全角カナに変換する
		$str = mb_convert_kana($str, 'K', $encode);
		
		// 文字数の取得
		$lenmax = mb_strlen($str,$encode);

		// 折り返し
		$nowlen = 0;
		$totalLen = 0;
		$crlfCount = 1;
		$crSize = mb_strwidth($cr . $indent, $encode);
		for ($i = 0; $i < $lenmax; $i++) {
			$c = mb_substr($str, $i, 1, $encode);
//			$cw = mb_strwidth($c, $encode);
			$cw = strlen(mb_convert_encoding($c, 'SJIS-win', $encode));
			if(($nowlen + $cw) > $width) {

				if ($lineLen != 0 && $crlfCount >= $lineLen) {
					$out = mb_substr($out, 0, $totalLen) . "…";
					break;
				}

				$out .= $cr . $indent . $c;
				$nowlen = $cw;
				$totalLen = ($totalLen + 1 + $crSize);
				$crlfCount++;
			} else {
				$out .= $c;
				$nowlen += $cw;
				$totalLen++;
			}
		}

		return $out;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('convertURLToLink'))
{
	/**
	 * 文字列に含まれるURLをリンクにする
	 *
	 * @param $str 文字列
	 * @return string 変換後文字列
	 */
	function convertURLToLink($str) {
		return mb_ereg_replace('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', '<a href="\1" target="_blank">\1</a>', $str);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('isTimeDuplication'))
{
	/**
	 * ２つの時間帯が重複しているかをチェック ENDTIMEがDBのデフォルト値の場合はSTARTTIMEと同じ値を代入する
	 *
	 * @param int $startTime1 一つ目の時間範囲の開始時間
	 * @param int $endTime1 一つ目の時間範囲の終了時間
	 * @param int $startTime2 二つ目の時間範囲の開始時間
	 * @param int $endTime2 二つ目の時間範囲の終了時間
	 * @return bool 重複している場合はtrueを返す
	 */
	function isTimeDuplication($startTime1, $endTime1, $startTime2, $endTime2) {
		$db_default_date_time = '1900-01-01 00:00:00';
		if($endTime1 == $db_default_date_time.'.000'){
			$endTime1 = $startTime1;
		}
		if($endTime2 == $db_default_date_time.'.000'){
			$endTime2 = $startTime2;
		}
		return (strtotime($startTime1) <= strtotime($endTime2) && strtotime($startTime2) <= strtotime($endTime1));
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('hashLoginID')) {
    /**
     * ログインIDのハッシュ値
     * @param $loginID
     * @return string
     */
    function hashLoginID($loginID)
    {
        return md5(strtolower($loginID));
    }
}

if ( ! function_exists('hashLoginPW')) {
    /**
     * ログインPWのハッシュ値
     * @param $loginPW
     * @return string
     */
    function hashLoginPW($loginPW)
    {
        return md5($loginPW);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('asciiConvertFullWidth'))
{
    /**
     * asciiConvertFullWidth
     *
     * ASCII文字の半角->全角変換
     *
     * @access	public
     * @param string $inputStr 変換対象の文字列
     * @return string 変換後の文字列
     */
    function asciiConvertFullWidth($inputStr = '')
    {
        $source = array(" ","!","\"","#","\$","%","&","'","(",")","*","+","-",".","/","0","1","2",
            "3","4","5","6","7","8","9",":",";","<","=",">","?","@","A","B","C","D","E","F","G",
            "H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","[","\\",
            "]","^","_","`","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q",
            "r","s","t","u","v","w","x","y","z","{","|","}","~",",","-","-","-");
        $dest = array("　","！","”","＃","＄","％","＆","’","（","）","＊","＋","－","．","／",
            "０","１","２","３","４","５","６","７","８","９","：","；","＜","＝","＞","？","＠",
            "Ａ","Ｂ","Ｃ","Ｄ","Ｅ","Ｆ","Ｇ","Ｈ","Ｉ","Ｊ","Ｋ","Ｌ","Ｍ","Ｎ","Ｏ","Ｐ","Ｑ",
            "Ｒ","Ｓ","Ｔ","Ｕ","Ｖ","Ｗ","Ｘ","Ｙ","Ｚ","［","￥","］","＾","＿","｀","ａ","ｂ",
            "ｃ","ｄ","ｅ","ｆ","ｇ","ｈ","ｉ","ｊ","ｋ","ｌ","ｍ","ｎ","ｏ","ｐ","ｑ","ｒ","ｓ",
            "ｔ","ｕ","ｖ","ｗ","ｘ","ｙ","ｚ","｛","｜","｝","～","，","‐","ー","―");

        return str_replace($source, $dest, $inputStr);
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('deleteHyphen'))
    {
        /**
         * deleteHyphen
         *
         * 文字列からハイフンを取り除く
         *
         * @access	public
         * @param string $inputStr 変換対象の文字列
         * @return string 変換後の文字列
         */
        function deleteHyphen($inputStr = '')
        {
            // 変換した文字列
            $retVal = '';

            // ハイフンの削除
            $retVal = str_replace("-", "", $inputStr);

            return $retVal;
        }

    }

// ------------------------------------------------------------------------

    if ( ! function_exists('deleteComma'))
    {
        /**
         * deleteComma
         *
         * 文字列からカンマを取り除く
         *
         * @access	public
         * @param string $inputStr 変換対象の文字列
         * @return string 変換後の文字列
         */
        function deleteComma($inputStr = '')
        {
            // 変換した文字列
            $retVal = '';

            // ハイフンの削除
            $retVal = str_replace(",", "", $inputStr);

            return $retVal;
        }

    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('zeroToEmpty'))
    {
        /**
         * zeroToEmpty
         *
         * 文字列が「0」の場合、「(空)」に変換します。
         *
         * @access	public
         * @param string $inputStr 変換対象の文字列
         * @return string 変換後の文字列
         */
        function zeroToEmpty($inputStr = '')
        {
            if ($inputStr == '0') {
                return '';
            }

            return $inputStr;
        }

    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('nullToEmpty'))
    {
        /**
         * zeroToEmpty
         *
         * 文字列が「NULL」の場合、「(空)」に変換します。
         *
         * @access	public
         * @param string $inputStr 変換対象の文字列
         * @return string 変換後の文字列
         */
        function nullToEmpty($inputStr = '')
        {
            if (is_null($inputStr)) {
                return '';
            }

            return $inputStr;
        }

    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('nullToDefaultDate'))
    {
        /**
         * zeroToEmpty
         *
         * 文字列が「NULL」の場合、「(空)」に変換します。
         *
         * @access	public
         * @param string $inputStr 変換対象の文字列
         * @return string 変換後の文字列
         */
        function nullToDefaultDate($inputStr = 1900/01/01)
        {
            if (is_null($inputStr)) {
                return '1900/01/01';
            }

            return $inputStr;
        }

    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('forceToEmpty'))
    {
        /**
         * forceToEmpty
         *
         * 強制的に「(空)」を返します。パラメータ破棄の用途。
         *
         * @access	public
         * @param string $inputStr 変換対象の文字列
         * @return string 変換後の文字列
         */
        function forceToEmpty($inputStr = '')
        {
            return '';
        }

    }
}
