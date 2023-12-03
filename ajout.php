<?php
session_start();
include "connect.php";
$mat = null;
$nom = null;
$cot = null;
$nom1 = null;
$compte = null;
$mont = null;
$valeur = 0;
$compteur = 0;
$_POST['compt1'] = null;
$_SESSION['err'] = '';
$suppa = null;
if (!empty($_POST['modif'])) {
    $_SESSION['fic'] = $_POST['modif'];
}
if (!empty($_SESSION['fic1'])) {
    $_SESSION['fic'] = $_SESSION['fic1'];
    $_POST['modif'] = $_SESSION['fic1'];
}
// consultation
if (isset($_POST['sub']) && !empty($_POST['coco'])) {

    $_SESSION['cont'] = 1;
    $cot = $_POST['coco'];
    $molonne = $dbco->query("SELECT `mat`,`nom`,`prenom`,`n_compt` FROM `pers_pia`                                                                                                                           
                                        WHERE  mat='$cot' ");
    $result = $molonne->fetch();
}

//......................................................bouton valider..............................................................

if (isset($_POST['ajout'])) {
    $nom1 = trim($_POST['noma']);
    $compte = preg_replace("/\s+/", "", $_POST['compta']);
    $mont = abs($_POST['montant']);
    $_SESSION['err'] = '';

    if ((!empty($_POST['noma'])) && (!empty($_POST['compta'])) && (!empty($_POST['montant']))) {

        if (isset($_SESSION['cont']) && $_SESSION['cont'] == 1) {
            $query2 = $db->prepare("SELECT nom,ncompte,montant FROM ccp_ens WHERE  ncompte='$compte' ");
            $query2->execute();
            $result = $query2->fetch();
            $mont = abs($_POST['montant']);
            $_SESSION['cont'] = 0;

            // ...................................................................................................................
            if ($result) {
                $_SESSION['err'] = 1;

?>

                <!-- ici la place des modales  -->

                <!-- /.................................................................... -->

<?php

                // $_SESSION['err'] = "l'enseignant(e) que vous voulez inserrer <strong style='color:black'> <br/> -" . $_POST['noma'] . " - </strong>   <br/> existe déja !, veuillez le(la) choisir d'aprés la liste du tableau ci-contre";
            } else {
                $insertEns1 = "INSERT INTO ccp_ens (nom,ncompte,montant) VALUES (:nom,:ncompte,:montant)";
                $query1 = $db->prepare($insertEns1);
                $donnees = [
                    ':nom' => htmlentities($nom1),
                    ':ncompte' => htmlentities($compte),
                    ':montant' => htmlentities($mont),
                ];
                $queryens1 = $query1->execute($donnees);
                $_SESSION['err'] = '';
            }

            //.....................................................................................................................

        } else {

            $maj = $db->prepare("UPDATE ccp_ens SET montant='$mont' WHERE nom='$nom1'");
            $maj->execute();

            $_SESSION['cont'] = 0;
        }
    }
}

if (isset($_POST['suppression'])) {



    if (!empty($_POST['numcompte'])) {
        $suppa = strip_tags(trim($_POST['numcompte']));

        $insertEns1 = "DELETE  FROM ccp_ens WHERE ncompte=:ncompte";
        $query1 = $db->prepare($insertEns1);
        $donnees = [
            ':ncompte' => htmlentities($suppa),
        ];
        $queryens1 = $query1->execute($donnees);
    }
}
?>
<!-- <!DOCTYPE html> -->
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="js/bootstrap.min.js" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="modalcss.css" /> -->
    <link rel="stylesheet" type="text/css" href="modiCSS.css">
    <link rel="stylesheet" type="text/css" href="modalcss.css">
    <script src="appel.js"></script>
    <title>Ajout</title>
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
        width: 99.8%;
        display: grid;
        grid-template-columns: 1fr 5fr 1fr;
        grid-template-rows: 1fr 1fr 0.8fr 7.8fr 0.5fr;
        grid-template-areas:
            "entete entete entete"
            "recherche1 recherche1 recherche1"
            "lateraltitre  titre recherche"
            "lateralcorps  corps gauche"
            "footer footer footer";
        gap: 7px;
        background-color: white;
    }

    .design1 {
        grid-area: entete;

    }

    .design2 {
        grid-area: recherche1;

    }

    .couca {
        grid-area: rech;

    }

    .design3 {
        grid-area: corps;

    }

    .design5 {
        grid-area: titre;
    }

    .design4 {
        grid-area: footer;
    }

    .design6 {
        grid-area: gauche;
    }

    .design7 {
        grid-area: recherche;
    }

    .design8 {
        grid-area: lateraltitre;
    }

    .design9 {
        grid-area: lateralcorps;
    }
