<h1>Shipping Address</h1>
   <table cellspacing="3" cellpadding="3"  width="100%" class="table">
      <tr>
        <td>First Name</td>
        <td><input type="text" name="ship_first_name" id="ship_first_name" value="<?=$_REQUEST['ship_first_name']?>" class="form-control" required/></td>
      </tr>
      <tr>
        <td>Last Name</td>
        <td><input type="text" name="ship_last_name" id="ship_last_name" value="<?=$_REQUEST['ship_last_name']?>" class="form-control" required/></td>
      </tr>
      <tr>
        <td>Address Line 1</td>
        <td><input type="text" name="ship_adress1" id="ship_adress1" value="<?=$_REQUEST['ship_adress1']?>" class="form-control" required/>
        </td>
      </tr>
      <tr>
        <td>Address Line 2</td>
        <td><input type="text" name="ship_adress2" id="ship_adress2"  value="<?=$_REQUEST['ship_adress2']?>" class="form-control"/>
        </td>
      </tr>
      <tr>
        <td>Zip code</td>
        <td><input type="text" name="ship_zip_code" id="ship_zip_code" value="<?=$_REQUEST['ship_zip_code']?>" class="form-control" required/>
        </td>
      </tr>
      <tr>
        <td>District/City</td>
        <td><input type="text" name="ship_city" id="ship_city" value="<?=$_REQUEST['ship_city']?>" class="form-control" required/>
        </td>
      </tr>
      <tr>
        <td>State</td>
        <td><input type="text" name="ship_state" id="ship_state" value="<?=$_REQUEST['ship_state']?>" class="form-control"/>
        </td>
      </tr>
      <tr>
        <td>Country</td>
        <td><input type="text" name="ship_country" id="ship_country" value="<?=$_REQUEST['ship_country']?>" class="form-control" required/>
        </td>
      </tr>
      <tr>
        <td>Cell Phone</td>
        <td><input type="text" name="ship_contact_phone" id="ship_contact_phone" value="<?=$_REQUEST['ship_contact_phone']?>" class="form-control" required/>
        </td>
      </tr>
   </table>