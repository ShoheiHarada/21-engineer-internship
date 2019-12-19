<?php

// ------------------------------------------------------------------------

/**
* 現在日時取得
*
* @access    public
* @return    void
*/
if ( ! function_exists('nowDateTime') )
{
    function nowDateTime()
    {
        return date('Y-m-d H:i:s');
    }
}

// ------------------------------------------------------------------------

/**
* debug出力 ヘルパー
*
* @access    public
* @param    boolean
* @return    void
*/
if ( ! function_exists('preDump'))
{
    function preDump($variables, $isExit=false, $all=false)
    {
        if ($all) {
            ini_set('xdebug.var_display_max_children', -1);
            ini_set('xdebug.var_display_max_data', -1);
            ini_set('xdebug.var_display_max_depth', -1);
        }
        echo '<meta charset="utf-8" />';
        echo "<pre>";
        var_dump($variables);
        echo "</pre>";

        if ( $isExit ) {
            exit();
        }
        return;
    }
}

// ------------------------------------------------------------------------

/**
 * UAを取得
 *
 * @param void
 * @return string
 */
if (! function_exists('getUserAgent')) {
    function getUserAgent()
    {
        // ユーザーエージェントを取得
        return (isset($_SERVER['HTTP_USER_AGENT'])) ? ($_SERVER['HTTP_USER_AGENT']) : '';
    }
}

// ------------------------------------------------------------------------

/**
 * UAからPC・SPを判定
 *
 * @param void
 * @return string
 */
if (! function_exists('getUserAgentType')) {

    function getUserAgentType()
    {
        // ユーザーエージェントを取得
        $userAgent = (isset($_SERVER['HTTP_USER_AGENT'])) ? ($_SERVER['HTTP_USER_AGENT']) : '';

        // Android (mobile) ※ tabletは対象外
        if ( preg_match('#Android\s.*\sMobile#', $userAgent) ) {
            return 'SP';
        }
        // iPhone ※ iPad は対象外
        else if ( preg_match('#iPhone#', $userAgent) ) {
            return 'SP';
        }
        // 上記以外すべてPCアクセス
        else {
            return 'PC';
        }
    }
}

// ------------------------------------------------------------------------

/**
 * modifyDate
 *
 * 日付の整形
 *
 * @param string $format       DateTime::format()関数に指定できるformat文字列
 * @param string $time         DateTimeのコンストラクタで指定できる日付文字列
 * @param boolean $needWeekDay 曜日を付加するかどうかのフラグ
 * @param array $weekDay       曜日の表示文字配列
 * @return string 整形後の日付
 */
if (! function_exists('modifyDate')) {
    function modifyDate(
        $format,
        $time = "now",
        $needWeekDay = FALSE,
        $weekDay = ['日', '月', '火', '水', '木', '金', '土'])
    {

        $date = new DateTime($time);
        $modifiedDate = $date->format($format);
        if ($needWeekDay === TRUE) {
            $modifiedDate .= '(' . $weekDay[$date->format('w')] . ')';
        }

        return $modifiedDate;
    }
}

// ------------------------------------------------------------------------

/**
 * calcAge
 *
 * 誕生日から年齢を計算する
 *
 * @param string $dateStr DateTimeのコンストラクタで指定できる日付文字列
 * @throws Exception 日付文字列の指定に問題があった場合
 * @return integer 年齢(計算失敗時はFALSE)
 */
if (!function_exists('calcAge')) {
    function calcAge($dateStr)
    {
        $interval = createDateInterval($dateStr);

        if ($interval instanceof DateInterval) {
            return $interval->y;
        }

        return FALSE;
    }
}

// ------------------------------------------------------------------------

/**
 * createDateInterval
 *
 * 現在時刻を基準としたDateIntervalオブジェクトを生成
 *
 * @param string $dateStr DateTimeのコンストラクタで指定できる日付文字列
 * @throws Exception 日付文字列の指定に問題があった場合
 * @return DateInterval|FALSE
 */