</style>

<body>

    <div class="conteneur" id="conteneur">
        <div class="design1" style="padding:2px">
            <nav class="navbar navbar-expand-lg " style=" height: 65px;">

                <div class="collapse navbar-collapse " id="navbarCollapse1" style="display:inline;position:fixed;width:100%;background-color:black;">
                    <div style="margin-right:6%;">
                        <img src="image/Cou1.png" alt="Logo">
                    </div>
                    <div style="margin:0px auto;">
                        <span id="demo" style="font-size:1.8em;margin:0px auto">
                            ATTRIBUTIONS DES <B style="color:crimson">A.F</B> ET DIVERS TRAITEMENTS MANUELS </span>
                    </div>
                    <div class="navbar" style="margin:auto 15px;">
                        <div>
                            <a class="hop" href="ajoutelement.php" class="nav-item nav-link">Retour Page des
                                FICHIERS</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="design7">


        </div>
        <div class="design5">
            <div class="bloc2">
                <div class="bloc3" style="display:flex; align-items: center;justify-content: center;height:100%;background:rgb(207, 211, 210);">
                    <div style="display:inline-block; align-items: center;justify-content: center;width:70%;padding-left:30px;margin-top:4px;padding-top:10px">
                        <form action="" id="form" method="post">
                            <label class="recept" id="mat" name="mata" style="width:15%;background:white;text-align:center;padding:5px 10px">
                                <?php
                                $mat = isset($result['mat']) ? $result['mat'] : ' ';
                                echo $mat;
                                $_SESSION['mat'] = $mat; ?>
                            </label>

                            <label class="recept" id="nom" style="width:45%;background:white;padding:5px 10px">
                                <?php
                                if (!empty($result['nom']) && !empty($result['prenom'])) {
                                    echo $result['nom'] . " " . $result['prenom'];
                                } ?>
                            </label>

                            <label class="recept" id="compte" style="width:35%;background:white;padding:5px 10px">
                                <?php
                                if (!empty($result['n_compt'])) {
                                    $compt = $result['n_compt'];
                                    echo $compt;
                                } ?>
                            </label>

                    </div>
                    <div style="display:inline-block; align-items: center;justify-content: center;width:30%;padding-top:8px;padding-left:20px;">
                        <input type="hidden" name="noma" id="nomin1" value=" <?php
                                                                                if (!empty($result['nom']) && !empty($result['prenom'])) {
                                                                                    echo $result['nom'] . " " . $result['prenom'];
                                                                                } ?>">
                        <input type="hidden" name="compta" id="comptin1" value="<?php
                                                                                if (!empty($result['n_compt'])) {
                                                                                    $compt = $result['n_compt'];
                                                                                    echo $compt;
                                                                                } ?>">
                        <input class="recept1" type="text" id="montants" name="montant" maxlength="13" minlength="1" required onkeypress="saisie(event);return false ;" autocomplete="off" style="width:50%;background:white;padding-right:10px" value="">

                        <input class="recept1" type="submit" id="app" name="ajout" value="valider" style="margin-left:12px;width:30%;">
                    </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="design2">
            <div id="div-titre">
                <p id="parag-titre" style="color:cyan;flex-wrap:wrap;text-align:center;padding:2px;height:55px;margin:auto 60px;">
                    <span id="span-ccp">
                        TRAITEMENTS SUR LES FICHIERS POSTAUX </span>
                </p>
            </div>

        </div>
        <div class="design6" id="supp1" style="display:block;margin:0 5px;visibility:hidden;font-size:13px;">
            <div style="border:2px solid lightgrey;padding:10px;height:12%;margin-top:0;border-radius:5px;margin-bottom:10px">
                <label style="font-variant-caps:small-caps;margin-bottom:15px;font-weight:bold">voulez vraiment
                    supprimer cette personne!!</label>
            </div>
            <div style="border:2px solid lightgrey;padding:10px;height:75%;;border-radius:5px">
                <form action="" method="post">
                    <div> <label style="text-align:center;font-variant-caps:small-caps">nom prénom</label></div>
                    <div> <label class="recept1" type="text" name="" id="montants3" style="text-align:left;height:36px;width:98%;margin-top:4px;margin-bottom:10px;font-size:13px;padding:5px 5px"></label>
                    </div>
                    <div> <label style="text-align:center;font-variant-caps:small-caps">numerocompte</label></div>
                    <div> <input class="recept1" type="text" name="numcompte" id="montants2" readonly style="text-align:center;height:36px;margin-top:4px;margin-bottom:10px;font-size:15px;padding:5px 5px">
                    </div>
                    <div> <label style="text-align:center;font-variant-caps:small-caps">Montant:</label></div>
                    <div>
                        <label class="recept1" type="text" name="" id="montants1" style="text-align:right;height:36px;margin-top:4px;margin-bottom:10px;color:white;background-color:rgb(82, 184, 209);font-weight:bold;font-size:15px;padding:5px 5px"></label>
                    </div>
                    <div class="anim" style="border:0.5px solid lightgrey;padding:10px;height:28%;margin-bottom:5px">
                        <label class="titresupp" style="text-align:center;font-variant-caps:small-caps;">cette personne
                            est sur le point
                            d'être <strong>supprimée </strong>des bénéficiaires de ce traitement</label>
                    </div>
                    <div style="text-align:center"> <input class="recept11" type="submit" id="suppression" name="suppression" value="valider supp." style="margin-top:15px;border-color:black"> </div>
                </form>
            </div>
        </div>
        <!-- table des modifications et des ajouts. -->
        <div class="design3">
            <div class="bloc1">

                <div class="tablemod" id="tabmoda" style="position:relative;display:flex;align-items:center;justify-content:center">

                    <?php
                    // if ($_SESSION['err'] == 1) {

                    ?>

                    <?php
                    //     $_SESSION['err'] = '';
                    // }
                    ?>
                    <div style="position:absolute;width:100%;top:2px">
                        <table id="modif" style="width:95%">
                            <thead id="modifthead" style="display:block">
                                <tr id="trmod" style="padding:10px">

                                    <th style="width:32%;">nom et prénom</th>
                                    <th style="width:16%;">n° compte </th>
                                    <th style="width:15%">montant</th>
                                    <th style="width:3%;background:black;color:black">null
                                    </th>
                                    <th style="width:3%;color:rgb(82, 184, 209)">null</th>
                                    <th style="width:3%;padding-left:15px;color:rgb(82, 184, 209)" style="text-align:center">null
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="modifcorps" style="display:block;overflow-y:auto;height:32vh;border-bottom:0.5px solid lightgrey;">
                                <?php
                                if (isset($_POST['subtmod']) && !empty($_POST['modif'])) {
                                    $trunc = "TRUNCATE table `ccp_ens`";

                                    $stat = $db->prepare($trunc);
                                    $stat->execute();

                                    $got = $_POST['modif'];

                                    $file = fopen($got, "r") or exit;
                                    $geto = fgets($file);
                                    $compteur = 1;
                                    $valeur = 0;
                                    while (!feof($file)) {
                                        $compteur++;
                                        $geto = fgets($file);
                                        $nbre = substr($geto, 21, 13);
                                        $nbre = floatval($nbre / 100);
                                        $compte = substr($geto, 9, 12);
                                        $compte = intval($compte);
                                        $valeur = $valeur + $nbre;
                                        $nom = substr($geto, 34, 27);
                                        $insertEns = "INSERT INTO ccp_ens (nom,ncompte,montant) VALUES (:nom,:ncompte,:montant)";
                                        $query = $db->prepare($insertEns);
                                        $donnees = [
                                            ':nom' => htmlentities($nom),
                                            ':ncompte' => htmlentities($compte),
                                            ':montant' => htmlentities($nbre),
                                        ];
                                        $queryens = $query->execute($donnees); ?>

                                        <tr id="trbody">
                                            <td style="width:35%;" id="majnom">
                                                <?php echo $nom ?>
                                            </td>
                                            <td style="width:15%;text-align:right;padding-right:5px" id="majcompte">
                                                <?php echo $compte ?>
                                            </td>
                                            <td style="width:15%;text-align:right;padding-right:5px" id="majmont">
                                                <?php echo $nbre
                                                    = number_format($nbre, 2, '.', ' ');
                                                ?>
                                            </td>
                                            <td type="submit" style="width:3%;"></td>
                                            <td style="width:3%;" id="supp">⟹</td>
                                            <td style="width:3%;">✬</td>

                                        </tr>
                                    <?php
                                    }
                                    $_POST['modif'] = null;
                                    fclose($file);
                                    $_SESSION['count'] = $compteur;
                                    $_POST['total'] = $valeur;
                                } else {
                                    $total = 0;

                                    $query = $db->prepare('SELECT nom,ncompte,montant FROM `ccp_ens` ORDER BY  nom ASC');
                                    $query->execute();
                                    while ($users = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr id="trbody">
                                            <td style="width:35%;" id="majnom">
                                                <?php echo $users['nom'] ?>
                                            </td>
                                            <td style="width:15%;text-align:right;padding-right:5px" id="majcompte">
                                                <?php $compte = $users['ncompte'];
                                                echo $users['ncompte'] ?>
                                            </td>
                                            <td style="width:15%;text-align:right;padding-right:5px" id="majmont">
                                                <?php $total = $total + $users['montant'];
                                                echo $users['montant']
                                                    = number_format($users['montant'], 2, '.', ' '); ?>
                                            </td>
                                            <td type="submit" style="width:3%;"></td>
                                            <td style="width:3%;" id="supp">⟹</td>
                                            <td style="width:3%;">✬</td>

                                        </tr>
                                <?php
                                    }
                                    $count = $query->rowCount();
                                    $_SESSION['count'] = $count;
                                    $_POST['total'] = $total;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    ?>
                    <div style="position:absolute;width:100%;height:20vh;bottom:2px">
                        <div id="divrech">
                            <form method="POST" class="format">
                                <input class="form-control   " type="search" autocomplete="off" name="rech_user" id="rech_user" pattern="[A-Za-z0-9]{25}" maxlength="25" style="height:40px;padding-left: 70px ;text-align:left;color:black;width:90%;background-repeat: no-repeat;
                              font-size:18px;background-image: url(image/peo.png);font-variant-caps:small-caps ;border-color:grey;border-style:outset;margin:10px auto ;" placeholder="veuillez introduire le numéro de compte ccp ou le nom de la personne à trouver !" autofocus />
                            </form>
                        </div>
                        <div class="info">
                            <div class="format f1"></div>
                            <div class="format f2">


                                <div id="maj" style="visibility:visible;width:200px;height:150px;color:crimson;text-align:left;font-size:1em;font-variant-caps: petite-caps; margin: 5px auto;padding-left:6px">
                                    <p id="message">

                                    </p>
                                </div>




                            </div>

                        </div>
                    </div>
                </div>
                <div class="tablemod1" style="margin-top:8px">
                    <div class="baspage" style="width:100%;color:white;text-align:center">
                        <p style="margin:6px 10px; font-variant-caps: petite-caps;font-size:1.1em;">fichier traité :
                            <strong>
                                <?= $_SESSION['fic'] ?>
                            </strong>
                            avec :
                            <strong style="color:#008CBA">
                                <?= $_SESSION['count'] ?>
                            </strong>Enseignant(s) et d'une valeur de : <small> <strong style="color:#008CBA;;">
                                    <?php
                                    $_POST['total'] = number_format($_POST['total'], 2, '.', ' ');
                                    echo $_POST['total'] ?>
                                </strong>
                                DA </small>
                        </p>

                    </div>

                    <div class="baspage" style="width:16%;">
                        <button class="hogo1" style="border-left:5px solid rgb(123, 187, 187);width:90%;margin:7px auto;
                        font-variant-caps: small-caps;border-right:5px solid rgb(123, 187, 187)">
                            <a href="recherche.php" id="lien" style="text-decoration:none;color:black">Ajout.
                                <strong>Enseignant</strong>
                            </a> </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- fin de la table  -->
        <div class="design9">
            <div style="text-align:center;font-variant-caps: small-caps;height:100%;">
                <p style="inline-size: auto;writing-mode: sideways-lr;text-align:center;background:rgb(207, 211, 210);color:grey;float: right;height:90%;font-family:Arial, Helvetica, sans-serif;font-size:1.1em;border-bottom:4px solid ">
                    liste exhaustive des personnels ayant comptes ccp
                </p>
                <a href="#modus" class="modal-btn modal-trigger" id="bouton">ouvrir</a>


            </div>
            <?php
            //  if (isset($_SESSION['err'])) { 
            ?>
            <!-- <div id="maj" style="visibility:visible;width:200px;height:200px;color:crimson;text-align:left;font-size:1em;font-variant-caps: petite-caps; -->
            <!-- margin: 5px auto;padding-left:6px"> -->
            <!-- <p id="message"> -->
            <?php
            // {
            // echo $_SESSION['err'];
            // unset($_SESSION['err']);
            // }
            ?>
            <!-- </p> -->
            <!-- </div> -->
            <?php
            //  } else { 
            ?>
            <!-- <div id="maj" style="visibility:hidden;border-left:none">
                    <p id="message"> -->
            <?php
            // {
            // unset($_SESSION['err']);
            // unset($_SESSION['err']);
            // }
            ?>
            <!-- </p>
                </div> -->
            <?php
            // } 
            ?>
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
    <div class="modal-container" id="modus">
        <!-- <div class="overlay modal-trigger"></div> -->
        <div class="message1 " id="messageA" style="position:absolute;left:50%;top:47%;transform: translate(-50%,-50%);">
            <div>
                <div style="display:flex">
                    <div id="photo" STYLE="width:50px;height:50px;padding:2px">
                        <img src="./image/circle.png" width="50" height="50">
                    </div>
                    <div class="messago" style="margin-left:5px;margin-top:11px;height:30px;width:90%;font-variant-caps:small-caps;text-align:center;font-size: 1.4em;">
                        <p id="clin">la personne existe déja ! comment voulez vous operer ? </p>
                    </div>
                </div>
                <div class="ecrasement ">

                    <div class="validation" id="validation1">
                        <div class="cadre">
                            <div class="Contenu">
                                <div class="detail"><label for="" style="width:140px">matricule : </label> <input type="text" class="inputs" id="etiq1" disabled style="width:8vw;"><label for="" style="width:58px;margin-left:4px">nom : </label> <input type="text" id="etiq1" disabled style="width:18vw;">
                                    <div class="ecart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="cadre">
                            <div class="Contenu">
                                <div class="detail"><label for="" style="width:140px"> prénom : </label><input type="text" id="etiq2" class="inputs" disabled>
                                    <div class="ecart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="cadre">
                            <div class="Contenu">
                                <div class="detail"><label for="" style="width:140px">grade : </label><input type="text" id="etiq3" class="inputs" disabled>
                                    <div class="ecart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="cadre">
                            <div class="Contenu">
                                <div class="detail"><label for="" style="width:140px">n°compte :</label><input type="text" id="etiq4" class="inputs" disabled>
                                    <div class="ecart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="cadre">
                            <div class="Contenu">
                                <div class="detail"><label for="" style="width:140px">poste actuel :</label><input type="text" id="etiq5" class="inputs" disabled>
                                    <div class="ecart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="validation" id="validation2">
                        <div class="conteneur">
                            <div class="contenus"><label for="" class="lab">50000.20</label><button id="bt1">garder </button></div>
                            <div class="contenus"><label for="" class="lab">250000.50</label><button id="bt2">ecraser </button></div>
                            <div class="contenus"><label for="" class="lab">260000.00</label><button id="bt3">cummuler </button></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>




    <script type="text/javascript">
        var recherche = document.getElementById('rech_user');
        recherche.addEventListener('keyup', function() {
            var mot = this.value;
            mot = mot.toUpperCase();

            var Ens = document.getElementById('modif');
            var lignes = Ens.getElementsByTagName('tr');
            for (var i = 0; i < lignes.length; i++) {
                var colonnes = lignes[i].getElementsByTagName('td')[0];
                var colonnes1 = lignes[i].getElementsByTagName('td')[1];
                if (colonnes || colonnes1) {
                    var trouve = colonnes.innerHTML || colonnes.textContent;
                    trouve = trouve.toUpperCase();
                    var trouve1 = colonnes1.innerHTML || colonnes1.textContent;
                    trouve = trouve.toUpperCase();
                    if (trouve.indexOf(mot) > -1 || trouve1.indexOf(mot) > -1) {
                        // mot.style.color='cyan';
                        lignes[i].style.display = '';


                    } else {
                        lignes[i].style.display = 'none'
                    }

                }
            }
        })
        $(document).ready(function() {
            $('#montant').focus(function() {
                $(this).css('background-color', 'yellow');
            });
            $('#montant').blur(function() {
                $(this).css('background-color', 'white');
            });
            $('#montants').focus(function() {
                $(this).replace(/^\s+|\s+$/gm, '');
            });
            $('#montants').focus(function() {
                $(this).css('text-align', 'right');
            });

        });


        // function saisie(event) {
        //     var keyCode = event.which ? event.which : event.keyCode;
        //     var touche = String.fromCharCode(keyCode);
        //     var champ = document.getElementById('montant');
        //     var caracteres = '0123456789.';
        //     if (caracteres.indexOf(touche) >= 0) {
        //         champ.value += touche;
        //     }
        // }
        var modif1 = document.getElementById('modif'),
            rIndex;
        for (var i = 0; i < modif1.rows.length; i++) {
            modif1.rows[i].onclick = function() {
                rIndex = this.rowIndex;


                document.getElementById("mat").innerHTML = '';
                var nom = document.getElementById("nom");
                nom.innerHTML = this.cells[0].innerHTML;
                nom.style.paddingLeft = "15px";
                var compte = document.getElementById("compte");
                compte.innerHTML = this.cells[1].innerHTML;
                var nomin = document.getElementById("nomin1");
                nomin.value = this.cells[0].innerHTML;
                nomin.style.textAlign = 'left';
                var comptin = document.getElementById("comptin1");
                comptin.value = this.cells[1].innerHTML;
                comptin.style.textAlign = 'left';
                // var nom = document.getElementById("app");
                var stylo = document.getElementById('supp1');
                stylo.style.visibility = "hidden";
                document.getElementById("montants").focus();
                var monton = document.getElementById('montants');
                let valeur = this.cells[2].innerHTML;
                let valeurspace = valeur.replace(/^\s+|\s+$/gm, '');
                monton.placeholder = valeurspace;
                monton.style.textAlign = 'right';

            }
        }
        var modif1 = document.getElementById('modif'),
            rIndex;
        for (var i = 0; i < modif1.rows.length; i++) {
            modif1.rows[i].ondblclick = function() {
                rIndex = this.rowIndex;
                var app = document.getElementById("app");
                var nom = document.getElementById("montants3");

                nom.innerHTML = this.cells[0].innerHTML;
                nom.style.paddingLeft = "15px";
                var compteau = document.getElementById("montants2");
                compteau.style.textAlign = 'center';
                let text = this.cells[1].innerHTML;
                let result = text.replace(/^\s+|\s+$/gm, '');
                compteau.value = result;
                compteau.ReadOnly = true;
                var val2 = this.cells[2].innerHTML;
                document.getElementById('montants1').innerHTML = this.cells[2].innerHTML;
                var stylo = document.getElementById('supp1');
                stylo.style.visibility = "visible";
                document.getElementById("nom").innerHTML = '';
                document.getElementById("compte").innerHTML = '';
                document.getElementById("mat").innerHTML = '';
                document.getElementById("comptin1").value = '';
                document.getElementById("montants").value = '';
                document.getElementById("montants").placeholder = '';

                document.getElementById("suppression").focus();



                // console.log(this.cells[2].innerHTML);v;
                // montant1.innerHTML = this.cells[2].innerHTML;
                // console.log(this.cells[2].innerHTML);
            }
        }
        const button = document.querySelector('#suppression');
        const message1 = document.querySelector('#messageA');
        button.addEventListener('click', () => {
            if (message1.style.display === 'none') {
                message1.style.display = 'block';
            } else {
                message1.style.display = 'none';
            }

        })



        // let bt1 = document.getElementById('bt1');
        // let boite = document.getElementById("messageA");
        // let cont = document.getElementById('conteneur');
        // bt1.addEventListener("click", fonct);

        // function fonct() {
        //     boite.style.zIndex = -100;
        // };




        // let mess = document.getElementById('message');
        // bt1.addEventListener('mouseover', mouse);

        // function mouse() {
        //     mess.innerText = "la messagerie ";
        // };


        // let modalcontainer = document.querySelector(".modal-container");
        // let modaltrigger = document.querySelectorAll(".modal-trigger");
        // let tables = document.getElementById("tabmoda");
        // let boole = false;
        // modaltrigger.forEach(trigger => trigger.addEventListener("click", toggleModal));



        // function toggleModal() {
        //     // modalcontainer.classList.toggle("active");
        //     //    tables.style.visibility="hidden";
        //     boole = !boole;
        //     boole ?  (tables.style.visibility = "hidden", modalcontainer.classList.toggle("active")) : ( modalcontainer.classList.toggle("inactive") ,tables.style.visibility = "visible") ;
            

        // }
        // const garder =document.getElementById("bt1");
        
        // garder.addEventListener('click',garde)
        // function garde(){
        //     modalcontainer.removeClass("active");
        // }


        // $(document).ready(function () {
        //     $('#rech_user').keyup(function () {
        //         var search = $(this).val();
        //         $.ajax({
        //             method: "POST",
        //             url: "actionRech.php",
        //             data: {
        //                 query: search
        //             },
        //             success: function (response) {

        //                 $('#modif').html(response);
        //             }

        //         });
        //     });

        // });
        // var modif1 = document.getElementById('modif'),
        //     rIndex;
        // for (var i = 0; i < modif1.rows.length; i++) {
        //     modif1.rows[i].onmouseover = function () {
        //         rIndex = this.rowIndex;

        //         document.getElementById("aide").style.visibility = "visible";

        //     }
        // }
        // for (var i = 0; i < modif1.rows.length; i++) {
        //     modif1.rows[i].onmouseout = function () {
        //         rIndex = this.rowIndex;

        //         document.getElementById("aide").style.visibility = "hidden";

        //     }
        // }
    </script>


</body>

</html>