function SellCreateForm(event) {
  
  
    //Assume the form is valid; set to false if any validation tests fail.
    var valid = true;
    
    
    var elements = event.currentTarget;
    var selltitle = elements[0].value; //The Question
    var sellauthor = elements[1].value; //The Answer
    var sellisbn = elements[2].value;  
    var price = elements[3].value;
    var sellclassnum = elements[4].value;  
    var sellimage = elements[5].value;  
    var selldescription = elements[8].value; 

    var msg_selltitle = document.getElementById("msg_selltitle");
    var msg_sellauthor= document.getElementById("msg_sellauthor");
    var msg_sellisbn= document.getElementById("msg_sellisbn");
    var msg_price= document.getElementById("msg_price");
    var msg_sellclassnum= document.getElementById("msg_sellclassnum");
    var msg_sellimage= document.getElementById("msg_sellimage");
    var msg_selldescription= document.getElementById("msg_selldescription");

    msg_selltitle.innerHTML   ="";
    msg_sellauthor.innerHTML    ="";
    msg_sellisbn.innerHTML    ="";
    msg_sellclassnum.innerHTML    ="";
    msg_sellimage.innerHTML    ="";
    msg_selldescription.innerHTML    ="";
    msg_price.innerHTML    ="";



var textNode;
    
    
      if (selltitle == null || selltitle == "") {
        textNode = document.createTextNode("Please Type in a Title.");
        msg_selltitle.appendChild(textNode);
        valid = false;
      } 
       else if (selltitle.length > 100) {
        textNode = document.createTextNode("Title is too long. Maximum is 100 characters.");
        msg_selltitle.appendChild(textNode);
        valid = false;
      }

      if (sellauthor == null || sellauthor == "") {
        textNode = document.createTextNode("Please Type in an Author name.");
        msg_sellauthor.appendChild(textNode);
        valid = false;
      } 
       else if (sellauthor.length > 100) {
        textNode = document.createTextNode("Author name is too long. Maximum is 100 characters.");
        msg_sellauthor.appendChild(textNode);
        valid = false;
      }

      if ( sellisbn == null || sellisbn == "") {
        textNode = document.createTextNode("Please Type in an ISBN number.");
        msg_sellisbn.appendChild(textNode);
        valid = false;
      } 
       else if (sellisbn.length > 16) {
        textNode = document.createTextNode("ISBN  is too long. Maximum is 16 characters.");
        msg_sellisbn.appendChild(textNode);
        valid = false;
      }

      if (sellclassnum == null || sellclassnum == "") {
        textNode = document.createTextNode("Please Type in a Class Number.");
        msg_sellclassnum.appendChild(textNode);
        valid = false;
      } 
       else if (sellclassnum.length > 30) {
        textNode = document.createTextNode("Class Number is too long. Maximum is 30 characters.");
        msg_sellclassnum.appendChild(textNode);
        valid = false;
      }

      if (sellimage==null || sellimage=="")
   {
     textNode = document.createTextNode("Please upload a photo");
     msg_sellimage.appendChild(textNode);
     valid = false;
    
   }

   if (selldescription == null || selldescription == "") {
    textNode = document.createTextNode("Please Type in despription for the book.");
    msg_selldescription.appendChild(textNode);
    valid = false;
  } 
   else if (selldescription.length > 700) {
    textNode = document.createTextNode("Class Number is too long. Maximum is 30 characters.");
    msg_selldescription.appendChild(textNode);
    valid = false;
  }

  if (price == null || price == "") {
    textNode = document.createTextNode("Please Type in the price of the book.");
    msg_price.appendChild(textNode);
    valid = false;
  } 
   else if (price.length > 50) {
    textNode = document.createTextNode("Price Number is too long. Maximum is 30 characters.");
    msg_price.appendChild(textNode);
    valid = false;
   }

   if (valid == false) {
        
    event.preventDefault(); 



  }

}

function countChars(event){
    
    // var lng = document.forms.PollCreation.pollquestion.value.length;
     var lngg = event.currentTarget;
      var lng= lngg[0].value.length;
 
    
    if(lng >100)
    {
     document.getElementById("msg_characterscount").innerHTML =  '<span style="color: red;" >' +  lng + ' out of 100 characters';
    }
    else{
     document.getElementById("msg_characterscount").innerHTML = lng + ' out of 100 characters';
    }
    
 
 }

 function countChars_author(event){
    
    // var lng = document.forms.PollCreation.pollquestion.value.length;
     var lngg = event.currentTarget;
      var lng= lngg[0].value.length;
 
    
    if(lng >100)
    {
     document.getElementById("msg_characterscount").innerHTML =  '<span style="color: red;" >' +  lng + ' out of 100 characters';
    }
    else{
     document.getElementById("msg_characterscount").innerHTML = lng + ' out of 100 characters';
    }
    
 
 }

 function countChars_price(event){
    
    // var lng = document.forms.PollCreation.pollquestion.value.length;
     var lngg = event.currentTarget;
      var lng= lngg[0].value.length;
 
    
    if(lng >16)
    {
     document.getElementById("msg_characterscount").innerHTML =  '<span style="color: red;" >' +  lng + ' out of 100 characters';
    }
    else{
     document.getElementById("msg_characterscount").innerHTML = lng + ' out of 100 characters';
    }
    
 
 }

 function countChars_isbn(event){
    
    // var lng = document.forms.PollCreation.pollquestion.value.length;
     var lngg = event.currentTarget;
      var lng= lngg[0].value.length;
 
    
    if(lng >16)
    {
     document.getElementById("msg_characterscount").innerHTML =  '<span style="color: red;" >' +  lng + ' out of 100 characters';
    }
    else{
     document.getElementById("msg_characterscount").innerHTML = lng + ' out of 100 characters';
    }
    
 
 }

 function countChars_classnum(event){
    
    // var lng = document.forms.PollCreation.pollquestion.value.length;
     var lngg = event.currentTarget;
      var lng= lngg[0].value.length;
 
    
    if(lng >30)
    {
     document.getElementById("msg_characterscount").innerHTML =  '<span style="color: red;" >' +  lng + ' out of 100 characters';
    }
    else{
     document.getElementById("msg_characterscount").innerHTML = lng + ' out of 100 characters';
    }
    
 
 }

 function countChars_description(event){
    
    // var lng = document.forms.PollCreation.pollquestion.value.length;
     var lngg = event.currentTarget;
      var lng= lngg[0].value.length;
 
    
    if(lng >700)
    {
     document.getElementById("msg_characterscount").innerHTML =  '<span style="color: red;" >' +  lng + ' out of 100 characters';
    }
    else{
     document.getElementById("msg_characterscount").innerHTML = lng + ' out of 100 characters';
    }
    
 
 }
  
