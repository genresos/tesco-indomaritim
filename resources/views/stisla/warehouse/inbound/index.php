<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENCANA KEDATANGAN BARANG</title>
    <style>
        /* Global Styles */

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #e6f7ff, #ffffff);
            /* Soft gradient background */
            margin: 0;
            padding: 10px;
            background-size: cover;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.1);
            /* Subtle inner shadow */
        }


        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
            /* Mengganti font dengan font yang lebih modern */
            font-size: 40px;
            /* Menyesuaikan ukuran font */
            font-weight: bold;
            /* Membuat teks lebih tebal */
            letter-spacing: 2px;
            /* Memberikan jarak antar huruf */
            text-transform: uppercase;
            /* Membuat teks menjadi huruf besar semua */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            /* Memberikan bayangan teks untuk efek 3D */
            line-height: 1.4;
            /* Mengatur jarak antar baris */
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            /* Soft outer shadow for depth */
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf4ff;
        }

        td {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 14px;
            padding: 10px;
            overflow: hidden;
        }

        td:nth-child(9) {

            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 500px;
            /* Lebar maksimum untuk kolom */
        }

        /* Status Colors */
        .status {
            cursor: pointer;
            padding: 10px 20px;
            text-align: center;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Soft shadow */
            width: 100px;
            /* Tentukan lebar tombol yang sama */
            height: 30px;
            /* Tentukan tinggi tombol yang sama */
            line-height: 30px;
            /* Pusatkan teks secara vertikal */
        }

        /* Hover effects */
        .status:hover {
            transform: translateY(-3px);
            /* Lift effect */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            /* Slightly stronger shadow */
        }

        /* Delivered */
        .status-closed {
            background-color: #28a745;
            border: 2px solid #218838;
            /* Slight darker green border */
        }

        .status-closed:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        /* Cancelled */
        .status-cancelled {
            background-color: #dc3545;
            border: 2px solid #c82333;
            /* Darker red border */
        }

        .status-cancelled:hover {
            background-color: #c82333;
            /* Darker red on hover */
        }

        /* partially */
        .status-partially {
            background-color: #ffc107;
            color: black;
            border: 2px solid #e0a800;
            /* Darker yellow border */
        }

        .status-partially:hover {
            background-color: #e0a800;
            /* Darker yellow on hover */
        }

        /* Arrived */
        .status-arrived {
            background-color: #6c757d;
            border: 2px solid #5a6268;
            /* Darker gray border */
        }

        .status-arrived:hover {
            background-color: #5a6268;
            /* Darker gray on hover */
        }

        /* New */
        .status-new {
            background-color: #6c757d;
            /* Set to gray */
            border: 2px solid #5a6268;
            /* Slightly darker gray border */
        }

        .status-new:hover {
            background-color: #5a6268;
            /* Darker gray on hover */
        }


        /* Focus states for accessibility */
        .status:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
            /* Blue glow on focus */
        }


        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .modal-close {
            background-color: #dc3545;
            color: red;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-close:hover {
            background-color: #c82333;
        }

        td.status {
            font-size: 14px;
            /* Smaller font size */
            padding: 5px 10px;
            /* Adjust padding */
            text-align: center;
            /* Center the text */
            border-radius: 4px;
            /* Optional: add rounded corners */
            cursor: pointer;
            /* Change the cursor to a pointer on hover */
        }

        td.status:hover {
            background-color: #f0f0f0;
            /* Optional: change background on hover */
            transition: background-color 0.3s ease;
            /* Smooth background transition */
        }

        /* Modal Background */
        .modal {
            display: none;
            /* Hidden by default, show via JS */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Transparent black */
            overflow: auto;
            padding-top: 50px;
            transition: opacity 0.3s ease;
        }

        /* Modal Content Box */
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Title Styling */
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* QR Code Container */
        .qr-container {
            margin-bottom: 30px;
        }

        /* QR Code Styling */
        .qr-code {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Footer / Close Button */
        .modal-footer {
            margin-top: 20px;
        }

        .modal-close {
            background-color: #007BFF;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-close:hover {
            background-color: #0056b3;
        }

        /* Responsif: layar kecil */
        @media screen and (max-width: 768px) {
            table {
                border: 0;
            }

            th,
            td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            th::before {
                content: attr(data-title);
                position: absolute;
                left: 10px;
                font-weight: bold;
                text-transform: uppercase;
            }

            td {
                text-align: left;
                padding-left: 10px;
            }
        }

        footer {
            margin-top: 40px;
            text-align: center;
        }

        footer img {
            max-width: 150px;
            height: auto;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px; */
        }
    </style>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <h1>RENCANA KEDATANGAN BARANG - <span id="current-date"></span></h1>
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
        <tbody>
            <?php foreach ($data as $row): ?>
                <?php
                // Tentukan kelas status berdasarkan nama status
                $statusClass = strtolower(str_replace(" ", "-", $row->status));
                $est_date = strftime('%d-%m-%Y', strtotime($row->est_date));
                $est_time = $row->est_time;

                $arr_date = ($row->arrival_date) ? strftime('%d-%m-%Y', strtotime($row->arrival_date)) : null;
                $arr_time = ($row->arrival_date) ? date('H:i', strtotime($row->arrival_time)) : null;

                $qr_combination = "http://192.168.77.254:8000/warehouse/inbound/edit/" . $row->id;

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

    <!-- Modal -->
    <!-- Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <h3>SCAN me</h3>
            <img id="qrImage" src="" alt="QR Code" style="max-width: 100%; height: auto; margin-bottom: 50px;">
            <p></p>
            <button class="modal-close" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- DataTables JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        // Mendapatkan tanggal saat ini
        const currentDate = new Date();

        // Format tanggal dalam format DD MMMM YYYY
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const formattedDate = currentDate.toLocaleDateString('id-ID', options);

        // Menampilkan tanggal pada elemen dengan id 'current-date'
        document.getElementById('current-date').textContent = formattedDate;
    </script>
    <script>
        var refreshTimeout; // Variable to store the timeout reference

        // Function to refresh the page every 5 seconds
        function startAutoRefresh() {
            refreshTimeout = setTimeout(function() {
                location.reload();
            }, 50000); // Set the refresh time to 5 seconds
        }


        // Fungsi untuk membuka modal dan menampilkan QR code berdasarkan kombinasi data
        function openModal(qr_combination, $status) {
            // Cek jika status adalah "Cancelled" atau "Closed"
            if (status === 'Cancelled' || status === 'Closed') {
                return; // Jangan buka modal jika statusnya Cancelled atau Closed
            }

            // Ambil elemen gambar dan set URL QR Code-nya
            var qrImage = document.getElementById('qrImage');
            qrImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + qr_combination;

            // Tampilkan modal
            var modal = document.getElementById('statusModal');
            modal.style.display = 'block';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            var modal = document.getElementById('statusModal');
            modal.style.display = 'none';
            location.reload();

        }

        // Start the auto-refresh when the page loads
        startAutoRefresh();

        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#inboundTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": false,
                "autoWidth": true,
            });
        });
    </script>
</body>
<!-- Footer -->
<footer style="margin-top: 10px; text-align: center;">
    <img src="http://103.165.130.102/assets/images/TESCO-01.png" alt="Logo" style="max-width: 150px; height: auto;">
    <img src="https://marmin.co.id/content/marmin_page/images/logo.png" alt="Logo" style="max-width: 150px; height: auto;">
    </br>
    <p style="font-family: 'Poppins', Arial, sans-serif; font-size: 16px; color: #333; margin: 0;">
        <span style="font-weight: bold;">&copy; 2024
            <a href="https://tescoindomaritim.com" style="color: #007bff; text-decoration: none; font-weight: bold;">Tesco Indomaritim</a>
            &
            <a href="https://marmin.co.id" style="color: #007bff; text-decoration: none; font-weight: bold;">Marmin</a>.
        </span>
        All rights reserved.
    </p>
</footer>

</html>