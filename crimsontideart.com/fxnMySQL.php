<?php
    if ($con = @mysql_connect("localhost", "framed_framed", "stoprich"))
      @mysql_select_db("framed_artcart")
        or print(jsError("index", "Invalid Table"));
    else
      print(jsError("index", "Database Connection Failed"));

?>