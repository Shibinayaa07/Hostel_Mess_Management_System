<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management</title>
    <link rel="icon" type="image/png" sizes="32x32" href="image/icons/mkce_s.png">
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- In the <head> section -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Export Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

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

        .custom-tabs .nav-item:nth-child(4) .nav-link.hover i {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link.hover i {
            font-size: 1.1rem;
            color: white;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link.hover i {
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
                    <li class="breadcrumb-item active">Mess Portal</li>
                </ol>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="custom-tabs">
                <div class="statistics-container">
                    <div class="stat-box">
                        <h6>TOTAL TOKENS</h6>
                        <h2 id="stat_tokens">0</h2>
                        <div class="icon"><i class="fas fa-ticket-alt"></i></div>
                    </div>

                    <div class="stat-box">
                        <h6>AVAILABLE</h6>
                        <h2 id="stat_available">0</h2>
                        <div class="icon"><i class="fas fa-star"></i></div>
                    </div>

                    <div class="stat-box">
                        <h6>MONTHLY BILL</h6>
                        <h2 id="stat_bill">₹0</h2>
                        <div class="icon"><i class="fas fa-receipt"></i></div>
                    </div>

                    <div class="stat-box">
                        <h6>WELCOME</h6>
                        <h2 id="stat_name" style="font-size: 1.2rem;">Student</h2>
                        <div class="icon"><i class="fas fa-user"></i></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="custom-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#daily_menu" type="button">
                            <i class="fas fa-utensils"></i> Daily Menu
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#special_tokens" type="button">
                            <i class="fas fa-star"></i> Special Tokens
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#my_tokens" type="button">
                            <i class="fas fa-list"></i> My Tokens
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bill" type="button">
                            <i class="fas fa-file-invoice-dollar"></i> Monthly Bill
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history" type="button">
                            <i class="fas fa-history"></i> History
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="daily_menu" role="tabpanel">
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
                    <div class="tab-pane fade" id="special_tokens" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-star"></i> Available Special Tokens</h5>
                        <div class="loading" id="tokensLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="tokensTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Fee (₹)</th>
                                        <th>Serving Date</th>
                                        <th>Request Window</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="my_tokens" role="tabpanel">
                        <div class="filter-section">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Select Month:</strong></label>
                                    <input type="month" id="tokensMonth" class="form-control" value="<?php echo date('Y-m'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" onclick="loadMyTokens()"><i class="fas fa-search"></i> View Tokens</button>
                                </div>
                            </div>
                        </div>
                        <div class="loading" id="myTokensLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="myTokensTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Fee (₹)</th>
                                        <th>Serving Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bill" role="tabpanel">
                        <div class="filter-section">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Select Month:</strong></label>
                                    <input type="month" id="billMonth" class="form-control" value="<?php echo date('Y-m'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" onclick="loadBill()"><i class="fas fa-search"></i> Generate Bill</button>
                                </div>
                            </div>
                        </div>
                        <div class="loading" id="billLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div id="billContainer"></div>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel">
                        <h5 class="mb-3"><i class="fas fa-history"></i> Token History</h5>
                        <div class="loading" id="historyLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                        <div class="table-responsive">
                            <table id="historyTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Fee (₹)</th>
                                        <th>Serving Date</th>
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
        const rollNumber = '927623bit203';
        const studentName = 'SHIBINAYAA S';
        let tables = {};

        $(document).ready(function() {
            loadDashboard();
            loadMenu();
            loadSpecialTokens();
            loadMyTokens();
            loadBill();
            loadHistory();
        });

        function loadDashboard() {
            $.ajax({
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_student_dashboard',
                    roll_number: rollNumber
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#stat_name').text(response.data.student_name);
                        $('#stat_tokens').text(response.data.total_special_tokens || 0);
                        $('#stat_available').text(response.data.available_tokens || 0);
                        $('#stat_bill').text('₹' + parseFloat(response.data.monthly_bill || 0).toFixed(2));
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
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_daily_menu',
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
            if (tables.menu) tables.menu.destroy();
            const tbody = $('#menuTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="4" class="text-center">No menu available</td></tr>');
                return;
            }
            data.forEach((item) => {
                tbody.append(`<tr><td>${item.date}</td><td><strong>${item.meal_type}</strong></td><td>${item.items}</td><td>₹${parseFloat(item.fee).toFixed(2)}</td></tr>`);
            });
            tables.menu = $('#menuTable').DataTable({
                paging: true,
                pageLength: 10,
                searching: false,
                ordering: false
            });
        }

        function loadSpecialTokens() {
            $('#tokensLoading').show();
            $.ajax({
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_available_special_tokens'
                },
                dataType: 'json',
                success: function(response) {
                    $('#tokensLoading').hide();
                    if (response.success) displaySpecialTokens(response.data);
                },
                error: function(err) {
                    $('#tokensLoading').hide();
                    console.log('Tokens error:', err);
                }
            });
        }

        function displaySpecialTokens(data) {
            if (tables.tokens) tables.tokens.destroy();
            const tbody = $('#tokensTable tbody').empty();

            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="7" class="text-center">No special tokens available</td></tr>');
                return;
            }

            data.forEach((item) => {
                let badge = '<span class="badge" style="background:#dc3545;color:white;">expired</span>';
                let actionHtml = badge; // Default action is badge for expired

                if (item.request_status === 'open') {
                    // Check if the student already requested this token
                    if (item.already_taken) {
                        badge = '<span class="badge" style="background:#28a745;color:white;">Special token taken</span>';
                        actionHtml = badge; // Show "Special token taken" as badge
                    } else {
                        badge = '<span class="badge" style="background:#28a745;color:white;">open</span>';
                        actionHtml = `<button class="btn-request" onclick="requestToken(${item.menu_id})"><i class="fas fa-plus"></i> Request</button>`;
                    }
                } else if (item.request_status === 'coming_soon') {
                    badge = '<span class="badge" style="background:#ffc107;color:black;">coming soon</span>';
                    actionHtml = badge; // Show as badge only
                }
                else if (item.request_status === 'expired') {
                    badge = '<span class="badge" style="background:#6c757d;colour:white;">expired</span>';
                    actionHtml = badge;
                }

                tbody.append(`<tr>
            <td><strong>${item.meal_type}</strong></td>
            <td>${item.menu_items}</td>
            <td>₹${parseFloat(item.fee).toFixed(2)}</td>
            <td><strong>${item.token_date}</strong></td>
            <td>${item.from_date} ${item.from_time} to ${item.to_date} ${item.to_time}</td>
            <td>${badge}</td>
            <td>${actionHtml}</td>
        </tr>`);
            });

            tables.tokens = $('#tokensTable').DataTable({
                paging: true,
                pageLength: 10
            });
        }

        function requestToken(menuId) {
            $.ajax({
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'request_special_token',
                    roll_number: rollNumber,
                    menu_id: menuId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Special token requested successfully!');
                        loadSpecialTokens();
                        loadMyTokens();
                        loadDashboard();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(err) {
                    alert('Error requesting token');
                }
            });
        }

        function loadMyTokens() {
            $('#myTokensLoading').show();
            const month = $('#tokensMonth').val();
            $.ajax({
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_my_tokens',
                    roll_number: rollNumber,
                    month: month
                },
                dataType: 'json',
                success: function(response) {
                    $('#myTokensLoading').hide();
                    if (response.success) displayMyTokens(response.data);
                },
                error: function(err) {
                    $('#myTokensLoading').hide();
                    console.log('My tokens error:', err);
                }
            });
        }

        function displayMyTokens(data) {
            if (tables.myTokens) tables.myTokens.destroy();
            const tbody = $('#myTokensTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="6" class="text-center">No tokens taken</td></tr>');
                return;
            }
            data.forEach((item, i) => {
                // Choose colors per status
                let bgColor = '#6c757d'; // consumed - gray
                let textColor = '#ffffff';
                if (item.token_status === 'today') {
                    bgColor = '#198754'; // today - green (bootstrap success)
                    textColor = '#ffffff';
                } else if (item.token_status === 'upcoming') {
                    bgColor = '#ffc107'; // upcoming - yellow (bootstrap warning)
                    textColor = '#212529';
                } else if (item.token_status === 'cancelled') {
                    bgColor = '#dc3545'; // cancelled - red (bootstrap danger)
                    textColor = '#ffffff';
                }
                const badgeHtml = `<span class="badge" style="background:${bgColor};color:${textColor};padding:0.45em 0.75em;border-radius:0.5rem;font-weight:600;">${item.token_status}</span>`;
                tbody.append(`<tr><td>${i+1}</td><td><strong>${item.meal_type}</strong></td><td>${item.menu_items}</td><td>₹${parseFloat(item.fee).toFixed(2)}</td><td><strong>${item.token_date}</strong></td><td>${badgeHtml}</td></tr>`);
            });
            tables.myTokens = $('#myTokensTable').DataTable({
                paging: true,
                pageLength: 10
            });
        }

        function loadBill() {
            $('#billLoading').show();
            const month = $('#billMonth').val();
            $.ajax({
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_monthly_bill',
                    roll_number: rollNumber,
                    month: month
                },
                dataType: 'json',
                success: function(response) {
                    $('#billLoading').hide();
                    if (response.success) displayBill(response.data);
                },
                error: function(err) {
                    $('#billLoading').hide();
                    console.log('Bill error:', err);
                }
            });
        }

        function displayBill(data) {
            let html = '<div class="card"style="width: 30rem";><div class="container-fluid"><h4>Monthly Mess Bill</h4>';
            html += `<div class="bill-item"><span>Roll Number:</span><strong>${data.roll_number}</strong></div>`;
            html += `<div class="bill-item"><span>Name:</span><strong>${data.name||'N/A'}</strong></div>`;
            html += `<div class="bill-item"><span>Month:</span><strong>${data.month}</strong></div>`;
            html += `<div class="bill-item"><span>Total Tokens:</span><strong>${data.total_tokens}</strong></div>`;
            html += `<div class="bill-total"><span>TOTAL BILL:</span> ₹${parseFloat(data.total_bill).toFixed(2)}</div>`;
            html += '</div></div>';
            $('#billContainer').html(html);
        }

        function loadHistory() {
            $('#historyLoading').show();
            $.ajax({
                url: 'studentmessapi.php',
                type: 'POST',
                data: {
                    action: 'get_token_historys',
                    roll_number: rollNumber
                },
                dataType: 'json',
                success: function(response) {
                    $('#historyLoading').hide();
                    if (response.success) displayHistory(response.data);
                },
                error: function(err) {
                    $('#historyLoading').hide();
                    console.log('History error:', err);
                }
            });
        }

        function displayHistory(data) {
            if (tables.history) tables.history.destroy();
            const tbody = $('#historyTable tbody').empty();
            if (!data || data.length === 0) {
                tbody.html('<tr><td colspan="5" class="text-center">No history available</td></tr>');
                return;
            }
            data.forEach((item, i) => {
                tbody.append(`<tr><td>${i+1}</td><td><strong>${item.meal_type}</strong></td><td>${item.menu_items}</td><td>₹${parseFloat(item.fee).toFixed(2)}</td><td>${item.token_date}</td></tr>`);
            });
            tables.history = $('#historyTable').DataTable({
                paging: true,
                pageLength: 10
            });
        }
    </script>
</body>

</html>