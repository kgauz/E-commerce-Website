
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: emailLogin.php");
    exit;
}
?>

<?php include("header_order.php");?>

<?php include("logoutInfor.php");?>
  
<section class="profile-wrapper">
<div class="profileS"> 
   <p>Profile</p>
</div>  
<!-- 
<div class="profile2"> -->
   
 <?php

if (!isset($_SESSION['email'])) {
    echo "<h3>You are not logged in. Please log in first.</h3>";
    exit();
}
?>

<div class="detail1">
    <?php

$email = $_SESSION['email'];
 

 $sql =$conn->query("SELECT * FROM Profile WHERE email = '$email'");

     $count = mysqli_num_rows($sql);

     if($count > 0)
     {
      $rows = mysqli_fetch_assoc($sql);
      $name = $rows['FirstName'];
      $secondName = $rows['SecondName'];

      $fullName = htmlspecialchars($name. " " . $secondName);

     }
     else{
       $fullName = "Name";
     }


 echo '
<div class="detailsName">
    <p>' . $fullName . '</p>
  <div id="editor">
    <svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 -960 960 960" width="15px" fill="#ECB576">
      <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
    </svg>
  </div>
</div>
';
 echo "<p class='email10'> Email </p>";
 echo "<p class='email11'> $email</p>";
 ?>
 </div> <!-- end of details1 -->

 <div class="infor1 backgoundColor" >
  <?php
  $sql4 = $conn->query("SELECT * FROM Profile WHERE email='$email' LIMIT 1");

if ($sql4 && $sql4->num_rows > 0) {
    $rows = $sql4->fetch_assoc();
    $firstName = $rows['FirstName'];
    $secondName = $rows['SecondName'];
    $email = $rows['email'];
}

 echo '
<div class="hiddenForm" > 
<form  method="POST">
    <div class="formDetails">
        <label>Edit Profile</label>
        <div class="closeForm" id="closePage">&times;</div>
        
        <div class="emailName">
            <input type="text" name="firstName" 
                placeholder="First Name" 
                value="' . htmlspecialchars($firstName) . '" required>

            <input type="text" name="secondName" 
                placeholder="Second Name" 
                value="' . htmlspecialchars($secondName) . '" required>

            <input type="email" name="email" 
                placeholder="Email" 
                value="' . htmlspecialchars($email) . '" required>
        </div>
        <div class="formProfile">

        <input class="button1" id ="saveButton"type="submit" name="save" value="Save">
        <input class="button2" id="cancelButton" type="cancel" name="cancel" value="Cancel">
    </div>
    </div>
</form> </div>';

?>

</div> <!-- end of infor1 -->
 <!-- end of profile2 -->


<div class="addressDetail">
  <p id="headerAddress">Address</p>
  <div id="editIcon">
    <p> <span>+ Add</span></p>
     <?php
     $email = $_SESSION['email'];

            $sql3 = $conn->query("SELECT * FROM  Addresses  WHERE email ='$email'");
            if($sql3)
            {
                $count = mysqli_num_rows($sql3);
                if($count > 0)
                {
                  while($rows= mysqli_fetch_assoc($sql3))
                  {
                        $country = $rows['Country'];
                        $firstName = $rows['FirstName'];
                        $lastName = $rows['LastName'];
                        $Address = $rows['Address'];
                        $city = $rows['City'];
                        $province = $rows['Province'];
                        $PostalCode = $rows['PostalCode'];
                        $phone = $rows['Phone'];
                        $suburb = $rows['Suburb'];


                         ?>
                        <div class="showAdress">
                          <p><?php echo  $firstName ." ".$lastName ; ?> </p>
                          <p><?php echo  $Address; ?> </p>
                          <p><?php echo  $province; ?> </p>
                            <p><?php echo  $city; ?> </p>
                          <p><?php echo  $PostalCode; ?> </p>
                            <p><?php echo  $phone; ?> </p>
                             <p><?php echo  $country; ?> </p>
                          <p><?php  if (isset( $suburb)){
                            echo $suburb;
                          }?>


                          </div> <!-- end of showAddress -->

                          <?php
                  }
                }
            }
            else{
                echo $conn->error;
            }
          
          

        
    ?> 

</div> <!-- end of editionIcon -->
 </div> <!-- end of addressDetails -->

