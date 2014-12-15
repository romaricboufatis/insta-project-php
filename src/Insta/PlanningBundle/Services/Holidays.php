<?php
/**
 * Created by PhpStorm.
 * User: Rodolphe
 * Date: 09/12/2014
 * Time: 14:04
 */

namespace Insta\PlanningBundle\Services;


class Holidays {

    /**
     * Cette fonction retourne un tableau de timestamp correspondant
     * aux jours fériés en France pour une année donnée.
     * @param null $year
     * @return \DateTime[]
     */
    function getHolidays($year = null)
    {
        if ($year === null)
        {
            $year = intval(date('Y'));
        }

        $easterDate  = easter_date($year);
        $easterDay   = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);

        $holidays = array(

            // Dates fixes
            "Jour de l'an" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-1-1 00:00:00"),
            "Fête du travail" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-5-1 00:00:00"),
            "Victoire 39-45" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-5-8 00:00:00"),
            "Fête nationale" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-7-14 00:00:00"),
            "Assomption" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-8-15 00:00:00"),
            "Toussaint" =>\DateTime::createFromFormat('Y-n-j H:i:s', "$year-11-1 00:00:00"),
            "Armistice 14-18" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-11-11 00:00:00"),
            "Noël" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-12-25 00:00:00"),


            // Dates variables
            "Lundi de Pâques" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-$easterMonth-" . ($easterDay+1) ." 00:00:00"),
            "Jeudi de l'Ascension" => \DateTime::createFromFormat('Y-n-j H:i:s', "$year-$easterMonth-" . ($easterDay+39) ." 00:00:00"),
            "Lundi de Pentecôte" =>\DateTime::createFromFormat('Y-n-j H:i:s', "$year-$easterMonth-" . ($easterDay+51) ." 00:00:00"),
        );

//        sort($holidays);

        return $holidays;
    }

    function getHolidayOn($day, $month, $year = null) {
        $holidays = $this->getHolidays($year);

        foreach ($holidays as $name => $holiday) {

            if ($holiday->format('m-j') == "$month-$day") {
                return array('name' => $name, 'date'=>$holiday);

            }

        }

        return null;

    }


} 