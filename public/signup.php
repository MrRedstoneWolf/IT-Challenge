<!doctype html>
<?php session_start(); ?>

<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="main.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>

  <div class="announcement"><span class="announcement_row">Pentolabel B.V., Mon Plaisir 89c, 4879 AM Etten-Leur</span></div>

  <div class="container">

    <a class="logo" href="index"><img src="images/pentolabel.png"></a>

    <nav>
      <ul>
        <a href="index"><li>Home</li></a>
        <a href="signup"><li>Inloggen</li></a>
      </ul>
    </nav>

    <?php if (isset($_SESSION['u_id']))
    {
      header("Location: index");
    } else { ?>
      <h4><strong>Inloggen</strong></h4>
      <form class="inloggen" action="includes/login.inc" method="POST" autocomplete="on">
          <input type="email" name="email_login" placeholder="Voer hier uw e-mailadres in*" required autofocus pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Voer een geldig e-mailadres in">
          <input type="password" name="wachtwoord_login" placeholder="Voer hier uw wachtwoord in" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Moet minimaal een nummer, een hoofdletter en kleine letter bevatten en uit minimaal 8 tekens bestaan">
          <input id="submit" type="submit" name="submit" value="submit">
      </form>

      <h4><strong>Registreren</strong></h4>
      <form class="registreren" action="includes/signup.inc" method="POST" autocomplete="off">
          <input type="email" name="email_registreren" placeholder="Voer hier uw e-mailadres in*" required autofocus pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Voer een geldig e-mailadres in">
          <input type="text" name="voornaam_registreren" placeholder="Voer hier uw voornaam in*" required minlength="3" title="Voer hier uw voornaam in">
          <input type="text" name="achternaam_registreren" placeholder="Voer hier uw achternaam in*" required minlength="3" title="Voer hier uw achternaam in">
          <input type="tel"  name="telefoon_registreren" placeholder="Voer hier uw telefoonnummer in*" required pattern="(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)" title="Voer hier uw telefoonnummer in">
          <input type="text" name="bedrijf_registreren" placeholder="Voer hier de naam van uw bedrijf in" title="Voer hier de naam van uw bedrijf in">
          <input type="password" name="wachtwoord_registreren" placeholder="Voer hier uw wachtwoord in*" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Moet minimaal een nummer, een hoofdletter en kleine letter bevatten en uit minimaal 8 tekens bestaan">
          <input type="password" name="wachtwoord_2_registreren" placeholder="Bevestig uw wachtwoord*" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Moet hetzelfde zijn als uw eerste wachtwoord">
          <input id="submit" type="submit" name="submit" value="submit">
      </form>

    <?php } ?>

  </div>

</body>

</html>
