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

require_once(STARTPATH.DBPATH.'db.php');
require_once(STARTPATH.DATAMODELPATH.'article.php');
require_once(STARTPATH.FILTERPATH.'numberfilterremote.php');

class Number {
    const NEW_NUMBER = -1;
    private $id = self::NEW_NUMBER;
    private $indexnumber;
    private $published;
    private $title;
    private $subtitle;
    private $summary;
    private $db;
    private $filter;

    const INSERT_SQL = 'insert into numbers (indexnumber, published, title, subtitle, summary) values (\'?\', \'?\', \'?\', \'?\', \'?\')';
    const UPDATE_SQL = 'update numbers set indexnumber = \'?\', published = \'?\', title = \'?\', subtitle = \'?\', summary = \'?\' where id = \'?\'';
    const DELETE_SQL = 'delete from numbers where id = \'?\'';
    const SELECT_BY_ID = 'select * from numbers where id = ?';
    const SELECT_BY_TITLE = 'select * from numbers where title like ?';
    const SELECT_LAST = 'select * from numbers where published=1 order by indexnumber DESC Limit 1';
    const SELECT_ALL_PUB = 'select * from numbers where published=1 order by indexnumber DESC';
    const SELECT_ALL = 'select * from numbers order by id DESC';
    const SELECT_ARTICLES_PUB = 'select * from articles where published=1 AND number_id = ? order by indexnumber DESC';
    const SELECT_BY_INDEXNUMBER = 'select indexnumber from numbers order by indexnumber DESC';

    public function __construct($id=self::NEW_NUMBER, $indexnumber='', $published='', $title='', $subtitle='', $summary='') {
        $this->db = DB::getInstance();
        $this->filter = NumberFilterRemote::getInstance();
        $this->id = $id;
        $this->indexnumber = $indexnumber;
        $this->published = $published;
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
                $ret = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary']);
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
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary']);
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
                $ret = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary']);
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
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary']);
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
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary']);
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
                    $row['published'],
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

    public function save() {
        if ($this->id == self::NEW_NUMBER) {
            $this->insert();
        } else {
            $this->update();
        }
        $this->setTimeStamps();
    }

    public function delete() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::DELETE_SQL,
            array($this->id),
            $tables);
        $this->id = self::NEW_NUMBER;
        $this->indexnumber = '';
        $this->published = '';
        $this->title = '';
        $this->subtitle = '';
        $this->summary = '';
    }

    protected function insert() {
        $this->setIndexnumber($this->getMaxIndexNumber()+1);
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::INSERT_SQL,
            array($this->indexnumber, $this->published, $this->title, $this->subtitle, $this->summary),
            $tables);
////        if ($rs) {
////            $this->id = (int) $this->conn->Insert_ID();
////        } else {
////            trigger_error('DB error: '.$this->db->getErrorMsg());
////        }
    }

    protected function update() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::UPDATE_SQL,
            array($this->indexnumber, $this->published, $this->title, $this->subtitle, $this->summary, $this->id),
            $tables);
    }

    protected function setTimeStamps() {
//        $tables = array("numbers" => TBPREFIX."numbers");
//        $rs = DB::getInstance()->execute(
//            self::SELECT_BY_ID,
//            array($this->id),
//            $tables);
//        if ($rs) {
//            $row = $rs->fetchRow();
//            $this->created = $row['created'];
//            $this->updated = $row['updated'];
//        }
    }

    public function getMaxIndexNumber() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_BY_INDEXNUMBER,
            array(),
            $tables);
        if ($rs) {
            $row = mysql_fetch_array($rs);
                $maxIndexNumber = $row['indexnumber'];
        }
        return $maxIndexNumber;
    }

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
    }

    public function getTitle() {
        $out = $this->filter->executeFiltersTitle($this->title);
        return $out;
    }

    public function getUnfilteredTitle(){
        return $this->title;
    }


    public function setTitle($title) {
        $this->title = $title;
    }

    public function getSubtitle() {
        $out = $this->filter->executeFiltersSubTitle($this->subtitle);
        return $out;
    }

    public function getUnfilteredSubtitle() {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    public function getSummary() {
        $out = $this->filter->executeFiltersSummary($this->summary);
        return $out;
    }

    public function getUnfilteredSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

}

?>
