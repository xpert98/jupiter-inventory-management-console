<?php

/*
Jupiter Inventory Management Console
Copyright (C) 2019 Matt Stanchek

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

session_start();

if (!empty($_POST)) {

    include 'fortify.php';

    $fortify = new fortify;

    $newSSCApp = $fortify->createNewProjectVersion($_POST['sscProjName'], $_POST['sscProjVer'], $_POST['description'], $_POST['issueTemplate']);

    $decodedSSCApp = json_decode($newSSCApp, true);

    if ($decodedSSCApp['responseCode'] === 201) {
        $setSSCAppAttrs = $fortify->setProjectVersionAttrs($decodedSSCApp['data']['id'], $_POST['accessibility'], $_POST['businessRisk'], $_POST['devPhase'], $_POST['devStrategy']);

        if ($setSSCAppAttrs === 200) {
            $commitSSCApp = $fortify->commitProjectVersion($decodedSSCApp['data']['id']);

            if ($commitSSCApp === 200) {
                echo '<script type="text/javascript">location.href = \'applications.php\';</script>';
            }
            else {
                echo "failure importing application";
            }
        }
    }

}
else {
    echo "failure importing application";
}

?>