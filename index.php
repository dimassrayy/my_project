<?php
// Pengaturan waktu
date_default_timezone_set('UTC');

// Mengambil info server & PHP secara dinamis
$phpVersion = phpversion();
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
$serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';
$documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? '/home/site/wwwroot';
$protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';

$memoryLimit = ini_get('memory_limit');
$maxExecutionTime = ini_get('max_execution_time') . 's';
$uploadMaxSize = ini_get('upload_max_filesize');
$postMaxSize = ini_get('post_max_size');
$timezone = date_default_timezone_get();

$operatingSystem = PHP_OS_FAMILY;
$architecture = php_uname('m');
$currentTime = date('Y-m-d H:i:s');
$clientIP = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Info Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #6366f1;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Header Card */
        .header-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 32px 20px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .header-subtitle {
            font-size: 20px;
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 8px;
        }

        .header-desc {
            font-size: 14px;
            color: #64748b;
        }

        /* Grid Layout */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        /* Section Cards */
        .card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 14px;
        }

        .info-label {
            color: #64748b;
            font-weight: 500;
        }

        .info-value {
            color: #0f172a;
            font-weight: 700;
            text-align: right;
            word-break: break-all;
        }

        .info-value.highlight {
            color: #10b981;
        }

        /* Features List */
        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #0f172a;
            font-weight: 600;
            font-size: 14px;
        }

        .feature-item span {
            color: #10b981;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header-card">
        <h1 class="header-title">🚀 PHP Info Dashboard</h1>
        <div class="header-subtitle">PHP <?php echo htmlspecialchars($phpVersion); ?></div>
        <p class="header-desc">Aplikasi sederhana untuk testing Azure Web App</p>
    </div>

    <!-- 3 Column Info Cards -->
    <div class="grid">
        <!-- Server Info -->
        <div class="card">
            <h2 class="card-title">📊 Server Info</h2>
            <div class="info-row">
                <span class="info-label">PHP Version</span>
                <span class="info-value highlight"><?php echo htmlspecialchars($phpVersion); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Server Software</span>
                <span class="info-value"><?php echo htmlspecialchars($serverSoftware); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Server Name</span>
                <span class="info-value"><?php echo htmlspecialchars($serverName); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Document Root</span>
                <span class="info-value"><?php echo htmlspecialchars($documentRoot); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Protocol</span>
                <span class="info-value"><?php echo htmlspecialchars($protocol); ?></span>
            </div>
        </div>

        <!-- PHP Configuration -->
        <div class="card">
            <h2 class="card-title">⚙️ PHP Configuration</h2>
            <div class="info-row">
                <span class="info-label">Memory Limit</span>
                <span class="info-value"><?php echo htmlspecialchars($memoryLimit); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Max Execution Time</span>
                <span class="info-value"><?php echo htmlspecialchars($maxExecutionTime); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Upload Max Size</span>
                <span class="info-value"><?php echo htmlspecialchars($uploadMaxSize); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Post Max Size</span>
                <span class="info-value"><?php echo htmlspecialchars($postMaxSize); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Timezone</span>
                <span class="info-value"><?php echo htmlspecialchars($timezone); ?></span>
            </div>
        </div>

        <!-- System Info -->
        <div class="card">
            <h2 class="card-title">💻 System Info</h2>
            <div class="info-row">
                <span class="info-label">Operating System</span>
                <span class="info-value"><?php echo htmlspecialchars($operatingSystem); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Architecture</span>
                <span class="info-value"><?php echo htmlspecialchars($architecture); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Current Time</span>
                <span class="info-value"><?php echo htmlspecialchars($currentTime); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Your IP</span>
                <span class="info-value"><?php echo htmlspecialchars($clientIP); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Request Method</span>
                <span class="info-value"><?php echo htmlspecialchars($requestMethod); ?></span>
            </div>
        </div>
    </div>

    <!-- Bottom Features Card -->
    <div class="grid">
        <div class="card">
            <h2 class="card-title">✨ PHP <?php echo explode('.', $phpVersion)[0] . '.' . explode('.', $phpVersion)[1]; ?> Features</h2>
            <ul class="feature-list">
                <li class="feature-item"><span>✓</span> Property Hooks</li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
