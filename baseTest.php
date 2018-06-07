<?php
class fileGrabber
{
   
    
    public function readFile()
    {
        $row = 1;
        if (($handle = fopen("test.csv", "r")) !== FALSE) 
        {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) 
            {
                $num = count($data);
                if ($num > 3)
                {
                echo "improper data format";
                exit();
                }
                $row++;
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . " ";
                }
                echo "\n";
            }
            fclose($handle);
        }
    }
}

?>