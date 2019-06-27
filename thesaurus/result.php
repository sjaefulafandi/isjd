<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="HandheldFriendly" content="True">

  <title>Thesaurus Online PDII LIPI</title>

  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" type="text/css" media="screen" href="css/concise.min.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/starter.css" />
</head>

<?php
error_reporting(0);
include 'database.php';

$db = new Database();
$db->connect();

?>
<body>
  <header container class="siteHeader">
    <div row>
      <h1 column=4 class="logo">THESAURUS ONLINE</h1>
      </nav>
    </div>
  </header>

  <main container class="siteContent">
    <form action="result.php">
      <div column=10>
      <input class="float--left input--large" value="<?php echo @$_GET['q'] ?>" required="true" name="q" autocomplete="off" title="Search" type="text">  
      </div>
      <div column=2>
      <button class="button--sm float--left" type="submit">Search</button>
      </div>
    </form>
    </div>
    <div class="clearfix"></div>
    
    <?php
    $query  = "SELECT * FROM thesaurus WHERE nama LIKE '%".mysql_escape_string($_GET['q'])."%'";
    $result = mysql_query($query);
    ?>

    <div column=12 style="margin: 10px 0;">
      <div class="float--left"><em>Menampilkan hasil pencarian dengan kata kunci: <b><?php echo @$_GET['q']?></b></em></div>
    </div>
    <div column=12>
      <ul>
        <?php
          while ($row = mysql_fetch_assoc($result)) {
            echo "<li>".trim($row['nama'])." (".trim($row['hierarchy']).")</li>";
          }
        ?>
      </ul>
    </div>
  </main>
<div class="right_col" role="main">
    <footer>
        <div class="">
            <p class="pull-right">
                <p>Copyright &copy; 2016 by Pusat Dokumentasi dan Informasi Ilmiah - LIPI</p>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
</div>

  <script src="js/jquery.min.js"></script>
</body>
</html>
