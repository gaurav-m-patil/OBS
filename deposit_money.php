<?php 
session_start();        
if(!isset($_SESSION['admin_login'])) 
    header('location:adminlogin.php');   
?>
<?php
include '_inc/dbconn.php';
$id=  mysql_real_escape_string($_REQUEST['customer_id']);
$sql="SELECT * FROM `customer` WHERE id=$id";
$result=  mysql_query($sql) or die(mysql_error());
$rws=  mysql_fetch_array($result);
$credit= mysql_real_escape_string($_POST['depositt']);
?>

<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="newcss.css"/>
        <title>Deposit Money</title>
        
    </head>
    <?php include 'header.php'; ?>
        <div class='content_addstaff'>
    <?php include 'admin_navbar.php'?>
                <div class='addstaff'>
                <form action="alter_customer.php" method="POST">
            <table align="center">
                                <input type="hidden" name="current_id" value="<?php echo $id;?>"/>
                 <tr><td colspan='2' align='center' style='color:#2E4372;'><h3><u>Deposit Money in Account</u></h3></td></tr>
                <tr>
                    <td>Customer's Name</td>
                    <td><input type="text" name="edit_name" value="<?php echo $rws[1];?>" required=""/></td>
                </tr>
                <tr>
                    <td>Account Type</td>
                    <td>
                        <select name="edit_account">
                            <option <?php if($rws[5]=="savings") echo "selected";?>>Savings</option>
                            <option <?php if($rws[5]=="current") echo "selected";?>>Current</option>
                        </select>
                    </td>
                </tr>               
                <tr>
                    <td>Amount</td>
                    <?php
                    include '_inc/dbconn.php';
                    $id=  mysql_real_escape_string($_REQUEST['customer_id']);
                    #$sql="SELECT * FROM passbook".$id." WHERE transactionid=$id";
                    $sql="SELECT MAX(transactionid) from passbook".$id."";
                    $result=  mysql_query($sql) or die(mysql_error());
                    $rws=  mysql_fetch_array($result);
                    $r_last_tid=$rws[0];

                    $sql="SELECT * from passbook".$id." where transactionid='$r_last_tid'";
                    $result=mysql_query($sql) or die(mysql_error());
                    while($rws= mysql_fetch_array($result)){
                    $r_amount=$rws[7];
                    $r_name=$rws[2];
                    $r_branch=$rws[3];
                    $r_ifsc=$rws[4];}
                    $date=date("Y-m-d");
                    
                    $r_total=$r_amount+$credit;
                    $sql1="insert into passbook".$id." values('','$date','$r_name','$r_branch','$r_ifsc','$credit','0','$r_total','BY ADMIN')";
                        mysql_query($sql1) or die(mysql_error());
                    ?>
                    <td><input type="text" name="depositt" value="" required=""/></td>
                </tr>
                <tr>
                    <td colspan="2" align='center' style='padding-top:20px'><input type="submit" name="alter_customer" value="DEPOSIT" class='addstaff_button'/></td>
                </tr>
            </table>
        </form>
                
        </div>
        </div>           
    </body>
</html>
<?php echo $rws[0];?>
                <!--<tr>
                    //<td>gender</td>
                    <td>
                        M<input type="radio" name="edit_gender" value="M" <?php if($rws[2]=="M") echo "checked";?>/>
                        F<input type="radio" name="edit_gender" value="F" <?php if($rws[2]=="F") echo "checked";?>/>
                    </td>
                </tr>
                <tr>
                    <td>
                        DOB
                    </td>
                    <td>
                        <input type="date" name="edit_dob" value="<?php echo $rws[3];?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Nominee</td>
                    <td><input type="text" name="edit_nominee" value="<?php echo $rws[4];?>" required=""/></td>
                </tr>-->
                <!--<tr>
                    <td>Address:</td>
                    <td><textarea name="edit_address"><?php echo $rws[6];?></textarea></td>
                </tr>
                
                    <td>mobile</td>
                    <td><input type="text" name="edit_mobile" value="<?php echo $rws[7];?>" required=""/></td>
                </tr>

                <tr>
                    <td>email id</td>
                    <td><input type="text" name="edit_mobile" value="<?php echo $rws[8];?>" required=""/></td>
                </tr>-->