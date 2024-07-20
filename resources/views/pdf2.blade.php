<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengiriman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Pengiriman</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $record->order->customer->name }}</td>
                </tr>
                <tr>
                    <th>Order Number</th>
                    <td>{{ $record->order->order_number }}</td>
                </tr>
                @if($record->customer)
                <tr>
                    <th>Customer Address</th>
                    <td>{{ $record->customer->address }}</td>
                </tr>
                @endif
                @if($record->delivery_name)
                <tr>
                    <th>Delivery Name</th>
                    <td>{{ $record->delivery_name }}</td>
                </tr>
                @endif
                <tr>
                    <th>Delivery Address</th>
                    <td>{{ $record->delivery_address }}</td>
                </tr>
                <tr>
                    <th>Delivery Date</th>
                    <td>{{ $record->delivery_date }}</td>
                </tr>
                <tr>
                    <th>Courier</th>
                    <td>{{ $record->courier->name }}</td>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>
