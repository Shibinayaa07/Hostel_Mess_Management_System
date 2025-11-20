<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/icons/mkce_s.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

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

        .table-responsive {
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-top: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        /* Table Header Gradient - Green to Blue */
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
            border: 0.3px solid #feffffff !important;
            /* Change color as needed */
            vertical-align: middle;
        }

        .table tbody {
            text-align: center;
        }

        /* Override any Bootstrap defaults */
        .table>thead {
            --bs-table-bg: transparent;
            --bs-table-color: white;
        }

        /* For striped/hover tables */

        .table-hover thead,
        .table-bordered thead {
            background: linear-gradient(135deg, #4CAF50 0%, #2196F3 100%) !important;
        }


        .btn-group-sm .btn {
            margin: 0 2px;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.5em 0.75em;
        }

        /* ========== STATISTICS DASHBOARD STYLING ========== */

        /* Dashboard Header */
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

        /* Statistics Container */
        .statistics-container {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        /* Individual Stat Box */
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

        /* Hover Effect */
        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        /* Gradient Backgrounds */
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

        /* Stat Value (Number) */
        .stat-box h3 {
            font-size: 3rem;
            font-weight: 700;
            margin: 0;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Stat Label (Text) */
        .stat-box p {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
            opacity: 0.95;
            letter-spacing: 0.5px;
        }

        /* Decorative Background Effect */
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

        /* Responsive Design */
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

        /* Tabs Container */
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

        /* Individual Tab Button - INACTIVE (Grey/White) */
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


        /* Icon Styling - Inactive */
        .custom-tabs .nav-item:nth-child(1) .nav-link i {
            font-size: 1.1rem;
            color: #d531a4ff;
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link i {
            font-size: 1.1rem;
            color: #3497efff;
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link i {
            font-size: 1.1rem;
            color: #7B1FA2;
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link i {
            font-size: 1.1rem;
            color: #F57C00;
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link i {
            font-size: 1.1rem;
            color: #f50000ff;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link i {
            font-size: 1.1rem;
            color: #d800f5ff;
        }

        .custom-tabs .nav-item:nth-child(1) .nav-link i:hover {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link i:hover {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link i:hover {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link:hover i {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link:hover i {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link:hover i {
            font-size: 1.1rem;
            color: white;
        }


        /* Hover Effect for Inactive Tabs */
        .custom-tabs .nav-item:nth-child(1) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(1) .nav-link:hover i {
            background: linear-gradient(135deg, #d531a4ff 0%, #cc4da2ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(2) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(2) .nav-link:hover i {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(3) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(3) .nav-link:hover i {
            background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(4) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(4) .nav-link:hover i {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(5) .nav-link:hover i {
            background: linear-gradient(135deg, #eb454aff 0%, #f50000ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(6) .nav-link:hover i {
            background: linear-gradient(135deg, #da59f0ff 0%, #d800f5ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* ========== ACTIVE TAB STATES (COLORED) ========== */

        /* Tab 1 Active - GREEN */
        .custom-tabs .nav-item:nth-child(1) .nav-link.active {
            background: linear-gradient(135deg, #d531a4ff 0%, #cc4da2ff 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(175, 76, 134, 0.4);
        }

        .custom-tabs .nav-item:nth-child(1) .nav-link.active i {
            color: white;
        }

        /* Tab 2 Active - BLUE */
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

        /* Tab 3 Active - PURPLE */
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

        /* Tab 4 Active - ORANGE */
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


        .custom-tabs .nav-item:nth-child(5) .nav-link.active {
            background: linear-gradient(135deg, #eb454aff 0%, #f50000ff 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 152, 0, 0.4);
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link.active i {
            color: white;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link.active {
            background: linear-gradient(135deg, #da59f0ff 0%, #d800f5ff 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 152, 0, 0.4);
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link.active i {
            color: white;
        }

        /* Tab Content Area */
        .custom-tabs .tab-content {
            background: white;
            padding: 25px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            min-height: 400px;
        }

        /* Responsive Design */
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

        /* Filter Section Styling */
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .filter-section .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .filter-section .form-control,
        .filter-section .form-select {
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }

        .filter-section .form-control:focus,
        .filter-section .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .filter-section .btn {
            margin-right: 5px;
        }

        /* Export button styling */
        .btn-success {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            border: none;
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(76, 175, 80, 0.4);
        }

        .btn-success i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php include './assets/sidebar.php'; ?>
    <div class="content">
        <?php include './assets/topbar.php'; ?>
        <div class="breadcrumb-area">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Mess Supervision</li>
                </ol>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="custom-tabs">
                <div class="statistics-header">
                    <i class="fas fa-chart-bar"></i>
                    Statistics Dashboard
                </div>

                <div class="statistics-container">
                    <div class="stat-box">
                        <h3 id="stat_menu">0</h3>
                        <p>Today's Menu Items</p>
                    </div>

                    <div class="stat-box">
                        <h3 id="stat_tokens">0</h3>
                        <p>Active Tokens</p>
                    </div>

                    <div class="stat-box">
                        <h3 id="stat_revenue">₹0</h3>
                        <p>Today's Revenue</p>
                    </div>

                    <div class="stat-box">
                        <h3 id="stat_month">0</h3>
                        <p>Month Tokens</p>
                    </div>
                </div>
            </div>
            <div class="custom-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#menu" type="button">
                            <i class="fas fa-utensils"></i> Mess Menu
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#special" type="button">
                            <i class="fas fa-star"></i> Special Tokens
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#requests" type="button">
                            <i class="fas fa-list"></i> Token Requests
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#revenue" type="button">
                            <i class="fas fa-chart-line"></i> Revenue
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#consumption" type="button">
                            <i class="fas fa-chart-bar"></i> Consumption
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="menu" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-utensils"></i> Daily Menu </h5>

                        <div class="filter-section">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Select Date:</strong></label>
                                    <input type="date" id="menuDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" onclick="loadMenu()"><i class="fas fa-search"></i> View Menu</button>
                                </div>
                            </div>
                        </div>
                        <div class="loading" id="menuLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="menuTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Fee (₹)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="special" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-star"></i> Special Meal Tokens</h5>
                        <div class="loading" id="specialLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="specialTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Token Date</th>
                                        <th>Fee (₹)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="requests" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-list"></i> Student Token Requests</h5>
                            <button class="btn btn-success" onclick="exportTokenRequests()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                        
                        <!-- Filter Section -->
                        <div class="filter-section mb-3">
                            <div class="row align-items-end">
                                <div class="col-md-2">
                                    <label class="form-label"><strong>Filter by Month:</strong></label>
                                    <input type="month" id="requestsFilterMonth" class="form-control" value="<?php echo date('Y-m'); ?>">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"><strong>Filter by Date:</strong></label>
                                    <input type="date" id="requestsFilterDate" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"><strong>Filter by Meal Type:</strong></label>
                                    <select id="requestsFilterMealType" class="form-control">
                                        <option value="">All Meal Types</option>
                                        <option value="Breakfast">Breakfast</option>
                                        <option value="Lunch">Lunch</option>
                                        <option value="Snacks">Snacks</option>
                                        <option value="Dinner">Dinner</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"><strong>Search Menu Items:</strong></label>
                                    <input type="text" id="requestsFilterItem" class="form-control" placeholder="Type item name (e.g., Rice, Chicken)">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary" onclick="loadRequests()"><i class="fas fa-filter"></i> Apply Filter</button>
                                    <button class="btn btn-secondary" onclick="resetRequestsFilter()"><i class="fas fa-undo"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="loading" id="requestsLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="requestsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Roll No.</th>
                                        <th>Name</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Fee (₹)</th>
                                        <th>Token Date</th>
                                        <th>Requested At</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="revenue" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-chart-line"></i> Revenue</h5>
                            <button class="btn btn-success" onclick="exportRevenue()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>

                        <div class="filter-section">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Select Month:</strong></label>
                                    <input type="month" id="revenueMonth" class="form-control" value="<?php echo date('Y-m'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" onclick="loadRevenue()"><i class="fas fa-search"></i> View Revenue</button>
                                </div>
                            </div>
                        </div>
                        <div class="loading" id="revenueLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="revenueTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Tokens Count</th>
                                        <th>Revenue (₹)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="info-box mt-3">
                            <h5>Total Monthly Revenue: <span id="totalRevenue" style="color: #4CAF50; font-weight: bold; font-size: 1.5rem;">₹0.00</span></h5>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="consumption" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-chart-bar"></i> Consumption</h5>
                            <button class="btn btn-success" onclick="exportConsumption()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>

                        <div class="filter-section">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Select Month:</strong></label>
                                    <input type="month" id="consumptionMonth" class="form-control" value="<?php echo date('Y-m'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" onclick="loadConsumption()"><i class="fas fa-search"></i> View Consumption</button>
                                </div>
                            </div>
                        </div>
                        <div class="loading" id="consumptionLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="consumptionTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Roll No.</th>
                                        <th>Name</th>
                                        <th>Tokens</th>
                                        <th>Total Spent (₹)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './assets/footer.php'; ?>
    </div>
    <script>
        let tables = {};
        $(document).ready(function() {
            loadDashboard();
            loadMenu();
            loadSpecialTokens();
            loadRequests();
            loadRevenue();
            loadConsumption();
            setInterval(loadDashboard, 30000);
            
            // Add Enter key listener for item filter
            $('#requestsFilterItem').on('keypress', function(e) {
                if (e.which === 13) { // Enter key
                    e.preventDefault();
                    loadRequests();
                }
            });
        });

        function loadDashboard() {
            $.ajax({
                url: 'adminmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_dashboard_stats'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#stat_menu').text(response.data.todays_menu_items || 0);
                        $('#stat_tokens').text(response.data.active_special_tokens || 0);
                        $('#stat_revenue').text('₹' + parseFloat(response.data.todays_revenue || 0).toFixed(2));
                        $('#stat_month').text(response.data.month_special_tokens || 0);
                    }
                },
                error: function(err) {
                    console.log('Dashboard error:', err);
                }
            });
        }

        function loadMenu() {
            $('#menuLoading').show();
            const date = $('#menuDate').val();
            $.ajax({
                url: 'adminmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_mess_menu',
                    date: date
                },
                dataType: 'json',
                success: function(response) {
                    $('#menuLoading').hide();
                    if (response.success) displayMenu(response.data);
                },
                error: function(err) {
                    $('#menuLoading').hide();
                    console.log('Menu error:', err);
                }
            });
        }

        function displayMenu(data) {
            if (tables.menu) {
                tables.menu.destroy();
                tables.menu = null;
            }
            const tbody = $('#menuTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="4" class="text-center">No menu found for this date</td></tr>');
                return;
            }
            data.forEach((item) => {
                tbody.append(`<tr><td>${item.date}</td><td><strong>${item.meal_type}</strong></td><td>${item.items}</td><td>₹${parseFloat(item.fee).toFixed(2)}</td></tr>`);
            });
            tables.menu = $('#menuTable').DataTable({
                paging: true,
                pageLength: 10,
                searching: true,
                ordering: true
            });
        }

        function loadSpecialTokens() {
            $('#specialLoading').show();
            $.ajax({
                url: 'adminmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_special_tokens'
                },
                dataType: 'json',
                success: function(response) {
                    $('#specialLoading').hide();
                    if (response.success) displaySpecialTokens(response.data);
                },
                error: function(err) {
                    $('#specialLoading').hide();
                    console.log('Special tokens error:', err);
                }
            });
        }

        function displaySpecialTokens(data) {
            if (tables.special) {
                tables.special.destroy();
                tables.special = null;
            }
            const tbody = $('#specialTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="7" class="text-center">No special tokens</td></tr>');
                return;
            }
            data.forEach((item, i) => {
                const badgeClass = item.status === 'active' ? 'bg-success' : 'bg-secondary';
                tbody.append(`<tr><td>${i+1}</td>
                <td><strong>${item.meal_type}</strong></td>
                <td>${item.menu_items}</td>
                <td>${item.from_date}<br><small>${item.from_time.substring(0,5)}</small></td>
                <td>${item.to_date}<br><small>${item.to_time.substring(0,5)}</small></td>
                <td><strong>${item.token_date}</strong></td>
                <td>₹${parseFloat(item.fee).toFixed(2)}</td>
                <td><span class="badge ${badgeClass}">${item.status}</span></td></tr>`);
            });
            tables.special = $('#specialTable').DataTable({
                paging: true,
                pageLength: 10
            });
        }

        function loadRequests() {
            $('#requestsLoading').show();
            
            // Get filter values
            const filterMonth = $('#requestsFilterMonth').val();
            const filterDate = $('#requestsFilterDate').val();
            const filterMealType = $('#requestsFilterMealType').val();
            const filterItem = $('#requestsFilterItem').val().trim();
            
            $.ajax({
                url: 'adminmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_token_requests',
                    filter_month: filterMonth,
                    filter_date: filterDate,
                    filter_meal_type: filterMealType,
                    filter_item: filterItem
                },
                dataType: 'json',
                success: function(response) {
                    $('#requestsLoading').hide();
                    if (response.success) displayRequests(response.data);
                },
                error: function(err) {
                    $('#requestsLoading').hide();
                    console.log('Requests error:', err);
                }
            });
        }
        
        function resetRequestsFilter() {
            $('#requestsFilterMonth').val('<?php echo date('Y-m'); ?>');
            $('#requestsFilterDate').val('');
            $('#requestsFilterMealType').val('');
            $('#requestsFilterItem').val('');
            loadRequests();
        }

        function displayRequests(data) {
            if (tables.requests) {
                tables.requests.destroy();
                tables.requests = null;
            }
            const tbody = $('#requestsTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="8" class="text-center">No token requests</td></tr>');
                return;
            }
            data.forEach((item, i) => {
                let requestedAtFormatted = 'N/A';
                if (item.requested_at && item.requested_at !== 'N/A') {
                    try {
                        const dateObj = new Date(item.requested_at);
                        if (!isNaN(dateObj.getTime())) {
                            requestedAtFormatted = dateObj.toLocaleString('en-IN', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: true
                            });
                        }
                    } catch (e) {
                        requestedAtFormatted = item.requested_at;
                    }
                }
                tbody.append(`<tr><td>${i+1}</td>
                <td><strong>${item.roll_number}</strong></td>
                <td>${item.student_name}</td>
                <td>${item.meal_type}</td>
                <td>${item.menu_items}</td>
                <td>₹${parseFloat(item.fee).toFixed(2)}</td>
                <td><strong>${item.token_date}</strong></td>
                <td>${requestedAtFormatted}</td></tr>`);
            });
            tables.requests = $('#requestsTable').DataTable({
                paging: true,
                pageLength: 10
            });
        }

        function loadRevenue() {
            $('#revenueLoading').show();
            const month = $('#revenueMonth').val();
            $.ajax({
                url: 'adminmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_monthly_revenue',
                    month: month
                },
                dataType: 'json',
                success: function(response) {
                    $('#revenueLoading').hide();
                    if (response.success) displayRevenue(response.data, response.total);
                },
                error: function(err) {
                    $('#revenueLoading').hide();
                    console.log('Revenue error:', err);
                }
            });
        }

        function displayRevenue(data, total) {
            if (tables.revenue) {
                tables.revenue.destroy();
                tables.revenue = null;
            }
            const tbody = $('#revenueTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="3" class="text-center">No revenue data</td></tr>');
                $('#totalRevenue').text('₹0.00');
                return;
            }
            data.forEach((item) => {
                tbody.append(`<tr><td><strong>${item.date}</strong></td><td>${item.tokens_count}</td><td>₹${parseFloat(item.revenue).toFixed(2)}</td></tr>`);
            });
            $('#totalRevenue').text('₹' + parseFloat(total).toFixed(2));
            tables.revenue = $('#revenueTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        }

        function loadConsumption() {
            $('#consumptionLoading').show();
            const month = $('#consumptionMonth').val();
            $.ajax({
                url: 'adminmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_student_consumption',
                    month: month
                },
                dataType: 'json',
                success: function(response) {
                    $('#consumptionLoading').hide();
                    if (response.success) displayConsumption(response.data);
                },
                error: function(err) {
                    $('#consumptionLoading').hide();
                    console.log('Consumption error:', err);
                }
            });
        }

        function displayConsumption(data) {
            if (tables.consumption) {
                tables.consumption.destroy();
                tables.consumption = null;
            }
            const tbody = $('#consumptionTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="5" class="text-center">No consumption data</td></tr>');
                return;
            }
            data.forEach((item, i) => {
                tbody.append(`<tr><td>${i+1}</td><td><strong>${item.roll_number}</strong></td><td>${item.student_name}</td><td><span class="badge bg-primary">${item.tokens_count}</span></td><td>₹${parseFloat(item.total_spent).toFixed(2)}</td></tr>`);
            });
            tables.consumption = $('#consumptionTable').DataTable({
                paging: true,
                pageLength: 10
            });
        }

        // Export functions
        function exportTokenRequests() {
            const filterMonth = $('#requestsFilterMonth').val();
            const filterDate = $('#requestsFilterDate').val();
            const filterMealType = $('#requestsFilterMealType').val();
            const filterItem = $('#requestsFilterItem').val().trim();
            
            let url = 'messexport.php?type=token_requests';
            if (filterMonth) url += '&filter_month=' + encodeURIComponent(filterMonth);
            if (filterDate) url += '&filter_date=' + encodeURIComponent(filterDate);
            if (filterMealType) url += '&filter_meal_type=' + encodeURIComponent(filterMealType);
            if (filterItem) url += '&filter_item=' + encodeURIComponent(filterItem);
            
            window.open(url, '_blank');
        }

        function exportRevenue() {
            const month = $('#revenueMonth').val();
            let url = 'messexport.php?type=revenue';
            if (month) url += '&filter_month=' + encodeURIComponent(month);
            
            window.open(url, '_blank');
        }

        function exportConsumption() {
            const month = $('#consumptionMonth').val();
            let url = 'messexport.php?type=consumption';
            if (month) url += '&filter_month=' + encodeURIComponent(month);
            
            window.open(url, '_blank');
        }
    </script>
</body>

</html>