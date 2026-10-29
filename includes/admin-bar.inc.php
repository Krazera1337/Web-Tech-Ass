<?php
/*
 * Toolbar shown at the top of every admin page. Needs $conn from
 * db.inc.php for the "waiting" counts beside Contributions and Enquiries.
 */
$waiting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT
    (SELECT COUNT(*) FROM `contribution` WHERE status = 'pending') AS contributions,
    (SELECT COUNT(*) FROM `enquiry` WHERE status = 'new') AS enquiries"));

// Count bubble for a toolbar link, hidden when nothing is waiting.
function admin_badge($count, $label)
{
    return $count > 0 ? ' <span class="admin-badge" aria-label="' . $count . ' ' . $label . '">' . $count . '</span>' : '';
}
?>
<nav class="admin-bar" aria-label="Administration">
  <p class="admin-bar__who">Signed in as <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong></p>
  <ul>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="manage_users.php">Users</a></li>
    <li><a href="manage_plants.php">Plants</a></li>
    <li><a href="manage_contributions.php">Contributions<?= admin_badge((int) $waiting['contributions'], 'pending') ?></a></li>
    <li><a href="manage_enquiries.php">Enquiries<?= admin_badge((int) $waiting['enquiries'], 'new') ?></a></li>
    <li><a href="logout.php" class="admin-bar__logout">Log out</a></li>
  </ul>
</nav>
