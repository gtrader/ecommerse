<!DOCTYPE html>
<head>
<title>Ecommerse template</title>
<link rel="stylesheet" type="text/css" href="Styles/layout.css">
<script src="JS/equal_column.js"></script>

<style>
/*Your code here*/
</style>
</head>
<body onload="equal_column()">
<!--*************The page container****************-->
<div id="page_container">
<!--*************The page top section****************-->
<div id="page_top">
<h1>This is a top part of the page</h1>
</div>
<!--*************The end of page top section****************-->

<!--*************The page main menu****************-->
<div id="main_menu">
<h1>This is a place for main menu</h1>
</div>
<!--*************The end of page main menu****************-->

<!--*************The page main section****************-->
<div id="page_main">
<!--*************The page left bar****************-->
<div id="left_bar">
</div>
<!--*************The end of page left bar****************-->

<!--*************The page main content****************-->
<div id="main_content">
<h1>Admin</h1>

<!--CATEGORIES DROPDOWN LIST WITH EDIT ADD AND ADDITEM BUTTINS-->
<table>
<tr>
<td>
<form name="categories" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php
//*****CREATE CONNECTION
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                                             //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
}
?>
<!--*************Creates static Form with categories drop-down list***********-->
<select id="categories" autofocus="yes" name="select_categories" required="yes">
<option value="">Categories</option>
<?php
//CREATE SQL QUIRY FOR NAME AND TITLE OURPUT
$sql = 'SELECT name, title                               
                       FROM categories';

mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
//IF QUIRY EXECUTION FAILED
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
//ELSE DO THIS CODE
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
$name=$row['name'];
$title=$row['title'];
?>
<!--******************Creates drop-down lists option*****************-->
<option value="<?php echo $name; ?>"><?php echo $title; ?></option>
<?php
}
mysql_close($conn);                       //CLOSE DATABASE CONNECTION
?>
</select>
<!--******************END OF drop-down lists option*****************-->

<!--******************EDIT CATEGORY BUTTON*****************-->
<td>
<input type="submit" name="edit_category" value="Edit"></input>
<!--******************END OF EDIT CATEGORY BUTTON*****************-->

<!--******************ADD CATEGORY ITEM BUTTON*****************-->
<td>
<input name="add_item" value="Add-Item" type="submit"></input>
<!--******************END OF ADD CATEGORY ITEM BUTTON*****************-->

<!--******************ADD SUBCATEGORY BUTTON*****************-->
<td>
<input name="add_subcategory" value="Sub-add" type="submit"></input>
<!--******************END OF ADD SUBCATEGORY ITEM BUTTON*****************-->

<!--******************DELETE CATEGORY BUTTON*****************-->
<td>
<input type="submit" name="delete_category" value="Delete Category"></input>
<!--******************END OF DELETE CATEGORY ITEM BUTTON*****************-->
</form>
<!--*************END OF Form with categories drop-down list***********-->

<!--*********************ADD CATEGORY: Form and button for adding a category**********-->
<form name="categories" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<td>
<input name="add_category" value="Add category" type="submit"></input>
</tr>
</form>
</table>
<!--END OF CATEGORIES DROPDOWN LIST WITH EDIT ADD AND ADDITEM BUTTINS-->

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
//ADD CATEGORY FORM
  if(!empty($_GET['add_category'])){
//************ Add categories form
?>
<form name="add_categories" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<input name="cat_name" type="text" placeholder="Category name"></input>
<input name="cat_title" type="text" placeholder="Category title"></input><br>
<textarea name="cat_description" placeholder="Description">
</textarea>
<textarea name="cat_permission" placeholder="Permission">
</textarea><br>

<input name="add" type="submit" value="Add"></input><br>

</form>
<?php
}
//ADD CATEGORY
elseif(!empty($_GET['add'])){
$cat_name=$_GET['cat_name'];
$cat_title=$_GET['cat_title'];
$cat_description=$_GET['cat_description'];
$cat_permission=$_GET['cat_permission'];
$cat_name="c_".$cat_name;
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                                             //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
mysql_close($conn);                       //CLOSE DATABASE CONNECTION
}
$sql = "INSERT INTO categories ".
       "(name,title,description,permission) ".
       "VALUES ".
       "('$cat_name','$cat_title','$cat_description','$cat_permission')";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "Category ".$cat_title." added successfully";
}
//DELETE CATEGORY
elseif(!empty($_GET['delete_category'])){
$cat_selected=$_GET['select_categories'];
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                                             //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
}
$sql = "DELETE FROM categories
        WHERE name='$cat_selected'";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo "Category ".$cat_selected." deleted successfully";
mysql_close($conn);                       //CLOSE DATABASE CONNECTION

}
//ADD SUBCATEGORY FORM

