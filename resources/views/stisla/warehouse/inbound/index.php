<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>RENCANA KEDATANGAN BARANG</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #E0F7FA, #FFFFFF);
            margin: 0;
            padding: 20px;
            background-size: cover;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.1);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Title */
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Poppins', sans-serif;
            font-size: 45px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
            line-height: 1.3;
        }

        /* Table Wrapper - Use Flexbox to fill space */
        .table-wrapper {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            overflow-y: auto;
            margin-top: 20px;
            border-radius: 12px;
            position: relative;
            height: 100%;
            /* Ensures it fills the height */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            transition: all 0.3s ease;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border-spacing: 0;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Table Header Styling */
        th {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            padding: 16px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #0056b3;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        /* Table Cell Styling */
        td {
            padding: 18px;
            /* Menambahkan padding lebih banyak */
            text-align: center;
            color: #333;
            font-size: 16px;
            /* Ukuran font sedikit lebih besar */
            transition: all 0.3s ease;
            border-bottom: 2px solid #eee;
            font-weight: 500;
            /* Memberikan sedikit ketebalan pada font */
        }

        td:hover {
            background-color: #f0f8ff;
            /* Warna latar belakang saat hover */
            cursor: pointer;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            /* Efek sedikit terangkat saat hover */
        }

        /* Alternating Row Colors */
        tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        /* Ukuran khusus untuk kolom # di header */
        th:nth-child(1) {
            font-size: 12px;
            /* Ukuran font lebih kecil */
            padding: 10px 8px;
            /* Padding lebih kecil */
        }

        /* Ukuran khusus untuk kolom # di body */
        td:nth-child(1) {
            font-size: 14px;
            /* Ukuran font lebih kecil */
            padding: 10px 8px;
            /* Padding lebih kecil */
            text-align: center;
            /* Memastikan teks tetap terpusat */
        }

        /* Menyesuaikan lebar kolom # agar lebih kecil */
        th:nth-child(1),
        td:nth-child(1) {
            width: 50px;
            /* Lebar kolom lebih kecil */
        }

        /* Ukuran khusus untuk kolom Project Name di header */
        th:nth-child(10) {
            font-size: 16px;
            /* Ukuran font lebih besar */
            padding: 14px 12px;
            /* Padding lebih besar */
        }

        /* Ukuran khusus untuk kolom Project Name di body */
        td:nth-child(10) {
            font-size: 16px;
            /* Ukuran font lebih besar */
            padding: 14px 12px;
            /* Padding lebih besar */
            text-align: center;
            /* Memastikan teks tetap terpusat */
        }

        /* Menyesuaikan lebar kolom Project Name agar lebih besar */
        th:nth-child(10),
        td:nth-child(10) {
            width: 180px;
            /* Lebar kolom Project Name lebih besar */
        }

        /* Status Badge Styling */
        .status {
            cursor: pointer;
            padding: 8px 15px;
            text-align: center;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            color: white;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            width: 100px;
            height: 30px;
            line-height: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);

            /* Posisi tengah */
            margin: 0 auto;
            /* untuk elemen block atau inline-block */
            display: block;
            /* agar margin auto dapat bekerja */
            text-align: center;
            /* memastikan teks berada di tengah */
        }

        /* Status Colors */
        .status-received {
            background-color: #28a745;
        }

        .status-received-late {
            background-color: #28a745;
        }

        .status-delay {
            background-color: #dc3545;
        }

        .status-partial {
            background-color: #ffc107;
            color: black;
        }

        .status-arrived {
            background-color: #6c757d;
        }

        .status-new {
            background-color: #007bff;
        }

        /* Status Hover */
        .status:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        /* Scrollable Table Body */
        .table-body {
            flex-grow: 1;
            /* Make the table body take up remaining space */
            overflow-y: auto;
            padding-bottom: 10px;
            /* Padding for smooth scrolling */
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 50px;
            overflow: auto;
            transition: all 0.3s ease;
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            border-radius: 12px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);

            /* Menambahkan Flexbox untuk pemusatan */
            display: flex;
            flex-direction: column;
            /* Mengatur agar konten modal terorganisir secara vertikal */
            justify-content: center;
            /* Memusatkan secara vertikal */
            align-items: center;
            /* Memusatkan secara horizontal */
            text-align: center;
            /* Memastikan teks dan elemen lain dalam modal terpusat */
        }

        .modal-close {
            background-color: #007bff;
            color: white;
            padding: 14px 26px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-close:hover {
            background-color: #0056b3;
        }

        /* Smooth Scroll for Table */
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <h1>RENCANA KEDATANGAN BARANG - <span id="current-date"></span></h1>

    <div class="table-wrapper">
        <!-- Table Header -->
        <table id="inboundTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>SITE</th>
                    <th>Est. Date</th>
                    <th>Est. Time</th>
                    <th>Arrival Date</th>
                    <th>Arrival Time</th>
                    <th>PO No.</th>
                    <th>WO No.</th>
                    <th>VENDOR</th>
                    <th>PROJECT NAME</th>
                    <th>STATUS</th>
                    <th>COMPANY</th>
                </tr>
            </thead>
        </table>

        <!-- Table Body (Scrollable) -->
        <div class="table-body">
            <table>
                <tbody>
                    <?php foreach ($data as $row): ?>
                        <?php
                        $statusClass = strtolower(str_replace(" ", "-", $row->status));
                        $est_date = strftime('%d-%m-%Y', strtotime($row->est_date));
                        $est_time = $row->est_time;

                        $arr_date = ($row->arrival_date) ? strftime('%d-%m-%Y', strtotime($row->arrival_date)) : null;
                        $arr_time = ($row->arrival_date) ? date('H:i', strtotime($row->arrival_time)) : null;

                        $qr_combination = "https://monitoring.marmin.co.id/warehouse/inbound/edit/" . $row->id;
                        ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= $row->site ?></td>
                            <td><?= $est_date ?></td>
                            <td><?= $est_time ?></td>
                            <td><?= $arr_date ?></td>
                            <td><?= $arr_time ?></td>
                            <td><?= $row->po_number ?></td>
                            <td><?= $row->wo_number ?></td>
                            <td><?= $row->vendor ?></td>
                            <td><?= $row->project_name ?></td>
                            <td class="status status-<?= $statusClass ?>"
                                onclick="openModal('<?= $qr_combination ?>', '<?= $row->status ?>')">
                                <?= $row->status ?>
                            </td>
                            <td><?= $row->company ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <h3>SCAN me</h3>
            <img id="qrImage" src="" alt="QR Code" style="max-width: 100%; height: auto; margin-bottom: 50px;">
            <button class="modal-close" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- DataTables JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        // Mendapatkan tanggal saat ini
        const currentDate = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const formattedDate = currentDate.toLocaleDateString('id-ID', options);
        document.getElementById('current-date').textContent = formattedDate;

        // Function to open modal
        function openModal(qr_combination, status) {
            if (status === 'Delay' || status === 'Received' || status === 'Partial') {
                return;
            }
            var qrImage = document.getElementById('qrImage');
            qrImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + qr_combination;
            var modal = document.getElementById('statusModal');
            modal.style.display = 'block';
        }

        // Function to close modal
        function closeModal() {
            var modal = document.getElementById('statusModal');
            modal.style.display = 'none';
            location.reload();
        }

        // Start auto-scrolling
        function autoScrollTable() {
            var tableBody = document.querySelector('.table-body');
            if (tableBody.scrollTop + tableBody.clientHeight >= tableBody.scrollHeight) {
                duplicateTableBody();
            } else {
                tableBody.scrollTop += 1; // Auto scroll down
            }
        }

        // Create a duplicate of the table body to loop the scroll
        function duplicateTableBody() {
            var tableWrapper = document.querySelector('.table-body');
            var table = tableWrapper.querySelector('table');

            // Clone the table and append it to the wrapper to create a seamless loop
            var clonedTable = table.cloneNode(true);
            tableWrapper.appendChild(clonedTable);
        }

        // Initialize the duplication of the table and start scrolling
        document.addEventListener("DOMContentLoaded", function() {
            // Start the auto-scrolling and duplicate process
            setInterval(autoScrollTable, 50); // Call autoScrollTable every 10 milliseconds
        });

        // DataTables initialization
        $(document).ready(function() {
            $('#inboundTable').DataTable({
                paging: false,
                searching: false,
                ordering: true,
                info: false,
                lengthChange: false,
                autoWidth: false
            });
        });

        // Refresh halaman setiap 3 detik
        setInterval(function() {
            location.reload();
        }, 60000); // 60000ms = 1 menit
    </script>
</body>

</html>