if (!function_exists('createDateInterval')) {
    function createDateInterval($dateStr)
    {
        static $now;

        if (!$now instanceof DateTime) {
            $now = new DateTime;
        }

        $target = new DateTime($dateStr);

        return $now->diff($target);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('getDayPeriod'))
{
    /**
     * getDayPeriod
     *
     * 日付から日付の期間(日数)を求める
     *
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    function getDayPeriod($startDate, $endDate)
    {
        return ((strtotime($endDate) - strtotime($startDate)) / (60*60*24) + 1);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('dayOfDateExistsInMonth'))
{
    /**
     * dayOfDateExistsInMonth
     *
     * 日付の日が月の初日～最終日の範囲に存在すればTRUEを返す
     *
     * @param string $date Y/m/d or Y-m-d
     * @return boolean
     */
    function dayOfDateExistsInMonth($date)
    {
        $splitDate = preg_split('@[/-]@', $date);
        if (count($splitDate) !== 3) { // 年、月、日に分解できなければFALSE
            return FALSE;
        }

        $dateHasValidDay = FALSE;
        list($year, $month, $day) = $splitDate;
        $lastDayOfMonth = date('t', strtotime("{$year}-{$month}-01"));
        if ($day >= 1 && $day <= $lastDayOfMonth) {
            $dateHasValidDay = TRUE;
        }

        return $dateHasValidDay;
    }
}

// ------------------------------------------------------------------------

/**
 * nowDate
 *
 * 現在日取得
 *
 * @return    string
 */
if ( ! function_exists('nowDate') )
{
    function nowDate()
    {
        return date('Y-m-d 00:00:00');
    }
}

// ------------------------------------------------------------------------

/**
 * defaultDateTime
 *
 * DT型 DB初期値を返します(1900-01-01 00:00:00)
 *
 * @return    string
 */
if ( ! function_exists('defaultDateTime') )
{
    function defaultDateTime($s = '-')
    {
        return vsprintf("%04d{$s}%02d{$s}%02d %02d:%02d:%02d", [1900, 1, 1, 0, 0, 0]);
    }
}

// ------------------------------------------------------------------------

/**
 * convertJpYear
 *
 * 西暦を和暦に変換する
 *
 * @param string $yearStr 西暦を表す4文字の文字列
 * @throws Exception 日付文字列の指定に問題があった場合
 * @return string 和暦表記の文字列
 */
if (!function_exists('convertJpYear')) {
    function convertJpYear($yearStr, $appendNen = TRUE)
    {
        $year = (int)$yearStr;

        if ($year >= 1989) {
                $era = '平成';
                $jpYear = $year - 1988;
        } else if ($year >= 1927) {
                $era = '昭和';
                $jpYear = $year - 1925;
        } else if ($year >= 1913) {
                $era = '大正';
                $jpYear = $year - 1911;
        } else if ($year >= 1868) {
                $era = '明治';
                $jpYear = $year - 1867;
        } else {
                $era = '明治以前';
                $jpYear = '';
        }

        if ($jpYear == 1) {
                return $era . '元' . ($appendNen ? '年' : '');
        } else if ($era == '明治以前') {
                return $era;
        } else {
                return $era . $jpYear . ($appendNen ? '年' : '');
        }
    }
}

// ------------------------------------------------------------------------

/**
 * arraySplit
 *
 * 配列のキーを維持したまま一部を取り出す
 *
 * @param array $input 元の配列
 * @param integer $start 開始位置（0スタート）
 * @param integer $length 取り出す配列の長さ
 * @return array 取り出した配列
 */
if (!function_exists('arraySplit')) {
    function arraySplit($input, $start, $length = 1)
    {
        $counter = 0;
        foreach ($input as $key => $val) {
            if ($start <= $counter && $start + $length > $counter) {
                $return[$key] = $val;
            }
            $counter++;
        }
        return $return;
    }
}

// ------------------------------------------------------------------------

/**
 * collapseArray
 *
 * 渡した2次元配列の下層の値をデリミタ区切りのリストとし、1次元配列に変換する
 *
 * 値にデリミタが入っていてもエスケープなどは行われない。
 * 3次元配列以上は再起処理が行われる。
 * 第2階層以降が連想配列だった場合キーは失われる。
 * expandArray が対になる。
 *
 * @param array $array 処理対象
 * @param string $delimiter デリミタ
 * @return array デリミタで結合処理された後の1次元配列
 */
if (!function_exists('collapseArray')) {

    function collapseArray($array, $delimiter = '_')
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $array[$k] = implode($delimiter, collapseArray($v));
            }
        }
        return $array;
    }
}

// ------------------------------------------------------------------------

/**
 * expandArray
 *
 * 渡した1次元配列のうち、指定された値はデリミタ区切りの文字列であるとみなし、
 * PHPの2次元配列に変換する
 *
 * @param array $items 配列化するキーの配列
 * @param array $array 処理対象
 * @param mixed $default 配列にキーが無かった場合や空文字だった場合の初期値
 * @param string $delimiter デリミタ
 * @return array デリミタで分割処理された後の2次元配列
 */