elseif(!empty($_GET['add_subcategory'])){
$categ_selected=$_GET['select_categories'];

?>
<form name="add_subcategories" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<input name="add_sub_name" type="text" placeholder="Subcategory ID"></input>
<input name="add_sub_title" type="text" placeholder="Subcategory name"></input><br>
<textarea name="add_sub_description" placeholder="Subcategory description"></textarea>
<textarea name="add_sub_permission" placeholder="Subcategory permission"></textarea>

<input name="categ_selected" type="text" hidden="yes" value="<?php echo $categ_selected; ?>"></input><br>
<input name="add_sub" type="submit" value="Add - Sub" style="margin-left:55px"></input><br>
</form>
<?php
}
//ADD SUBCATEGORY
elseif(!empty($_GET['add_sub'])){
$categ_selected=$_GET['categ_selected'];
$sub_name=$_GET['add_sub_name'];
$sub_name=$categ_selected."^"."s1_".$sub_name;
$sub_title=$_GET['add_sub_title'];
$sub_description=$_GET['add_sub_description'];
$sub_permission=$_GET['add_sub_permission'];
//CONNECT TO DATABASE
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                    //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
}
$sql="SELECT sub_count from categories where name='$categ_selected'";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$row = mysql_fetch_array($retval);
$sub_count=$row['sub_count'];
$sub_count++;
$sql = "UPDATE categories
        SET sub_count=$sub_count
        WHERE name='$categ_selected'";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$sql = "INSERT INTO subcategories ".
       "(name,title,description,permission) ".
       "VALUES ".
       "('$sub_name','$sub_title','$sub_description','$sub_permission')";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

echo "Subcategory".$sub_title." added successfully";
}
//EDIT CATEGORY FORM
elseif(!empty($_GET['edit_category']))
{
$categ_selected=$_GET['select_categories'];            //SELECTED CATEGORU FOR EDIT
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                                             //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
}
$sql = "select* FROM categories
        WHERE name='$categ_selected'";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$row = mysql_fetch_array($retval);
$categ_title=$row['title'];
$categ_description=$row['description'];
$categ_permission=$row['permission'];
mysql_close($conn);                       //CLOSE DATABASE CONNECTION


?>
<!--***********************EDIT CATEGORY FORM************-->

<form name="edit_categories" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<label>Category name<input name="categ_name" readonly="yes" size="7" type="text" value="<?php echo $categ_selected; ?>"></input>
<label>Category title<input name="categ_title" type="text" value="<?php echo $categ_title; ?>"></input><br>
<label>Category description<textarea name="categ_description">
<?php echo $categ_description; ?>
</textarea><br>
<label>Category permission<textarea name="categ_permission">
<?php echo $categ_permission; ?>
</textarea><br>

<input name="edit_categ" type="submit" value="Edit"></input><br>
</form>

<!--***********************SUBCATEGORIES OF SELECTED CATEGORY************-->
<table>
<tr>
<td>
<form name="edit_subcategories_form" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<select name="select_subcategories" required="yes">
<option value="">Subcategories</option> 
<?php
//CONNECT TO DATABASE
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                                             //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
}
$sql = "select* FROM subcategories
        WHERE name LIKE '%$categ_selected%'";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
$sub_categ=explode("^",$row['name']);
mysql_close($conn);
?>
<option value="<?php echo $sub_categ; ?>"><?php echo $row['title']; ?></option>
<?php
}
?>
</select>
<td>
<input type="submit" name="edit_subcategory" value="Sub-Edit"></input>
<!--*********************ADD SUBCATEGORY ITEM: Formm and button for adding a subcategory item**********-->
<td>
<input name="add_subcategory_item" value="Sub-add-Item" type="submit"></input>
<input name="add_subcategory" value="Add - Sub" type="submit"></input>
<input name="delete_subcategory" value="Delete - Sub" type="submit"></input>

<</form>
</tr>
</table>
<?php
}
//EDIT CATEGORY
elseif(!empty($_GET['edit_categ']))
{
$categ_e_name=$_GET['categ_name'];
$categ_e_title=$_GET['categ_title'];
$categ_e_desc=$_GET['categ_description'];
$categ_e_perm=$_GET['categ_permission'];
$dbhost = 'fdb3.biz.nf:3306';                            //HOST NAME
$dbuser = '1542957_ec';                                            //USER USERNAME
$dbpass = '19gag571d';                              //USER PASSWORD
$conn = mysql_connect($dbhost, $dbuser, $dbpass);               //CREATE CONNECTION
if(! $conn )                                                                             //IF CONNECTION FAILED ERROR
{
  die('Could not connect: ' . mysql_error());
}
$sql = "UPDATE categories
        SET title='$categ_e_title',description='$categ_e_desc',permission='$categ_e_perm'
        WHERE name='$categ_e_name'";
mysql_select_db('1542957_ec');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
echo $categ_e_name." Edited successfully"; 
}
}
?>
</div>
<!--*************The end of page main content****************-->

<!--*************The page right bar****************-->
<div id="right_bar">
This is a right bar
</div>
<!--*************The end of page right bar****************-->
</div>
<!--*************The end of page main section****************-->

<!--*************The page bottom section bar****************-->
<div id="page_bottom">
<h2>This is a bottom part of the page</h2>
</div>
<!--*************The end of page bottom section ****************-->

<!--*************The page footer****************-->
<div id="page_footer">
<h4>This is a footer</h4>
</div>
<!--*************The end of page footer****************-->
</div>
<!--*************The end of page container****************-->
</body>
</html>
