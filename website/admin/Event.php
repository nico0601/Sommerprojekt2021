<?php
include "adminSpaceHeader.php";

class Event
{
    /**
     * Link to Event in Database
     * @var string
     */
    private string $event;
    /**
     * Bool for possible duplicate event
     * @var bool
     */
    private bool $duplicate;

    /**
     * Regex Pattern for Event
     * @var string
     */
    private string $eventPattern = "/^[\w\d `'{}()%&\-@#$~!_^\/]+\.[\w]+$/";

    /**
     * Event constructor.
     * Set event "pk" / "link to event image"
     * check event if there is a duplicate entry
     * @param $event
     * @throws \Doctrine\DBAL\Exception
     */
    public function __construct($event)
    {
        $this->event = $event;
        $this->duplicate = $this->checkPK();
    }

    /**
     * checks Event if PK is already in database
     * @return bool
     * @throws \Doctrine\DBAL\Exception
     */
    public function checkPK(): bool
    {
        $duplicate = false;

        $queryBuilder = getPDO()
            ->select('*')
            ->from('event');
        $events = $queryBuilder->fetchAllAssociative();

        foreach ($events as $event) {
            if ($duplicate) {
                return true;
            }
            $duplicate = $event['pk_event'] == $this->event;
        }
        return $duplicate;
    }

    /**
     * Deletes given event from database
     */
    public function delete()
    {
        if (preg_match($this->eventPattern, $this->event)) {
            $queryBuilder = getPDO()
                ->delete('event')
                ->where('pk_event = ?')
                ->setParameter(0, $this->event);
            $queryBuilder->execute();
            if (unlink("..".$this->event)) {
                $this->success("delete");
            } else {
                $this->duplicateText("delete");
            }
        } else {
            $this->otherError();
        }
    }

    /**
     * Inserts given event in database
     */
    public function insert()
    {
        if (!$this->duplicate && preg_match($this->eventPattern, $this->event)) {
            $queryBuilder = getPDO()
                ->insert('event')
                ->values(array(
                    'pk_event' => '?',
                    'fk_pk_id' => 1
                ))
                ->setParameter(0, $this->event);
            $queryBuilder->execute();
            $this->success("insert");
        } else if ($this->duplicate) {
            $this->duplicateText("insert");
        } else {
            $this->otherError();
        }
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