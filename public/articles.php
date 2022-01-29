<?php
session_start();
if($_SESSION["login"] !== true){
	header("Location: /login.php");
    die();
}
// Connect to db
$server = 'mysql';
$username = 'student';
$password = 'student';

$schema = 'csy2028';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//End to con

if(isset($_GET['delpost'])){ 

    $stmt = $pdo->prepare('DELETE FROM articles WHERE idarticles = :idarticles') ;
    $stmt->execute(array(':idarticles' => $_GET['delpost']));

    header('Location: indexx.php?action=deleted');
    exit;
} 

?>

<?php include("head.php");  ?>

<main>

  <title>Admin Home </title>
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
      if (confirm("Are you sure you want to delete '" + title + "'"))
      {
          window.location.href = 'articles.php?delpost=' + id;
      }
  }
  </script>


<div class="content">
<?php 
    //show message from add / edit page
    if(isset($_GET['action'])){ 
        echo '<h3>Post '.$_GET['action'].'.</h3>'; 
    } 
    ?>

    <table>
    <tr>
        <th>Article Title</th>
        <th>Posted Date</th>
        <th>Category</th>
        <th>Update</th>
         <th>Delete</th>
    </tr>
    <?php
        try {

            $stmt = $pdo->query('SELECT idarticles, articleTitle, articleDate, categoryName FROM articles ORDER BY idarticles DESC');
            while($row = $stmt->fetch()){
                
                echo '<tr>';
                echo '<td>'.$row['articleTitle'].'</td>';
                echo '<td>'.date('jS M Y', strtotime($row['articleDate'])).'</td>';
                echo ' <td>' . $row['categoryName'] . ' </td>';
                ?>

                <td>
                     <button class="editbtn" > <a href="editarticles.php?id=<?php echo $row['idarticles'];?>" >Edit </a >  </button ></td> <td>
                    <button class="delbtn" >    <a href="javascript:delpost('<?php echo $row['idarticles'];?>','<?php echo $row['articleTitle'];?>')" >Delete </a > </button >
                </td>
                
                <?php 
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
    </table>

    <p> <button class="editbtn"><a href='addarticles.php'>Add New Article</a></button></p>       
</p></div>
</main>
<?php 
include("sidebar.php");  ?>