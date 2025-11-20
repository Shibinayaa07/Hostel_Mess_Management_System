<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/icons/mkce_s.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 60px;
            --footer-height: 60px;
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --dark-bg: #1a1c23;
            --light-bg: #f8f9fc;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.collapsed~.content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .breadcrumb-area {
            background-image: linear-gradient(to top, #fff1eb 0%, #ace0f9 100%);
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin: 20px;
            padding: 15px 20px;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: #224abe;
        }

        .container-fluid {
            padding: 20px;
        }

        .loader-container {
            position: fixed;
            left: var(--sidebar-width);
            right: 0;
            top: var(--topbar-height);
            bottom: var(--footer-height);
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            transition: left 0.3s ease;
        }

        .sidebar.collapsed~.content .loader-container {
            left: var(--sidebar-collapsed-width);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }

            .sidebar.mobile-show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0 !important;
            }

            .loader-container {
                left: 0;
            }
        }

        .loader-container.hide {
            display: none;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid var(--primary-color);
            border-right: 5px solid var(--success-color);
            border-bottom: 5px solid var(--primary-color);
            border-left: 5px solid var(--success-color);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* ========== STATISTICS DASHBOARD STYLING ========== */
        .statistics-header {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .statistics-header i {
            font-size: 1.8rem;
        }

        .statistics-container {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-box {
            flex: 1;
            min-width: 280px;
            padding: 30px 20px;
            border-radius: 15px;
            color: white;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .stat-box:nth-child(1) {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        }

        .stat-box:nth-child(2) {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        }

        .stat-box:nth-child(3) {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
        }

        .stat-box:nth-child(4) {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
        }

        .stat-box h3 {
            font-size: 3rem;
            font-weight: 700;
            margin: 0;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .stat-box p {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
            opacity: 0.95;
            letter-spacing: 0.5px;
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .stat-box:hover::before {
            transform: rotate(45deg) translateY(-10%);
        }

        @media (max-width: 992px) {
            .statistics-container {
                gap: 1rem;
            }

            .stat-box {
                min-width: 230px;
                padding: 25px 15px;
            }

            .stat-box h3 {
                font-size: 2.5rem;
            }

            .stat-box p {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .stat-box {
                min-width: 100%;
            }

            .statistics-container {
                flex-direction: column;
            }
        }

        /* ========== CUSTOM TABS STYLING (ACTIVE TAB COLORED) ========== */
        .custom-tabs {
            margin-bottom: 2rem;
        }

        .custom-tabs .nav-tabs {
            border-bottom: none;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            gap: 8px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        /* Tab 1 - PINK */
        .custom-tabs .nav-item:nth-child(1) .nav-link {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #d531a4ff;
            background: white;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-tabs .nav-item:nth-child(1) .nav-link i {
            font-size: 1.1rem;
            color: #d531a4ff;
        }

        .custom-tabs .nav-item:nth-child(1) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(1) .nav-link:hover i {
            background: linear-gradient(135deg, #d531a4ff 0%, #cc4da2ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(1) .nav-link.active {
            background: linear-gradient(135deg, #d531a4ff 0%, #cc4da2ff 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(213, 49, 164, 0.4);
        }

        .custom-tabs .nav-item:nth-child(1) .nav-link.active i {
            color: white;
        }

        /* Tab 2 - BLUE */
        .custom-tabs .nav-item:nth-child(2) .nav-link {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #2196F3;
            background: white;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link i {
            font-size: 1.1rem;
            color: #2196F3;
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(2) .nav-link:hover i {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link.active {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(33, 150, 243, 0.4);
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link.active i {
            color: white;
        }

        /* Tab 3 - PURPLE */
        .custom-tabs .nav-item:nth-child(3) .nav-link {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #7B1FA2;
            background: white;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link i {
            font-size: 1.1rem;
            color: #7B1FA2;
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(3) .nav-link:hover i {
            background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link.active {
            background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(156, 39, 176, 0.4);
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link.active i {
            color: white;
        }

        /* Tab 4 - ORANGE */
        .custom-tabs .nav-item:nth-child(4) .nav-link {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #F57C00;
            background: white;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link i {
            font-size: 1.1rem;
            color: #F57C00;
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(4) .nav-link:hover i {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link.active {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 152, 0, 0.4);
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link.active i {
            color: white;
        }

        /* Tab 5 - RED */
        .custom-tabs .nav-item:nth-child(5) .nav-link {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #f50000ff;
            background: white;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link i {
            font-size: 1.1rem;
            color: #f50000ff;
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(5) .nav-link:hover i {
            background: linear-gradient(135deg, #eb454aff 0%, #f50000ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link.active {
            background: linear-gradient(135deg, #eb454aff 0%, #f50000ff 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(245, 0, 0, 0.4);
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link.active i {
            color: white;
        }

        /* Tab 6 - MAGENTA */
        .custom-tabs .nav-item:nth-child(6) .nav-link {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #d800f5ff;
            background: white;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link i {
            font-size: 1.1rem;
            color: #d800f5ff;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(6) .nav-link:hover i {
            background: linear-gradient(135deg, #da59f0ff 0%, #d800f5ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link.active {
            background: linear-gradient(135deg, #da59f0ff 0%, #d800f5ff 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(216, 0, 245, 0.4);
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link.active i {
            color: white;
        }

        .custom-tabs .tab-content {
            background: white;
            padding: 25px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            min-height: 400px;
        }

        @media (max-width: 768px) {
            .custom-tabs .nav-tabs {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .custom-tabs .nav-link {
                padding: 10px 15px;
                font-size: 0.85rem;
            }

            .custom-tabs .nav-link i {
                font-size: 1rem;
            }
        }

        /* ========== TABLE STYLING ========== */
        .table-responsive {
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-top: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #4CAF50 0%, #2196F3 100%) !important;
            color: white !important;
        }

        .table thead th {
            background: transparent !important;
            color: white !important;
            text-align: center;
            height: 1.5cm;
            font-size: 1em;
            font-weight: 600;
            padding: 12px 8px;
            border: 0.3px solid #ffffff !important;
            vertical-align: middle;
        }

        .table tbody {
            text-align: center;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .btn-group-sm .btn {
            margin: 0 2px;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.5em 0.75em;
            border-radius: 20px;
        }

        /* ========== CUSTOM BUTTONS ========== */
        .btn-mark-out {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }

        .btn-mark-out:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(76, 175, 80, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-mark-in {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
        }

        .btn-mark-in:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(33, 150, 243, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-mark-in.late {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            box-shadow: 0 4px 8px rgba(244, 67, 54, 0.3);
        }

        .btn-mark-in.late:hover {
            box-shadow: 0 6px 12px rgba(244, 67, 54, 0.4);
        }

        /* ========== STATUS BADGES ========== */
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-approved {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
        }

        .status-out {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
            color: white;
        }

        .status-closed {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
        }

        .status-late {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
        }

        /* ========== ALERT STYLING ========== */
        .alert {
            border: none;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left-color: #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left-color: #dc3545;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border-left-color: #ffc107;
        }

        /* ========== MODAL STYLING ========== */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px 12px 0 0;
        }

        .modal-header .close {
            color: white;
            opacity: 0.8;
        }

        /* ========== TIME INFO BOXES ========== */
        .time-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #667eea;
        }

        .time-info strong {
            color: #333;
        }

        /* ========== NO DATA STATE ========== */
        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .no-data-icon {
            font-size: 64px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .no-data p {
            font-size: 1.1rem;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .stat-box h3 {
                font-size: 2rem;
            }

            .statistics-header {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <?php include './assets/sidebar.php'; ?>

    <div class="content">
        <!-- Breadcrumb -->
        <?php include './assets/topbar.php'; ?>

        <!-- Breadcrumb -->
        <div class="breadcrumb-area custom-gradient">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="#">In & Out </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Status</li>
                </ol>
            </nav>
        </div>


        <!-- Statistics Cards -->
        <div class="container-flex" style="background-color: white;">
            <div class="container-fluid">
                <div class="custom-tabs">
                    <div class="statistics-header">
                        <i class="fas fa-chart-bar"></i> System Overview
                    </div>
                    <div class="statistics-container">
                        <div class="stat-box">
                            <h3 id="totalApprovedCount">0</h3>
                            <p>Approved Leaves</p>
                        </div>
                        <div class="stat-box">
                            <h3 id="totalOutCount">0</h3>
                            <p>Currently Out</p>
                        </div>
                        <div class="stat-box">
                            <h3 id="totalLateCount">0</h3>
                            <p>Late Entries</p>
                        </div>
                        <div class="stat-box">
                            <h3 id="totalClosedCount">0</h3>
                            <p>Closed Leaves</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <!-- Custom Tabs -->
            <div class="custom-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">

                        <a class="nav-link active" data-toggle="tab" href="#markOutTab" role="tab">
                            <i class="fas fa-arrow-up"></i> Mark Out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#markInTab" role="tab">
                            <i class="fas fa-arrow-down"></i> Mark In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#historyTab" role="tab">
                            <i class="fas fa-history"></i> History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#lateEntriesTab" role="tab">
                            <i class="fas fa-exclamation-circle"></i> Late Entries
                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#statsTab" role="tab">
                            <i class="fas fa-bar-chart"></i> Statistics
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settingsTab" role="tab">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Mark Out Tab -->
                    <div id="markOutTab" class="tab-pane fade show active" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-arrow-up text-success"></i> Mark Student Out</h5>
                        <div id="outMessage" class="mb-3"></div>
                        <div id="approvedLeavesList"></div>
                    </div>

                    <!-- Mark In Tab -->
                    <div id="markInTab" class="tab-pane fade" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-arrow-down text-primary"></i> Mark Student In</h5>
                        <div id="inMessage" class="mb-3"></div>
                        <div id="outStudentsList"></div>
                    </div>

                    <!-- History Tab -->
                    <div id="historyTab" class="tab-pane fade" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-history text-info"></i> Fingerprint History</h5>
                        <div id="historyMessage" class="mb-3"></div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Roll Number</th>
                                        <th>Student Name</th>
                                        <th>Scan Type</th>
                                        <th>Scan Time</th>
                                        <th>Leave Status</th>
                                        <th>Late Entry</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Late Entries Tab -->
                    <div id="lateEntriesTab" class="tab-pane fade" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-exclamation-circle text-danger"></i> Late Entry Records</h5>
                        <div id="lateMessage" class="mb-3"></div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Roll Number</th>
                                        <th>Student Name</th>
                                        <th>Expected Return</th>
                                        <th>Actual Return</th>
                                        <th>Late By (Hours)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="lateTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Statistics Tab 
                    <div id="statsTab" class="tab-pane fade" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-chart-pie text-warning"></i> System Statistics</h5>
                        <div id="statsContent" class="row">
                            <div class="col-md-6">
                                <canvas id="statsChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <div id="statsTable"></div>
                            </div>
                        </div>
                    </div>-->

                    <!-- Settings Tab -->
                    <div id="settingsTab" class="tab-pane fade" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-cog text-secondary"></i> System Settings</h5>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Settings for fingerprint system management
                        </div>
                        <div class="form-group">
                            <label for="lateThreshold">Late Entry Threshold (Minutes):</label>
                            <input type="number" class="form-control" id="lateThreshold" value="0" placeholder="Enter minutes">
                        </div>
                        <div class="form-group">
                            <label for="refreshRate">Auto Refresh Rate (Seconds):</label>
                            <input type="number" class="form-control" id="refreshRate" value="10" placeholder="Enter seconds">
                        </div>
                        <button class="btn btn-primary" onclick="saveSettings()"><i class="fas fa-save"></i> Save Settings</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include './assets/footer.php'; ?>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel"><i class="fas fa-check-circle"></i> Confirm Action</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="confirmMessage"></p>
                    <div id="leaveDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">
                        <i class="fas fa-check"></i> Confirm
                    </button>
                </div>
            </div>
        </div>
        <?php include './assets/footer.php'; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const API_URL = 'apif.php';
        let autoRefreshInterval = null;

        function loadAllData() {
            loadStatistics();
            loadApprovedLeaves();
            loadOutStudents();
            loadHistory();
            loadLateEntries();
        }

        function loadStatistics() {
            fetch(`${API_URL}?action=getStatistics`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('totalApprovedCount').textContent = data.approved || 0;
                        document.getElementById('totalOutCount').textContent = data.out || 0;
                        document.getElementById('totalLateCount').textContent = data.late || 0;
                        document.getElementById('totalClosedCount').textContent = data.closed || 0;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadApprovedLeaves() {
            fetch(`${API_URL}?action=getApprovedLeaves`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayApprovedLeaves(data.leaves);
                    } else {
                        showMessage('outMessage', data.message || 'Error loading leaves', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('outMessage', 'Error loading data', 'danger');
                });
        }

        function displayApprovedLeaves(leaves) {
            const container = document.getElementById('approvedLeavesList');
            if (leaves.length === 0) {
                container.innerHTML = '<div class="no-data"><div class="no-data-icon">📭</div><p>No approved leaves available</p></div>';
                return;
            }

            let html = '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Roll No</th><th>Name</th><th>Leave Type</th><th>From Date</th><th>To Date</th><th>Action</th></tr></thead><tbody>';

            leaves.forEach(leave => {
                const fromDate = new Date(leave.From_Date);
                const toDate = new Date(leave.To_Date);
                const now = new Date();
                const isWithinLeave = now >= fromDate && now <= toDate;

                html += `<tr>
                    <td>${escapeHtml(leave.Reg_No)}</td>
                    <td>${escapeHtml(leave.student_name || 'N/A')}</td>
                    <td><span class="badge badge-info">${escapeHtml(leave.Leave_Type_Name)}</span></td>
                    <td>${formatDateTime(leave.From_Date)}</td>
                    <td>${formatDateTime(leave.To_Date)}</td>
                    <td>
                        <button class="btn btn-mark-out btn-sm" onclick="markOut(${leave.Leave_ID}, '${leave.Reg_No}', '${escapeHtml(leave.student_name)}', '${leave.To_Date}')" ${isWithinLeave ? '' : 'disabled'}>
                            <i class="fas fa-arrow-up"></i> Mark Out
                        </button>
                    </td>
                </tr>`;
            });

            html += '</tbody></table></div>';
            container.innerHTML = html;
        }

        function markOut(leaveId, regNo, studentName, toDate) {
            const confirmMessage = document.getElementById('confirmMessage');
            const leaveDetails = document.getElementById('leaveDetails');

            confirmMessage.textContent = `Mark ${studentName} as OUT?`;
            leaveDetails.innerHTML = `
                <div class="time-info">
                    <strong><i class="fas fa-user"></i> Roll Number:</strong> ${regNo}<br>
                    <strong><i class="fas fa-clock"></i> Scan Time:</strong> ${new Date().toLocaleString()}<br>
                    <strong><i class="fas fa-calendar"></i> Expected Return:</strong> ${formatDateTime(toDate)}
                </div>
            `;

            document.getElementById('confirmBtn').onclick = function() {
                performMarkOut(leaveId, regNo);
            };

            $('#confirmModal').modal('show');
        }

        function performMarkOut(leaveId, regNo) {
            const formData = new FormData();
            formData.append('action', 'markOut');
            formData.append('Leave_ID', leaveId);
            formData.append('Reg_No', regNo);

            fetch(API_URL, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    $('#confirmModal').modal('hide');
                    if (data.success) {
                        showMessage('outMessage', 'Student marked OUT successfully!', 'success');
                        setTimeout(() => {
                            loadAllData();
                        }, 1500);
                    } else {
                        showMessage('outMessage', data.message || 'Error marking out', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('outMessage', 'Error processing request', 'danger');
                });
        }

        function loadOutStudents() {
            fetch(`${API_URL}?action=getOutStudents`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayOutStudents(data.students);
                    } else {
                        showMessage('inMessage', data.message || 'Error loading students', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('inMessage', 'Error loading data', 'danger');
                });
        }

        function displayOutStudents(students) {
            const container = document.getElementById('outStudentsList');
            if (students.length === 0) {
                container.innerHTML = '<div class="no-data"><div class="no-data-icon">👥</div><p>No students currently marked OUT</p></div>';
                return;
            }

            let html = '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Roll No</th><th>Name</th><th>Out Time</th><th>Expected Return</th><th>Status</th><th>Action</th></tr></thead><tbody>';

            students.forEach(student => {
                const toDate = new Date(student.To_Date);
                const now = new Date();
                const isLate = now > toDate;
                const statusClass = isLate ? 'status-late' : 'status-out';
                const statusText = isLate ? 'Late' : 'On Time';

                html += `<tr>
                    <td>${escapeHtml(student.Reg_No)}</td>
                    <td>${escapeHtml(student.student_name || 'N/A')}</td>
                    <td>${formatDateTime(student.scan_time)}</td>
                    <td>${formatDateTime(student.To_Date)}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td>
                        <button class="btn btn-mark-in btn-sm ${isLate ? 'late' : ''}" onclick="markIn(${student.Leave_ID}, '${student.Reg_No}', '${escapeHtml(student.student_name)}', '${student.To_Date}', ${isLate})">
                            <i class="fas fa-arrow-down"></i> Mark In
                        </button>
                    </td>
                </tr>`;
            });

            html += '</tbody></table></div>';
            container.innerHTML = html;
        }

        function markIn(leaveId, regNo, studentName, toDate, isLate) {
            const confirmMessage = document.getElementById('confirmMessage');
            const leaveDetails = document.getElementById('leaveDetails');

            let lateWarning = '';
            if (isLate) {
                const toDateTime = new Date(toDate);
                const now = new Date();
                const diffMs = now - toDateTime;
                const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
                const diffMins = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
                lateWarning = `<div class="alert alert-warning"><strong><i class="fas fa-exclamation-triangle"></i> Late Entry Detected!</strong> Student is ${diffHours}h ${diffMins}m late.</div>`;
            }

            confirmMessage.textContent = `Mark ${studentName} as IN?`;
            leaveDetails.innerHTML = `
                ${lateWarning}
                <div class="time-info">
                    <strong><i class="fas fa-user"></i> Roll Number:</strong> ${regNo}<br>
                    <strong><i class="fas fa-clock"></i> Scan Time:</strong> ${new Date().toLocaleString()}<br>
                    <strong><i class="fas fa-calendar"></i> Expected Return:</strong> ${formatDateTime(toDate)}
                </div>
            `;

            document.getElementById('confirmBtn').onclick = function() {
                performMarkIn(leaveId, regNo, isLate);
            };

            $('#confirmModal').modal('show');
        }

        function performMarkIn(leaveId, regNo, isLate) {
            const formData = new FormData();
            formData.append('action', 'markIn');
            formData.append('Leave_ID', leaveId);
            formData.append('Reg_No', regNo);
            formData.append('isLate', isLate ? 1 : 0);

            fetch(API_URL, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    $('#confirmModal').modal('hide');
                    if (data.success) {
                        showMessage('inMessage', data.message || 'Student marked IN successfully!', 'success');
                        setTimeout(() => {
                            loadAllData();
                        }, 1500);
                    } else {
                        showMessage('inMessage', data.message || 'Error marking in', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('inMessage', 'Error processing request', 'danger');
                });
        }

        function loadHistory() {
            fetch(`${API_URL}?action=getHistory`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayHistory(data.history);
                    } else {
                        showMessage('historyMessage', data.message || 'Error loading history', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('historyMessage', 'Error loading data', 'danger');
                });
        }

        function displayHistory(history) {
            const tbody = document.getElementById('historyTableBody');
            if (history.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No history records found</td></tr>';
                return;
            }

            let html = '';
            history.forEach(record => {
                const isLate = record.is_late_entry === 1 ? 'Yes' : 'No';
                const lateBadgeClass = record.is_late_entry === 1 ? 'status-late' : '';

                html += `<tr>
                    <td>${escapeHtml(record.roll_number)}</td>
                    <td>${escapeHtml(record.student_name)}</td>
                    <td><span class="badge ${record.scan_type === 'Out' ? 'badge-success' : 'badge-warning'}">${record.scan_type}</span></td>
                    <td>${formatDateTime(record.scan_time)}</td>
                    <td><span class="status-badge ${record.leave_status === 'Closed' ? 'status-closed' : (record.leave_status === 'Out' ? 'status-out' : 'status-approved')}">${record.leave_status}</span></td>
                    <td><span class="status-badge ${lateBadgeClass}" style="background: transparent; color: #333;"><i class="fas ${record.is_late_entry === 1 ? 'fa-exclamation-circle text-danger' : 'fa-check-circle text-success'}"></i> ${isLate}</span></td>
                </tr>`;
            });

            tbody.innerHTML = html;
        }

        function loadLateEntries() {
            fetch(`${API_URL}?action=getLateEntries`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayLateEntries(data.late_entries);
                    } else {
                        showMessage('lateMessage', data.message || 'Error loading late entries', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('lateMessage', 'Error loading data', 'danger');
                });
        }

        function displayLateEntries(entries) {
            const tbody = document.getElementById('lateTableBody');
            if (entries.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No late entries recorded</td></tr>';
                return;
            }

            let html = '';
            entries.forEach(entry => {
                html += `<tr>
                    <td>${escapeHtml(entry.Reg_No)}</td>
                    <td>${escapeHtml(entry.student_name)}</td>
                    <td>${formatDateTime(entry.To_Date)}</td>
                    <td>${formatDateTime(entry.scan_time)}</td>
                    <td>${entry.late_hours} hours</td>
                    <td><span class="status-badge status-late">Late</span></td>
                </tr>`;
            });

            tbody.innerHTML = html;
        }

        function showMessage(elementId, message, type) {
            const element = document.getElementById(elementId);
            element.innerHTML = `<div class="alert alert-${type}" role="alert"><i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'}"></i> ${message}</div>`;
            setTimeout(() => {
                element.innerHTML = '';
            }, 5000);
        }

        function formatDateTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('en-IN', {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function saveSettings() {
            const lateThreshold = document.getElementById('lateThreshold').value;
            const refreshRate = document.getElementById('refreshRate').value;

            alert(`Settings saved!\nLate Threshold: ${lateThreshold} minutes\nRefresh Rate: ${refreshRate} seconds`);
        }

        // Setup tab click handlers
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            const target = $(e.target).attr("href");
            if (target === '#historyTab') {
                loadHistory();
            } else if (target === '#lateEntriesTab') {
                loadLateEntries();
            }
        });

        // Load initial data on page load
        window.addEventListener('load', function() {
            loadAllData();
        });
    </script>
</body>

</html>