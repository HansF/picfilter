
<?php
// On Windows:
if (disk_total_space("d:")>1) echo "we hace d";
if (disk_total_space("f:")>1) echo "we hace f";
if (disk_total_space("g:")>1) echo "we hace g";
if (disk_total_space("C:")>1) echo "we hace c";

 phpinfo();

?>