</section> <!-- end profile -wrapper -->

  <div class="addressBackgroud">
 
  <div class="customerAddress" id="addressCust">
     <div class="formCloser" id="closeaddress">&times;</div>
       <p>Add address</p>
       <?php
       $country = $firstName = $lastName = $Address = $city = $province = $PostalCode = $phone = $suburb = "";

           $email = $_SESSION['email'];
            $sql5 = $conn->query("SELECT * FROM Addresses WHERE email ='$email' ");

            if($sql5 && $sql5->num_rows >0)
            {
                $rows = mysqli_fetch_assoc($sql5);
                  $country = $rows['Country'];
                  $firstName = $rows['FirstName'];
                  $lastName = $rows['LastName'];
                  $Address = $rows['Address'];
                  $city = $rows['City'];
                  $province = $rows['Province'];
                  $PostalCode = $rows['PostalCode'];
                  $phone = $rows['Phone'];
                  $suburb = $rows['Suburb'];
            }

       
        ?>
          <form id = "addressForm" method="POST">
          <!-- <p>default address </p>
            <input type="radio" name="radio" value="Yes"> -->
            <select name="country" id="country" required>
              <?php if(isset($country))
                     {
                      ?>
                        <option value="<?php echo htmlspecialchars($country); ?>">
                          <?php echo htmlspecialchars($country); ?>
                      </option>
                      <?php
                     }
                     else{
                       ?> <option value ="">Select a Country </option>
                        <?php
                     }
              ?>
              
              <option value="Afghanistan">Afghanistan</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Argentina">Argentina</option>
              <option value="Armenia">Armenia</option>
              <option value="Australia">Australia</option>
              <option value="Austria">Austria</option>
              <option value="Azerbaijan">Azerbaijan</option>
              <option value="Bahamas">Bahamas</option>
              <option value="Bahrain">Bahrain</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Barbados">Barbados</option>
              <option value="Belarus">Belarus</option>
              <option value="Belgium">Belgium</option>
              <option value="Belize">Belize</option>
              <option value="Benin">Benin</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
              <option value="Botswana">Botswana</option>
              <option value="Brazil">Brazil</option>
              <option value="Brunei">Brunei</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Colombia">Colombia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Croatia">Croatia</option>
              <option value="Cuba">Cuba</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="DR Congo">DR Congo</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Eritrea">Eritrea</option>
              <option value="Estonia">Estonia</option>
              <option value="Eswatini">Eswatini</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Georgia">Georgia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Greece">Greece</option>
              <option value="Grenada">Grenada</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guinea">Guinea</option>
              <option value="Guinea-Bissau">Guinea-Bissau</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Honduras">Honduras</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran">Iran</option>
              <option value="Iraq">Iraq</option>
              <option value="Ireland">Ireland</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Jamaica">Jamaica</option>
              <option value="Japan">Japan</option>
              <option value="Jordan">Jordan</option>
              <option value="Kazakhstan">Kazakhstan</option>
              <option value="Kenya">Kenya</option>
              <option value="Kiribati">Kiribati</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Kyrgyzstan">Kyrgyzstan</option>
              <option value="Laos">Laos</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon">Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
              <option value="Libya">Libya</option>
              <option value="Liechtenstein">Liechtenstein</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malawi">Malawi</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mexico">Mexico</option>
              <option value="Moldova">Moldova</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montenegro">Montenegro</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Namibia">Namibia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherlands">Netherlands</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="North Korea">North Korea</option>
              <option value="North Macedonia">North Macedonia</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau">Palau</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Qatar">Qatar</option>
              <option value="Romania">Romania</option>
              <option value="Russia">Russia</option>
              <option value="Rwanda">Rwanda</option>
              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
              <option value="Saint Lucia">Saint Lucia</option>
              <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
              <option value="Samoa">Samoa</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Serbia">Serbia</option>
              <option value="Seychelles">Seychelles</option>
              <option value="Sierra Leone">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="South Korea">South Korea</option>
              <option value="South Sudan">South Sudan</option>
              <option value="Spain">Spain</option>
              <option value="Sri Lanka">Sri Lanka</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syria">Syria</option>
              <option value="Taiwan">Taiwan</option>
              <option value="Tajikistan">Tajikistan</option>
              <option value="Tanzania">Tanzania</option>
              <option value="Thailand">Thailand</option>
              <option value="Togo">Togo</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turkmenistan">Turkmenistan</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="Uganda">Uganda</option>
    <!-- } -->
   
    if (!country) {
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Uzbekistan">Uzbekistan</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Vatican City">Vatican City</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Vietnam">Vietnam</option>
              <option value="Yemen">Yemen</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>}
              
