<?php

//このファイルの場所
namespace  MyCommon\Libraries\Utils;

/**
 * Class OpensslCryptUtils
 * OpenSSL を使った暗号化
 * @package MyCommon\Libraries\Utils
 */
//このファイルのクラス名と役割
class OpensslCryptUtils
{
    const CIPHER_METHOD = 'AES-256-CBC';

    /**
     * OpenSSL を使った暗号化
     * @param $str 暗号化する文字列
     * @param $password パスワード
     * @return array ['encrypt'=>暗号化された文字列, 'iv'=>使用した初期ベクトル(base64)]
     */
    public function encrypt($str, $password)
    {
        // 初期ベクタ生成
        $ivLen = openssl_cipher_iv_length(self::CIPHER_METHOD);
        $iv = openssl_random_pseudo_bytes($ivLen);

        // 暗号化
        $encrypted = openssl_encrypt($str, self::CIPHER_METHOD, $password, false, $iv);
        $ivBase64 = base64_encode($iv);

        return [
            'encrypt' => $encrypted,
            'iv' => $ivBase64,
        ];
    }

    /**
     * OpenSSL を使った復号
     * @param $encrypted 暗号化された文字列
     * @param $password パスワード
     * @param $ivBase64 使用した初期ベクトル(base64)
     * @return string 復号した元文字列
     */
    public function decrypt($encrypted, $password, $ivBase64)
    {
        // base64化してある初期ベクタを戻す
        $iv = base64_decode($ivBase64);

        // 復号
        $original = openssl_decrypt($encrypted, self::CIPHER_METHOD, $password, false, $iv);

        return $original;
    }
}