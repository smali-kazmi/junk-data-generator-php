<?php

/**
 * @property $db CI_DB_active_record
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Junkdata extends MY_Controller {

    public function index() {
        die('i m end');
    }

    public function start($table_name, $chankSize = 100, $limit = 1000000) {

        $fields = $this->db->field_data($table_name);

        $chankSize = is_numeric($chankSize) ? $chankSize : 100;
        $limit = is_numeric($limit) ? $limit : 1000000;




        $data = array();

        for ($x = 1; $x <= $limit; $x++) {
            $row = array();
            foreach ($fields as $field) {
                if (!$field->primary_key) {
                    $row[$field->name] = $this->getDataByVieldType($field->type, $field->max_length);
                }
            }
            $data[] = $row;
            if ($x % $chankSize == 0) {
                $this->db->insert_batch($table_name, $data);
                $data = [];

                echo "Record Inserted: $x \n";
            }
        }

        if (count($data)) {
            $this->db->insert_batch($table_name, $data);
            echo "Record Inserted: $x \n";
        }

        die;
    }

    private function getDataByVieldType($fieldType, $maxSize = '') {

        $ret = NULL;



        switch (strtoupper($fieldType)) {

            case 'TINYINT':
                $ret = $this->generateRandomNumber(127);
                break;

            case 'SMALLINT':
                $ret = $this->generateRandomNumber(32767);
                break;

            case 'MEDIUMINT':
                $ret = $this->generateRandomNumber(8388607);
                break;

            case 'INT':
            case 'INTEGER':
                $ret = $this->generateRandomNumber(2147483647);
                break;

            case 'BIGINT':
                $ret = $this->generateRandomNumber(2147483647);
                break;

            case 'FLOAT':
                $ret = $this->generateRandomNumber(1.175494351E-38);
                break;

            case 'DOUBLE':
            case 'DOUBLE PRECISION':
            case 'REAL':
                $ret = $this->generateRandomNumber(1.175494351E-38);
                break;

            case 'DECIMAL':
            case 'NUMERIC':
                $ret = $this->generateRandomNumber(8388607);
                break;

            case 'DATE':
                $ret = date('Y-m-d', $this->generateRandomTimestamp());
                break;

            case 'DATETIME':
                $ret = date('Y-m-d H:i:s', $this->generateRandomTimestamp());
                break;

            case 'TIMESTAMP':
                $ret = $this->generateRandomTimestamp();
                break;

            case 'TIME':
                $ret = date('H:i:s', $this->generateRandomTimestamp());
                break;

            case 'YEAR':
                $ret = date('H:i:s', $this->generateRandomTimestamp());
                break;

            case 'CHAR':
                $ret = $this->generateRandomString($maxSize);
                break;

            case 'VARCHAR':
                $ret = $this->generateRandomString($maxSize);
                break;

            case 'TINYBLOB':
            case 'TINYTEXT':
                $ret = $this->generateRandomString(255);
                break;

            case 'BLOB':
            case 'TEXT':
                $ret = $this->generateRandomString(65535);
                break;

            case 'MEDIUMBLOB':
            case 'MEDIUMTEXT':
                $ret = $this->generateRandomString(16777215);
                break;

            case 'LONGBLOB':
            case 'LONGTEXT':
                $ret = $this->generateRandomString(4294967295);
                break;

            case 'ENUM':
                $ret = $this->getEnumValue($maxSize);
                break;

            case 'SET':
                break;
        }
        return $ret;
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789 abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ ';
        $randomString = '';
        $limit = rand(1, $length);
        for ($i = 0; $i < $limit; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    private function generateRandomNumber($max) {
        return rand(0, $max - 1);
    }

    private function generateRandomTimestamp() {
        return rand(315581200, 1735738000);
    }

    private function getEnumValue($enum) {
        $arr = explode(',', $enum);
        return $arr[rand(0, count($arr) - 1)];
    }

    public function fromdump($tableName, $chankSize = 50, $limit = 1000000) {


        $fields = $this->db->field_data($tableName);
        $primeryKey = null;

        foreach ($fields as $field) {
            if ($field->primary_key) {
                $primeryKey = $field->name;
            }
        }

        $data = array();
        $rows = $this->db->get($tableName)->result('array');

        if (count($rows)) {

            for ($x = 1; $x <= $limit; $x++) {

                $row = $rows[array_rand($rows)];

                if ($primeryKey) {
                    unset($row[$primeryKey]);
                }

                $data[] = $row;

                if ($x % $chankSize == 0) {
                    $this->db->insert_batch($tableName, $data);
                    $data = [];
                    echo "Record Inserted: $x \n";
                }
            }

            if (count($data)) {
                $this->db->insert_batch($tableName, $data);
                echo "Record Inserted: $x \n";
            }
        }
        
        
        die('done');
    }

}
