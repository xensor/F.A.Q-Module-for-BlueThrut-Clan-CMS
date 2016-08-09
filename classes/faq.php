<?php

class faq Extends Basic
{
  public function __construct($sqlConnection)
  {

    $this->mysql = $sqlConnection;
    $this->main_root = $GLOBALS['MAIN_ROOT'];


  }
  public function faq_list()
  {
    $doom = $this->mysql->query("SELECT * FROM faq_cat ORDER BY title ASC");
    if ($doom->num_rows > 0) {

      while ($row = $doom->fetch_array()) {

        echo"<table class='formTable'>
        <tr>
        <td class='formTitle' align='center' colspan='4' style='width: 5%; height: 14px'>$row[title]</td>
        </tr><tr>
        <td class='main' colspan='4'>";

        $faq = $this->mysql->query("SELECT * FROM faq WHERE cat_id='$row[faqid]' ORDER BY title ASC");
        if ($faq->num_rows > 0) {


          while ($rows = $faq->fetch_array()) {
            $tab[] = $rows;

            echo"<section class='faq-section'>
            <input type='checkbox' id='q1'>
            <label for='q1'>
            $rows[title]
            </label>
            <p>
            $rows[message]
            </p>
            <p>
            $rows[answer]
            </p>
            </section>";
          }
        }
        else {


          echo"<section class='faq-section'>
          <input type='checkbox' id='q1'>
          <label for='q1'>
          Error
          </label>
          <p>
          Nothing Found
          </p>
          <p>
          Sorry right now we have not gotten to making the f.a.q page fully.
          </p>
          </section>";
        }
        echo"</td>
        </tr>
        </table>";
      }
    }
    else {
      echo"<section class='faq-section'>
      <input type='checkbox' id='q1'>
      <label for='q1'>
      Error
      </label>
      <p>
      Nothing Found
      </p>
      <p>
      Sorry right now we have not gotten to making the f.a.q page fully.
      </p>
      </section>";
    }
  }
  public function show_faq($cID, $dID)
  {

    $query = $this->mysql->query('select * from faq_cat ORDER BY title ASC');
    if ($query->num_rows > 0) {
      while ($row = $query->fetch_array()) {

        echo"<table class='formTable'>

        <tr>

        <td class='formTitle' align='center' colspan='100'>$row[title] <a href='".MAIN_ROOT."/members/console.php?cID=229'>Create Faq </a></td>

        </tr>

        <tr>

        <td class='formTitle' align='center' style='width: 5%; height: 14px'>title</td>

        <td class='formTitle' align='center' style='width: 5%; height: 14px'>Options</td>

        </tr>";

        $rules = $this->mysql->query("SELECT * FROM faq WHERE cat_id = '$row[faqid]'") or die($mysqli->error);

        if ($rules->num_rows > 0) {

          while ($rows = $rules->fetch_array()) {

            echo"<tr>

            <td class='main' align='center'>$rows[title]</td>

            <td class='main' align='center'><a href='".MAIN_ROOT."/members/console.php?cID=$cID&rID=$rows[faq_id]'>Edit</a> <a href='".MAIN_ROOT."/members/console.php?cID=$dID&rID=$rows[faq_id]'>Delete</a></tr>";

          }



        }

        else {

          /* determine number of rows result set */

          $row_cnt = $rules->num_rows;





          echo"<tr>

          <td class='main' colspan='4' align='center'>Sorry $row_cnt found</td>

          </tr>";

        }

        echo "</table> <br/>";

      }
    }
    else {
      echo"sorry nothing Found";
    }
  }

