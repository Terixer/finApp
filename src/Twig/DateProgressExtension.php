<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DateProgressExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('dateProgress', [$this, 'calculateProgress']),
        ];
    }

    public function calculateProgress(\DateTime $dateFrom, \DateTime $dateTo):float
    {
        $currentDate = new \DateTime('now');
        if($currentDate >= $dateTo ){
            return 100;
        }elseif($currentDate <= $dateFrom){
            return 0;
        }else{
            $actualProgress = $this->dateDifferenceTimestamp($dateFrom,$currentDate);
            $periodDifference = $this->dateDifferenceTimestamp($dateFrom,$dateTo);
            return (float) round(($periodDifference !== 0.0)?($actualProgress/$periodDifference)*100:0,2);
        }
        
    }

    private function dateDifferenceTimestamp(\DateTime $dateFrom ,\DateTime $dateTo):float
    {
        return $dateFrom->getTimestamp() - $dateTo->getTimestamp();
    
    }
}