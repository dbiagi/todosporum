<?php

namespace DBiagi\MainBundle\Service\Log\Handler;

use Monolog\Handler\AbstractProcessingHandler;

/**
 * Description of DatabaseHandler
 *
 * @author Diego de Biagi<diegobiagiviana@gmail.com>
 */
class DatabaseHandler extends AbstractProcessingHandler {

    /**
     * @var \Doctrine\DBAL\Connection 
     */
    private $conn;

    /**
     * @var string
     */
    private $table = 'log';

    /**
     * @var string[] additional fields to be stored in the database
     *
     * For each field $field, an additional context field with the name $field
     * is expected along the message, and further the database needs to have these fields
     * as the values are stored in the column name $field.
     */
    private $additionalFields = array();

    /**
     * @var \Doctrine\DBAL\Driver\Statement statement to insert a new record
     */
    private $statement;

    /**
     * @var boolean
     */
    private $initialized = false;
    
    public function __construct(Connection $conn, $level = Logger::DEBUG, $bubble = true) {
        parent::__construct($level, $bubble);

        $this->conn = $conn;
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record) {
        if (!$this->initialized) {
            $this->initialize();
        }

        if (!isset($record['context']['persist']) || !$record['context']['persist']) {
            return;
        }

        //'context' contains the array
        $contentArray = array_merge(array(
            'channel' => $record['channel'],
            'level' => $record['level'],
            'message' => $record['message'],
            'time' => $record['datetime']->format('U')
        ));

        $this->statement->execute($contentArray);
    }

    /**
     * Initializes this handler by creating the table if it not exists
     */
    private function initialize() {
        $this->conn->exec(
                'CREATE TABLE IF NOT EXISTS `' . $this->table . '` '
                . '(channel VARCHAR(255), level INTEGER, message LONGTEXT, time INTEGER UNSIGNED)'
        );

        //Read out actual columns
        $actualFields = array();
        $rs = $this->conn->query('SELECT * FROM `' . $this->table . '` LIMIT 0');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $actualFields[] = $col['name'];
        }

        //Calculate changed entries
        $removedColumns = array_diff($actualFields, $this->additionalFields, array('channel', 'level', 'message', 'time'));
        $addedColumns = array_diff($this->additionalFields, $actualFields);

        //Remove columns
        if (!empty($removedColumns)) {
            foreach ($removedColumns as $c) {
                $this->conn->exec('ALTER TABLE `' . $this->table . '` DROP `' . $c . '`;');
            }
        }

        //Add columns
        if (!empty($addedColumns)) {
            foreach ($addedColumns as $c) {
                $this->conn->exec('ALTER TABLE `' . $this->table . '` add `' . $c . '` TEXT NULL DEFAULT NULL;');
            }
        }

        //Prepare statement
        $columns = "";
        $fields = "";
        foreach ($this->additionalFields as $f) {
            $columns.= ", $f";
            $fields.= ", :$f";
        }
        $this->statement = $this->conn->prepare(
                'INSERT INTO `' . $this->table . '` (channel, level, message, time' . $columns . ') VALUES (:channel, :level, :message, :time' . $fields . ')'
        );
        $this->initialized = true;
    }

}
