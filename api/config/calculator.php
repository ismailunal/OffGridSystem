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
      public static function cal_whcapacity($reqtotalwatt,$volt):float{//wh cinsinden sonuç
        return $reqtotalwatt/$volt;
      }
     public static  function cal_amp($whacumulator) :float { //ah hesabı fakat 12 olarak sabit tutlan değer 12 24 48 olabilir düzenlenecek
        return $whacumulator*0.3+$whacumulator;
      }
      public static function cal_solarPanel($inverted):float{ //inverted değere göre panel güç hesabı
        return $inverted/5*0.55;
       }
      public static function cal_panelCount($reqtotalwatt,$panelwatt):float{
         return $reqtotalwatt/($panelwatt);
       }
    };
    ?>
