<?php
/**
 * @Lainatussifa Dalimunthe
 * @adapted from http://phpguru.org/
 */


    class PorterStemmer
    {
        /**
        * Regex for matching a consonant
        * @var string
        */
        private static $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';


        /**
        * Regex for matching a vowel
        * @var string
        */
        private static $regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';


        /**
        * Stems a word. Simple huh?
        *
        * @param  string $word Word to stem
        * @return string       Stemmed word
        */
        public static function Stem($word)
        {
            if (strlen($word) <= 2) {
                return $word;
            }

            $word = self::step1($word);            
            $word = self::step2($word);
            

            return $word;
        }


        /**
        * Step 1
        */
        private static function step1($word)
        {
            // Part a
			
            if (substr($word, -2, 1)) {

                   self::replace($word, 'lah', '')
                OR self::replace($word, 'kah', '')
				OR self::replace($word, 'ku', '')
                OR self::replace($word, 'mu', '')
                OR self::replace($word, 'nya', '')
                OR self::replace($word, 'pun', '');
            }

            return $word;
        }
		/**
        * Step 1
        */
        private static function step2($word)
        {
            // Part a
			
            if (substr($word, -2, 1)) {

                   self::replace($word, 'kan', '')
                OR self::replace($word, 'an', '')
                OR self::replace($word, 'i', '');
            }

            return $word;
        }


        

    
        /** [[[[[[[[[[[[----Still have to learn about the codes below-------]]]]]]]]]]]]]]]]]]]
        * Replaces the first string with the second, at the end of the string. If third
        * arg is given, then the preceding string must match that m count at least.
        *
        * @param  string $str   String to check
        * @param  string $check Ending to check for
        * @param  string $repl  Replacement string
        * @param  int    $m     Optional minimum number of m() to meet
        * @return bool          Whether the $check string was at the end
        *                       of the $str string. True does not necessarily mean
        *                       that it was replaced.
        */
        private static function replace(&$str, $check, $repl, $m = null)
        {
            $len = 0 - strlen($check);

            if (substr($str, $len) == $check) {
                $substr = substr($str, 0, $len);
                if (is_null($m) OR self::m($substr) > $m) {
                    $str = $substr . $repl;
                }

                return true;
            }

            return false;
        }


        /**
        * What, you mean it's not obvious from the name?
        *
        * m() measures the number of consonant sequences in $str. if c is
        * a consonant sequence and v a vowel sequence, and <..> indicates arbitrary
        * presence,
        *
        * <c><v>       gives 0
        * <c>vc<v>     gives 1
        * <c>vcvc<v>   gives 2
        * <c>vcvcvc<v> gives 3
        *
        * @param  string $str The string to return the m count for
        * @return int         The m count
        */
        private static function m($str)
        {
            $c = self::$regex_consonant;
            $v = self::$regex_vowel;

            $str = preg_replace("#^$c+#", '', $str);
            $str = preg_replace("#$v+$#", '', $str);

            preg_match_all("#($v+$c+)#", $str, $matches);

            return count($matches[1]);
        }


        /**
        * Returns true/false as to whether the given string contains two
        * of the same consonant next to each other at the end of the string.
        *
        * @param  string $str String to check
        * @return bool        Result
        */
        private static function doubleConsonant($str)
        {
            $c = self::$regex_consonant;

            return preg_match("#$c{2}$#", $str, $matches) AND $matches[0]{0} == $matches[0]{1};
        }


        /**
        * Checks for ending CVC sequence where second C is not W, X or Y
        *
        * @param  string $str String to check
        * @return bool        Result
        */
        private static function cvc($str)
        {
            $c = self::$regex_consonant;
            $v = self::$regex_vowel;

            return     preg_match("#($c$v$c)$#", $str, $matches)
                   AND strlen($matches[1]) == 3
                   AND $matches[1]{2} != 'w'
                   AND $matches[1]{2} != 'x'
                   AND $matches[1]{2} != 'y';
        }
    }
?>
