<?php
include_once "../getPDO.php";

class Termin
{
    /**
     * @var string
     */
    private string $date;
    /**
     * @var string
     */
    private string $von;
    /**
     * @var string
     */
    private string $bis;
    /**
     * @var string
     */
    private string $location;

    private string $datePattern = "/^[\d]{4}-[\d]{2}-[\d]{2}$/";
    private string $timePattern = "/^[\d]{2}:[\d]{2}$/";
    private string $locationPattern = "/^[\w\d `'{}()%&\-@#$~!_^\/]*$/";

    /**
     * Termin constructor.
     * @param string $date
     * @param string $von
     * @param string $bis
     * @param string $location
     */
    public function __construct(string $date, string $von, string $bis, string $location)
    {
        $this->date = $date;
        $this->von = $von;
        $this->bis = $bis;
        $this->location = $location;
    }


    /**
     * Deletes given termin from database
     */
    public function delete()
    {
        if (preg_match($this->datePattern, $this->date)) {
            $queryBuilder = getPDO()
                ->delete('termin')
                ->where('pk_datum = ?')
                ->setParameter(0, $this->date);

            if ($queryBuilder->execute()) {
                $this->success("delete");
            } else {
                $this->duplicateText("delete");
            }
        } else {
            $this->otherError();
        }
    }

    /**
     * Returns termin values in german language
     * adds value "tag" in german language
     * @return array
     */
    public function getValues() {
        $von = explode(":", $this->von);
        $this->von = $von[0].":".$von[1];

        $bis = explode(":", $this->bis);
        $this->bis = $bis[0].":".$bis[1];

        $datumArray = explode('-', $this->date);
        $tag = strtotime($this->date);

        $this->date = $datumArray[2].".".$datumArray[1].".".substr($datumArray[0], 2);
        $tag = date('D', $tag);

        switch ($tag) {
            case "Mon":
                $tag = "Mo";
                break;
            case "Tue":
                $tag = "Di";
                break;
            case "Wed":
                $tag = "Mi";
                break;
            case "Thu":
                $tag = "Do";
                break;
            case "Fri":
                $tag = "Fr";
                break;
            case "Sat":
                $tag = "Sa";
                break;
            case "Sun":
                $tag = "So";
                break;
            default:
                $tag = "n.V";
        }

        return array(
            'pk_datum' => $this->date,
            'zeit_von' => $this->von,
            'zeit_bis' => $this->bis,
            'location' => $this->location,
            'tag' => $tag
        );
    }

    /**
     * Success Message
     * @param $function
     */
    public function success($function) {
        $text = $function == "delete" ? "gelöscht" : ($function == "insert" ? "hinzugefügt" : "");
        echo <<<ENDE
        <div id='erfolgreich'>
            <h2>Dieses Event wurde erfolgreich $text!</h2>
        </div>

ENDE;
    }

    /**
     * Error Message for duplicated Database Entries
     */
    public function duplicateText($function)
    {
        $text = $function == "delete" ? "gelöscht" : ($function == "insert" ? "vorhanden" : "");
        echo <<<ENDE
        <div id='fehlgeschlagen' class='error'>
            <h2>Dieses Event ist bereits $text!</h2>
        </div>

ENDE;
    }

    /**
     * Error Message for any other Error (f.e. does not match the expected pattern)
     */
    public function otherError() {
        echo <<<ENDE
        <div id='fehlgeschlagen' class='error'>
            <h2>Dieses Event entspricht nicht den Anforderungen!</h2>
        </div>

ENDE;
    }
}