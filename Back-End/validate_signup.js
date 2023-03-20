function SignUpForm(event){ 
   var elements = event.currentTarget; 
   var email = elements[0].value; 
   var uname = elements[1].value; 
   var pswd = elements[2].value;//Password
   var pswdr = elements[3].value; //Confirm Password
   var photo = elements[4].value;

   var result = true;    

   var email_v = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
   var uname_v = /^[a-zA-Z0-9_-]+$/;
   var pswd_v  = /^\W*\w*\W+/;
   var pswdr_v  = /^\W*\w*\W+/;

   document.getElementById("email_msg");
   document.getElementById("uname_msg");
   document.getElementById("photo_msg");
   document.getElementById("pswd_msg");
   document.getElementById("pswdr_msg");
   


     //Variables for DOM Manipulation commands
 var textNode;

   if (email==null || email==""||!email_v.test(email) || email.length > 60)
   {   
      //document.getElementById("email_msg").innerHTML="Invalid email address (should be name@somewhere.sth)";
      textNode = document.createTextNode("Invalid email address (should be name@somewhere.sth)");
      email_msg.appendChild(textNode);
      result = false;
    
   }
   if (uname==null || uname==""||!uname_v.test(uname))
   {
      textNode = document.createTextNode("Username should not have any leading or trailing spaces");
      uname_msg.appendChild(textNode);
   }
   

   if (pswd == null || pswd == "") {
     textNode = document.createTextNode("Password is empty.");
     pswd_msg.appendChild(textNode);
     result = false;
     }
   else if (pswd_v.test(pswd) == false) {
     textNode = document.createTextNode("Password is invalid. it must contain at least one non-letter character");
     pswd_msg.appendChild(textNode);
     result = false;
   }
   //if username is too long, report it
   else if(pswd.length != 8){
     textNode = document.createTextNode("Password must be exactly 8 characters.\n");
     pswd_msg.appendChild(textNode);
     result = false;
   }

   
   if (pswdr == null || pswdr == "") {
     textNode = document.createTextNode("Confirm Password is empty.");
     pswdr_msg.appendChild(textNode);
     result = false;
     }
     else if (pswd_v.test(pswdr) == false) {
       textNode = document.createTextNode(" Confrim Password is invalid. it must contain at least one non-letter character");
       pswdr_msg.appendChild(textNode);
       result = false;
     }
   //if Password is too long, report it
   else if(pswd != pswdr){
           textNode = document.createTextNode("Password must be the same.\n");
           pswdr_msg.appendChild(textNode);
           result = false;
   }
 


   if (photo==null || photo=="")
   {
     textNode = document.createTextNode("Please upload a photo");
     photo_msg.appendChild(textNode);
      result = false;
      
      
   }

   if(result == false )
   {    
      event.preventDefault();
   }
}