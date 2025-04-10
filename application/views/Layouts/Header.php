<?php
$user = $this->session->userdata('user');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 40px;
            font-size: 22px;
            text-align: center;
            border-bottom: 1px solid #495057;
            padding-bottom: 10px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 10px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #ffffff;
            padding: 20px 30px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 22px;
            color: #343a40;
        }

        .header .user-name {
            font-size: 16px;
            color: #6c757d;
        }

        .content {
            padding: 30px;
            flex: 1;
        }

        .content h2 {
            color: #212529;
            margin-bottom: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card.user-details {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-left: 20px;
            max-width: 400px;
        }

        .card.user-details h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #333;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .label {
            font-weight: 600;
            color: #555;
        }

        .value {
            color: #222;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }

        .badge-admin {
            background-color: #dc3545;
            /* Merah */
            color: #fff;
        }

        .badge-editor {
            background-color: #ffc107;
            /* Kuning */
            color: #212529;
        }

        .badge-user {
            background-color: #0d6efd;
            /* Biru */
            color: #fff;
        }


        .card.user-table {
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
            overflow-x: auto;
        }

        .user-table table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .user-table th,
        .user-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #f8f9fa;
            color: #333;
        }

        .user-table tr:hover {
            background-color: #f1f1f1;
            transition: 0.2s ease-in-out;
        }


        .form-card {
            background-color: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 700px;
        }

        .form-card h3 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2e86de;
            outline: none;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .btn-save {
            background-color: #27ae60;
            color: white;
            padding: 8px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-back {
            background-color: #bdc3c7;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }




        a.btn-add, a.btn-edit, a.btn-delete {
            text-decoration: none;
            display: inline-block;
        }

        a.btn-add {
            background-color: rgb(57, 15, 205);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        a.btn-add:hover {
            background-color: rgb(36, 10, 102) 15, 205);
        }

        a.btn-edit {
            background-color:rgb(78, 164, 255);
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }
        a.btn-edit:hover {
            background-color:rgb(10, 45, 82);
        }
        a.btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        } 
        a.btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="user-name">Halo, <?= $user['name']; ?></div>
    </div>