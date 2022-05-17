<?php
echo"<br>";

//Check if user hit submit button
if(isset($_POST['submit'])){
    //variables to get picture info
    $file = $_FILES['file'];
    $file2 = $_FILES['file2'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileName2 = $file2['name'];
    $fileTmpName2 = $file2['tmp_name'];
    $fileSize2 = $file2['size'];
    $fileError2 = $file2['error'];
    $fileType2 = $file2['type'];
    $suceed=0;

    //get file ext so that we can check if it is JPG photo
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $fileExt2 = explode('.', $fileName2);
    $fileActualExt2 = strtolower(end($fileExt2));    

    //variable to see if it is .csv extension file
    $allowed = array('jpeg','.jpg', '.jpeg', 'jpg');



    //Check if file is within $allowed files
    if($fileError === 0){
        //Check if there was no upload errors
        if(in_array($fileActualExt, $allowed)){

                //Move file to desired destination and upload
                $fileDest = "upload/".$fileName;
                move_uploaded_file($fileTmpName, $fileDest);
                $suceed= $suceed+1;
                echo "<br>Your file $fileName has been uploaded successfully!";
                //Else to output why file failed to upload
            }else{
            echo "You can only upload jpg photos!";
            }
    }else{
        echo "There was an error uploading photo 1";
    }

    if($fileError2 === 0){
        //Check if there was no upload errors
        if(in_array($fileActualExt2, $allowed)){

                //Move file to desired destination and upload
                $fileDest2 = "upload/".$fileName2;
                move_uploaded_file($fileTmpName2, $fileDest2);
                $suceed=$suceed+2;
                echo "<br>Your file $fileName2 has been uploaded successfully!";
                //Else to output why file failed to upload
            }else{
            echo "You can only upload JPG photos";
            }
    }else{
        echo "<br>There was an error uploading photo 2";
    }


    //Run php if both photos were uploaded for picture 1
   if($suceed == 3){
    //Read picture data
    $exif = exif_read_data($fileDest, 0, true);

    //parse picture data
    $width = $exif['COMPUTED']['Width'];
    $height= $exif['COMPUTED']['Height'];
    $brand = $exif["IFD0"]["Make"];
    $model = $exif["IFD0"]["Model"];
    $software = $exif["IFD0"]["Software"];
    $aperture = convertToDecimal($exif["EXIF"]["ApertureValue"]);
    $meterMode = $exif['EXIF']['MeteringMode'];
    $focalLength = convertToDecimal($exif['EXIF']['FocalLength']);
    $exposureTime = convertToDecimal($exif['EXIF']['ExposureTime']);
    $orientation = $exif['IFD0']['Orientation'];
    $latRef = $exif['GPS']['GPSLatitudeRef'];
    $lat = $exif['GPS']['GPSLatitude'];
    $long = $exif['GPS']['GPSLongitude'];
    $longRef = $exif['GPS']['GPSLongitudeRef'];
    $alt = convertToDecimal($exif['GPS']['GPSAltitude']);
    $altRef = $exif['GPS']['GPSAltitudeRef'];
    $direct = convertToDecimal($exif['GPS']['GPSImgDirection']);
    $directRef = $exif['GPS']['GPSImgDirectionRef'];
    $date = $exif['EXIF']['DateTimeOriginal'];

    //convert latitude data to actual latitude
    $latdeg = convertToDecimal($lat[0]);
    $latmin = convertToDecimal($lat[1]);
    $latsec = convertToDecimal($lat[2]);

    $longdeg = convertToDecimal($long[0]);
    $longmin = convertToDecimal($long[1]);
    $longsec = convertToDecimal($long[2]);   
    //lat long formula 
    if($latRef =='W' || $latRef == 'S')
        $lat = ($latdeg + ($latmin/60) + ($latsec/3600))*-1;
    else
        $lat = ($latdeg + ($latmin/60) + ($latsec/3600));

    if($longRef =='W' || $longRef == 'S')
        $long = ($longdeg + ($longmin/60) + ($longsec/3600))*-1;
    else
        $long = $longdeg + ($longmin/60) + ($longsec/3600);
    echo "<br>";

    //output data
    echo "<br>Width: $width Height: $height";
    echo "<br>Brand: $brand";
    echo "<br>Model: $model";
    echo "<br>EXIF version: $software";
    echo "<br>Aperture: $aperture";
    echo "<br>Metering Mode: $meterMode";
    echo "<br>Focal Length: $focalLength";
    echo "<br>Exposure time: $exposureTime";
    echo "<br>Orientation: $orientation";
    echo "<br>Latitude: $lat Ref: $latRef";
    echo "<br>Longitude: $long Ref: $longRef";
    echo "<br>Altitude: $alt Ref: Sea Level";
    echo "<br>Direction: $direct Ref: $directRef";
    echo "<br>Date: $date";


   } 

   echo "<br><hr>";

   //picture 2 
    if($suceed == 3){
        $exif = exif_read_data($fileDest2, 0, true);
        $width = $exif['COMPUTED']['Width'];
        $height= $exif['COMPUTED']['Height'];
        $brand = $exif["IFD0"]["Make"];
        $model = $exif["IFD0"]["Model"];
        $software = $exif["IFD0"]["Software"];
        $aperture = convertToDecimal($exif["EXIF"]["ApertureValue"]);
        $meterMode = $exif['EXIF']['MeteringMode'];
        $focalLength = convertToDecimal($exif['EXIF']['FocalLength']);
        $exposureTime = convertToDecimal($exif['EXIF']['ExposureTime']);
        $orientation = $exif['IFD0']['Orientation'];
        $latRef2 = $exif['GPS']['GPSLatitudeRef'];
        $lat2 = $exif['GPS']['GPSLatitude'];
        $long2 = $exif['GPS']['GPSLongitude'];
        $longRef2 = $exif['GPS']['GPSLongitudeRef'];
        $alt = convertToDecimal($exif['GPS']['GPSAltitude']);
        $altRef = $exif['GPS']['GPSAltitudeRef'];
        $direct2 = convertToDecimal($exif['GPS']['GPSImgDirection']);
        $directRef2 = $exif['GPS']['GPSImgDirectionRef'];
        $date = $exif['EXIF']['DateTimeOriginal'];

        // lat and long conversion
    $latdeg2 = convertToDecimal($lat2[0]);
    $latmin2 = convertToDecimal($lat2[1]);
    $latsec2 = convertToDecimal($lat2[2]);

    $longdeg2 = convertToDecimal($long2[0]);
    $longmin2 = convertToDecimal($long2[1]);
    $longsec2 = convertToDecimal($long2[2]);    

    //lat long formula
    if($latRef2 =='W' || $latRef2 == 'S')
        $lat2 = ($latdeg2 + ($latmin2/60) + ($latsec2/3600))*-1;
    else
        $lat2 = ($latdeg2 + ($latmin2/60) + ($latsec2/3600));

    if($longRef2 =='W' || $longRef2 == 'S')
        $long2 = ($longdeg2 + ($longmin2/60) + ($longsec2/3600))*-1;
    else
        $long2 = $longdeg2 + ($longmin2/60) + ($longsec2/3600);

    //output info
    echo "<br>Width: $width Height: $height";
    echo "<br>Brand: $brand";
    echo "<br>Model: $model";
    echo "<br>EXIF version: $software";
    echo "<br>Aperture: $aperture";
    echo "<br>Metering Mode: $meterMode";
    echo "<br>Focal Length: $focalLength";
    echo "<br>Exposure time: $exposureTime";
    echo "<br>Orientation: $orientation";
    echo "<br>Latitude: $lat2 Ref: $latRef2";
    echo "<br>Longitude: $long2 Ref: $longRef2";
    echo "<br>Altitude: $alt Ref: Sea Level";
    echo "<br>Direction: $direct2 Ref: $directRef2";
    echo "<br>Date: $date";

    //call function to calc distance and view

    calcDist($lat, $long, $lat2, $long2);
    calcView($direct, $direct2);

   }   



 }
   //convert string fraction to decimal
    function convertToDecimal ($fraction)
    {
        $numbers=explode("/",$fraction);
        return round($numbers[0]/$numbers[1],20);
    }

    //calculate view angles
    function calcView($deg1, $deg2){
        $dif=0;

        if($deg1>$deg2)
            $dif=$deg1-$deg2;
        else
            $dif=$deg2-$deg1;

        if($dif<=60)
            echo "<br>The two photos are facing at similar direction and possibly have overlapped view.";
        else if($dif<=120)
            echo "<br>Although the two photos face different diractions, they might have overlapped view.";
        else
            echo "<br>The two photos are facing at opposite direction and NO overlapped view.";



    }
    //calculate distace between photos using formulas
    function calcDist($lat1, $long1, $lat2, $long2){
        //convert to rad
        $latRad1 = deg2rad($lat1);
        $latRad2 = deg2rad($lat2);
        $longRad1 = deg2rad($long1);
        $longRad2 = deg2rad($long2);

        //insert into formula
        $dist = 3963.0*acos((sin($latRad1)*sin($latRad2))+cos($latRad1)*cos($latRad2)*cos(($longRad2-$longRad1)));
        $dist = round(($dist * 1.609344),2);

        echo"<br> <br> Distance between the two photos: $dist Km ";

    }


?>
