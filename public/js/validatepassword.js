
        function passwordconfirm(){

            var passlengh = document.getElementById("new_password").value;
            var password_again = document.getElementById('password_again').value;

            var newpass = document.forms["passwordform"]["new_password"].value;
            var NewpassPattern = new RegExp(/^\S([A-Za-z0-9\'\~\`\!\@\#\$\%\^\&\*\(\)\_\+\-\=\{\}\|\[\]\;\:\"\<\>\?\,\.\/\s]+){6}$/g);

            if (NewpassPattern.test(newpass) == true){
                document.getElementById("new_pass_ok").innerHTML = "Your new password looks good.";
                document.getElementById("new_pass_error").innerHTML = "";
                document.getElementById("password_again").disabled = false;
                
            }
            else{
                document.getElementById("new_pass_error").innerHTML = "Your new password must not begin with space and must contain at least 7 characters.";
                document.getElementById("new_pass_ok").innerHTML = "";
                document.getElementById("password_again").value = "";
                document.getElementById("success_message").innerHTML = "";
                document.getElementById("error_message").innerHTML = "";
                document.getElementById("password_again").disabled = true;
                document.getElementById("submitbtn").disabled = true;
                
            }

            if (password_again != "" && new_password != password_again){
                document.getElementById("new_pass_error").innerHTML = "It looks like you've changed your mind. Please re-enter your password to confirm.";
                document.getElementById("success_message").innerHTML = "";
                document.getElementById("error_message").innerHTML = "";
                document.getElementById("new_pass_ok").innerHTML = "";
                document.getElementById("password_again").value = "";
                document.getElementById("submitbtn").disabled = true;
            }

        }

        function retypepass(){
            var new_password = document.getElementById('new_password').value;
            var password_again = document.getElementById('password_again').value;

            if(new_password != password_again){
                document.getElementById("error_message").innerHTML = "Please re-enter your password correctly";
                document.getElementById("success_message").innerHTML = "";
                document.getElementById("submitbtn").disabled = true;
            }
            else{
                document.getElementById("error_message").innerHTML = "";
                document.getElementById("success_message").innerHTML = "Success. Please click Change Password";
                document.getElementById("new_pass_ok").innerHTML = "Your new password looks good.";
                document.getElementById("new_pass_error").innerHTML = "";
                check();
            }
        }

        function check(){
            var old = document.getElementById("old_password").value;
            var new_password = document.getElementById('new_password').value;
            var password_again = document.getElementById('password_again').value;

            if (old != "" && new_password != "" && password_again != "" && new_password == password_again){
                document.getElementById("submitbtn").disabled = false;
            }
            else{
                document.getElementById("submitbtn").disabled = true;
            }
        }

       
