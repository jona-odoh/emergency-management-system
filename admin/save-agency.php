                            <?php
                            if(isset($mysqli,$_POST['submit'])){
                            $name = mysqli_real_escape_string($mysqli,$_POST['name']);
                            $phone = mysqli_real_escape_string($mysqli,$_POST['phone']);
                            $email = mysqli_real_escape_string($mysqli,$_POST['email']);
                            $personincharge = mysqli_real_escape_string($mysqli,$_POST['personincharge']); 
                            $username = mysqli_real_escape_string($mysqli,$_POST['username']); 
                            $password = mysqli_real_escape_string($mysqli,$_POST['password']); 
                            $state = mysqli_real_escape_string($mysqli,$_POST['state']);   
                            $address = mysqli_real_escape_string($mysqli,$_POST['address']);   
                            $joined = date(" d M Y ");
                            $agency_id = rand(9999999,1000000);    
                            $tmp = rand(1,9999);
                            $file = $_FILES['file'];
                            $fileName =$file['name'];
                            $fileTmpName = $file['tmp_name'];
                            $fileSize = $file['size'];
                            $fileError = $file['error'];
                            $fileType = $file['type'];
                            $fileExt = explode('.', $fileName);
                            $fileActualExt = strtolower(end($fileExt));
                            $allowed = array('jpg','jpeg','png');
    

                            $sql_n = "SELECT * FROM agency WHERE phone ='$phone'";
                            $res_n = mysqli_query($mysqli, $sql_n);    
                            $sql_e = "SELECT * FROM agency WHERE email ='$email'";
                            $res_e = mysqli_query($mysqli, $sql_e);
                            if(mysqli_num_rows($res_e) > 0){
                            ?>
                             <div class="alert alert-danger samuel animated shake" id="sams1">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong> Danger! </strong><?php echo'sorry the email is already allocated to someone';?></div>
                        <?php    
                       }elseif(mysqli_num_rows($res_n) > 0){
                        ?>
                        <div class="alert alert-danger samuel animated shake" id="sams1">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong> Danger! </strong><?php echo'sorry the phone is already allocated to someone';?></div>
                        <?php    
                        }
                    else{      
                  
                $sql = "INSERT INTO agency(name,phone,email,personincharge,username,password,state,address,joined,agency_id,tmp,file)VALUES('$name','$phone','$email','$personincharge','$username','$password','$state','$address','$joined','agency_id','$tmp')";
                $results = mysqli_query($mysqli,$sql);
                if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                if($fileSize < 1000000){
                $fileNameNew = "user".$tmp.".".$fileActualExt;
                $fileDestination ='uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sqli = "INSERT INTO agency(name,tmp)VALUES('$fileNameNew','$tmp')";
                mysqli_query($mysqli,$sqli);
                //header('Location:acc.php');
                    }
                        }
                            }
                        
                        
                        if($results==1){
                              ?>
                        <div class="alert alert-success strover animated bounce" id="sams1">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong> Successfully! </strong><?php echo'Thank you for adding new employee';?></div>
                        <?php

                          }else{
                                ?>
                        <div class="alert alert-danger samuel animated shake" id="sams1">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong> Danger! </strong><?php echo'OOPS something went wrong';?></div>
            
                        <?php    
                          }      
                 }
            }
                
                ?>