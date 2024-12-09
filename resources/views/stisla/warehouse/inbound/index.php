<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10" id="refreshMeta"> <!-- Refresh otomatis setiap 5 detik -->
    <title>Penerimaan Barang - Warehouse TM5</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #e6f7ff;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            text-align: left;
            padding: 12px 15px;
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
            font-size: 14px;
        }

        /* Status Colors */
        .status {
            cursor: pointer;
            padding: 6px 12px;
            text-align: center;
            border-radius: 4px;
            color: white;
        }

        .status-delivered {
            background-color: #28a745;
        }

        .status-cancelled {
            background-color: #dc3545;
        }

        .status-delayed {
            background-color: #ffc107;
            color: black;
        }

        .status-arrived {
            background-color: #6c757d;
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
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-close:hover {
            background-color: #c82333;
        }
    </style>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <h2>Jadwal Kedatangan Barang - Warehouse TM5</h2>
    <table id="inboundTable">
        <thead>
            <tr>
                <th>SITE</th>
                <th>ETD</th>
                <th>ETA</th>
                <th>NO PO</th>
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
                ?>
                <tr>
                    <td><?= $row->site ?></td>
                    <td><?= $row->etd ?></td>
                    <td><?= $row->eta ?></td>
                    <td><?= $row->po_number ?></td>
                    <td><?= $row->vendor ?></td>
                    <td><?= $row->project_name ?></td>
                    <td class="status status-<?= $statusClass ?>" onclick="openModal('<?= $row->status ?>')">
                        <?= $row->status ?>
                    </td>
                    <td><?= $row->company ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <h3>Update Status</h3>
            <img id="qrImage" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://localhost:8000/warehouse/inbound" alt="QR Code" style="max-width: 100%; height: auto; margin-bottom: 50px;">
            <p></p>
            <button class="modal-close" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- DataTables JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        var refreshTimeout; // Variable to store the timeout reference

        // Function to refresh the page every 5 seconds
        function startAutoRefresh() {
            refreshTimeout = setTimeout(function() {
                location.reload();
            }, 5000); // Set the refresh time to 5 seconds
        }

        // Function to open the modal
        function openModal(status) {
            document.getElementById('statusModal').style.display = 'block';

            // Stop auto-refresh when modal is open
            clearTimeout(refreshTimeout);
        }

        // Function to close the modal and start auto-refresh again
        function closeModal() {
            document.getElementById('statusModal').style.display = 'none';

            // Restart the auto-refresh timer
            startAutoRefresh();
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

</html>