if (!function_exists('expandArray')) {
    function expandArray($items, $array, $default = [], $delimiter = '_')
    {
        foreach ($items as $item) {
            if (array_key_exists($item, $array)) {
                if (is_array($array[$item])) {
                    // そのまま許容する
                } else if ($array[$item] == '') {
                    // 空文字等は['']ではなく入力なしとする
                    $array[$item] = $default;
                } else {
                    $array[$item] = explode($delimiter, $array[$item]);
                }
            } else {
                $array[$item] = $default;
            }
        }
        return $array;
    }
}

// ------------------------------------------------------------------------

/**
 * convertUnderMiniNum
 *
 * 下限を下回る数値を下限値に変換する
 * 数値でなければ変換しない
 *
 * @param type $value
 */
if (!function_exists('convertUnderMiniNum')) {
    function convertUnderMiniNum($value, $min)
    {
        if (ctype_digit($value) && $value < $min) {
            return $min;
        } else {
            return $value;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * arrayVal
 *
 * 変数の配列としての値を得ます
 *
 * @param mixed $val
 * return array
 */
if (!function_exists('arrayVal')) {
    function arrayVal($val)
    {
        return (array) $val;
    }
}

// ------------------------------------------------------------------------

/**
 * getArrayValue
 *
 * 配列より値を取得する（キーが未定義の場合は第3引数の値を返す）
 *
 * @param array $array 配列名
 * @param string $key 配列キー名
 * @param string $default キー未定義時の返り値
 * @return string 指定のキーの値
 */
if (!function_exists('a')) {
    function a($array, $key, $default = '')
    {
        $value = $default;
        if ( isset($array[$key]) ) {
            $value = $array[$key];
        }
        return $value;
    }
}

// ------------------------------------------------------------------------

/**
 * generateUuid
 * 
 * Version 4 の UUID を生成する
 * 
 * @return string
 */
if (!function_exists('generateUuid')) {
    function generateUuid()
    {
        $data = openssl_random_pseudo_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}

// ------------------------------------------------------------------------

/**
 * convertJpYear
 *
 * 西暦を和暦に変換する
 *
 * @param string $year1 西暦を表す4文字の文字列（開始）
 * @param string $year2 西暦を表す4文字の文字列（終了）
 * @param string $month1 月を表す2文字の文字列（開始）
 * @param string $month2 月を表す2文字の文字列（終了）
 * @param string $continuousFlg　エンドが存在するか
 * @param string $numEmFlg　数値の強調表示
 * @throws Exception 日付文字列の指定に問題があった場合
 * @return string x年xヶ月
 */
if (!function_exists('getTerm')) {
    function getTerm($year1, $year2, $month1, $month2, $continuousFlg = FALSE ,$numEmFlg = FALSE)
    {
        if($continuousFlg) {
            $year2 = date('Y');
            $month2 = date('m');
        }
                $year = (int)$year2 - (int)$year1;
        $month = (int)$month2 - (int)$month1;

        if($year == 0 || $month >= 0) {
            $month = $month + 1;
        }else {
            $month = (int)$month2 + (12 - (int)$month1 + 1);
            if($month > 11) {
                $month = $month - 12;
            }else {
                $year = $year - 1;
            }
        }

        if($year == 0) {
            $return = ($numEmFlg ? "<em>" : "") . $month . ($numEmFlg ? "</em>" : "") . "ヶ月";
        }
        elseif($month == 0) {
            $return = ($numEmFlg ? "<em>" : "") . $year . ($numEmFlg ? "</em>" : "") . "年";
        }
        else {
            $return = ($numEmFlg ? "<em>" : "") . $year . ($numEmFlg ? "</em>" : "") . "年" . ($numEmFlg ? "<em>" : "") . $month . ($numEmFlg ? "</em>" : "") . "ヶ月";
        }
        return $return;
    }
}

// ------------------------------------------------------------------------

if (!function_exists('isJsonStr'))
{
    function isJsonStr($str)
    {
        return is_string($str) && is_array(json_decode($str, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}

// ------------------------------------------------------------------------

// 多次元配列になったstdClassをArrayにキャストする
if (!function_exists('stdClassToArray'))
{
    function stdClassToArray($stdClassObject){

        if(empty($stdClassObject)){
            return [];
        }

        return json_decode(json_encode($stdClassObject), true);
    }

}

// ------------------------------------------------------------------------

// apply_idから応募元のサービスを判定する
if (!function_exists('isApiApply'))
{
    function isApiApply($id){

        if((substr($id, 0, 4) === 'AEMP') && (strlen($id) === 36)){
            return true;    // API経由
        }

        return false;
    }

}

/* End of file common_helper.php */
