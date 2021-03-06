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

include ('../system/config.php');

class DbCreator {

    private $connection;

    public function connect() {
        $this->connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        mysql_select_db(DB_NAME, $this->connection);
    }

    public function closeConnection() {
        if ($this->connection) {
            mysql_close($this->connection);
        }
    }


    public function createTableNumbers() {
        $cmd = "CREATE TABLE ".TBPREFIX."numbers (
           id int(11) NOT NULL auto_increment,
           indexnumber int,
           published int NOT NULL DEFAULT '0',
           title varchar(255),
           subtitle text,
           summary text,
           commentsallowed int,
           metadescription text,
           metakeyword text,
           created datetime,
           updated datetime,
           PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTableNumbers() {
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (1, 1, 1, 'My first number', 'Subtitle to my first number',
           'Summary of my first number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (2, 2, 1, 'My second number', 'Subtitle to my second number',
           'Summary of my second number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (3, 3, 1, 'My third number', 'Subtitle to my third number',
           'Summary of my third number', 0, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (4, 4, 1, 'My 4th number', 'Subtitle to my first number',
           'Summary of my first number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (5, 5, 1, 'My 5th number', 'Subtitle to my second number',
           'Summary of my second number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (6, 6, 1, 'My 6th number', 'Subtitle to my third number',
           'Summary of my third number', 0, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (7, 7, 1, 'My 7th number', 'Subtitle to my first number',
           'Summary of my first number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (8, 8, 1, 'My 8th number', 'Subtitle to my second number',
           'Summary of my second number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (9, 9, 1, 'My 9th number', 'Subtitle to my third number',
           'Summary of my third number', 0, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (10, 10, 1, 'My 10 number', 'Subtitle to my first number',
           'Summary of my first number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (11, 11, 1, 'My 11 number', 'Subtitle to my second number',
           'Summary of my second number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (12, 12, 1, 'My 12 number', 'Subtitle to my third number',
           'Summary of my third number', 0, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (13, 13, 1, 'My 13 number', 'Subtitle to my first number',
           'Summary of my first number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword, created, updated)
           values (14, 14, 1, 'My 14th number', 'Subtitle to my second number',
           'Summary of my second number', 1, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, metadescription, metakeyword,  created, updated)
           values (15, 15, 0, 'My 15th number', 'Subtitle to my third number',
           'Summary of my third number', 0, '', '', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTableNumbers() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."numbers;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createTableArticles() {
        $cmd = "CREATE TABLE ".TBPREFIX."articles (
            id int(11) NOT NULL auto_increment,
            number_id int(11),
            category_id int(11),
            indexnumber int,
            published int NOT NULL DEFAULT '0',
            title varchar(255),
            subtitle text,
            summary text,
            body text,
            commentsallowed int,
            tag text,
            metadescription text,
            metakeyword text,
            created datetime,
            updated datetime,
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTableArticles() {
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (1, 1, 1, 1, 1, 'My first Article', 'Subtitle of my first article', 'summary of my first article',
            'Body of my first article', 1, 'history, flowers',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (2, 1, 1, 2, 1, 'My second Article', 'Subtitle of my second article', 'summary of my second article',
            'Body of my second article', 1, 'flowers, hello',
            'metadescription of my second article', 'metakeyword of my second article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (3, 1, 2, 3, 0, 'My third Article', 'Subtitle of my third article', 'summary of my third article',
            'Body of my third article', 1, 'roman history, bike',
            'metadescription of my third article', 'metakeyword of my third article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (4, 1, 1, 4, 1, 'My first Article', 'Subtitle of my first article', 'summary of my first article',
            'Body of my first article', 1, 'bike, flowers',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (5, 1, 1, 5, 1, 'My second Article', 'Subtitle of my second article', 'summary of my second article',
            'Body of my second article', 1, 'tag of my second article',
            'metadescription of my second article', 'metakeyword of my second article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (6, 1, 1, 6, 1, 'My third Article', 'Subtitle of my third article', 'summary of my third article',
            'Body of my third article', 1, 'tag of my third article',
            'metadescription of my third article', 'metakeyword of my third article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (7, 1, 1, 7, 1, 'My first Article', 'Subtitle of my first article', 'summary of my first article',
            'Body of my first article', 1, 'tag of my first article',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (8, 1, 1, 8, 1, 'My second Article', 'Subtitle of my second article', 'summary of my second article',
            'Body of my second article', 1, 'tag of my second article',
            'metadescription of my second article', 'metakeyword of my second article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (9, 1, 1, 9, 1, 'My third Article', 'Subtitle of my third article', 'summary of my third article',
            'Body of my third article', 1, 'tag of my third article',
            'metadescription of my third article', 'metakeyword of my third article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (10, 1, 1, 10, 1, 'My first Article', 'Subtitle of my first article', 'summary of my first article',
            'Body of my first article', 1, 'tag of my first article',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (11, 1, 1, 11, 1, 'My second Article', 'Subtitle of my second article', 'summary of my second article',
            'Body of my second article', 1, 'tag of my second article',
            'metadescription of my second article', 'metakeyword of my second article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (12, 1, 1, 12, 1, 'My third Article', 'Subtitle of my third article', 'summary of my third article',
            'Body of my third article', 1, 'tag of my third article',
            'metadescription of my third article', 'metakeyword of my third article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (13, 1, 1, 13, 1, 'My first Article', 'Subtitle of my first article', 'summary of my first article',
            'Body of my first article', 1, 'tag of my first article',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (14, 1, 1, 14, 1, 'My second Article', 'Subtitle of my second article', 'summary of my second article',
            'Body of my second article', 1, 'tag of my second article',
            'metadescription of my second article', 'metakeyword of my second article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (15, 1, 1, 15, 1, 'My third Article', 'Subtitle of my third article', 'summary of my third article',
            'Body of my third article', 1, 'roman history, flowers, hello',
            'metadescription of my third article', 'metakeyword of my third article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."articles (id, number_id, category_id, indexnumber, published, title, subtitle, summary, body, commentsallowed, tag, metadescription, metakeyword, created, updated) values
            (16, 14, 1, 15, 1, 'My final Article', 'Subtitle of my final article', 'summary of my final article',
            'Body of my final article', 1, 'bike, hello',
            'metadescription of my final article', 'metakeyword of my final article', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTableArticles() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."articles;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createTableComments() {
        $cmd = "CREATE TABLE ".TBPREFIX."comments (
            id int(11) NOT NULL auto_increment,
            article_id int(11),
            title varchar(255),
            published int NOT NULL DEFAULT '0',
            body text,
            signature text,
            created datetime,
            updated datetime,
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTableComments() {
        $cmd = "insert into ".TBPREFIX."comments (id, article_id, published, title, body, signature, created, updated) values
            (1, 1, 1, 'My first comment', 'text of my first comment', 'signature of my first comment', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."comments (id, article_id, published, title, body, signature, created, updated) values
            (2, 1, 0, 'My first comment', 'text of my first comment', 'signature of my first comment', now(), now())";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTableComments() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."comments;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createTablePages() {
        $cmd = "CREATE TABLE ".TBPREFIX."pages (
            id int(11) NOT NULL auto_increment,
            title varchar(255),
            published int NOT NULL DEFAULT '0',
            indexnumber int,
            subtitle text,
            summary text,
            body text,
            tag text,
            metadescription text,
            metakeyword text,
            created datetime,
            updated datetime,
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTablePages() {
        $cmd = "insert into ".TBPREFIX."pages (id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values
            (1, 1, 1, 'My firts Page', 'Subtitle of my first page', 'summary of my first page',
            'Body of my first page', 'tag of my first page',
            'metadescription of my first page', 'metakeyword of my first page', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."pages (id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values
            (2, 2, 1, 'My second Page', 'Subtitle of my second page', 'summary of my second page',
            'Body of my second page', 'tag of my second page',
            'metadescription of my first page', 'metakeyword of my first page', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."pages (id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values
            (3, 3, 0, 'My third Page', 'Subtitle of my third page', 'summary of my third page',
            'Body of my third page', 'tag of my third page',
            'metadescription of my third page', 'metakeyword of my third page', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTablePages() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."pages;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createTableUsers() {
        $cmd = "CREATE TABLE ".TBPREFIX."users (
            id int(11) NOT NULL auto_increment,
            name varchar(255),
            username varchar(255),
            password varchar(255),
            body text,
            role varchar(255),
            toshow int NOT NULL DEFAULT '1',
            email varchar(255),
            msn varchar(255),
            skype varchar(255),
            created datetime,
            updated datetime,
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTableUsers() {
        $cmd = "insert into ".TBPREFIX."users (name, username, password, body, role, toshow, email, msn, skype, created, updated) values
            ('New User', 'newuser', '".md5('psw')."', 'short description', '', 1, 'email@email.com', 'abcdef@abcdef.com', 'abcdef', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."users (name, username, password, body, role, toshow, email, msn, skype, created, updated) values
            ('Second User', 'seconduser', '".md5("second")."', 'short description', 'role', 1, 'email@email.com', 'abcdef@abcdef.com', 'abcdef', NOW(), NOW())";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."users (name, username, password, body, role, toshow, email, msn, skype, created, updated) values
            ('New User', 'user', '".md5("psw")."',
            'Tityre, tu patulae recubans sub tegmine fagi siluestrem tenui musam meditaris auena: nos patriae finis et dulcia linquimus arua. nos patriam fugimus: tu, Tityre, lentus in umbra formosam resonare doces Amaryllida siluas. O Meliboee, deus nobis haec otia fecit. namque erit ille mihi semper deus, illius aram saepe tener nostris ab ouilibus imbuet agnus. ille meas errare boues, ut cernis, et ipsum ludere quae uellem calamo permisit agresti. Non equidem inuideo, miror magis; undique totis',
            'publisher', 1, 'email@email.com', 'abcdef@abcdef.com', 'abcdef', '2009-08-06', '2009-08-06')";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTableUsers() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."users;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createTableUsersArticles() {
        $cmd = "CREATE TABLE ".TBPREFIX."users_articles (
            id int(11) NOT NULL auto_increment,
            article_id int(11),
            user_id int(11),
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTableUsersArticles() {
        $cmd = "insert into ".TBPREFIX."users_articles (id, article_id, user_id) values (1, 1, 1)";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."users_articles (id, article_id, user_id) values (2, 1, 2)";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."users_articles (id, article_id, user_id) values (3, 2, 1)";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."users_articles (id, article_id, user_id) values (4, 3, 2)";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTableUsersArticles() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."users_articles;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createCategories() {
        $cmd = "CREATE TABLE ".TBPREFIX."categories (
            id int(11) NOT NULL auto_increment,
            name varchar(255),
            description text,
            published int NOT NULL DEFAULT '0',
            indexnumber int,
            created datetime,
            updated datetime,
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateCategories() {
        $cmd = "insert into ".TBPREFIX."categories (name, description, published, indexnumber, created, updated) values
            ('News', 'News Articles', 1, 1, '2009-08-06', '2009-08-06')";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."categories (name, description, published, indexnumber, created, updated) values
            ('Sport', 'Sport Articles', 1, 2, '2009-08-06', '2009-08-06')";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."categories (name, description, published, indexnumber, created, updated) values
            ('Relax', 'Relaxing Articles', 0, 3, '2009-08-06', '2009-08-06')";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropCategories() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."categories;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function createTableOptions() {
        $cmd = "CREATE TABLE ".TBPREFIX."options (
            id int(11) NOT NULL auto_increment,
            name varchar(255),
            type varchar(255),
            value varchar(255),
            PRIMARY KEY (id));";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function populateTableOptions() {
        $cmd = "insert into ".TBPREFIX."options (name, type, value) values
            ('commandSandBox', 'plugin', 'active')";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."options (name, type, value) values
            ('filterSandBox', 'plugin', 'active')";
        $result = mysql_query($cmd, $this->connection);
        $cmd = "insert into ".TBPREFIX."options (name, type, value) values
            ('default', 'template', 'active')";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    public function dropTableOptions() {
        $cmd="DROP TABLE IF EXISTS ".TBPREFIX."options;";
        $result = mysql_query($cmd, $this->connection);
        return $result;
    }

    function createSchema() {

        if ($this->connection) {

            $result = $this->createTableNumbers();

            if ($result) {
                $out = "Table Numbers created<BR>";
            } else {
                $out = "Table Numbers NOT created<BR>";;
            }

            $result = $this->createCategories();

            if ($result) {
                $out .= "Table Categories created<BR>";
            } else {
                $out .= "Table Categories NOT created<BR>";;
            }

            $result = $this->createTableArticles();

            if ($result) {
                $out .= "Table Articles created<BR>";
            } else {
                $out .= "Table Articles NOT created<BR>";;
            }

            $result = $this->createTableComments();

            if ($result) {
                $out .= "Table Comments created<BR>";
            } else {
                $out .= "Table Comments NOT created<BR>";;
            }

            $result = $this->createTablePages();

            if ($result) {
                $out .= "Table Pages created<BR>";
            } else {
                $out .= "Table Pages NOT created<BR>";;
            }

            $result = $this->createTableUsers();

            if ($result) {
                $out .= "Table Users created<BR>";
            } else {
                $out .= "Table Users NOT created<BR>";;
            }

            $result = $this->createTableUsersArticles();

            if ($result) {
                $out .= "Table Users created<BR>";
            } else {
                $out .= "Table Users NOT created<BR>";
            }

            $result = $this->createTableOptions();

            if ($result) {
                $out .= "Table Options created<BR>";
            } else {
                $out .= "Table Options NOT created<BR>";
            }

        } else {
            $out = "Error in the connection <br>".mysql_errno().": ".mysql_error();
        }

        return $out;
    }

    function populateSchema() {

        if ($this->connection) {

            $result = $this->populateTableNumbers();

            if ($result) {
                $out = "Dummy data Number Created<BR>";
            } else {
                $out = "Dummy data Number NOT created<BR>";;
            }

            $result = $this->populateCategories();

            if ($result) {
                $out .= "Dummy data Categories Created<BR>";
            } else {
                $out .= "Dummy data Categories NOT created<BR>";;
            }

            $result = $this->populateTableArticles();

            if ($result) {
                $out .= "Dummy data Article Created<BR>";
            } else {
                $out .= "Dummy data Article NOT created<BR>";;
            }

            $result = $this->populateTableComments();

            if ($result) {
                $out .= "Dummy data Comment Created<BR>";
            } else {
                $out .= "Dummy data Comment NOT created<BR>";;
            }

            $result = $this->populateTablePages();

            if ($result) {
                $out .= "Dummy data Page Created<BR>";
            } else {
                $out .= "Dummy data Page NOT created<BR>";;
            }

            $result = $this->populateTableUsers();

            if ($result) {
                $out .= "Dummy data User Created<BR>";
            } else {
                $out .= "Dummy data User NOT created<BR>";;
            }

            $result = $this->populateTableUsersArticles();

            if ($result) {
                $out .= "Dummy data Relation User<->Article Created<BR>";
            } else {
                $out .= "Dummy data Relation User<->Article NOT created<BR>";;
            }

            $result = $this->populateTableOptions();

            if ($result) {
                $out .= "Dummy data Relation Options Created<BR>";
            } else {
                $out .= "Dummy data Relation Options NOT created<BR>";;
            }

        } else {
            $out = "Error in the connection <br>".mysql_errno().": ".mysql_error();
        }

        return $out;
    }

    function dropSchema() {

        if ($this->connection) {

            $result = $this->dropTableNumbers();

            if ($result) {
                $out = "Table Number dropped<BR>";
            } else {
                $out = "Table Number NOT dropped<BR>";;
            }

            $result = $this->dropCategories();

            if ($result) {
                $out .= "Table Categories dropped<BR>";
            } else {
                $out .= "Table Categories NOT dropped<BR>";;
            }

            $result = $this->dropTableArticles();

            if ($result) {
                $out .= "Table Article dropped<BR>";
            } else {
                $out .= "Table Article NOT dropped<BR>";;
            }

            $result = $this->dropTableComments();

            if ($result) {
                $out .= "Table Comment dropped<BR>";
            } else {
                $out .= "Table Comment NOT dropped<BR>";;
            }

            $result = $this->dropTablePages();

            if ($result) {
                $out .= "Table Page dropped<BR>";
            } else {
                $out .= "Table Page NOT dropped<BR>";;
            }

            $result = $this->dropTableUsers();

            if ($result) {
                $out .= "Table User dropped<BR>";
            } else {
                $out .= "Table User NOT dropped<BR>";;
            }

            $result = $this->dropTableUsersArticles();

            if ($result) {
                $out .= "Table Relation User<->Article dropped<BR>";
            } else {
                $out .= "Table Relation User<->Article NOT dropped<BR>";;
            }

            $result = $this->dropTableOptions();

            if ($result) {
                $out .= "Table Relation Options dropped<BR>";
            } else {
                $out .= "Table Relation Options NOT dropped<BR>";;
            }

        } else {
            $out = "Error in the connection <br>".mysql_errno().": ".mysql_error();
        }

        return $out;
    }

}

?>
