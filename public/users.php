<?php
// Connect to db
$server = 'mysql';
$username = 'student';
$password = 'student';

$schema = 'csy2028';
$pdo = new PDO(
  'mysql:dbname=' . $schema . ';host=' . $server,
  $username,
  $password,
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
//End to con



// add / edit page
if (isset($_GET['deluser'])) {


  if ($_GET['deluser'] != '1') {

    $stmt = $db->prepare('DELETE FROM users WHERE idusers = :idusers');
    $stmt->execute(array(':idusers' => $_GET['deluser']));

    header('Location: users.php?action=deleted');
    exit;
  }
}

?>

<?php include("adminhead.php");  ?>
<title>Users</title>
<script language="JavaScript" type="text/javascript">
  function deluser(id, title) {
    if (confirm("Are you sure you want to delete '" + title + "'")) {
      window.location.href = 'users.php?deluser=' + id;
    }
  }
</script>

<div class="content">
  <?php
  //show message from add / edit page
  if (isset($_GET['action'])) {
    echo '<h3>User ' . $_GET['action'] . '.</h3>';
  }
  ?>

  <table>
    <tr>
      <th>Username </th>
      <th>Email </th>
      <th>User Type </th>
      <th>Edit </th>
      <th>Delete </th>
     

    </tr>
    <?php
    try {

      $stmt = $pdo->query('SELECT idusers, username, email, usertype FROM users ORDER BY idusers');
      while ($row = $stmt->fetch()) {

        echo ' <tr>';
        echo ' <td>' . $row['username'] . ' </td>';
        echo ' <td>' . $row['email'] . ' </td>';
        echo ' <td>' . $row['usertype'] . ' </td>';
    ?>

        <td>
          <button class="editbtn"><a href="editusers.php?id=<?php echo $row['idusers']; ?>">Edit</a> </button>
          <?php if ($row['idusers'] != 1) { ?>
        </td>
        <td><button class="delbtn"><a href="javascript:deluser('<?php echo $row['idusers']; ?>','<?php echo $row['username']; ?>')">Delete</a></button>

        <?php }

        ?>
        </td>

    <?php
        echo '</tr>';
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    ?>
  </table>

  <p><button class="editbtn"><a href='addusers.php'>Add User</a></button></p>


</div>




<?php include("footer.php");  ?>