<?php
include_once "../getPDO.php";

class Termin
{
    /**
     * Termin with all information
     * @var array
     */
    private array $termin;

    /**
     * Termin constructor.
     * Set termin array with all values
     * @param array $termin
     */
    public function __construct(array $termin)
    {
        $this->termin = $termin;
    }

    /**
     * Returns termin values in german language
     * adds value "tag" in german language
     * @return array
     */
    public function getValues() {
        $von = explode(":", $this->termin["zeit_von"]);
        $this->termin["zeit_von"] = $von[0].":".$von[1];

        $bis = explode(":", $this->termin["zeit_bis"]);
        $this->termin["zeit_bis"] = $bis[0].":".$bis[1];

        $datumArray = explode('-', $this->termin["pk_datum"]);
        $tag = strtotime($this->termin["pk_datum"]);

        $this->termin["pk_datum"] = $datumArray[2].".".$datumArray[1].".".substr($datumArray[0], 2);
        $tag = date('D', $tag);

        switch ($tag) {
            case "Mon":
                $this->termin["tag"] = "Mo";
                break;
            case "Tue":
                $this->termin["tag"] = "Di";
                break;
            case "Wed":
                $this->termin["tag"] = "Mi";
                break;
            case "Thu":
                $this->termin["tag"] = "Do";
                break;
            case "Fri":
                $this->termin["tag"] = "Fr";
                break;
            case "Sat":
                $this->termin["tag"] = "Sa";
                break;
            case "Sun":
                $this->termin["tag"] = "So";
                break;
            default:
                $this->termin["tag"] = "n.V";
        }

        return $this->termin;
    }
}