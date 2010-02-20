<?

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Easy Magazine Admin: Settings</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <style media="all" type="text/css">@import "../../resources/css/all.css";</style>
        <style media="all" type="text/css">@import "../../resources/css/messages.css";</style>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <a href="#" class="logo"><img src="../../resources/img/logo_blu_arancio.gif" alt="" /></a>
                <ul id="top-navigation">
                    <li><span><span><a href="dashboard.php">Dashboard</a></span></span></li>
                    <li><span><span><a href="number.php">Numbers</a></span></span></li>
                    <li><span><span><a href="category.php">Categories</a></span></span></li>
                    <li><span><span><a href="article.php">Articles</a></span></span></li>
                    <li><span><span><a href="page.php">Pages</a></span></span></li>
                    <li><span><span><a href="comment.php">Comments</a></span></span></li>
                    <li><span><span><a href="plugin.php">Plugin</a></span></span></li>
                    <li><span><span><a href="template.php">Template</a></span></span></li>
                    <li class="active"><span><span>Settings</span></span></li>
                    <li><span><span><a href="user.php">Users</a></span></span></li>
                </ul>
                <div id="logout"><a href="../../logout.php">logout</a></div>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3>Hello, <? echo $_SESSION['user']->getName() ?></h3><br />
                    <a href="../../index.php" class="link">View the website</a>
                </div>
                <div id="center-column">
                    <?
                    foreach ($infoarray as $info) {
                        echo '<div class="message info"><p><strong>Info:</strong>: '.$info.'</p></div>';
                    }
                    foreach ($warningarray as $warning) {
                        echo '<div class="message warning"><p><strong>Warning:</strong>: '.$warning.'</p></div>';
                    }
                    foreach ($questionarray as $question) {
                        echo '<div class="message question"><p><strong>Question:</strong>: '.$question.'</p></div>';
                    }
                    foreach ($errorarray as $error) {
                        echo '<div class="message error"><p><strong>Error:</strong>: '.$error.'</p></div>';
                    }
                    ?>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <form name="form1" enctype="multipart/form-data" method="post" action="settings.php?action=update">
                            <table class="listing form" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th class="full" colspan="2">Settings</th>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Publication Language</strong></td>
                                    <td class="last">
                                        <select name="language">
                                            <option value="ca" <?if ($settingsindb['language']->getValue() == 'ca') echo 'selected';?> >ca</option>
                                            <option value="cs" <?if ($settingsindb['language']->getValue() == 'cs') echo 'selected';?> >cs</option>
                                            <option value="da" <?if ($settingsindb['language']->getValue() == 'da') echo 'selected';?> >da</option>
                                            <option value="de" <?if ($settingsindb['language']->getValue() == 'de') echo 'selected';?> >de</option>
                                            <option value="el" <?if ($settingsindb['language']->getValue() == 'el') echo 'selected';?> >el</option>
                                            <option value="en" <?if ($settingsindb['language']->getValue() == 'en') echo 'selected';?> >en</option>
                                            <option value="eo" <?if ($settingsindb['language']->getValue() == 'eo') echo 'selected';?> >eo</option>
                                            <option value="es" <?if ($settingsindb['language']->getValue() == 'es') echo 'selected';?> >es</option>
                                            <option value="et" <?if ($settingsindb['language']->getValue() == 'et') echo 'selected';?> >et</option>
                                            <option value="fr" <?if ($settingsindb['language']->getValue() == 'fr') echo 'selected';?> >fr</option>
                                            <option value="he" <?if ($settingsindb['language']->getValue() == 'he') echo 'selected';?> >he</option>
                                            <option value="hr" <?if ($settingsindb['language']->getValue() == 'hr') echo 'selected';?> >hr</option>
                                            <option value="it" <?if ($settingsindb['language']->getValue() == 'it') echo 'selected';?> >it</option>
                                            <option value="ja" <?if ($settingsindb['language']->getValue() == 'ja') echo 'selected';?> >ja</option>
                                            <option value="ko" <?if ($settingsindb['language']->getValue() == 'ko') echo 'selected';?> >ko</option>
                                            <option value="ltz" <?if ($settingsindb['language']->getValue() == 'ltz') echo 'selected';?> >ltz</option>
                                            <option value="nl" <?if ($settingsindb['language']->getValue() == 'nl') echo 'selected';?> >nl</option>
                                            <option value="nn" <?if ($settingsindb['language']->getValue() == 'nn') echo 'selected';?> >nn</option>
                                            <option value="no" <?if ($settingsindb['language']->getValue() == 'no') echo 'selected';?> >no</option>
                                            <option value="pl" <?if ($settingsindb['language']->getValue() == 'pl') echo 'selected';?> >pl</option>
                                            <option value="pt" <?if ($settingsindb['language']->getValue() == 'pt') echo 'selected';?> >pt</option>
                                            <option value="ru" <?if ($settingsindb['language']->getValue() == 'ru') echo 'selected';?> >ru</option>
                                            <option value="sv" <?if ($settingsindb['language']->getValue() == 'sv') echo 'selected';?> >sv</option>
                                            <option value="tr" <?if ($settingsindb['language']->getValue() == 'tr') echo 'selected';?> >tr</option>
                                            <option value="ko" <?if ($settingsindb['language']->getValue() == 'ko') echo 'selected';?> >ko</option>
                                            <option value="zh" <?if ($settingsindb['language']->getValue() == 'zh') echo 'selected';?> >zh</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>Web Magazine Title</strong></td>
                                    <td class="last"><input type="text" size="50" name="title" value="<?= $settingsindb['title']->getValue(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Web Magazine Description</strong></td>
                                    <td class="last"><textarea name="description" rows="4" cols="60"><?= $settingsindb['description']->getValue(); ?></textarea></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>URL Type</strong></td>
                                    <td class="last">
                                        <select name="urltype">
                                            <option value="standard" <?if ($settingsindb['urltype']->getValue() == 'standard') echo 'selected';?> >PHP standard</option>
                                            <option value="optimized" <?if ($settingsindb['urltype']->getValue() == 'optimized') echo 'selected';?> >SEO optimized (require apache)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Publisher</strong></td>
                                    <td class="last"><input type="text" size="50" name="publisher" value="<?= $settingsindb['publisher']->getValue(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>Rights</strong></td>
                                    <td class="last"><input type="text" size="50" name="rights" value="<?= $settingsindb['rights']->getValue(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Administration Email</strong></td>
                                    <td class="last"><input type="text" size="50" name="email" value="<?= $settingsindb['email']->getValue(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Epub filename</strong></td>
                                    <td class="last"><input type="text" size="50" name="epubname" value="<?= $settingsindb['epubname']->getValue(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>&nbsp;</strong></td>
                                    <td class="last"><input type="submit" value="Save" name="save" /></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h">INFO</strong>
                    <div class="box">Here there is a list of settings to manage the magazine.</div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>