</select>
            <input type="text" name="firstName"  placeholder="First name" value ="<?php echo $firstName ;?>" required>
            <input type="text" name="lastName" placeholder="Last name" value ="<?php echo $lastName ;?>" required>
            <input type ="text" name="Address"  placeholder="Address" value ="<?php echo $Address ;?>" required>   
            <input type ="text" name="suburb"  placeholder="Suburb (optional)" value ="<?php echo $suburb ;?>" >
            <div class="three">
            <input type ="text" name="city"  placeholder="City" value ="<?php echo $firstName ;?>" required>
             <select name="province" id="province" required>
               <?php if (!empty($province)) : ?>
                <option value="<?php echo htmlspecialchars($province); ?>">
                    <?php echo htmlspecialchars($province); ?>
                </option>
            <?php else : ?>
                <option value="">Province</option>
            <?php endif; ?>
              <option value="eastern-cape">Eastern Cape</option>
              <option value="free-state">Free State</option>
              <option value="gauteng">Gauteng</option>
              <option value="kwazulu-natal">KwaZulu-Natal</option>
              <option value="limpopo">Limpopo</option>
              <option value="mpumalanga">Mpumalanga</option>
              <option value="northern-cape">Northern Cape</option>
              <option value="north-west">North West</option>
              <option value="western-cape">Western Cape</option>
            </select>
           <input type ="text" name = "PostalCode"  placeholder="Postal code" value="<?php echo $PostalCode ;?>" required>
           </div > <!-- end of three -->
           <input id="phone" class="errorBox"type="tel" name ="phone" placeholder="Phone Number"  value ="<?php echo $phone ;?>"required>

           <div class="buttonSave">
           <input type="submit" name="saveAddress" value ="Save" required>
           <input type="cancel" id ="cancelButton2" name="cancelAddress" value ="Cancel">
           </div>

        </form>
        
  </div> <!-- end of customerAddress-->
            
</div> <!-- end of addressBackground-->

           

<?php
$name = "";
$surname = "";
$email = "";

if (isset($_POST['save'])) {
  $name = $_POST['firstName'];
  $surname = $_POST['secondName'];
  $email = $_POST['email'];
 $sql = $conn->query("UPDATE Profile SET FirstName = '$name', SecondName = '$surname', email ='$email' WHERE email ='$email' ");
 
 if($sql->num_rows > 0)
 {
     $conn->query("INSERT INTO Profile (FirstName, SecondName, email) VALUES('$name','$surname','$email')");
 }

if ($sql) {
  $_SESSION['firstName'] = $name;
  $_SESSION['secondName'] = $surname;
  $_SESSION['email'] = $email; 

     // header("Location: profile.php" );
    //  exit();
} else {
    echo "Not processed: " . $conn->error;
}


}
else{
     echo " " . $conn->error;
}

?>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
  const iconPen = document.querySelector("#editor");
  const information = document.querySelector(".infor1");
  const closeMenu = document.getElementById("closePage");
  const form = document.querySelector(".hiddenForm");
  const nameDisplay = document.querySelector(".detailsName p");


  if (iconPen && information) {
    iconPen.addEventListener("click", () => {
      information.style.display = "flex";
    });
  } else {
    console.error("Editor or form not found in DOM!");
  }

  if(closeMenu)
  {
    closeMenu.addEventListener("click", ()=>{
        information.style.display = "none";
    })
  }
  else
  {
    console.error("closeMenu or form not found in DOM!");
  }

  const nameInput = document.querySelector('input[name="firstName"]');
  const saveButton = document.querySelector('.button1');


//saveButton.disabled = true;

//const originalName = nameInput.value.trim(); 




}); 

const addressEditor = document.querySelectorAll("#editIcon");
const customerAddres = document.querySelector(".addressBackgroud");

  const closer = document.querySelector(".addressBackgroud");
  const closeAddress = document.getElementById("closeaddress");
addressEditor.forEach(button4 =>{
button4.addEventListener("click", ()=>
{
    customerAddres.style.display = "flex";
     document.body.classList.add("lock-scroll");

});

});


closeAddress.addEventListener("click", ()=>{
  if(closeAddress)
  {
    closer.style.display = "none";
  }
  else{
    console.error("Address not found");
  }
  
});

const phoneInputField = document.querySelector("#phone");


const iti = window.intlTelInput(phoneInputField, {
    initialCountry: "za",
    separateDialCode: true,
    nationalMode: false,
    preferredCountries: ["za", "us", "gb", "au", "in"],
    geoIpLookup: function (callback) {
        callback("za");
    },
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
});

const addressForm = document.querySelector("#addressForm");

addressForm.addEventListener("submit", function(e) {
    if (!iti.isValidNumber()) {
        e.preventDefault();
        alert("Please enter a valid phone number.");
        return;
    }
    
    console.log("Valid number");
});

