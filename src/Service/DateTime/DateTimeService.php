<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Shrek
 *
 * User:    gra
 * Date:    23/April/2021
 * Time:    01:09
 * Project: virtuopo-admin-service
 * File:    DateTimeService.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\DateTime;


class DateTimeService
{
    private $timeAgo;

    public function __construct(TimeAgo $timeAgo)
    {
        $this->timeAgo = $timeAgo;
    }

    public function getNiceTime(\DateTime $dateTime) : string
    {
        return $dateTime->format('D jS \of F Y G:i:s');
    }

    public static function getNiceEventTime(\DateTime $dateTime) : string
    {
        return $dateTime->format('l jS F G:iA \G\M\T');
    }

    //ToDo: Allow the event to pick if shit is in 12 or 24 hr times

     public static function getNiceEventTimeOnly(\DateTime $dateTime) : string
    {
        return $dateTime->format('G:i');
    }

    public static function getNiceEventTimeBetweenTime(\DateTime $dateTime, \Datetime $endTime) : string
    {
        return $dateTime->format('D M jS') . ' - ' . $endTime->format('D M jS Y');
    }

    public static function getDaysBetweenDates(\DateTime $from, \DateTime $to) : string
    {
        $diff = $to->diff($from);
        $returnString = '';
        if ($diff->format("%a") > 1) {
            $returnString = $diff->format("%a") . ' Days';
        }

        if ($diff->format("%a") == 1) {
            $returnString = $diff->format("%a") . ' Day';
        }

        if ($diff->format("%a") < 1) {
            $returnString = $diff->format("%h") . ' Hours';
        }

        if ($diff->format("%a") < 1 && $diff->format("%h") < 1) {
            $returnString = $diff->format("%i") . ' Minutes';
        }

        if ($diff->format("%a") < 1 && $diff->format("%h") < 1 && $diff->format("%i") < 2) {
            $returnString = $diff->format("%s") . ' Seconds';
        }

        $returnString = $diff->format("Year: %Y Month: %M Day: %D Hours: %a Mins: %i Secs: %s");

        return $returnString;

    }

    public static function getArrayOfDatesInBetween2Dates($start, $end, $format = 'Y-m-d')
    {
        // Declare an empty array
        $array = array();

        // Variable that store the date interval
        // of period 1 day
        $interval = new \DateInterval('P1D');

        $realEnd = new \DateTime($end);
        $realEnd->add($interval);

        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);

        // Use loop to store date into array
        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        // Return the array elements
        return $array;

    }

    public static function getArrayOfDateTimeObjectsBetween2Dates(\DateTime $start, \DateTime $end)
    {
        $datesInBetween = self::getArrayOfDatesInBetween2Dates($start->format('Y-m-d'), $end->format('Y-m-d'));
        $datesToReturn = [];
        foreach($datesInBetween as $date) {
            $startFrom = new \DateTime($date);
            $startFrom->setTime(0, 0, 0);

            $endFrom = new \DateTime($date);
            $endFrom->setTime(23, 59, 59);

            $datesToReturn[] = [
                'start' => $startFrom,
                'end' => $endFrom,
            ];
        }
        return $datesToReturn;
    }

    public function getNiceTimeFileName(\DateTime $dateTime)
    {
        return $dateTime->format('D j F Y G:i:s');
    }

    public function getNiceTimeFileNameNow()
    {
        return $this->getNiceTimeFileName($this->getTimeNow());
    }


    public function getNiceDateNow()
    {
        return $this->getNiceDate($this->getTimeNow());
    }

    public function getNiceDateTimeNow()
    {
        return $this->getNiceTime($this->getTimeNow());
    }

    public function getNiceDate(\DateTime $dateTime)
    {
        return $dateTime->format('D, jS M, Y');
    }

    public function getShortDate(\DateTime $dateTime)
    {
        return $dateTime->format('d/m/Y');
    }

    public function getTimeNow() : \DateTime
    {
        return new \DateTime("now");
    }

    public function getTimeAgo(\DateTime $datetime, $future = false)
    {
        return $this->timeAgo->formatDiff(new \DateTime('now'), $datetime);
    }

    public function getNiceBetweenDates(\DateTime $from, \DateTime $to) : string
    {
        return $this->timeAgo->formatDiff($from, $to);
    }

    public function getAgeInYears(\DateTime $dateTime)
    {
        return $this->getTimeNow()->diff($dateTime)->y;
    }

    public static function convertToHoursMins($time, $format = '%02d:%02d') {
            if ($time < 1) {
                return;
            }
        $hours = floor($time / 60);
        $minutes = ($time % 60);

        if ($hours > 1) {
            $hours = $hours . ' hrs';
        }
        if ($hours == 1) {
            $hours = $hours . ' hour';
        }
        if ($hours < 1) {
            $hours = '';
        }

        if ($minutes > 1) {
            $minutes = ':' . $minutes . 'mins';
        }
        if ($minutes == 1) {
            $minutes = ':' . $minutes . 'min';
        }
        if ($minutes < 1) {
            $minutes = '';
        }



        return $hours . '' . $minutes;
    }

    /**
     * A sweet interval formatting, will use the two biggest interval parts.
     * On small intervals, you get minutes and seconds.
     * On big intervals, you get months and days.
     * Only the two biggest parts are used.
     *
     * @param \DateTime $start
     * @param \DateTime|null $end
     * @return string
     */
    public static function formatDateDiffNice(\DateTime $start, ?\DateTime $end=null) {
        if(!($start instanceof \DateTime)) {
            $start = new \DateTime($start);
        }

        if($end === null) {
            $end = new \DateTime();
        }

        if(!($end instanceof \DateTime)) {
            $end = new \DateTime($start);
        }

        $interval = $end->diff($start);
        $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;}; // adds plurals

        $format = array();
        if($interval->y !== 0) {
            $format[] = "%y ".$doPlural($interval->y, "year");
        }
        if($interval->m !== 0) {
            $format[] = "%m ".$doPlural($interval->m, "month");
        }
        if($interval->d !== 0) {
            $format[] = "%d ".$doPlural($interval->d, "day");
        }
        if($interval->h !== 0) {
            $format[] = "%h ".$doPlural($interval->h, "hour");
        }
        if($interval->i !== 0) {
            $format[] = "%i ".$doPlural($interval->i, "minute");
        }
        if($interval->s !== 0) {
            if(!count($format)) {
                return "less than a minute ago";
            } else {
                $format[] = "%s ".$doPlural($interval->s, "second");
            }
        }

        // We use the two biggest parts
        if(count($format) > 1) {
            $format = array_shift($format)." and ".array_shift($format);
        } else {
            $format = array_pop($format);
        }

        // Prepend 'since ' or whatever you like
        return $interval->format($format);
    }
}