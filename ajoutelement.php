<?php
session_start();
$_POST['valeurs'] = '';
$_SESSION['fic'] = null;
$_SESSION['fic1'] = null;

// $_SESSION['fic'] = $_POST['coco'];
// var_dump($_SESSION['fic']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="js/bootstrap.min.js" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Miseenforme.css">
    <link rel="stylesheet" type="text/css" href="cas.css" />
    <title>Trait-CCP</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        overflow: hidden;
    }

    .conteneur {
        margin: 2px;
        height: 100vh;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 2fr 2fr 2fr;
        grid-template-rows: 1fr 1.5fr 8fr 0.5fr;
        grid-template-areas:
            "entete entete entete entete"
            "recherche recherche recherche recherche"
            "corps corps corps corps"
            "footer footer footer footer";
        gap: 6px;
        background-color: white;
    }

    .design1 {
        grid-area: entete;

    }

    .design2 {
        grid-area: recherche;

    }

    .design3 {
        grid-area: corps;

    }

    .design4 {
        grid-area: footer;
    }

    .design6 {
        grid-area: gauche;
    }
</style>

<body>
    <div class="conteneur" style="padding:2px;">
        <div class="design1" style="padding:2px">
            <nav class="navbar navbar-expand-lg " style="background-color: black; height: 65px;">

                <div class="collapse navbar-collapse " id="navbarCollapse1" style="display:inline-flex;text-align:center;position:fixed;width:100%">
                    <div style="margin: 1px 1px;margin-right:10%">
                        <img src="image/Cou1.png" alt="Logo">
                    </div>
                    <div style="margin:0px auto">
                        <span id="demo" style="font-size:1.8em;">
                            ATTRIBUTIONS DES <B style="color:#008CBA">A.F</B> ET DIVERS TRAITEMENTS MANUELS </span>
                    </div>
                    <div class="navbar" style="margin:auto 15px">
                        <div>
                            <a class="hop" href="PageAc.html" class="nav-item nav-link">Retour Page d'accueil</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="design2">
            <div style=" background:grey;width:80%;height:100%;margin:auto;border-radius:2px;">

                <p style="color:cyan;flex-wrap:wrap;text-align:center;padding:25px;height: 90px;margin:auto 60px;">
                    <span style="width:50%;color:black;text-shadow:black;padding:2px 5px;background:white;border-radius:4px;font-size:40px;height: 40%;font-family:Arial, Helvetica, sans-serif">
                        TRAITEMENTS SUR LES FICHIERS POSTAUX </span>
                </p>


            </div>
        </div>

        <div class="design3" style="margin-top:20px;border:5px solid lightgrey;padding-top:10px;width:80%;margin:0px auto;background-color:antiquewhite">
            <div style="height:3.7vh;padding:5px;width:68%;margin:0px auto;background-color:rgb(93, 192, 180);;border:0.5px solid grey;border-radius:5px">
                <table>
                    <thead style="background-color:white;color:black; ">
                        <TR>
                            <th style="width:13%;padding-left:36px">N° ORDRE</th>
                            <th style="width:27%;padding-left:10px">NOM FICHIER</th>
                            <th style="width:11%;padding-left:5px">NBR LIGNES</th>
                            <th style="width:11%;padding-left:5px">DATE CREAT.</th>
                            <th style="width:15%;padding-left:6px">DESCRIPTION</th>
                            <th>INSERTION</th>
                        </TR>

                    </thead>
                </table>
            </div>
            <div style="height:22vh;padding:5px;width:63%;margin:0px auto;overflow-y:auto;border:1px solid grey;border:4px solid lightgrey;border-top:none ;background-color:ivory">
                <?php
                $fichier = "bureau/";
                ?>
                <table>
                    <caption style="text-align:center;font-variant-caps: petite-caps;">liste des fichiers du repertoire
                        du serveur</caption>
                    <thead id="invisible" style="background:white">
                        <tr style="visibility:hiden;border:none;background:grey">
                            <th style="width:10%;visibility:hiden;border:none">1</th>
                            <th style="width:30%;visibility:hiden;border:none">2</th>
                            <th style="width:12%;visibility:hiden;border:none">3</th>
                            <th style="width:12%;visibility:hiden;border:none">4</th>
                            <th style="width:15%;visibility:hiden;border:none">5</th>
                            <th style="visibility:hiden;border:none">INSERTION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <!-- <?= $valeur ?>   -->
                        </tr>
                    </tfoot>
                    <tbody style="background:white;">
                        <?php
                        $dir = "";
                        $valeur = 0;
                        if (file_exists("bureau/paie/pa/CCPS/" )) {
                            if (isset($_POST['paie'])) {
                                $fichier = "bureau/paie/pa/CCPS/";
                                $doss = opendir($fichier);
                            }
                        }
                        if (file_exists("bureau/rappel/pa/CCPS")) {
                            if (isset($_POST['rappel'])) {
                                $fichier = "bureau/rappel/pa/CCPS/";
                                $doss = opendir($fichier);
                            }
                        }
                        if (file_exists("bureau/PRI/pa/CCPS")) {
                            if (isset($_POST['pri'])) {
                                $fichier = "bureau/pri/pa/CCPS";
                                $doss = opendir($fichier);
                            }
                            }
                            if (file_exists("bureau/autre/pa/CCPS")) {
                            if (isset($_POST['autre'])) {
                                $fichier = "bureau/autre/pa/CCPS";
                                $doss = opendir($fichier);
                            
                        }}
                        $doss = opendir($fichier);
                        $compt = 1;
                        while ($fic = readdir($doss)) {
                        ?>

                            <tr>
                                <?php
                                if ($fic != "." && $fic != ".." && strtolower(pathinfo($fic, PATHINFO_EXTENSION)) == 'txt' && substr(strtoupper($fic), 0, 3) === 'CCP') {
                                ?>

                                    <td>
                                        <?php echo $compt++ ?>
                                    </td>
                                    <td>
                                        <?php echo strtoupper($fic) ?>
                                    </td>
                                    <td style="text-align:right">
                                        <?php
                                         echo count(file($fichier . $fic)) ;
                                         ?> 
                                       
                                    </td>
                                    <td style="padding-left:7px">
                                        <?php 
                                        echo date("d-m-Y", filemtime($fichier . $fic)) ;
                                        ?>
                                    </td>
                                    <td style="padding-left:5px">zee</td>
                                    <form method="POST">
                                        <td style="text-align:center">
                                            <input type="hidden" name="coco" value="<?= $fic ?>">
                                            <input type="submit" id="but" value="consulter" name="subt" style="width:70px;font-variant-caps: petite-caps;font-family: Arial, Helvetica, sans-serif;">
                                        </td>
                                    </form>
                                    <form method="POST" action="ajout.php">
                                        <td style="text-align:center">
                                            <input type="hidden" name="modif" value="<?= $fichier . $fic ?>">
                                            <input type="submit" id="but" value="traiter" name="subtmod" style="width:70px;font-variant-caps: petite-caps;font-family: Arial, Helvetica, sans-serif;">
                                        </td>
                                    </form>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        closedir($doss);
                        ?>

                    </tbody>
                </table>

            </div>
            <div id="repertoire">
                <form action="" method="post">
                    <input type="submit" name="paie" class="btn  m-1  logo" style="width:22%;" value="Paie">
                    <input type="submit" name="rappel" class="btn  m-1  pogo" style="width:22%;" value="Rappel">
                    <input type="submit" name="pri" class="btn  m-1  togo" style="width:22%;" value="Prime Rendement">
                    <input type="submit" name="autre" class="btn  m-1  mogo" style="width:22%;" value="Autres">
                </form>

            </div>
            <div style="height:32vh;width:92%;margin:0px auto;;margin-top:10px;font-size:16px;background-color:white;border-bottom:4px solid lightgrey;margin-top:1px">

                <p style="width:100%;height:35px;background:lightgrey;color:white;font-size:1.4em; text-shadow: 2px 2px 8px black;">
                    OUVERTURE DU FICHIER
                    TEXTE
                    SELECTIONNE
                    <SPAN style="color:#008CBA;font-size:23px" id="valeur">
                        <?php

                        if (isset($_POST['coco'])) {
                            echo ":  " . strtoupper($_POST['coco']);
                        } ?>
                    </SPAN>
                </p>

                <div style="display:flex;padding:2px;margin:0px auto">
                    <div style="height:24vh;width:40%;padding:8px;overflow-y:auto;margin:auto auto;font-size:12px;border:4px solid darkgrey;border-radius:5px">
                        <?PHP
                        if (isset($_POST['subt'])) {

                            $got = $_POST['coco'];

                            $file = fopen($fichier.$got, "w+") or exit;
                            chmod($fichier.$got, 0755); 
                            while (!feof($file)) {
                                echo fgets($file) . "<br />";
                            }
                            fclose($file);
                        }
                        ?>
                    </div>
                    <div style="height:24vh;width:56%;padding:8px;overflow-y:auto;margin:auto auto;font-size:12px;border:4px solid darkgrey;border-radius:5px">
                        <table id="tabdetail" style="border-collapse:collapse">
                            <thead id="tete">
                                <tr>
                                    <th style="width:50px;text-align:center">N°</th>
                                    <th style="width:342px">Nom & Prénom</th>
                                    <th style="width:140px">N° Compte CCP</th>
                                    <th style="width:140px">Net à Payer</th>
                                </tr>
                            </thead>
                            <tbody id="corps">
                                <?php
                                if (isset($_POST['subt'])) {
                                   
                                    $compt = 0;
                                    $valeur = 0;
                                    $got = $_POST['coco'];
                                    $file = fopen($fichier . $got, "w+") or exit;
                                    chmod($fichier.$got, 0755);
                                    $geto = fgets($file);
                                    while (!feof($file)) {
                                        $geto = fgets($file);
                                        $nbre = substr($geto, 21, 13);
                                        $nbre = floatval($nbre / 100);
                                        $compte = substr($geto, 9, 12);
                                        $compte = intval($compte);
                                        $valeur = $valeur + $nbre;
                                        $_POST['valeurs'] = $valeur;
                                ?>
                                        <tr>
                                            <td style="width:50px;text-align:right">
                                                <?php echo $compt++ ?>
                                            </td>
                                            <td style="width:350px;">
                                                <?php echo substr($geto, 34, 27) ?>
                                            </td>
                                            <td style="width:140px;text-align:right">
                                                <?php echo $compte ?>
                                            </td>
                                            <td style="width:140px;text-align:right">
                                                <?php $nbre = number_format($nbre, 2, '.', ' ');
                                                echo $nbre ?>
                                            </td>


                                        </tr>
                                    <?php
                                    }
                                    fclose($file);
                                    ?>
                                    <span class="montant">montant dans le fichier :
                                        <?php $valeur = number_format($valeur, 2, '.', ' ');
                                        echo "    " . '<strong style="color:#008CBA">' . $valeur . '</strong>' ?>
                                        DA
                                    </span>
                                    <span class="nombre"> de
                                        <?php echo "  " . '<strong style="color:#008CBA">' . $compt . '</strong>' ?>
                                        ENSEIGNANTS
                                    </span>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="design6">

        </div>
        <div class="design4">
            <div class="design4" style="padding:2px">
                <footer class="page-footer fixed-bottom" style="background-color: black ;">
                    <div class="footer-copyright  text-center py-2" style="color:crimson">
                        © UMC 2021:
                        <a href="https://www.umc.edu.dz/index.php/fr// " style="color:white;text-align: center; ">
                            Université
                            Mentouri
                            I</a>
                    </div>

                </footer>

            </div>
        </div>


    </div>

</body>

</html>