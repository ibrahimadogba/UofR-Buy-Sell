function SignInForm(event) {
  
    //Assume the form is valid; set to false if any validation tests fail.
    var valid = true;
    
    // TODO: Get field values for all form fields
    var elements = event.currentTarget;
    var email = elements[0].value; //Email
    var pswd = elements[1].value;//Password
    
  
  
    var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    var regex_pswd  = /^\W*\w*\W+/;
  
    var msg_email = document.getElementById("email_msg");
    var msg_pswd = document.getElementById("pswd_msg");
    
   msg_email.innerHTML  = "";
   msg_pswd.innerHTML= ""; 
  
    var textNode;
    
    
    if (email == null || email == "") {
        textNode = document.createTextNode("Email address empty.");
        msg_email.appendChild(textNode);
        valid = false;
      } 
      else if (regex_email.test(email) == false) {
        textNode = document.createTextNode("Email address wrong format. example: username@somewhere.sth");
        msg_email.appendChild(textNode);
        valid = false;
      }
      else if (email.length > 60) {
        textNode = document.createTextNode("Email address too long. Maximum is 60 characters.");
        msg_email.appendChild(textNode);
        valid = false;
      }
   
      if (pswd == null || pswd == "") {
        textNode = document.createTextNode("Password is empty.");
        msg_pswd.appendChild(textNode);
        valid = false;
        }
        else if(pswd.length != 8){
          textNode = document.createTextNode("Password must be exactly 8 characters.\n");
          msg_pswd.appendChild(textNode);
          valid = false;
        }
        else if (regex_pswd.test(pswd) == false) {
          textNode = document.createTextNode("Password is invalid. it must contain at least one non-letter character");
          msg_pswd.appendChild(textNode);
          valid = false;
        }
  
      
  
    
  
      
      if (valid == false) {
      
        event.preventDefault(); 
    
        
    
      }
  
  }
  