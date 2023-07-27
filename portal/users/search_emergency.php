<?php

session_start();
include 'includes/connect.php';

// Retrieve the search parameters
$fromDate = $_POST['from_date'];
$toDate = $_POST['to_date'];
$agency = $_POST['agency'];
$status = $_POST['status'];

// Build the SQL query based on the search parameters
$query = "SELECT e.*, a.agency_name FROM emergency e INNER JOIN agency a ON e.agency_id = a.agency_id WHERE e.victim_id = {$_SESSION['SESS_USERS_ID']}";

if (!empty($fromDate)) {
    $query .= " AND e.dates >= '$fromDate'";
}

if (!empty($toDate)) {
    $query .= " AND e.dates <= '$toDate'";
}

if (!empty($agency)) {
    $query .= " AND a.agency_name = '$agency'";
}

if (!empty($status)) {
    $query .= " AND e.status = '$status'";
}

$query .= " ORDER BY e.id DESC";

// Execute the query and fetch the results
$result = $db->prepare($query);
$result->execute();

// Generate the HTML for the search results
$html = '';
$i = 1;
while ($row = $result->fetch()) {
    $html .= '<tr>';
    $html .= '<td>' . $i . '</td>';
    $html .= '<td>' . $row['emergency_id'] . '</td>';
    $html .= '<td>' . $row['agency_name'] . '</td>';
    $html .= '<td>' . $row['emergency_category'] . '</td>';
    $html .= '<td>' . $row['address'] . '</td>';
    $html .= '<td>' . $row['case_severity'] . '</td>';
    $html .= '<td>';
    if ($row['status'] == "Pending") {
        $html .= '<p class="status-red">Pending</p>';
    } else {
        $html .= '<p class="status-green">Resolved</p>';
    }
    $html .= '</td>';
    $html .= '<td>' . $row['dates'] . '</td>';
    $html .= '<td class="text-right">';
    $html .= '<a class="btn btn-primary" href="make_action.php?id=' . $row['id'] . '"><i class="fa fa-eye m-r-5"></i> View Details</a>';
    $html .= '</td>';
    $html .= '</tr>';

    $i++;
}

// Return the search results HTML
echo $html;
?>
