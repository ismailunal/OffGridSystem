<?php 

  class Calculator{

     public static function cal_costw(float $amount,float $watt,float $hours,float $days) :float{ //aynı cinsi cihaz için saatlik watt hesabı
        $costwatt=$amount*$watt*$hours*$days/7;
        return $costwatt;
      }
      public static function cal_inverted($costwatt) : float { //Kayıp sonucu gerekli olan watt hesaplaması
       
        return $costwatt/0.85;
      }
     public static function cal_requiredtotalwatt($inverted,$autonomy) :float{ //otonomiye göre gerekli watt hesabı
        return $inverted*$autonomy;
      }
      public static function cal_whcapacity($reqtotalwatt):float{//wh cinsinden sonuç
        return $reqtotalwatt/0.6;
      }
     public static  function cal_amp($whacumulator,$volt) :float { //ah hesabı fakat 24 olarak sabit tutlan değer 12 24 48 olabilir düzenlenecek
        return $whacumulator/$volt;
      }
      public static function cal_solarPanel($inverted):float{ //inverted değere göre panel güç hesabı
        return $inverted/5/0.7;
       }
      public static function cal_panelCount($reqtotalwatt,$panelwatt):float{
         return $reqtotalwatt/(5*$panelwatt);
       }
    };
    ?>
