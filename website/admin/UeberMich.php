<?php
include_once "getPDO.php";

class UeberMich
{
    /**
     * Link to Event in Database
     * @var string
     */
    private string $infotext;

    /**
     * Regex Pattern for Event
     * @var string
     */

    private string $textPattern = "/^[\w `'{}()%&\-@#$~!_^\/\.\n\r]*$/m";

    /**
     * UeberMich constructor.
     * check ueberMich if there is a duplicate entry
     * @param $infotext
     */
    public function __construct($infotext)
    {
        $this->infotext = $infotext;
    }

    /**
     * Updates the infotext of UeberMich
     * @param $set
     * @throws \Doctrine\DBAL\Exception
     */
    public function update($set)
    {
        if (preg_match($this->textPattern, $set)) {
            $queryBuilder = getPDO()
                ->update('ueber_mich')
                ->set('infotext', '?')
                ->where('pk_person_id = ?')
                ->setParameter(0, $set)
                ->setParameter(1, 1);
            if ($queryBuilder->executeQuery()) {
                $this->success("update");
            }
        } else {
            $this->otherError();
        }
    }

    /**
     * Success Message
     * @param $function
     */
    public function success($function) {
        $text = $function == "update" ? "abgeändert" : "";
        echo <<<ENDE
        <div id='erfolgreich'>
            <h2>Dieser Infotext wurde erfolgreich $text!</h2>
        </div>
ENDE;
    }

    /**
     * Error Message for any other Error (f.e. does not match the expected pattern)
     */
    public function otherError() {
        echo <<<ENDE
        <div id='fehlgeschlagen' class='error'>
            <h2>Dieser Infotext entspricht nicht den Anforderungen!</h2>
        </div>
ENDE;
    }
}