<?php
//$err = error_reporting(-1);
date_default_timezone_set("Asia/Jakarta");  // this is required to run phpinfo()
//phpinfo();

//--------- first extract the word document to a folder called "here"------------
// But, must remove the folder "here" first if already exist to ensure "clean" directory "here"
// remove folder "here" using recursive function
$fname = 'Tinjauan 1.docx';
$dirname = "here";

function rrmdir($src) 
{
$dir = opendir($src);
while(false !== ( $file = readdir($dir)) ) 
   {
   if (( $file != '.' ) && ( $file != '..' )) 
      {
      $full = $src . '/' . $file;
      if ( is_dir($full) ) 
         {
          rrmdir($full);
         }
      else 
         {
          unlink($full);
         }
      }
   }
closedir($dir);
rmdir($src);
}
// if the directory "here" exist, remove it first
if (is_dir($dirname)) rrmdir($dirname);

// ok we can extract now
echo $fname,"<br>";
$za = new ZipArchive;
$r = $za->open($fname);
if ($r!==TRUE) exit("Error : $r");  
echo "filename: " , $za->filename , "<br>";
$za->extractTo($dirname);
$za->close();


//---------------- Second, parse the "document.xml"-----------------

// open the document.xml and parse it

$fname = "./here/word/document.xml";
echo "<p>XML Filename :",$fname,"<br>";

$dom = new DOMDocument;
$dom->preserveWhiteSpace = false;
$dom->load($fname);
$parentNode = $dom->getelementsByTagName('tr'); 
$nx = $parentNode->length; echo "Number of line(node) : ",$nx,"<p>";

// display each node
 foreach ($parentNode as $text)
   {
   echo "<br>",$text->nodeValue;
   } 
echo "<p>";
print_r($parentNode); echo "<p>"; 

$i=0;
while(is_object($parentNode = $dom->getElementsByTagName("tr")->item($i)))
   {
   echo "NODE $i <br>";
   foreach($parentNode->childNodes as $nodename)
      {
      echo $nodename->nodeName." - ".$nodename->nodeValue;  
      // look for subnode "drawing"
      /* foreach($nodename->getElementsByTagName("drawing")->childNodes as $subNodes)
         {
         if ($subNodes->nodeName == 'drawing')
            {
            echo "drawing",$subNodes->nodeName." - ".$subNodes->nodeValue."<br>";
            }
         } */
      echo "<br>";
      }
   $i++; echo "<br>";
   }   



?>
