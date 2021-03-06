<?php
/*
	Copyright (C) 2009-2010  Fabio Mattei <burattino@gmail.com>

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
require_once(STARTPATH.DATAMODELPATH.'number.php');
require_once(STARTPATH.DATAMODELPATH.'comment.php');
require_once(STARTPATH.DATAMODELPATH.'category.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.FILTERPATH.'articlefilterremote.php');
require_once(STARTPATH.UTILSPATH.'pagination.php');
require_once(STARTPATH.UTILSPATH.'datehandler.php');

class Article {
    const NEW_ARTICLE = -1;
    private $id = self::NEW_ARTICLE;
    private $number_id;
    private $category_id;
    private $indexnumber;
    private $published;
    private $title;
    private $subtitle;
    private $summary;
    private $body;
    private $commentsallowed;
    private $tag;
    private $metadescription;
    private $metakeyword;
    private $created;
    private $updated;
    private $filter;

    const INSERT_SQL = 'insert into articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values (@#@, @#@, @#@, @#@, @#@, @?@, @?@, @?@, @?@, @#@, @?@, @?@, @?@, now(), now())';
    const UPDATE_SQL = 'update articles set number_id = @#@, category_id = @#@, indexnumber = @#@, published = @#@, commentsallowed = @#@, title = @?@, subtitle = @?@, summary = @?@, body = @?@, tag = @?@, metadescription = @?@, metakeyword = @?@, updated=now() where id = @#@';
    const DELETE_SQL = 'delete from articles where id = @#@ ';
    const DELETE_USER_ARTICLE = 'delete from users_articles where article_id = @#@ ';
    const SELECT_BY_ID = 'select * from articles where id = @#@';
    const SELECT_LAST_N = 'select * from articles ORDER BY updated DESC LIMIT @#@ ';
    const SELECT_MAX_ID = 'select max(id) as maxid from articles ';
    const SELECT_BY_TITLE = 'select * from articles where title like @?@';
    const FIND_IN_ALL_TEXT_FIELDS_PUBLISHED_ARTICLES = 'select * from articles where (title like @?@ OR subtitle like @?@ OR summary like @?@ OR body like @?@) AND published=1 ';
    const SELECT_BY_TAG = 'select * from articles ';
    const SELECT_BY_TAG_COUNTER = 'select count(id) as num from articles ';
    const SELECT_BY_TAG_CONDITIONS = ' where tag like @?@ AND published=1 ';
    const SELECT_COMMENTS_PUB = 'select * from comments where published=1 AND article_id = @#@ order by created DESC';
    const SELECT_COMMENTS = 'select * from comments where article_id = @#@ order by created DESC';
    const SELECT_CATEGORY = 'select * from categories where id = @#@ Limit 1';
    const SELECT_NUMBER = 'select * from numbers where id = @#@';
    const SELECT_LAST = 'select * from articles order by indexnumber DESC Limit 1';
    const SELECT_ALL_PUB = 'select * from articles where published=1 order by indexnumber DESC';
    const SELECT_ALL = 'select * from articles order by id DESC';
    const SELECT_ALL_ORD_INDEXNUMBER = 'select * from articles order by indexnumber DESC';
    const SELECT_BY_INDEXNUMBER = 'select indexnumber from articles order by indexnumber DESC';
    const SELECT_MAX_INDEXNUMBER = 'select max(indexnumber) from articles ';
    const SELECT_BY_ID_ORD = 'select id from articles order by id DESC';
    const SELECT_UP_INDEXNUMBER = 'select * from articles WHERE number_id = @#@ AND indexnumber > @#@ order by indexnumber ';
    const SELECT_DOWN_INDEXNUMBER = 'select * from articles WHERE number_id = @#@ AND indexnumber < @#@ order by indexnumber DESC ';
    const SELECT_USERS = 'select US.* from users as US, users_articles as UA where US.id = UA.user_id AND UA.article_id = @#@ order by US.name ';
    const DELETE_USER = 'delete from users_articles WHERE article_id = @#@ AND user_id = @#@ ';
    const LINK_USER = 'insert into users_articles (article_id, user_id) values (@#@, @#@) ';

    public function __construct($id=self::NEW_ARTICLE, $number_id=self::NEW_ARTICLE, $category_id=self::NEW_ARTICLE, $indexnumber='', $published='0', $title='', $subtitle='', $summary='', $body='', $commentsallowed='0', $tag='', $metadescription='', $metakeyword='', $created='', $updated='') {
        $this->filter = ArticleFilterRemote::getInstance();
        $this->id = $id;
        $this->number_id = $number_id;
        $this->category_id = $category_id;
        $this->indexnumber = $indexnumber;
        $this->published = $published;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->summary = $summary;
        $this->body = $body;
        $this->commentsallowed = $commentsallowed;
        $this->tag = $tag;
        $this->metadescription = $metadescription;
        $this->metakeyword = $metakeyword;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        try {
            $tables = array("articles" => TBPREFIX."articles");
            $rs = DB::getInstance()->execute(
                    $SQL,
                    $array_str,
                    $array_int,
                    $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new Article($row['id'], $row['number_id'], $row['category_id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['body'], $row['commentsallowed'], $row['tag'], $row['metadescription'], $row['metakeyword'], $row['created'], $row['updated']);
            } else {
                $ret = new Article();
            }
        } catch (Exception $e) {
            $ret = new Article();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $tables = array("articles" => TBPREFIX."articles");
        return self::findManyAndSpecifyTables($SQL, $array_str, $array_int, $tables);
    }

    public static function findManyAndSpecifyTables($SQL, $array_str, $array_int, $tables) {
        $ret = array();
        try {
            $rs = DB::getInstance()->execute(
                    $SQL,
                    $array_str,
                    $array_int,
                    $tables);
            $ret = array();
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Article($row['id'], $row['number_id'], $row['category_id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['body'], $row['commentsallowed'], $row['tag'], $row['metadescription'], $row['metakeyword'], $row['created'], $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Article();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findById($id) {
        $ret = ARTICLE::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findLastN($n) {
        $ret = ARTICLE::findMany(self::SELECT_LAST_N, array(), array($n));
        return $ret;
    }

    public function findUpIndexNumber() {
        $ret = ARTICLE::findOne(self::SELECT_UP_INDEXNUMBER, array(), array($this->number_id, $this->indexnumber));
        return $ret;
    }

    public function findDownIndexNumber() {
        $ret = ARTICLE::findOne(self::SELECT_DOWN_INDEXNUMBER, array(), array($this->number_id, $this->indexnumber));
        return $ret;
    }

    public static function findByTitle($title) {
        $ret = ARTICLE::findMany(self::SELECT_BY_TITLE, array("%$title%"), array());
        return $ret;
    }

    public static function findByTag($tag) {
        $ret = ARTICLE::findMany(self::SELECT_BY_TAG . self::SELECT_BY_TAG_CONDITIONS, array("%$tag%"), array());
        return $ret;
    }

    public static function findInAllTextFields($string) {
        $query = 'select * from articles where';
        $dividedstrings = explode(' ', $string);
        $arraystrings = array();
        foreach ($dividedstrings as $str) {
            $query .= ' (title like @?@ OR subtitle like @?@ OR summary like @?@ OR body like @?@) AND ';
            $arraystrings[] = '%'.$str.'%';
            $arraystrings[] = '%'.$str.'%';
            $arraystrings[] = '%'.$str.'%';
            $arraystrings[] = '%'.$str.'%';
        }
        $query = substr($query, 0, -4);
        $ret = ARTICLE::findMany($query, $arraystrings, array());
        return $ret;
    }

    public static function findInAllTextFieldsInPublishedArticles($string) {
                $query = 'select * from articles where';
        $dividedstrings = explode(' ', $string);
        $arraystrings = array();
        foreach ($dividedstrings as $str) {
            $query .= ' (title like @?@ OR subtitle like @?@ OR summary like @?@ OR body like @?@) AND ';
            $arraystrings[] = '%'.$str.'%';
            $arraystrings[] = '%'.$str.'%';
            $arraystrings[] = '%'.$str.'%';
            $arraystrings[] = '%'.$str.'%';
        }
        $query = substr($query, 0, -4);
        $query .= ' AND published=1 ';
        $ret = ARTICLE::findMany($query, $arraystrings, array());
        return $ret;
    }

    public static function findLast() {
        return ARTICLE::findOne(self::SELECT_LAST, array(), array());
    }

    public static function findAllPublished() {
        return ARTICLE::findMany(self::SELECT_ALL_PUB, array(), array());
    }

    public static function findAll() {
        return ARTICLE::findMany(self::SELECT_ALL, array(), array());
    }

    public static function findAllOrderedByIndexNumber() {
        return ARTICLE::findMany(self::SELECT_ALL_ORD_INDEXNUMBER, array(), array());
    }

    public function commentsPublished() {
        return Comment::findMany(self::SELECT_COMMENTS_PUB, array(), array($this->id));
    }

    public function comments() {
        return Comment::findMany(self::SELECT_COMMENTS, array(), array($this->id));
    }

    public function category() {
        return Category::findOne(self::SELECT_CATEGORY, array(), array($this->category_id));
    }

    public function number() {
        return Number::findOne(self::SELECT_NUMBER, array(), array($this->number_id));
    }

    public function users() {
        $ret = array();
        try {
            $tables = array('users' => TBPREFIX.'users',
                    'users_articles' => TBPREFIX.'users_articles');
            $rs = DB::getInstance()->execute(
                    self::SELECT_USERS,
                    array(),
                    array($this->id),
                    $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new User(
                        $row['id'],
                        $row['name'],
                        $row['username'],
                        $row['password'],
                        $row['body'],
                        $row['role'],
                        $row['toshow'],
                        $row['email'],
                        $row['msn'],
                        $row['skype'],
                        $row['created'],
                        $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new User();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public function auhorsNamesConcatenation() {
        $out = '';
        foreach ($this->users() as $user) {
                $out .= $user->getName().', ';
        }

        return substr($out, 0, -2);
    }

    public function isUser($iduser) {
        $out = false;
        foreach ($this->users() as $user) {
            if ($user->getId() == $iduser) $out = true;
        }
        return $out;
    }

    public function unlinkUser($idUser) {
        try {
            $tables = array('users_articles' => TBPREFIX.'users_articles');
            $rs = DB::getInstance()->execute(
                    self::DELETE_USER,
                    array(),
                    array($this->id, $idUser),
                    $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function linkUser($idUser) {
        try {
            $tables = array('users_articles' => TBPREFIX.'users_articles');
            $rs = DB::getInstance()->execute(
                    self::LINK_USER,
                    array(),
                    array($this->id, $idUser),
                    $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function save() {
        if ($this->id == self::NEW_ARTICLE) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function insert() {
        $this->id = $this->getMaxId()+1;
        $this->indexnumber = $this->getMaxIndexNumber()+1;
        $tables = array("articles" => TBPREFIX."articles");
        try {
            DB::getInstance()->execute(
                    self::INSERT_SQL,
                    array($this->title, $this->subtitle, $this->summary, $this->body, $this->tag, $this->metadescription, $this->metakeyword),
                    array($this->id, $this->number_id, $this->category_id, $this->indexnumber, $this->published, $this->commentsallowed),
                    $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function update() {
        $tables = array("articles" => TBPREFIX."articles");
        try {
            DB::getInstance()->execute(
                    self::UPDATE_SQL,
                    array($this->title, $this->subtitle, $this->summary, $this->body, $this->tag, $this->metadescription, $this->metakeyword),
                    array($this->number_id, $this->category_id, $this->indexnumber, $this->published, $this->commentsallowed, $this->id),
                    $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function delete() {
        $tables = array("articles" => TBPREFIX."articles", "users_articles" => TBPREFIX."users_articles");
        try {
            DB::getInstance()->execute(self::DELETE_SQL, array(),array((int) $this->getId()), $tables);
            if (count($this->users()) > 0) {
                DB::getInstance()->execute(self::DELETE_USER_ARTICLE, array(),array((int) $this->getId()), $tables);
            }
            $this->id = self::NEW_ARTICLE;
            $this->number_id = '';
            $this->category_id = '';
            $this->title = '';
            $this->subtitle = '';
            $this->summary = '';
            $this->body = '';
            $this->tag = '';
            $this->metadescription = '';
            $this->metakeyword = '';
            $this->created = '';
            $this->updated = '';
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getMaxId() {
        $tables = array("articles" => TBPREFIX."articles");
        try {
            $rs = DB::getInstance()->execute(
                    self::SELECT_MAX_ID,
                    array(),
                    array(),
                    $tables);
            $row = mysql_fetch_array($rs);
            $maxId = $row['maxid'];
        } catch (Exception $e) {
            $maxId = 0;
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $maxId;
    }

    public function getMaxIndexNumber() {
        $tables = array("articles" => TBPREFIX."articles");
        try {
            $rs = DB::getInstance()->execute(
                    self::SELECT_MAX_INDEXNUMBER,
                    array(),
                    array(),
                    $tables);
            if ($row = mysql_fetch_array($rs)) {
                $maxIndexNumber = $row[0];
            } else {
                $maxIndexNumber = 1;
            }
        } catch (Exception $e) {
            $maxIndexNumber = 1;
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $maxIndexNumber;
    }

    public static function getPageNumbers() {
        return Pagination::calculatePageNumbers(DB::getInstance()->getCountLastQueryResults());
    }

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
    }

    public function getPublished() {
        return $this->published;
    }

    public function setPublished($published) {
        $this->published = $published;
    }

    public function getTitle() {
        $out = $this->filter->executeFiltersTitle($this->title);
        return $out;
    }

    public function getUnfilteredTitle() {
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

    public function getBody() {
        $out = $this->filter->executeFiltersBody($this->body);
        return $out;
    }

    public function getUnfilteredBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getCommentsallowed() {
        return $this->commentsallowed;
    }

    public function setCommentsallowed($commentsallowed) {
        $this->commentsallowed = $commentsallowed;
    }

    public function getTag() {
        $out = $this->filter->executeFiltersTag($this->tag);
        return $out;
    }

    public function getUnfilteredTag() {
        return $this->tag;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function getMetadescription() {
        return $this->metadescription;
    }

    public function setMetadescription($metadescription) {
        $this->metadescription = $metadescription;
    }

    public function getMetakeyword() {
        return $this->metakeyword;
    }

    public function setMetakeyword($metakeyword) {
        $this->metakeyword = $metakeyword;
    }
    
    public function getCreated() {
        return $this->created;
    }

    public function getCreatedFormatted() {
        return DateHandler::DataFormat($this->created);
    }
    public function getUpdated() {
        return $this->updated;
    }

    public function getNumber_id() {
        return $this->number_id;
    }

    public function setNumber_id($number_id) {
        $this->number_id = $number_id;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }

}

?>