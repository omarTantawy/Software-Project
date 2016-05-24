<?php

/**
 * @author yehia
 * @copyright 2010
 */

class Date extends Input{

    private $date;
    private $day;
    private $month;
    private $year;
    private $timestamp;

    static public function getJNYFromTimestamp($timestamp){
        if(!intval($timestamp))
            return '';
        else
            return date('d-m-Y', $timestamp);
    }

    static public function getTimestampFromJNY($date){
        if(!$date)
            return '';
        else {
            $d = explode('-', $date);
            if(!$d[0] || !$d[1] || !$d[2]){
                return '';
            }else {
                $dc = mktime(0, 0, 0, $d[1], $d[0], $d[2]);
            }
            return $dc;
        }
    }

    static public function calculateAge($birthday){
    return floor((time() - strtotime($birthday))/31556926);
    }
        
    public function getDateInWords($timestamp){
        $diff = time() - $timestamp;
        
        if($diff < 60){
            if($diff == 0){
                return 'الان';
            }else if($diff == 1){
                return 'ثانية واحدة';
            }else if($diff == 2){
                return 'ثانيتان';
            }else if($diff >=3 && $diff <=10){
                return $diff.' ثواني';
            }else{
                return $diff.' ثانية';
            }
        }else if($diff < 60 * 60){
            $diffInMinutes = round($diff/60);
            if($diffInMinutes == 1){
                return 'دقيقة واحدة';
            }else if($diffInMinutes == 2){
                return 'دقيقتان';
            }else if($diffInMinutes >=3 && $diffInMinutes <=10){
                return $diffInMinutes.' دقائق';
            }else{
                return $diffInMinutes.' دقيقة';
            }
            
        }else if($diff < 60 * 60 * 24){
            
            $diffInHours = round($diff/(60*60));
            if($diffInHours == 1){
                return 'ساعة واحدة';
            }else if($diffInHours == 2){
                return 'ساعتان';
            }else if($diffInHours >=3 && $diffInHours <=10){
                return $diffInHours.' ساعات';
            }else{
                return $diffInHours.' ساعة';
            }
            
        }else/* if($diff < 60 * 60 * 24 * 30)*/{
            
            $diffInDays = round($diff/(60*60*24));
            if($diffInDays == 1){
                return 'يوم واحد';
            }else if($diffInDays == 2){
                return 'يومان';
            }else if($diffInDays >=3 && $diffInDays <=10){
                return $diffInDays.' ايام';
            }else{
                return $diffInDays.' يوم';
            }
            
        }/*else if($diff < 60 * 60 * 24 * 30 * 12){
            
            $diffInMonths = round($diff/(60*60*24*30));
            if($diffInMonths == 1){
                return 'شهر واحد';
            }else if($diffInMonths == 2){
                return 'شهران';
            }else if($diffInMonths >=3 && $diffInMonths <=10){
                return $diffInMonths.' شهور';
            }else{
                return $diffInMonths.' شهر';
            }
        }*/
    }
    public function __construct($date){
        $this->date = $date;
        if($this->isDayMonthYear()){
            $dmy = $this->split();
            $this->day = $dmy[0];
            $this->month = $dmy[1];
            $this->year = $dmy[2];
        }
    }
    public function isDayMonthYear(){
        $dmy = $this->split();
        return (
                ($dmy[0] >= 1 && $dmy[0] <= 31) &&
                ($dmy[1] >= 1 && $dmy[1] <= 12) &&
                ($dmy[2] >= 1 && $dmy[2] <= 3000)
            );
    }
    public function getMonthArabicName($month){
        $months = array(
    "1" => "يناير",
    "2" => "فبراير",
    "3" => "مارس",
    "4" => "أبريل",
    "5" => "مايو",
    "6" => "يونيو",
    "7" => "يوليو",
    "8" => "أغسطس",
    "9" => "سبتمبر",
    "10" => "أكتوبر",
    "11" => "نوفمبر",
    "12" => "ديسمبر"
);
        return $months[$month];
    }
    public function getTimestamp(){
        return mktime(0, 0, 0, $this->month, $this->day, $this->year);
    }
    
    private function split(){
        return explode('/', $this->date);
    }
}
?>