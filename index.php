
<!DOCTYPE html>
<html>

<head>
    <title id="title"></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="theme-color" content="#3B5998" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <link rel="stylesheet" href="style.css">

</head>

<body>
        $(if chap-id)
        <form name="sendin" action="$(link-login-only)" method="post">
            <input type="hidden" name="username" />
            <input type="hidden" name="password" />
            <input type="hidden" name="dst" value="$(link-orig)" />
            <input type="hidden" name="popup" value="true" />
        </form>

        <script type="text/javascript" src="md5.js"></script>
        
        <script type="text/javascript">
            function doLogin() {
                document.sendin.username.value = document.login.username.value;
                document.sendin.password.value = hexMD5('$(chap-id)' + document.login.password.value +
                    '$(chap-challenge)');
                document.sendin.submit();
                return false;
            }
        </script>
        $(endif)

            <div id="main" class="main">
            
            <div class="box">
                <h3 class="brand">MOUNKAILA WIFI ZONE</h3>
            </div>
            <div class="box">
                
                <button id="btnmem" class="small-button" onclick="member();"><i class="icon icon-user-circle-o">&#xf2be;</i> Compte</button>
                <!-- <button id="btnvrc" class="small-button" onclick="voucher();"><i class="icon icon-ticket">&#xe802;</i> Essai</button> -->
              <!--  <button id="qr" class="small-button" onclick="window.location='https://laksa19.github.io/myqr';"> <i class="icon icon-qrcode">&#xe801;</i> QR
                    Code</button> -->
            </div>
            <div class="box" id="infologin">
            </div>
            <form autocomplete="off" name="login" action="$(link-login-only)" method="post" $(if chap-id) onSubmit="return doLogin()"
                $(endif)>
                <input type="hidden" name="dst" value="$(link-orig)" />
                <input type="hidden" name="popup" value="true" />
                <input class="username" name="username" type="text" value="" />
                <input class="password" name="password" placeholder="Mot de Passe" type="hidden" />

                <button class="button" type="submit"><i class="icon icon-login">&#xe803;</i> SE CONNECTER</button>

            </form>
            
           
           <table class="table">
    <caption style="font-size: 16px; font-weight: bold; margin-bottom:5px;">NOS TARIFS</caption>
    <tr>
        <th>DUREE</th>
        <th>PRIX</th>
        <th>VALIDITE</th>
        <th>Action</th>
    </tr>
    <tr>
        <td>2H</td>
        <td>100 FCFA</td>
        <td>1 JOUR</td>
        <td><button onclick="payer(100, '2H-001')">Payer</button></td>
    </tr>
    <tr>
        <td>12H</td>
        <td>200 FCFA</td>
        <td>1 JOUR</td>
        <td><button onclick="payer(200, '12H-002')">Payer</button></td>
    </tr>
    <tr>
        <td>24H</td>
        <td>300 FCFA</td>
        <td>2 JOURS</td>
        <td><button onclick="payer(300, '24H-003')">Payer</button></td>
    </tr>
    <!-- Continue pour les autres forfaits -->
</table>
                <br />
                <div class="disp">
                    LES TICKETS SONT DISPONIBLE CHEZ "ALADJI MOUNKAILA".
                </div>
                <div>
                    CONTACTS : 01-61-98-30-70
                </div>

        </div>
        <br />
        <div class="box" style="color:#000;">
            <i>Copyright &copy; 2024 geulech@gmail.com</i><br />
           <!-- <i> Powered by <a style="color:#000; text-decoration:underline;" href="https://laksa19.github.io">Mikhmon</a></i>
            <!-- Tolong jangan dihilangkan bagian ini-->
        </div>

        <script type="text/javascript">
            var hostname = window.location.hostname;
            document.getElementById('title').innerHTML = hostname  + " > login";
            
            document.login.username.focus();

            // Vérifie si un code est présent dans l'URL
const urlParams = new URLSearchParams(window.location.search);
const codeVoucher = urlParams.get('voucher');
if (codeVoucher) {
    document.login.username.value = codeVoucher;
    document.login.password.value = codeVoucher;
}

var infologin = document.getElementById('infologin');
infologin.innerHTML = "CONNEXION INTERNET HAUT DEBIT";

// login page 2 mode by Laksamadi Guko
var username = document.login.username;
var password = document.login.password;

 username.placeholder = "Tapez ici votre code";

 

// set password = username
function setpass() {
    var user = username.value
    //user = user.toLowerCase();
    username.value = user;
    password.value = user;
}

 username.onkeyup = setpass;

// change to voucher mode
function voucher() {
    username.focus();
    username.onkeyup = setpass;
    username.placeholder = "Kode Voucher";
    username.style = "border-radius:3px;"
    password.type = "hidden";
    infologin.innerHTML = "Masukkan Kode Voucher kemudian klik login.";
}

// change to member mode

function member() {
    username.focus();
    username.onkeyup = "";
    username.placeholder = "Nom d'utilisateur";
    username.style = "border-radius:3px 3px 0px 0px;"
    password.type = "Mot de Passe";
    infologin.innerHTML = "CONNEXION INTERNET HAUT DEBIT";
}

  

function payer(montant, codeVoucher) {
    const callbackURL = encodeURIComponent(`http://8a390a173b1f.sn.mynetname.net/login?voucher=${codeVoucher}`);
    const paiementURL = `https://me.fedapay.com/paiement-wifi?montant=${montant}&callback=${callbackURL}`;
    window.location.href = paiementURL;
}

    // Redirige vers la page FedaPay
  //  window.location.href = urlPaiement;


</script>
</body>

</html>




<?php
header("Location: generate-ticket.php");
exit;

