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

include(COMMANDPATH.'/remote.php');
include(SESSIONPATH.'/sessionmanager.php');

abstract class Router {

    private $remote;
    private $session;

    public function  __construct() {
        $this->remote = Remote::getInstance();
        $this->session = SessionManager::getInstance();
    }

    public abstract function applyTemplate();

    public abstract function loadController();

    public function show(){
        $this->session->startingPage();

        $this->loadController();

        $this->header();

        $this->remote->executeCommandBeforeIndex();
        $this->applyTemplate();

        $this->footer();

        $this->session->closingPage();
    }

    public function header() {
        if (file_exists(TEMPLATEPATH.'/header.php')) {
            include (TEMPLATEPATH.'/header.php');
        }
    }

    public function footer() {
        if (file_exists(TEMPLATEPATH.'/footer.php')) {
            include (TEMPLATEPATH.'/footer.php');
        }
    }

}

?>