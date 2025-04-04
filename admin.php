<?php
// Zabezpečenie admin prístupu - túto časť upravte podľa vášho systému autentifikácie
// session_start();
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     header('Location: login.php');
//     exit;
// }

// Načítanie triedy a konfigurácie
require_once 'db/config.php';
require_once 'db/classy/QnA.php';

// Inicializácia objektu QnA
$qnaManager = new QnA($conn);
$message = '';
$messageClass = '';

// Spracovanie formulára na pridanie otázky a odpovede
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $otazka = trim($_POST['otazka']);
    $odpoved = trim($_POST['odpoved']);
    
    $result = $qnaManager->vlozOtazkuOdpoved($otazka, $odpoved);
    $message = $result['message'];
    $messageClass = $result['success'] ? 'success' : 'error';
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pridať Q&A</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        textarea, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 150px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
  <!-- header -->
<?php include('parts/header.php');?>

  <main>
    <section class="banner">
      <div class="container text-white">
        <h1>Admin - Pridať Q&A</h1>
      </div>
    </section>
    <section class="container">
      <div class="row">
        <div class="col-100 text-center">
          <p><strong><em>Správa otázok a odpovedí - pridávanie nových položiek</em></strong></p>
        </div>
      </div>
    </section>
    
    <section class="container">
        <div class="form-container">
            <?php if (!empty($message)) : ?>
                <div class="message <?php echo $messageClass; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <h2>Pridať novú otázku a odpoveď</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="otazka">Otázka:</label>
                    <textarea id="otazka" name="otazka" required></textarea>
                </div>
                <div class="form-group">
                    <label for="odpoved">Odpoveď:</label>
                    <textarea id="odpoved" name="odpoved" required></textarea>
                </div>
                <button type="submit" name="submit">Pridať</button>
            </form>
        </div>
    </section>
  </main>
  