  public function create_faq()
  {
    echo"
    <div class='formDiv'>





    Use the form below to modify your website's Rules.<br><br>



    <div class='errorDiv' id='errorDiv' style='display: none'>

    <strong>

    Unable to save website settings because the following errors occurred:

    </strong><br><br>

    <span id='errorMessage'>

    </span>

    </div>



    <table class='formTable'>

    <tr>

    <td class='formLabel'>

    Title:

    </td>

    <td class='main'>

    <input type='text' id='ruletitle' name='ruletitle'   class='textBox' style='width: 50%'>

    </td>

    </tr>

    <tr>

    <td class='formLabel'>

    Message:

    </td>

    <td class='main'>

    <textarea class='textBox' id='rulemessage' name='rulemessage' style='width:100%;'></textarea>

    </td>

    </tr>

    <tr>

    <td class='formLabel'>

    Answer:

    </td>

    <td class='main'>

    <textarea class='textBox' id='ruleanswer' name='ruleanswer' style='width:100%;'></textarea>

    </td>

    </tr>

    <tr>

    <td class='formLabel'>

    Category:

    </td>

    <td class='main'>

    <select id='rulecat' class='textBox' name='rulecat'>";

    $query = $this->mysql->query("SELECT * FROM faq_cat");

    while ($row = $query->fetch_array()) {

      echo"<option value='$row[faqid]'>$row[title]</option>";

    }
    echo"
    </select>

    </td>

    </tr>

    </table>



    <table class='formTable' style='margin-top: 0px'>



    <tr>

    <td class='main' align='center' colspan='2'>

    <br><br>

    <input type='button' class='submitButton' id='btnSaveSettings' value='Save'>

    </td>

    </tr>





    <tr>

    <td colspan='2' align='center'>

    <p align='center' class='main'>

    <span id='loadingspiral' style='display: none'>

    <br><img src='".MAIN_ROOT."themes/".THEME."/images/loading-spiral2.gif' style='margin-bottom: 5px'><br>

    <i>

    Saving...

    </i>

    </span>

    <span id='saveMessage'>

    </span>

    </p>

    </td>

    </tr>

    </table>";
  }
  public function edit_faq($rID)
  {
    $query = $this->mysql->query("SELECT * FROM faq WHERE faq_id='$rID'");
    $row   = $query->fetch_array();
    echo"
    <table class='formTable'>

    <tr>

    <td class='formLabel'>

    Title:

    </td>

    <td class='main'>

    <input type='text' value='$row[title]' id='ruletitle' name='ruletitle'   class='textBox' style='width: 50%'>

    </td>

    </tr>

    <tr>

    <td class='formLabel'>

    Message:

    </td>

    <td class='main'>

    <textarea class='textBox' id='rulemessage' name='rulemessage' style='width:100%;'>$row[message]</textarea>

    </td>

    </tr>

    <tr>

    <td class='formLabel'>

    Answer:

    </td>

    <td class='main'>

    <textarea class='textBox' id='ruleanswer' name='ruleanswer' style='width:100%;'>$row[answer]</textarea>

    </td>

    </tr>

    <tr>

    <td class='formLabel'>

    Category:

    </td>

    <td class='main'>

    <select id='rulecat' class='textBox' name='rulecat'>";

    $query = $this->mysql->query("SELECT * FROM faq_cat");

    while ($rows = $query->fetch_array()) {
      echo"<option value='$rows[faqid]' ";
      if ($rows['faqid'] == $row['cat_id']) {
        echo"SELECTED>$rows[title]</option>\r\n";
      }
      else {
        echo">$rows[title]</option>\r\n";
      }

    } echo"

    </select>

    </td>

    </tr>

    </table>



    <table class='formTable' style='margin-top: 0px'>



    <tr>

    <td class='main' align='center' colspan='2'>

    <br><br>
    <input type='text' hidden value='$row[faq_i]' id='ruleid' name='ruleid' />

    <input type='button' class='submitButton' id='btnSaveSettings' value='Save'>

    </td>

    </tr>";

  }
  public function delete_faq($rID)
  {
    $query = $this->mysql->query("SELECT * FROM faq WHERE faq_id = '$rID'");
    if ($query->num_rows > 0) {
      $delete = "DELETE FROM faq WHERE faq_id = '$rID'";
      if ($this->mysql->query($delete) === true) {
        echo "removed successfully";
      }
      else {
        echo $this->mysql->error;
      }
    }
  }
  public function faq_cat()
  {
    $query = $this->mysql->query('select * from faq_cat ORDER BY title ASC') or die($this->mysql->error);
    echo"<table class='formTable'>

    <tr>

    <td class='formTitle' align='center' colspan='100'>Faq Categories <a href='".MAIN_ROOT."members/console.php?cID=230'>Create Faq Category</td>

    </tr>

    <tr>

    <td class='formTitle' align='center' style='width: 5%; height: 14px'>title</td>

    <td class='formTitle' align='center' style='width: 5%; height: 14px'>Options</td>

    </tr>";

    while ($rows = $query->fetch_array()) {



      echo"<tr>

      <td class='main' align='center'>$rows[title]</td>

      <td class='main' align='center'><a href='".MAIN_ROOT."members/console.php?cID=233&rID=$rows[faqid]'>Edit</a> <a href='".MAIN_ROOT."members/console.php?cID=234&rID=$rows[faqid]'>Delete</a></tr>";



    }

    echo "</table> <br/>";
  }
  public function create_cat()
  {
    echo"<div class='formDiv'>


    Use the form below to modify your website's Rules.<br><br>

    <div class='errorDiv' id='errorDiv' style='display: none'>
    <strong>
    Unable to save website settings because the following errors occurred:
    </strong><br><br>
    <span id='errorMessage'>
    </span>
    </div>

    <table class='formTable'>
    <tr>
    <td class='formLabel'>
    Title:
    </td>
    <td class='main'>
    <input type='text' id='ruletitle' name='ruletitle'   class='textBox' style='width: 50%'>
    </td>
    </tr>

    </table>

    <table class='formTable' style='margin-top: 0px'>

    <tr>
    <td class='main' align='center' colspan='2'>
    <br><br>
    <input type='button' class='submitButton' id='btnSaveSettings' value='Save'>
    </td>
    </tr>


    <tr>
    <td colspan='2' align='center'>
    <p align='center' class='main'>
    <span id='loadingspiral' style='display: none'>
    <br><img src='".MAIN_ROOT."themes/".THEME."/images/loading-spiral2.gif' style='margin-bottom: 5px'><br>
    <i>
    Saving...
    </i>
    </span>
    <span id='saveMessage'>
    </span>
    </p>
    </td>
    </tr>
    </table>



    </div>";
  }
  public function edit_cat($rID)
  {
    $query = $this->mysql->query("SELECT * FROM faq_cat WHERE faqid = '$rID'");
    $row   = $query->fetch_array();
    echo"<div class='formDiv'>


    Use the form below to modify your website's Rules.<br><br>

    <div class='errorDiv' id='errorDiv' style='display: none'>
    <strong>
    Unable to save website settings because the following errors occurred:
    </strong><br><br>
    <span id='errorMessage'>
    </span>
    </div>

    <table class='formTable'>
    <tr>
    <td class='formLabel'>
    Title:
    </td>
    <td class='main'>
    <input type='text' id='ruletitle' value='$row[title]' name='ruletitle'   class='textBox' style='width: 50%'>
    </td>
    </tr>

    </table>

    <table class='formTable' style='margin-top: 0px'>

    <tr>
    <td class='main' align='center' colspan='2'>
    <br><br>
    <input type='text' hidden value='$row[faqid]' id='ruleid' name='ruleid'/>
    <input type='button' class='submitButton' id='btnSaveSettings' value='Save'>
    </td>
    </tr>


    <tr>
    <td colspan='2' align='center'>
    <p align='center' class='main'>
    <span id='loadingspiral' style='display: none'>
    <br><img src='".MAIN_ROOT."themes/".THEME."/images/loading-spiral2.gif' style='margin-bottom: 5px'><br>
    <i>
    Saving...
    </i>
    </span>
    <span id='saveMessage'>
    </span>
    </p>
    </td>
    </tr>
    </table>



    </div>";
  }
  public function delete_cat($rID)
  {
    $query = $this->mysql->query("SELECT * FROM faq_cat WHERE faqid = '$rID'");
    if ($query->num_rows > 0) {
      $delete = "DELETE FROM faq_cat WHERE faqid = '$rID'";
      if ($this->mysql->query($delete) === true) {
        echo "removed successfully";
      }
      else {
        echo $this->mysql->error;
      }
    }
  }
}
?>
