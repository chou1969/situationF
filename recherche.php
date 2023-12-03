<?php
session_start();
include "connect.php";
$mat = null;
$nom = null;
$cot = null;
$valeur = 0;
$compteur = 0;
$_SESSION['fic1'] = $_SESSION['fic'];
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
    <link rel="stylesheet" type="text/css" href="/modiCSS.css">
    <!-- <link rel="stylesheet" type="text/css" href="cas.css" /> -->
    <title>Recherche Ens</title>
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
        grid-template-columns: 1fr 4fr 1fr;
        grid-template-rows: 1fr 1fr 1fr 7.8fr 0.5fr;
        grid-template-areas:
            "entete entete entete"
            "recherche1 recherche1 recherche1"
            "lateraltitre recherche titre "
            "lateralcorps gauche corps"
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
#trbodys:hover :nth-child(odd) {
  background-color: rgb(2, 2, 2);
  /* font-size: 1.1em; */
  text-shadow: 2px 2px 8px rgb(8, 8, 8);
  cursor: default;
  color: white;
  font-weight: bold;
  border-left: 3px solid red;
}  
#trbodys:hover :nth-child(even) {
  background-color: rgb(82, 184, 209);
  /* font-size: 1.1em; */
  cursor: default;
  font-weight: bold;
  color: white;
}
/* #trbodys:hover :nth-child(6) {
  background-color: red;
  font-weight: bold;
  font-size: 1.2em;
  color: white;
  text-shadow: 2px 2px 8px rgb(8, 8, 8);
  cursor: default;
} */

#trbodys:hover {
  cursor: pointer;
}
</style>

<body>
    <div class="conteneur" style="padding:2px;">
        <div class="design1" style="padding:2px">
            <nav class="navbar navbar-expand-lg " style=" height: 65px;">

                <div class="collapse navbar-collapse " id="navbarCollapse1"
                    style="display:inline;position:fixed;width:100%;background-color:black;">
                    <div style="margin-right:6%;">
                        <img src="image/Cou1.png" alt="Logo">
                    </div>
                    <div style="margin:0px auto;">
                        <span id="demo" style="font-size:1.8em;margin:0px auto">
                            ATTRIBUTIONS DES <B style="color:#008CBA">A.F</B> ET DIVERS TRAITEMENTS MANUELS </span>
                    </div>
                    <div class="navbar" style="margin:auto 15px;">
                        <div>
                            <a class="hop" href="PageAc.html" class="nav-item nav-link">Retour Page d'accueil</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="design7">
            <div class="bloc2">
                <div class="bloc3">
                    <p style="font-weight:bold;text-shadow:2px 2px 8px white;"> RECHERCHE ET INTEGRATION DU PERSONNEL DANS LE FICHIER CCP
                        

                    </p>

                </div>
            </div>

        </div>
        <div class="design5">

        </div>
        <div class="design2">
            <div id="div-titre">

                <p id="parag-titre"
                    style="color:cyan;flex-wrap:wrap;text-align:center;padding:2px;height:55px;margin:auto 60px;">
                    <span id="span-ccp">
                        TRAITEMENTS SUR LES FICHIERS POSTAUX </span>
                </p>
            </div>
            <!-- <-- -->
        </div>
        <!-- table des modifications et des ajouts. -->
        <div class="design3">

        </div>
        <!-- fin de la table  -->
        <div class="design6">
            <div style="margin:8px auto; width:100%;min-width:600px;padding:1px;">
                <form method="POST" class="format">
                    <input class="form-control mb-1" type="search" autocomplete="off" name="search-user" id="nom1"
                        pattern="[A-Za-z0-9]{25}" maxlength="25"
                        style="padding-left: 55px ;text-align:left;color:black;width:90%;background-repeat: no-repeat;
                              font-size:18px;background-image: url(image/peo.png);font-variant-caps:small-caps ;border-color:skyblue;;margin:0px auto ;"
                        placeholder="veuillez introduire le matricule ou le nom de la personne" autofocus />
                </form>
            </div>

            <div
                style="height:83%;width:98%;margin:5px auto;border-radius:3px;background:white;border-bottom:3px solid grey">

                <table class="table" id="musers" style="width:97%;
                                            margin:5px auto;display:block;font-size:13px">
                    <thead style="background-color: grey;;color:white; display:block;border-radius:5px">
                        <th style="width:3%;">MAT</th>
                        <th style="width:22%;">NOM</th>
                        <th style="width:22%;">PRENOM</th>
                        <th style="width:32%;">GRADE</th>
                        <th style="width:13%;font-size:11px">DATE NAIS.</th>
                        <th>INSERT.</th>
                    </thead>

                </table>
            </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nom1').keyup(function () {
                var search = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "actionResp.php",
                    data: {
                        query: search
                    },
                    success: function (response) {

                        $('#musers').html(response);
                    }

                });
            });

        });
    </script>
</body>

</html>