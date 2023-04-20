<?php

namespace App\Lib;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Modules\User\Facades\LaraTwilio as FacadesLaraTwilio;

class Helpers
{
    /**
     * Generate a "random" alpha-numeric string.
     *
     * Should not be considered sufficient for cryptography, etc.
     *
     * @param  int  $length
     * @return string
     */
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * Generate a "random" a password with letters and numbers.
     *
     * Should not be considered sufficient for cryptography, etc.
     *
     * @return string
     */
    public static function quickRandomPassword()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';

        $startLength = 6;
        $endLength = 4;

        $start = substr(str_shuffle(str_repeat($chars, $startLength)), 0, $startLength);
        $end = substr(str_shuffle(str_repeat($numbers, $endLength)), 0, $endLength);

        return $start . $end;
    }

    /**
     * make token with time
     *
     * @return String
     */
    public static function makeToken()
    {
        return sha1(Hash::make(time() . rand(0, 10000)));
    }

    /**
     * makeOrderId
     *
     * @return void
     */
    public static function makeOrderId()
    {
        return PREFIX_ORDER_ID . strtoupper(substr(uniqid(self::makeToken()), 0, 10));
    }

    /**
     * isMobile
     *
     * @return void
     */
    public static function isMobile()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
    }

    /**
     * strToHex
     *
     * @param  mixed $string
     * @return String
     */
    public static function strToHex($string)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0' . $hexCode, -2);
        }
        return strToUpper($hex);
    }

    /**
     * make otp
     *
     * @return String
     */
    public static function makeOTP($n = 6)
    {
        // Take a generator string which consist of
        // all numeric digits
        $generator = "0123456789";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        // Return result
        return $result;
    }

    /**
     * encrypto
     *
     * @param  mixed $plaintext
     * @return string
     */
    public static function encrypto($plaintext)
    {
        $method = "AES-256-CBC";
        $key = config('crypto.key');
        $iv = config('crypto.iv');
        return bin2hex(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));
    }

    /**
     * localeString
     *
     * @param  string $locale
     * @param  string $stringLocale
     * @return bool
     */
    public static function localeString($locale, $stringLocale)
    {
        try {
            $localeData = json_decode($stringLocale);
            if (json_last_error() !== JSON_ERROR_NONE || !isset($localeData->$locale)) {
                return $stringLocale;
            }
            return $localeData->$locale;
        } catch (\Exception $ex) {
            return $stringLocale;
        }
    }

    /**
     * isJson
     *
     * @param  mixed $string
     * @return boolean
     */
    public static function isJson($string)
    {
        $result = is_object(json_decode($string)) || is_array(json_decode($string));
        return json_last_error() === JSON_ERROR_NONE && $result;
    }

    /**
     * getLocaleString
     * @param  string $stringLocale
     * @param  string $forceLang
     * @return string
     */
    public static function getLocaleString($stringLocale, $forceLang = null)
    {
        $locale = app()->getLocale();
        $localeAvailableList = config('locales');

        if (!empty($forceLang)) {
            $locale = $forceLang;
        }

        if (!isset($localeAvailableList[$locale])) {
            return $stringLocale;
        }
        return self::localeString($locale, $stringLocale);
    }

    /**
     * getCommonLang
     *
     * @param  string $key
     * @param  string $lang = 'en' | 'ja' | 'ko'
     * @return string
     */
    public static function getCommonLang($key, $lang = 'en'): string
    {

        if (!file_exists(resource_path("lang/$lang/common.php"))) {
            return '';
        }

        $langs = include resource_path("lang/$lang/common.php");

        $keys = explode('.', $key);
        $result = '';
        for ($i = 0; $i < count($keys); $i++) {
            if ($i === 0 && !isset($langs[$keys[$i]])) {
                $result = '';
                break;
            } else if ($i > 0 && !isset($result[$keys[$i]])) {
                return '';
                break;
            }
            $result = $i === 0 ? $langs[$keys[$i]] : $result[$keys[$i]];
        }

        if ($result == '' && $lang !== 'en') {
            // Fallback
            return self::getCommonLang($key);
        }

        return $result;
    }

    /**
     * getCommonLangWithCurrentLocale
     *
     * @param  string $key
     * @return string
     */
    public static function getCommonLangWithCurrentLocale($key): string
    {
        $locale = app()->getLocale();
        return self::getCommonLang($key, $locale);
    }

    /**
     * createStringLang
     *
     * @param  string $en
     * @param  string $ja
     * @param  string $ko
     * @return string
     */
    public static function createStringLang(string $en = '', string $ja = '', string $ko = ''): string
    {
        return json_encode([
            'en' => $en,
            'ja' => $ja,
            'ko' => $ko,
        ], JSON_UNESCAPED_UNICODE);
    }

    public static function createStringLangWithKey($key): string
    {
        return json_encode([
            'en' => self::getCommonLang($key, 'en'),
            'ja' => self::getCommonLang($key, 'ja'),
            'ko' => self::getCommonLang($key, 'ko'),
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * getTokenCdnAdmin
     *
     * @return string
     */
    public static function getTokenCdnAdmin(): string
    {
        $data = [
            "expired_time" => Carbon::now('UTC')->addMinute(5),
        ];
        return self::encrypto(json_encode($data));
    }

    /**
     * createTokenDownload
     *
     * @param $filePath
     * @param $fileName
     * @param $timeout // minutes
     * @return string
     */
    public static function createTokenDownload($filePath, $fileName, $timeout = 5): string
    {
        $data = [
            "expired_time" => Carbon::now('UTC')->addMinute($timeout),
            "file_path" => $filePath,
            "file_name" => $fileName,
        ];
        return self::encrypto(json_encode($data));
    }

    /**
     * downloadFileUrl
     *
     * @return string
     */
    public static function downloadFileUrl($filePath, $fileName): string
    {
        $token = self::createTokenDownload($filePath, $fileName);
        $url = env('CDN_URL') . '/download-file?token=' . $token;
        return $url;
    }

    /**
     * getAvailablePerPage
     *
     * @return Number
     */
    public static function getAvailablePerPage()
    {
        $perPage = intval(request()->get('per_page'));
        return $perPage > 0 && $perPage <= LIMIT_PER_PAGE ? $perPage : DEFAULT_PER_PAGE;
    }

    /**
     * getLocaleFromTimezone
     * @param $timezone
     * @return String
     */
    public static function getLocaleFromTimezone($timezone): string
    {
        try {
            if (empty($timezone)) {
                return 'en';
            }
            Carbon::now()->setLocale($timezone);

            $result = 'en';
            switch ($timezone) {
                case 'Asia/Seoul':
                    $result = 'ko';
                    break;
                case 'Asia/Tokyo':
                    $result = 'ja';
                    break;
            }
            return $result;
        } catch (\Exception $ex) {
            return 'en';
        }
    }

    /**
     * getClientLocale
     * @return String
     */
    public static function getClientLocale(): string
    {
        try {

            $locale = request()->header('X-Application-Locale');

            if (!empty($locale) && in_array($locale, ACCEPT_LOCALES)) {
                return $locale;
            }

            $timezone = request()->header('X-Application-Timezone');

            if (empty($timezone)) {
                return 'en';
            }

            Carbon::now()->setLocale($timezone);

            $result = 'en';
            switch ($timezone) {
                case 'Asia/Seoul':
                    $result = 'ko';
                    break;
                case 'Asia/Tokyo':
                    $result = 'ja';
                    break;
            }
            return $result;
        } catch (\Exception $ex) {
            return 'en';
        }
    }

    /**
     * isValidTimezone
     * @param $timezone
     * @return Number
     */
    public static function isValidTimezone($timezone): string
    {
        try {
            Carbon::now()->setLocale($timezone);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * changeContentLocale
     * @param  string $stringLocale
     * @param  string $locale
     * @param  string $content
     * @return string
     */
    public static function changeContentLocale($stringLocale, $locale = "ja", $content = "")
    {
        $localeAvailableList = config('locales');
        if (!isset($localeAvailableList[$locale])) {
            return $content;
        }
        $objLocale = json_decode($stringLocale);

        $result = [];
        foreach (SOURCE_LANG as $sLocale => $fLocale) {
            if ($locale === $sLocale) {
                $result[$sLocale] = $content;
            } else {
                $result[$sLocale] = !empty($objLocale) && !empty($objLocale->$sLocale) ? $objLocale->$sLocale : "";
            }
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * createStringMultipleLang
     *
     * @param  string $key
     * @param  array $params
     * @return string
     */
    public static function createStringMultipleLang($key, $params = [])
    {
        if (empty($key)) {
            return "";
        }
        $result = [];
        foreach (ACCEPT_LOCALES as $locale) {
            $convertedParams = self::convertParamsLocale($params, $locale);
            $result[$locale] = Lang::get($key, $convertedParams, $locale);
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * convertParamsLocale
     *
     * @param $params
     * @return Array
     */
    private static function convertParamsLocale($params, $locale)
    {
        $result = [];
        foreach ($params as $key => $param) {
            $result[$key] = self::localeString($locale, $param);
        }
        return $result;
    }

    /**
     * getTimeZoneRequest
     *
     * @return string|null
     */
    public static function getTimeZoneRequest()
    {
        $timezone = request()->header('X-Application-Timezone');
        if (DateCommon::isValidTimezone($timezone)) {
            return $timezone;
        }
        return null;
    }

    // /**
    //  * sendSMS
    //  *
    //  * @param  string $phone
    //  * @param  string $message
    //  * @return void
    //  */
    // public static function sendSMS($phone, $message)
    // {
    //     $result = true;
    //     if (app()->environment(['production', 'staging'])) {
    //         $result = FacadesLaraTwilio::notify($phone, $message);
    //     }
    //     return $result;
    // }

    /**
     * Combines SQL and its bindings
     *
     * @param \Eloquent $query
     * @return string
     */
    public static function getEloquentSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }

    /**
     * convertTextWithFontStyleForJapanese
     *
     * @param $text
     * @param $fontName
     * @return string
     */
    public static function convertTextWithFontStyleForJapanese($text, $fontName = 'gothic')
    {
        $split = mb_str_split($text);
        if (!is_array($split)) {
            return $text;
        }

        $result = '';
        foreach ($split as $str) {
            $result .= self::isJapanese($str) ? "<span style='font-family: $fontName'>$str</span>" : $str;
        }
        return $result;
    }


    /**
     * isJapanese
     *
     * @param  mixed $lang
     * @return bool
     */
    public static function isJapanese($lang)
    {
        return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $lang);
    }


    /**
     * temporarySignedRoute
     *
     * @param  string $routeName
     * @param  datetime $expire
     * @param  array $param
     * @return string
     */
    public static function temporarySignedRoute($routeName, $expire, $params = [])
    {

        $params['expire'] = Carbon::parse($expire)->timestamp;

        $url = config('url.api_url') .  route($routeName, $params, false);

        $hash = hash_hmac('sha256', $url, config('app.key'));

        $params['hash'] = $hash;

        $fullUrl = route($routeName, $params);

        return $fullUrl;
    }

    /**
     * isValidSignature
     *
     * @param  Request $request
     * @return string
     */
    public static function isValidSignature(Request $request)
    {
        $expire = $request->get('expire');

        $path = $request->path();

        $query = http_build_query($request->except("hash"));

        $url = config('url.api_url') . '/' . $path . '?' . $query;

        $hash = hash_hmac('sha256', $url, config('app.key'));

        if (Carbon::createFromTimestamp($expire) <= Carbon::now()) {
            return false;
        }


        if ($hash !== $request->get('hash')) {
            return false;
        }

        return true;
    }
}
