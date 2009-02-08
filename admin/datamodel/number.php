<?php

/*
    Copyright (C) 2009  Fabio Mattei

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

include (DBPATH.'db.php');
include (DATAMODELPATH.'article.php');

class Number {
    const NEW_NUMBER = -1;
    private $id = self::NEW_NUMBER;
    private $indexnumber;
    private $title;
    private $subtitle;
    private $summary;
    private $db;

    const INSERT_SQL = 'insert into numbers (indexnumber, title, subtitle, summary) values (?, ?, ?, ?)';
    const UPDATE_SQL = 'update numbers set indexnumber = ?, title = ?, subtitle = ?, summary = ? where id = ?';
    const DELETE_SQL = 'delete from numbers where id = ?';
    const SELECT_BY_ID = 'select id, indexnumber, title, subtitle, summary from numbers where id = ?';
    const SELECT_BY_TITLE = 'select id, indexnumber, title, subtitle, summary from numbers where title like ?';
    const SELECT_LAST = 'select id, indexnumber, title, subtitle, summary from numbers where publisched=1 order by indexnumber DESC Limit 1';
    const SELECT_ALL_PUB = 'select id, indexnumber, title, subtitle, summary from numbers where publisched=1 order by indexnumber DESC';
    const SELECT_ALL = 'select id, indexnumber, title, subtitle, summary from numbers where publisched=1 order by id DESC';
    const SELECT_ARTICLES_PUB = 'select * from articles where publisched=1 AND number_id = ? order by indexnumber DESC';

    public function __construct($id=NEW_NUMBER, $indexnumber="", $title="", $subtitle="", $summary="") {
        $this->db = DB::getInstance();
        $this->id = $id;
        $this->indexnumber = $indexnumber;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->summary = $summary;
    }

    public function getId() {
        return $this->id;
    }

    public static function findById($id) {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_BY_ID,
            array("$id"),
            $tables);
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret = new Number($row['id'], $row['indexnumber'], $row['title'], $row['subtitle'], $row['summary']);
            }
        }
        return $ret;
    }

    public static function findByTitle($title) {
        $rs = DB::getInstance()->execute(
            self::SELECT_BY_TITLE,
            array("%$title%"),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['title'], $row['subtitle'], $row['summary']);
            }
        }
        return $ret;
    }

    public static function findLast() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_LAST,
            array(),
            $tables);
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret = new Number($row['id'], $row['indexnumber'], $row['title'], $row['subtitle'], $row['summary']);
            }
        }
        return $ret;
    }

    public static function findAllPublished() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_ALL_PUB,
            array(),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['title'], $row['subtitle'], $row['summary']);
            }
        }
        return $ret;
    }

    public static function findAll() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_ALL,
            array(),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['title'], $row['subtitle'], $row['summary']);
            }
        }
        return $ret;
    }

    public function articles() {
        $tables = array("articles" => TBPREFIX."articles");
        $rs = DB::getInstance()->execute(
            self::SELECT_ARTICLES_PUB,
            array("$this->id"),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Article(
                    $row['id'],
                    $row['number_id'],
                    $row['indexnumber'],
                    $row['publisched'],
                    $row['title'],
                    $row['subtitle'],
                    $row['summary'],
                    $row['body'],
                    $row['tag'],
                    $row['metadescription'],
                    $row['metakeyword']);
            }
        }
        return $ret;
    }

    protected function save() {
        if ($this->id == self::NEW_COMMENT) {
            $this->insert();
        } else {
            $this->update();
        }
        $this->setTimeStamps();
    }

    public function delete() {
        $this->conn->execute(DELETE_SQL, array((int) $this->getId()));
        $this->id = self::NEW_COMMENT;
        $this->title = '';
        $this->subtitle = '';
        $this->summary = '';
    }

    protected function insert() {
        $rs = $this->conn->execute(
            self::INSERT_SQL,
            array($this->title, $this->subtitle, $this->summary));
        if ($rs) {
            $this->id = (int) $this->conn->Insert_ID();
        } else {
            trigger_error('DB error: '.$this->db->getErrorMsg());
        }
    }

    protected function update() {
        $this->conn->execute(
            self::UPDATE_SQL,
            array($this->title, $this->subtitle, $this->summary));
    }

    protected function setTimeStamps() {
        $rs = $this->conn->execute(
            self::SELECT_BY_ID,
            array($this->id));
        if ($rs) {
            $row = $rs->fetchRow();
            $this->created = $row['created'];
            $this->updated = $row['updated'];
        }
    }
    

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getSubtitle() {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }
        
}


?>
