<?php
require("libraries/send-grid/sendgrid-php.php");

class Functions
{
	 // function to upload files.
   public function uploadFile($file = "",$path="",$size=0,$type="")
    {

        $target_dir = "../uploads/".$path;
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $msg = "";
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (!empty($file['name'])) {
            $check = getimagesize($file["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $msg = "File is not an image.";
                $uploadOk = 0;
            }

            /* Check if file already exists
            if (file_exists($target_file)) {
                $msg = "Sorry, file already exists.";
                $uploadOk = 0;
            }*/
            // Check file size
            if ($file["size"] > 500000) {
                $msg = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $msg = "Sorry, your file was not uploaded.";

            } else {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    $msg = "Sorry, there was an error uploading your file.";
                    return $msg;
                }
            }

        }
    }

	//to send emails using sendgrid

	public  function sendEmail($msg="", $to = "",$toName="", $subject = "")
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("do-not-reply@protrader.africa", "protrader.africa");

        $email->setSubject($subject);
        $email->addTo($to,$toName);
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", $msg
        );

        $sendgrid = new \SendGrid("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");
        try {
            $response = $sendgrid->send($email);
//    print_r($response);die();
            return $response->statusCode();

        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    //New API_WebTV
	public function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){
	   die("Connection Failure");
   }
   curl_close($curl);
   return $result;
}
	//pagination
	public function pagination($link="",$totalPages=0,$page=1)
	{
$link = "$link?page=%d";
$pagerContainer = '<div class="text-center">';   
if( $totalPages != 0 ) 
{
  if( $page == 1 ) 
  { 
    $pagerContainer .= ''; 
  } 
  else 
  { 
    $pagerContainer .= sprintf( '  <a href="' . $link . '" class="btn btn-info btn-sm" >Prev page</a>', $page - 1 ); 
  }
  $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>'; 
  if( $page == $totalPages ) 
  { 
    $pagerContainer .= ''; 
  }
  else 
  { 
    $pagerContainer .= sprintf( ' <a href="' . $link . '" class="btn btn-sm btn-info">  Next page </a>', $page + 1 ); 
  }           
}                   
$pagerContainer .= '</div>';

return $pagerContainer;
	}
}




?>