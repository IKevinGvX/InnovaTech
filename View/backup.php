<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'tp_web';

$backupDir = __DIR__ . '/backups';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

function generateBackupName() {
    return "backup_" . date("Y-m-d_H-i-s") . ".sql";
}

function createDatabaseBackup($dbHost, $dbUser, $dbPass, $dbName, $backupDir) {
    $backupFile = $backupDir . '/' . generateBackupName();
    $command = "mysqldump --host={$dbHost} --user={$dbUser} --password={$dbPass} {$dbName} > {$backupFile}";
    $output = [];
    $result = null;
    exec($command, $output, $result);
    if ($result !== 0) {
        throw new Exception("Error creating the database backup. Please check your MySQL credentials or mysqldump configuration.");
    }
    return $backupFile;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        ob_start();
        echo "<div style='text-align: center; font-size: 20px; margin-top: 50px;'>
                <h2>Processing Backup...</h2>
                <p>Please wait while we create your database backup. This might take a few seconds...</p>
                <progress id='progress-bar' value='0' max='100' style='width: 50%;'></progress>
              </div>";

        echo "<script>
                const progressBar = document.getElementById('progress-bar');
                let progress = 0;
                const interval = setInterval(() => {
                    progress += 10;
                    progressBar.value = progress;
                    if (progress >= 100) {
                        clearInterval(interval);
                    }
                }, 300);
              </script>";
        ob_flush();
        flush();

        $backupFile = createDatabaseBackup($dbHost, $dbUser, $dbPass, $dbName, $backupDir);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Backup Completed',
                    text: 'Your database backup has been successfully created!',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Principal.php'; 
                    }
                });
              </script>";
    } catch (Exception $e) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Backup Failed',
                    text: '" . $e->getMessage() . "',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Principal.php'; 
                    }
                });
              </script>";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "
    <nav style='display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; background: linear-gradient(45deg, #4CAF50, #2E8B57); box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);'>
        <div style='color: white; font-size: 24px; font-weight: bold;'>Backup Manager</div>
        <ul style='list-style: none; display: flex; margin: 0; padding: 0;'>
            <li style='margin: 0 10px;'><a href='Principal.php' style='color: white; text-decoration: none; font-size: 18px;'>Home</a></li>
            <li style='margin: 0 10px;'><a href='CenterStyles/innovatech.webp' style='color: white; text-decoration: none; font-size: 18px;'>About</a></li>
            <li style='margin: 0 10px;'><a href='contacts.php' style='color: white; text-decoration: none; font-size: 18px;'>Contact</a></li>
        </ul>
    </nav>

    <div style='text-align: center; margin-top: 50px;'>
        <h1 style='font-family: Arial, sans-serif; color: #333;'>MySQL Database Backup Tool</h1>
        <p style='color: #777; font-size: 16px;'>Easily create backups for your MySQL database with just one click.</p>
        <form method='POST' style='margin-top: 30px;'>
            <button type='submit' style='padding: 15px 30px; background: linear-gradient(to right, #4CAF50, #2E8B57); color: white; border: none; border-radius: 25px; font-size: 18px; cursor: pointer; transition: all 0.3s ease;'>Create Backup</button>
        </form>
    </div>
    <style>
        button:hover {
            transform: scale(1.1);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
    </style>
    ";
} else {
    echo "<div style='text-align: center; color: red;'>Invalid request method.</div>";
}
?>
