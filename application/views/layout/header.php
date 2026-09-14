<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Dashboard - SPMB SMK Grisa'; ?></title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- JS UTAMA (Dipindah ke <head> agar tidak error di View) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #2b3643;
            --header-top-bg: #1f2833;
            --header-sub-bg: #324356;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef1f5;
            overflow-x: hidden;
            font-size: 13px;
        }

        /* Top Header Dual Bar */
        .top-header-1 {
            background-color: var(--header-top-bg);
            color: #fff;
            padding: 6px 15px;
        }

        .top-header-2 {
            background-color: var(--header-sub-bg);
            color: #fff;
            padding: 6px 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: #b4bcc8;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        #sidebar.active {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        .user-panel {
            padding: 15px;
            background: rgba(0, 0, 0, 0.15);
        }

        .user-panel img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li a {
            padding: 10px 15px;
            color: #b4bcc8;
            display: block;
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li.active>a {
            color: #fff;
            background: #222b35;
            border-left-color: #36c6d3;
        }

        .sidebar-menu .treeview-menu {
            display: none;
            list-style: none;
            padding-left: 15px;
            background: #222b35;
        }

        .sidebar-menu .treeview-menu a {
            padding: 8px 15px;
        }

        /* Content Area */
        #content {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
        }

        #content.active {
            width: 100%;
            margin-left: 0;
        }

        /* Stat Cards */
        .card-stat {
            border-radius: 4px;
            color: white;
            padding: 12px 15px;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            margin-bottom: 15px;
        }

        .bg-purple {
            background-color: #5c6bc0;
        }

        .bg-cyan {
            background-color: #26c6da;
        }

        .bg-orange {
            background-color: #ff7043;
        }

        .bg-green {
            background-color: #26a69a;
        }

        .bg-pink {
            background-color: #ec407a;
        }

        .card-stat .stat-number {
            font-size: 26px;
            font-weight: bold;
        }

        .card-stat .stat-icon {
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 28px;
            opacity: 0.3;
        }

        /* Banner Box */
        .banner-spmb {
            background: linear-gradient(135deg, #101c2e 0%, #1e3c72 100%);
            color: white;
            border-radius: 6px;
            padding: 30px 15px;
            text-align: center;
        }
    </style>
</head>

<body>