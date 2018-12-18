<?php
/**
 * Created by PhpStorm.
 * User: Long
 * Date: 7/30/2018
 * Time: 9:34 AM
 */


function clean_filename($filename){
    if(!is_string($filename)) return $filename;
    if(strrpos($filename, ".") !== false){
        $extention = substr($filename, strrpos ($filename, ".") + 1);
        $title = substr($filename, 0,strrpos ($filename, "."));
        $path = clean_string($title) . "." . $extention;
        return $path;
    }
    else return clean_string($filename);
}


/**
 * Remove special characters from string
 */
function clean_string($string) {
    if(!is_string($string)) return $string;
    $string =  hyphenize_string($string);
    $string =  preg_replace('/[^A-Za-z0-9\-_]/', '_', $string); // Removes special chars to _
    $string =  preg_replace('/(_+)/', '_', $string); // Replace __ -> _
    $string =  preg_replace('/_$/', '', $string); // Removes last _
    $string =  preg_replace('/^_/', '', $string); // Removes first _
    return $string;
}

/**
 * Replace special characters to seo friendly characters
 */
function hyphenize_string($string){
    $foreign_characters = array(
        '/ä|æ|ǽ/' => 'ae',
        '/ö|œ/' => 'oe',
        '/ü/' => 'ue',
        '/Ä/' => 'Ae',
        '/Ü/' => 'Ue',
        '/Ö/' => 'Oe',
        '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
        '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
        '/Б/' => 'B',
        '/б/' => 'b',
        '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
        '/ç|ć|ĉ|ċ|č/' => 'c',
        '/Д/' => 'D',
        '/д/' => 'd',
        '/Ð|Ď|Đ|Δ/' => 'D',
        '/ð|ď|đ|δ/' => 'd',
        '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
        '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
        '/Ф/' => 'F',
        '/ф/' => 'f.json',
        '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
        '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
        '/Ĥ|Ħ/' => 'H',
        '/ĥ|ħ/' => 'h',
        '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
        '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
        '/Ĵ/' => 'J',
        '/ĵ/' => 'j',
        '/Ķ|Κ|К/' => 'K',
        '/ķ|κ|к/' => 'k',
        '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
        '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
        '/М/' => 'M',
        '/м/' => 'm',
        '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
        '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
        '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
        '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
        '/П/' => 'P',
        '/п/' => 'p',
        '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
        '/ŕ|ŗ|ř|ρ|р/' => 'r',
        '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
        '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
        '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
        '/ț|ţ|ť|ŧ|т/' => 't',
        '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
        '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
        '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
        '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
        '/В/' => 'V',
        '/в/' => 'v',
        '/Ŵ/' => 'W',
        '/ŵ/' => 'w',
        '/Ź|Ż|Ž|Ζ|З/' => 'Z',
        '/ź|ż|ž|ζ|з/' => 'z',
        '/Æ|Ǽ/' => 'AE',
        '/ß/' => 'ss',
        '/Ĳ/' => 'IJ',
        '/ĳ/' => 'ij',
        '/Œ/' => 'OE',
        '/ƒ/' => 'f.json',
        '/ξ/' => 'ks',
        '/π/' => 'p',
        '/β/' => 'v',
        '/μ/' => 'm',
        '/ψ/' => 'ps',
        '/Ё/' => 'Yo',
        '/ё/' => 'yo',
        '/Є/' => 'Ye',
        '/є/' => 'ye',
        '/Ї/' => 'Yi',
        '/Ж/' => 'Zh',
        '/ж/' => 'zh',
        '/Х/' => 'Kh',
        '/х/' => 'kh',
        '/Ц/' => 'Ts',
        '/ц/' => 'ts',
        '/Ч/' => 'Ch',
        '/ч/' => 'ch',
        '/Ш/' => 'Sh',
        '/ш/' => 'sh',
        '/Щ/' => 'Shch',
        '/щ/' => 'shch',
        '/Ъ|ъ|Ь|ь/' => '',
        '/Ю/' => 'Yu',
        '/ю/' => 'yu',
        '/Я/' => 'Ya',
        '/я/' => 'ya'
    );
    return preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $string);
}

function getLinkinText($str){//all link start with http ftp
    $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    if($num_found = preg_match_all($pattern,$str , $out))
    {
//        echo "FOUND ".$num_found." LINKS:\n";
        return array_unique($out[0]);
    } else return null;
}

function getLinkinTextStartwithSpace($str){//all link start with [space]http [space]ftp
    $pattern = "/(\s+)(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    if($num_found = preg_match_all($pattern,$str , $out))
    {
//        echo "FOUND ".$num_found." LINKS:\n";
        return array_unique($out[0]);
    } else return null;
}
/**
 * Lấy từ đầu tiên trong $word
 */
function text_between_word($word, $start_word, $end_word, $minlen = -1, $maxlen = 1000000000)
{
    $startWordlength = strlen($start_word);
    while (true) {
        $start = strpos($word, $start_word);

        if ($start === false) {
            return null;
        } else {
            $start = $start + $startWordlength;
        }

        $end = strpos($word, $end_word, $start);

        if ($end === false) {
            return null;
        }

        $endsubstart = $end - $start;


        if (($end !== false) && ($endsubstart <= $maxlen) && ($endsubstart >= $minlen)) {
            return substr($word, $start, $endsubstart);
        }

        $word = substr($word, $start);

    }
    return null;
}

/**
 * Lấy từ cuối cùng trong $word
 * Là một hàm mở rộng từ hàm text_between_word
 */
function last_text_between_word($word, $start_word, $end_word, $minlen = -1, $maxlen = 1000000000)
{
    $word       = strrev($word);//Đảo ngược xâu
    $start_word = strrev($start_word);//Đảo ngược xâu
    $end_word   = strrev($end_word);//Đảo ngược xâu
    $kq         = text_between_word($word, $end_word, $start_word, $minlen, $maxlen);
    return ($kq == null) ? null :  strrev($kq);
}

/**
 * Get first number in string
 */
function first_num_in_string($text)
{
    preg_match('/\d+/', $text, $matches);
    if ($matches == null)
    {
        return null;
    }
    else {
        if (is_numeric($matches[0]))
            return $matches[0];
        else
            return null;
    }
}


/**
 * is string $haystack starts with $needle
 */
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

/**
 * is string $haystack ends with $needle
 */
function endsWith($haystack, $needle)

{
    $length = strlen($needle);

    return $length === 0 ||
        (substr($haystack, -$length) === $needle);
}

/**
 * is string $haystack contains string $needle
 */
function containsString($haystack, $needle){
    return (strpos($haystack, $needle) !== false);
}