function validateAddressForm() {
    const first = document.querySelector("[name='firstName']").value.trim();
    const last = document.querySelector("[name='lastName']").value.trim();
    const address = document.querySelector("[name='Address']").value.trim();
    const city = document.querySelector("[name='city']").value.trim();
    const province = document.querySelector("[name='province']").value;
    const postal = document.querySelector("[name='PostalCode']").value.trim();
    const country = document.querySelector("[name='country']").value;
    
    
    const nameRegex = /^[A-Za-z\s'-]{2,40}$/;

    if (!nameRegex.test(first) || !nameRegex.test(last)) {
        alert("Names must contain only letters.");
        return false;
    }

    if (address.length < 5) {
        alert("Please enter a valid street address.");
        return false;
    }

    const cityRegex = /^[A-Za-z\s'-]{2,50}$/;
    if (!cityRegex.test(city)) {
        alert("Please enter a valid city name.");
        return false;
    }

    if (!province) {
        alert("Please select a province.");
        return false;
    }

    const postalRegex = /^[0-9]{4,6}$/;
    if (!postalRegex.test(postal)) {
        alert("Please enter a valid postal code.");
        return false;
    }

    if (!country) {
        alert("Please select a country.");
        return false;
    }

    return true;
}document.querySelector("#editor").addEventListener("click", () => {
    document.querySelector(".hiddenForm").style.display = "flex";
});
document.querySelector("#closePage").addEventListener("click", () => {
    document.querySelector(".hiddenForm").style.display = "none";
});


addressForm.addEventListener("submit", function(e) {
    if (!validateAddressForm()) {
        e.preventDefault();
    }
 
});



const closeWindow = document.querySelector("#cancelButton");
  const closerAddress = document.querySelector(".addressBackgroud");
const informationButton = document.querySelector(".infor1");

closeWindow.addEventListener("click", () =>{
    closerAddress.style.display ="none";
    informationButton.style.display="none";
});

window.addEventListener("DOMContentLoaded", () => {
    const hiddenForm = document.querySelector(".hiddenForm");
    document.body.appendChild(hiddenForm);
});

window.addEventListener("DOMContentLoaded", () => {
    const hiddenForm = document.querySelector(".hiddenForm");
    document.body.appendChild(hiddenForm);
});

document.querySelector("#editor").addEventListener("click", () => {
    document.querySelector(".hiddenForm").style.display = "flex";
});
document.querySelector("#closePage").addEventListener("click", () => {
    document.querySelector(".hiddenForm").style.display = "none";
});


document.querySelectorAll("#cancelButton").forEach(button => {
    button.addEventListener("click", () => {
        document.querySelector(".hiddenForm").style.display = "none";
    });
});

document.querySelectorAll(".saveButton").forEach(button => {
    button.addEventListener("click", () => {
        document.querySelector(".hiddenForm").style.display = "none";
    });
});


window.addEventListener('DOMContentLoaded', () => {
    const addressOverlay = document.querySelector('.addressBackgroud');
    document.body.appendChild(addressOverlay);

    document.querySelector('#cancelButton2').addEventListener('click', (e) => {
        e.preventDefault(); // prevent form submission
        addressOverlay.style.display = 'none';
    });
});

</script>



<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"></script>


</div>

</body>

</html>

<?php

if(isset($_POST['saveAddress']))
{
  $dbFirstName = "";
  $dbLastName ="";
    $country = $_POST['country'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $Address = $_POST['Address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $PostalCode = $_POST['PostalCode'];
    $phone = $_POST['phone'];

    if(isset($_POST['suburb']))
    {
       $suburb = $_POST['suburb'];
    }
    $email = $_SESSION['email'];

  $stmt = $conn->prepare("SELECT email FROM Addresses WHERE email=? LIMIT 1");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $exists = $stmt->get_result()->num_rows > 0;

  if ($exists) {
    
      $stmt = $conn->prepare("
          UPDATE Addresses 
          SET FirstName=?, LastName=?, Province=?, City=?, Phone=?, Suburb=?, PostalCode=?, Country=?, Address=? 
          WHERE email=?
      ");
      $stmt->bind_param("ssssssssss",
          $firstName, $lastName, $province, $city,
          $phone, $suburb, $PostalCode, $country,
          $Address, $email
      );
      $stmt->execute();
      
  } else {
   
      $stmt = $conn->prepare("
          INSERT INTO Addresses
          ( FirstName, LastName, Province, City, Phone, Suburb, PostalCode, Country, Address, email)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");
      $stmt->bind_param("ssssssssss",
           $firstName, $lastName, $province,
          $city, $phone, $suburb, $PostalCode,
          $country, $Address, $email
      );
      $stmt->execute();
  }
    


}
else
{
  echo "" .$conn->error;
}




?>