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
            vertical-align: middle;
        }

        .table tbody {
            text-align: center;
        }

        .table>thead {
            --bs-table-bg: transparent;
            --bs-table-color: white;
        }

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
            color: #4CAF50;
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
            color: #f44336;
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
            color: #4CAF50;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link i {
            font-size: 1.1rem;
            color: #f44336;
        }

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
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link:hover,
        .custom-tabs .nav-item:nth-child(6) .nav-link:hover i {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* ========== ACTIVE TAB STATES (COLORED) ========== */

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
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(76, 175, 80, 0.4);
        }

        .custom-tabs .nav-item:nth-child(5) .nav-link.active i {
            color: white;
        }

        .custom-tabs .nav-item:nth-child(6) .nav-link.active {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(244, 67, 54, 0.4);
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
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include './assets/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <?php include './assets/topbar.php'; ?>

        <!-- Breadcrumb -->
        <div class="breadcrumb-area custom-gradient">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Mess Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Management</li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <!-- Statistics Dashboard -->
            <div class="custom-tabs">
                <div class="statistics-header">
                    <i class="fas fa-chart-bar"></i>
                    Statistics Dashboard
                </div>

                <div class="statistics-container">
                    <div class="stat-box">
                        <h3 id="totalSpecialTokens">0</h3>
                        <p>Special Tokens</p>
                    </div>

                    <div class="stat-box">
                        <h3 id="totalMenus">0</h3>
                        <p>Menu Items</p>
                    </div>

                    <div class="stat-box">
                        <h3 id="totalTokens">0</h3>
                        <p>Total Tokens</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="custom-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab">
                            <i class="fas fa-utensils"></i> Menu
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tokens" type="button" role="tab">
                            <i class="fas fa-ticket-alt"></i> Token Requests
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#specialtokens" type="button" role="tab">
                            <i class="fas fa-star"></i> Special Tokens
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#revenue" type="button" role="tab">
                            <i class="fas fa-dollar-sign"></i> Revenue
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#consumption" type="button" role="tab">
                            <i class="fas fa-chart-pie"></i> Consumption
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                            <i class="fas fa-history"></i> History
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Menu Tab -->
                    <div class="tab-pane fade show active" id="menu" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-utensils"></i> Menu Management</h5>
                            <div class="btn">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#breakfastModal">
                                    <i class="fas fa-plus"></i> Breakfast
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#lunchModal">
                                    <i class="fas fa-plus"></i> Lunch
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#snacksModal">
                                    <i class="fas fa-plus"></i> Snacks
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#dinnerModal">
                                    <i class="fas fa-plus"></i> Dinner
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="messMenuTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Category</th>
                                        <th>Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tokens Tab -->
                    <div class="tab-pane fade" id="tokens" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-ticket-alt"></i> Token Requests</h5>
                            <button class="btn btn-success" onclick="exportTokenRequests()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                        
                        <!-- Filter Section -->
                        <div class="row mb-3 g-2">
                            <div class="col-md-2">
                                <label class="form-label"><strong>Filter by Month:</strong></label>
                                <input type="month" id="requestsFilterMonth" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label"><strong>Filter by Date:</strong></label>
                                <input type="date" id="requestsFilterDate" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label"><strong>Filter by Meal Type:</strong></label>
                                <select id="requestsFilterMealType" class="form-control">
                                    <option value="">All</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Dinner">Dinner</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label"><strong>Search Menu Items:</strong></label>
                                <input type="text" id="requestsFilterItem" class="form-control" placeholder="Type item name">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button class="btn btn-primary me-2" onclick="applyTokenFilters()"><i class="fas fa-filter"></i> Apply Filters</button>
                                <button class="btn btn-secondary" onclick="clearTokenFilters()"><i class="fas fa-times"></i> Clear</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="messTokensTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Student Name</th>
                                        <th>Roll Number</th>
                                        <th>Meal Type</th>
                                        <th>Menu</th>
                                        <th>Date</th>
                                        <th>Token Type</th>
                                        <th>Special Fee</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- MERGED Special Tokens Tab (Active + Inactive) -->
                    <div class="tab-pane fade" id="specialtokens" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-star"></i> Special Tokens Management</h5>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#specialtokenModal">
                                Enable Special Token
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="mergedTokenTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>From Date</th>
                                        <th>From Time</th>
                                        <th>To Date</th>
                                        <th>To Time</th>
                                        <th>Token Date</th>
                                        <th>Meal Type</th>
                                        <th>Items</th>
                                        <th>Fee</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Revenue Tab -->
                    <div class="tab-pane fade" id="revenue" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-dollar-sign"></i> Revenue Analysis</h5>
                            <button class="btn btn-success" onclick="exportRevenue()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                        
                        <!-- Month Filter -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label"><strong>Select Month:</strong></label>
                                <input type="month" id="revenueFilterMonth" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100" onclick="applyRevenueFilter()"><i class="fas fa-filter"></i> Apply</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="revenueTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Tokens Count</th>
                                        <th>Revenue (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">Select a month to view revenue</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Consumption Tab -->
                    <div class="tab-pane fade" id="consumption" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-chart-pie"></i> Student Consumption</h5>
                            <button class="btn btn-success" onclick="exportConsumption()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                        
                        <!-- Month Filter -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label"><strong>Select Month:</strong></label>
                                <input type="month" id="consumptionFilterMonth" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100" onclick="applyConsumptionFilter()"><i class="fas fa-filter"></i> Apply</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="consumptionTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Roll Number</th>
                                        <th>Student Name</th>
                                        <th>Tokens Count</th>
                                        <th>Total Spent (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center">Select a month to view consumption</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- History Tab -->
                    <div class="tab-pane fade" id="history" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-history"></i> Activity History</h5>
                            <div class="btn">
                                <button type="button" class="btn btn-secondary" onclick="viewHistory('menu')">Menu History</button>
                                <button type="button" class="btn btn-secondary" onclick="viewHistory('special')">Special Token History</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="historyTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center">Click a filter button to view history</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALS START -->

            <!-- Breakfast Modal -->
            <div class="modal fade" id="breakfastModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Breakfast</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" id="breakfastDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Items</label>
                                <textarea id="breakfastItems" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select id="breakfastCategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="breakfastFee" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveMenuForm('Breakfast')">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lunch Modal -->
            <div class="modal fade" id="lunchModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Lunch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" id="lunchDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Items</label>
                                <textarea id="lunchItems" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select id="lunchCategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="lunchFee" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveMenuForm('Lunch')">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Snacks Modal -->
            <div class="modal fade" id="snacksModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Snacks</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" id="snacksDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Items</label>
                                <textarea id="snacksItems" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select id="snacksCategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="snacksFee" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveMenuForm('Snacks')">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dinner Modal -->
            <div class="modal fade" id="dinnerModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Dinner</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" id="dinnerDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Items</label>
                                <textarea id="dinnerItems" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select id="dinnerCategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="dinnerFee" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveMenuForm('Dinner')">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Menu Modal -->
            <div class="modal fade" id="editMenuModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editMenuId">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" id="editMenuDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meal Type</label>
                                <select id="editMenuMealType" class="form-control" required>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Dinner">Dinner</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Items</label>
                                <textarea id="editMenuItems" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select id="editMenuCategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="editMenuFee" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateMenu()">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Special Token Modal -->
            <div class="modal fade" id="specialtokenModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Enable Special Token</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">From Date</label>
                                <input type="date" id="tokenfromDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">From Time</label>
                                <input type="time" id="tokenfromTime" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">To Date</label>
                                <input type="date" id="tokentoDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">To Time</label>
                                <input type="time" id="tokentoTime" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Token Date</label>
                                <input type="date" id="tokenDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meal Type</label>
                                <select id="specialMealType" class="form-control" required>
                                    <option value="">Select Meal Type</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Dinner">Dinner</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Menu Items</label>
                                <textarea id="specialMenuItems" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="specialtokenFee" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveSpecialToken()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Special Token Modal -->
            <div class="modal fade" id="editSpecialTokenModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Special Token</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editSpecialMenuId">
                            <div class="mb-3">
                                <label class="form-label">From Date</label>
                                <input type="date" id="editSpecialFromDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">From Time</label>
                                <input type="time" id="editSpecialFromTime" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">To Date</label>
                                <input type="date" id="editSpecialToDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">To Time</label>
                                <input type="time" id="editSpecialToTime" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Token Date</label>
                                <input type="date" id="editSpecialTokenDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meal Type</label>
                                <select id="editSpecialMealType" class="form-control">
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Dinner">Dinner</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Menu Items</label>
                                <textarea id="editSpecialMenuItems" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee (₹)</label>
                                <input type="number" id="editSpecialFee" class="form-control" step="0.01">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateSpecialToken()">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activate Token Modal -->
            <div class="modal fade" id="activateTokenModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Activate Token - Extend Duration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="activateMenuId">
                            <div class="mb-3">
                                <label class="form-label">New To Date</label>
                                <input type="date" id="activateToDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New To Time</label>
                                <input type="time" id="activateToTime" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="saveActivateToken()">Activate Token</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include './assets/footer.php'; ?>
    </div>

    <script>
        let allMenus = [],
            allTokens = [],
            allMergedTokens = [];
        let menuTable = null,
            tokensTable = null,
            mergedTokenTable = null,
            revenueTable = null,
            consumptionTable = null,
            historyTable = null;
        
        const tables = {
            menu: null,
            tokens: null,
            revenue: null,
            consumption: null
        };

        $(document).ready(function() {
            loadStatistics();
            loadMenus();
            loadTokens();
            loadMergedSpecialTokens();
            setInterval(loadStatistics, 30000);
        });

        function loadStatistics() {
            $.post('api.php', {
                action: 'get_statistics'
            }, function(response) {
                if (response && response.success) {
                    $('#totalSpecialTokens').text(response.data.total_special_tokens || 0);
                    $('#totalMenus').text(response.data.total_menus || 0);
                    $('#totalTokens').text(response.data.total_tokens || 0);
                }
            }, 'json');
        }

        function loadMenus() {
            $.post('api.php', {
                action: 'read_menus'
            }, function(response) {
                if (response && response.success && Array.isArray(response.data)) {
                    allMenus = response.data;
                } else {
                    allMenus = [];
                }
                displayMenus();
            }, 'json');
        }

        function displayMenus() {
            if (menuTable) menuTable.destroy();
            const tableBody = $('#messMenuTable tbody');
            tableBody.empty();
            if (allMenus.length === 0) {
                tableBody.html('<tr><td colspan="7" class="text-center">No menu items found</td></tr>');
                return;
            }
            allMenus.forEach(function(menu, index) {
                const row = `<tr><td>${index + 1}</td><td>${menu.date || 'N/A'}</td><td><span class="badge bg-primary">${menu.meal_type}</span></td><td>${menu.items}</td><td>${menu.category || 'N/A'}</td><td>₹${parseFloat(menu.fee || 0).toFixed(2)}</td><td><button class="btn btn-warning btn-sm" onclick="editMenu(${menu.menu_id})" data-bs-toggle="tooltip" title="Edit Menu"><i class="fas fa-edit"></i></button> <button class="btn btn-danger btn-sm" onclick="deleteMenu(${menu.menu_id})" data-bs-toggle="tooltip" title="Delete Menu"><i class="fas fa-trash"></i></button></td></tr>`;
                tableBody.append(row);
            });
            menuTable = $('#messMenuTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                order: [
                    [1, 'desc']
                ]
            });
            
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

        function saveMenuForm(mealType) {
            const prefix = mealType.toLowerCase();
            const data = {
                action: 'create_menu',
                date: $(`#${prefix}Date`).val(),
                meal_type: mealType,
                items: $(`#${prefix}Items`).val(),
                category: $(`#${prefix}Category`).val(),
                fee: $(`#${prefix}Fee`).val()
            };
            if (!data.date || !data.items || !data.fee) {
                Swal.fire('Error', 'Please fill all required fields', 'error');
                return;
            }
            $.post('api.php', data, function(response) {
                if (response && response.success) {
                    Swal.fire('Success', response.message, 'success');
                    $(`#${prefix}Modal`).modal('hide');
                    loadMenus();
                    loadStatistics();
                } else {
                    Swal.fire('Error', response.message || 'Save failed', 'error');
                }
            }, 'json');
        }

        function editMenu(menuId) {
            const menu = allMenus.find(m => m.menu_id == menuId);
            if (!menu) {
                Swal.fire('Error', 'Menu item not found', 'error');
                return;
            }
            $('#editMenuId').val(menu.menu_id);
            $('#editMenuDate').val(menu.date);
            $('#editMenuMealType').val(menu.meal_type);
            $('#editMenuItems').val(menu.items);
            $('#editMenuCategory').val(menu.category || '');
            $('#editMenuFee').val(menu.fee);
            new bootstrap.Modal(document.getElementById('editMenuModal')).show();
        }

        function updateMenu() {
            const data = {
                action: 'update_menu',
                menu_id: $('#editMenuId').val(),
                date: $('#editMenuDate').val(),
                meal_type: $('#editMenuMealType').val(),
                items: $('#editMenuItems').val(),
                category: $('#editMenuCategory').val(),
                fee: $('#editMenuFee').val()
            };
            $.post('api.php', data, function(response) {
                if (response && response.success) {
                    Swal.fire('Success', 'Menu updated successfully', 'success');
                    $('#editMenuModal').modal('hide');
                    loadMenus();
                    loadStatistics();
                }
            }, 'json');
        }

        function deleteMenu(menuId) {
            Swal.fire({
                title: 'Delete Menu?',
                text: 'This action cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('api.php', {
                        action: 'delete_menu',
                        menu_id: menuId
                    }, function(response) {
                        if (response && response.success) {
                            Swal.fire('Deleted!', 'Menu has been deleted.', 'success');
                            loadMenus();
                            loadStatistics();
                        }
                    }, 'json');
                }
            });
        }

        function loadTokens() {
            $.ajax({
                url: 'api.php',
                type: 'POST',
                data: {
                    action: 'read_tokens'
                },
                dataType: 'json'
            }).done(function(response) {
                if (response && response.success && Array.isArray(response.data)) {
                    allTokens = response.data;
                } else {
                    allTokens = [];
                }
                displayTokens();
            }).fail(function() {
                allTokens = [];
                displayTokens();
            });
        }

        function displayTokens() {
            if (tokensTable) tokensTable.destroy();
            const tableBody = $('#messTokensTable tbody');
            tableBody.empty();
            if (allTokens.length === 0) {
                tableBody.html('<tr><td colspan="9" class="text-center">No tokens found</td></tr>');
                return;
            }
            allTokens.forEach(function(token, index) {
                const row = `<tr><td>${index + 1}</td>
                <td>${token.student_name || 'N/A'}</td><td>${token.roll_number}</td>
                <td>${token.meal_type || 'N/A'}</td>
                <td>${token.menu_items || token.menu || 'N/A'}</td>
                <td>${token.token_date || 'N/A'}</td><td><span class="badge bg-danger">${token.token_type || 'Regular'}</span></td><td>₹${parseFloat(token.special_fee || 0).toFixed(2)}</td>
                </tr>`;
                tableBody.append(row);
            });
            tokensTable = $('#messTokensTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                order: [
                    [5, 'desc']
                ]
            });
        }

        // ========== MERGED SPECIAL TOKENS (Active + Inactive) ==========
        function loadMergedSpecialTokens() {
            $.post('api.php', {
                action: 'read_special_tokens'
            }, function(response1) {
                $.post('api.php', {
                    action: 'read_inactive_special_tokens'
                }, function(response2) {
                    allMergedTokens = [];
                    if (response1 && response1.success && Array.isArray(response1.data)) {
                        allMergedTokens = allMergedTokens.concat(response1.data.map(t => ({
                            ...t,
                            status: 'Active'
                        })));
                    }
                    if (response2 && response2.success && Array.isArray(response2.data)) {
                        allMergedTokens = allMergedTokens.concat(response2.data.map(t => ({
                            ...t,
                            status: 'Inactive'
                        })));
                    }
                    displayMergedSpecialTokens();
                }, 'json');
            }, 'json');
        }

        function displayMergedSpecialTokens() {
            if (mergedTokenTable) mergedTokenTable.destroy();
            const tableBody = $('#mergedTokenTable tbody');
            tableBody.empty();

            if (!allMergedTokens.length) {
                tableBody.html('<tr><td colspan="11" class="text-center">No special tokens found</td></tr>');
                return;
            }
            allMergedTokens.forEach(function(token, index) {
                const statusBadge = token.status === 'Active' ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>';
                let actionBtns = '';
                if (token.status === 'Active') {
                    actionBtns = `
                <button class="btn btn-warning btn-sm" onclick="editSpecialToken(${token.menu_id})" data-bs-toggle="tooltip" title="Edit Special Token">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="deleteSpecialToken(${token.menu_id})" data-bs-toggle="tooltip" title="Delete Special Token">
                    <i class="fas fa-trash"></i>
                </button>
            `;
                } else {
                    actionBtns = `
                <button class="btn btn-success btn-sm" onclick="activateToken(${token.menu_id})" data-bs-toggle="tooltip" title="Activate Token">
                    <i class="fas fa-play"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="endToken(${token.menu_id})" data-bs-toggle="tooltip" title="End Token">
                    <i class="fas fa-stop"></i>
                </button>
            `;
                }
                tableBody.append(`
            <tr>
                <td>${index + 1}</td>
                <td>${token.from_date || 'N/A'}</td>
                <td>${token.from_time ? token.from_time.substring(0,5) : 'N/A'}</td>
                <td>${token.to_date || 'N/A'}</td>
                <td>${token.to_time ? token.to_time.substring(0,5) : 'N/A'}</td>
                <td>${token.token_date || 'N/A'}</td>
                <td>${token.meal_type || 'N/A'}</td>
                <td>${token.menu_items || 'N/A'}</td>
                <td>₹${parseFloat(token.fee || 0).toFixed(2)}</td>
                <td>${statusBadge}</td>
                <td>${actionBtns}</td>
            </tr>
        `);
            });
            mergedTokenTable = $('#mergedTokenTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                order: [
                    [3, 'desc']
                ]
            });
            
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

        function saveSpecialToken() {
            const data = {
                action: 'create_special_token',
                from_date: $('#tokenfromDate').val(),
                from_time: $('#tokenfromTime').val(),
                to_date: $('#tokentoDate').val(),
                to_time: $('#tokentoTime').val(),
                token_date: $('#tokenDate').val(),
                meal_type: $('#specialMealType').val(),
                menu_items: $('#specialMenuItems').val(),
                fee: $('#specialtokenFee').val()
            };
            $.post('api.php', data, function(response) {
                if (response && response.success) {
                    Swal.fire('Success', response.message, 'success');
                    $('#specialtokenModal').modal('hide');
                    loadMergedSpecialTokens();
                    loadStatistics();
                }
            }, 'json');
        }

        function editSpecialToken(menuId) {
            const token = allMergedTokens.find(t => t.menu_id == menuId);
            if (!token) {
                Swal.fire('Error', 'Special Token not found', 'error');
                return;
            }
            $('#editSpecialMenuId').val(token.menu_id);
            $('#editSpecialFromDate').val(token.from_date);
            $('#editSpecialFromTime').val(token.from_time);
            $('#editSpecialToDate').val(token.to_date);
            $('#editSpecialToTime').val(token.to_time);
            $('#editSpecialTokenDate').val(token.token_date);
            $('#editSpecialMealType').val(token.meal_type);
            $('#editSpecialMenuItems').val(token.menu_items);
            $('#editSpecialFee').val(token.fee);
            new bootstrap.Modal(document.getElementById('editSpecialTokenModal')).show();
        }

        function updateSpecialToken() {
            const data = {
                action: 'update_special_token',
                menu_id: $('#editSpecialMenuId').val(),
                from_date: $('#editSpecialFromDate').val(),
                from_time: $('#editSpecialFromTime').val(),
                to_date: $('#editSpecialToDate').val(),
                to_time: $('#editSpecialToTime').val(),
                token_date: $('#editSpecialTokenDate').val(),
                meal_type: $('#editSpecialMealType').val(),
                menu_items: $('#editSpecialMenuItems').val(),
                fee: $('#editSpecialFee').val()
            };
            $.post('api.php', data, function(response) {
                if (response && response.success) {
                    Swal.fire('Success', 'Special token updated successfully', 'success');
                    $('#editSpecialTokenModal').modal('hide');
                    loadMergedSpecialTokens();
                }
            }, 'json');
        }

        function deleteSpecialToken(menuId) {
            Swal.fire({
                title: 'Delete Special Token?',
                text: 'This action cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('api.php', {
                        action: 'delete_special_token',
                        menu_id: menuId
                    }, function(response) {
                        if (response && response.success) {
                            Swal.fire('Deleted!', 'Special token has been deleted.', 'success');
                            loadMergedSpecialTokens();
                            loadStatistics();
                        }
                    }, 'json');
                }
            });
        }

        function activateToken(menuId) {
            const token = allMergedTokens.find(t => t.menu_id == menuId);
            if (!token) return;
            $('#activateMenuId').val(token.menu_id);
            $('#activateToDate').val(token.to_date);
            $('#activateToTime').val(token.to_time);
            new bootstrap.Modal(document.getElementById('activateTokenModal')).show();
        }

        function saveActivateToken() {
            const data = {
                action: 'update_special_token',
                menu_id: $('#activateMenuId').val(),
                to_date: $('#activateToDate').val(),
                to_time: $('#activateToTime').val()
            };
            $.post('api.php', data, function(response) {
                if (response && response.success) {
                    Swal.fire('Success', 'Token activated with new duration', 'success');
                    $('#activateTokenModal').modal('hide');
                    loadMergedSpecialTokens();
                }
            }, 'json');
        }

        function endToken(menuId) {
            Swal.fire({
                title: 'End Token?',
                text: 'This will move the token to history',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, end it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('api.php', {
                        action: 'end_special_token',
                        menu_id: menuId
                    }, function(response) {
                        if (response && response.success) {
                            Swal.fire('Success', 'Token moved to history', 'success');
                            loadMergedSpecialTokens();
                        }
                    }, 'json');
                }
            });
        }

        function viewHistory(type) {
            const action = type === 'menu' ? 'get_menu_history' : 'get_special_token_history';
            $.post('api.php', {
                action: action
            }, function(response) {
                if (response && response.success) {
                    displayHistory(response.data);
                }
            }, 'json');
        }

        function displayHistory(historyData) {
            if (historyTable) historyTable.destroy();
            const tableBody = $('#historyTable tbody');
            tableBody.empty();
            if (!historyData || historyData.length === 0) {
                tableBody.html('<tr><td colspan="6" class="text-center">No history found</td></tr>');
                return;
            }
            historyData.forEach(function(item) {
                const row = `<tr><td><span class="badge bg-primary">${item.type}</span></td><td>${item.date || 'N/A'}</td><td>${item.details || 'N/A'}</td><td>${item.description || 'No description'}</td><td>₹${parseFloat(item.amount || 0).toFixed(2)}</td><td>${item.timestamp || 'N/A'}</td></tr>`;
                tableBody.append(row);
            });
            historyTable = $('#historyTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                order: [
                    [5, 'desc']
                ]
            });
        }

        // ========== TOKEN FILTERS ==========
        function applyTokenFilters() {
            const filterMonth = $('#requestsFilterMonth').val();
            const filterDate = $('#requestsFilterDate').val();
            const filterMealType = $('#requestsFilterMealType').val();
            const filterItem = $('#requestsFilterItem').val();
            
            $.ajax({
                url: 'api.php',
                type: 'POST',
                data: {
                    action: 'get_filtered_tokens',
                    filter_month: filterMonth,
                    filter_date: filterDate,
                    filter_meal_type: filterMealType,
                    filter_item: filterItem
                },
                dataType: 'json'
            }).done(function(response) {
                if (response && response.success && Array.isArray(response.data)) {
                    allTokens = response.data;
                } else {
                    allTokens = [];
                }
                displayTokens();
            }).fail(function() {
                allTokens = [];
                displayTokens();
            });
        }

        function clearTokenFilters() {
            $('#requestsFilterMonth').val('');
            $('#requestsFilterDate').val('');
            $('#requestsFilterMealType').val('');
            $('#requestsFilterItem').val('');
            loadTokens();
        }

        // Enter key support for item search
        $(document).on('keypress', '#requestsFilterItem', function(e) {
            if (e.which === 13) {
                applyTokenFilters();
            }
        });

        // ========== REVENUE FUNCTIONS ==========
        function applyRevenueFilter() {
            const month = $('#revenueFilterMonth').val();
            if (!month) {
                Swal.fire('Error', 'Please select a month', 'error');
                return;
            }
            
            $.ajax({
                url: 'api.php',
                type: 'POST',
                data: {
                    action: 'get_revenue',
                    filter_month: month
                },
                dataType: 'json'
            }).done(function(response) {
                if (response && response.success) {
                    displayRevenue(response.data);
                } else {
                    displayRevenue([]);
                }
            }).fail(function() {
                displayRevenue([]);
            });
        }

        function displayRevenue(data) {
            if (tables.revenue) {
                tables.revenue.destroy();
                tables.revenue = null;
            }
            
            const tableBody = $('#revenueTable tbody');
            tableBody.empty();
            
            if (!data || data.length === 0) {
                tableBody.html('<tr><td colspan="4" class="text-center">No revenue data found for selected month</td></tr>');
                return;
            }
            
            let totalRevenue = 0;
            let totalTokens = 0;
            
            data.forEach(function(row, index) {
                const revenue = parseFloat(row.revenue || 0);
                const tokens = parseInt(row.tokens_count || 0);
                totalRevenue += revenue;
                totalTokens += tokens;
                
                tableBody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.date ? new Date(row.date).toLocaleDateString('en-GB') : 'N/A'}</td>
                        <td>${tokens}</td>
                        <td>Rs.${revenue.toFixed(2)}</td>
                    </tr>
                `);
            });
            
            // Add total row
            tableBody.append(`
                <tr class="table-info fw-bold">
                    <td colspan="2">TOTAL</td>
                    <td>${totalTokens}</td>
                    <td>Rs.${totalRevenue.toFixed(2)}</td>
                </tr>
            `);
            
            tables.revenue = $('#revenueTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 31,
                order: [[4, 'desc']]
            });
        }

        // ========== CONSUMPTION FUNCTIONS ==========
        function applyConsumptionFilter() {
            const month = $('#consumptionFilterMonth').val();
            if (!month) {
                Swal.fire('Error', 'Please select a month', 'error');
                return;
            }
            
            $.ajax({
                url: 'api.php',
                type: 'POST',
                data: {
                    action: 'get_consumption',
                    filter_month: month
                },
                dataType: 'json'
            }).done(function(response) {
                if (response && response.success) {
                    displayConsumption(response.data);
                } else {
                    displayConsumption([]);
                }
            }).fail(function() {
                displayConsumption([]);
            });
        }

        function displayConsumption(data) {
            if (tables.consumption) {
                tables.consumption.destroy();
                tables.consumption = null;
            }
            
            const tableBody = $('#consumptionTable tbody');
            tableBody.empty();
            
            if (!data || data.length === 0) {
                tableBody.html('<tr><td colspan="5" class="text-center">No consumption data found for selected month</td></tr>');
                return;
            }
            
            let totalSpent = 0;
            let totalTokensCount = 0;
            
            data.forEach(function(row, index) {
                const spent = parseFloat(row.total_spent || 0);
                const tokens = parseInt(row.tokens_count || 0);
                totalSpent += spent;
                totalTokensCount += tokens;
                
                tableBody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.roll_number || 'N/A'}</td>
                        <td>${row.student_name || 'Unknown'}</td>
                        <td>${tokens}</td>
                        <td>Rs.${spent.toFixed(2)}</td>
                    </tr>
                `);
            });
            
            // Add total row
            tableBody.append(`
                <tr class="table-info fw-bold">
                    <td colspan="3">TOTAL</td>
                    <td>${totalTokensCount}</td>
                    <td>Rs.${totalSpent.toFixed(2)}</td>
                </tr>
            `);
            
            tables.consumption = $('#consumptionTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 50,
                order: [[5, 'desc']]
            });
        }

        // ========== PDF EXPORT FUNCTIONS ==========
        function exportTokenRequests() {
            const filterMonth = $('#requestsFilterMonth').val();
            const filterDate = $('#requestsFilterDate').val();
            const filterMealType = $('#requestsFilterMealType').val();
            const filterItem = $('#requestsFilterItem').val();
            
            const params = new URLSearchParams({
                type: 'token_requests',
                filter_month: filterMonth || '',
                filter_date: filterDate || '',
                filter_meal_type: filterMealType || '',
                filter_item: filterItem || ''
            });
            
            window.open('messexport.php?' + params.toString(), '_blank');
        }

        function exportRevenue() {
            const month = $('#revenueFilterMonth').val();
            if (!month) {
                Swal.fire('Error', 'Please select a month first', 'error');
                return;
            }
            
            const params = new URLSearchParams({
                type: 'revenue',
                filter_month: month
            });
            
            window.open('messexport.php?' + params.toString(), '_blank');
        }

        function exportConsumption() {
            const month = $('#consumptionFilterMonth').val();
            if (!month) {
                Swal.fire('Error', 'Please select a month first', 'error');
                return;
            }
            
            const params = new URLSearchParams({
                type: 'consumption',
                filter_month: month
            });
            
            window.open('messexport.php?' + params.toString(), '_blank');
        }
    </script>
</body>

</html>
