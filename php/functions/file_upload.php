<?php

function fileUploadPet($picture){ // file upload pets

    if($picture['error'] == 4){ // Checks if an error with code 4 occurred during the file upload.
                                // Error code 4 (UPLOAD_ERR_NO_FILE) means no file was selected by the user.
        $pictureName = "pet.jpg"; // If no file was selected, a default image name is assigned.
        $message = "No picture has been selected, but you can upload one later.";
    } else {
        $checkImage = getimagesize($picture["tmp_name"]);  // If a file was selected, it checks if the uploaded file is indeed an image.
                                                           // getimagesize() returns false if the file is not a valid image.
        $message = $checkImage ? "OK" : "Not an Image";    // Sets the message based on the result of getimagesize().
                                                           // If it's an image, the message is "OK"; otherwise, it's "Not an Image".
    }

    if($message == "OK"){  // Proceeds only if the previous validation was successful (i.e., it's a valid image or no file was selected).
        
        $ext = strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION)); // Extracts the file extension of the uploaded image (e.g., "jpg", "png").
                                                                           // strtolower() converts it to lowercase.
                                                                           // pathinfo() with PATHINFO_EXTENSION returns only the file extension.
        $pictureName = uniqid("") . "." . $ext;    // Generates a unique filename to prevent naming conflicts.
                                                   // uniqid("") creates a unique ID, which is then combined with the file extension.                       

        $destination = "../img/{$pictureName}";     // Defines the full destination path where the file will be moved.
                                                    // "../img/" refers to a directory named 'img' one level up from the current script.
                                                    // The generated $pictureName is appended.
        move_uploaded_file($picture['tmp_name'], $destination);  // Moves the temporarily uploaded file (from the server's temp directory)
                                                                 // to its final permanent location within the 'img' folder.
    }
    
    return [$pictureName, $message];  // Returns an array containing the final picture name and the status message.
                                      // Example: ['new_filename.jpg', 'OK'] or ['media.png', 'No picture selected...']
}

   function fileUploadUser($picture){ // file upload user

       if($picture["error"] == 4){ // checking if a file has been selected, it will return 0 if you choose a file, and 4 if you didn't
           $pictureName = "avatar.png"; // the file name will be product.png (default picture for a product)
           $message = "No picture has been chosen, but you can upload an image later :)";
       }else{
           $checkIfImage = getimagesize($picture["tmp_name"]); // checking if you selected an image, return false if you didn't select an image
           $message = $checkIfImage ? "Ok" : "Not an image";
       }

       if($message == "Ok"){
           $ext = strtolower(pathinfo($picture["name"],PATHINFO_EXTENSION)); // taking the extension data from the image
           $pictureName = uniqid(""). "." . $ext; // changing the name of the picture to random string and numbers
           $destination = "pictures/{$pictureName}"; // where the file will be saved
           move_uploaded_file($picture["tmp_name"], $destination); // moving the file to the pictures folder
       }

       return [$pictureName, $message]; // returning the name of the picture and the message
   }

?>


