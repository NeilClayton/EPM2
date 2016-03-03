
<form class="col-md-8 col-md-offset-2 col-sm-12" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >

        <div class="whiteOpacity">
            <fieldset>
            <h1>Add Property to Portfolio</h1>

            <label for propertyref class = "col-md-2 col-md-offset-2 col-sm-12" >Property Ref</label><input class="col-md-6 col-sm-12" type = "text" name="propertyref" size="50" autofocus>
            <br><br>
            <label for address1 class="col-md-2 col-md-offset-2 col-sm-12" >Address</label><input class="col-md-6 col-sm-12" type = "text" name="address1" size="50">
            <br><br>
            <label for address2 class="col-md-2 col-md-offset-2 col-sm-12"></label><input class="col-md-6 col-sm-12" type = "text" name="address2" size="50">
            <br><br>
            <label for town class="col-md-2 col-md-offset-2 col-sm-12">Town</label><input class="col-md-6 col-sm-12" type = "text" name="town" size="50">
            <br><br>
            <label for county class="col-md-2 col-md-offset-2 col-sm-12">County</label><input class="col-md-6 col-sm-12" type = "text" name="county" size="50">
            <br><br>
            <label for postcode class="col-md-2 col-md-offset-2 col-sm-12">Postcode</label><input class="col-md-6 col-sm-12" type = "text" name="postcode" size="50">
            <br><br>
            <label for tel class="col-md-2 col-md-offset-2 col-sm-12">Tel</label><input class="col-md-6 col-sm-12" type = "text" name="tel" size="50">
            <br><br>
            <label for fax class="col-md-2 col-md-offset-2 col-sm-12">Fax</label><input class="col-md-6 col-sm-12" type = "text" name="fax" size="50">
            <br><br>
            <label for email class="col-md-2 col-md-offset-2 col-sm-12">Email</label><input class="col-md-6 col-sm-12" type = "text" name="email" size="50">
            <br><br>
            <input type="checkbox" name="addProperty" value="addProperty" required> &nbsp; Tick to confirm details are correct
            <br><br>
            <input class="AddBtn" type="submit" value="Add" name="submit">

            </fieldset>
            </div>
</form>



