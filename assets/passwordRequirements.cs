public partial class register : System.Web.UI.Page
{ 
protected void passwordRequirements (object sender, EventArgs e)
    {
        bool result = 
            passwordText.Any(p => char.IsLetter(p)) &&
            passwordText.Any(p => char.IsDigit(p)) &&
            passwordText.Any(p => char.IsSymbol(p));

        static bool IsLetter(char p)
        {
            return (p >= 'a' && p <= 'z') || (p >= 'A' && p <= 'Z');
        }
        static bool IsDigit(char p)
        {
            return p >= '0' && p <= '9';
        }
        static bool IsSymbol(char p)
        {
            return p > 32 && p < 127 && !IsDigit(p) && !IsLetter(p);
        }

        static bool IsValidPassword(string password)
        {
            return
                password.Any(p => IsLetter(p)) &&
                password.Any(p => IsDigit(p)) &&
                password.Any(p => IsSymbol(p));
        }
    }
}

------------------------------------------------------------------------------------------------------        

public partial class altRegister : System.Web.UI.Page
{
protected void altPasswordRequirements (object sender, EventArgs e)
    {
        string userEmail = txtEmail.Text;
        string currentPassord = txtPassword0.Text;
        string userPassword1 = txtPassword1.Text;
        string userPassword2 = txtPassword2.Text;
        string passwordNotMatch = "Your passwords do not match! Please try again.";
        string passwordLength = "Your passwords do not meet the minimum length! Please try again.";
        string newPassword = "Please enter a new password!";

        if(userPassword1 == userPassword2)
        {
            Response.Redirect(myAccount.html);
        }
        else(userPassword1 !== userPassword2)
        {
            Console.WriteLine(passwordNotMatch);
        }
        if(userPassword1.length >= 8)
        {
            Response.Redirect(myAccount.html);
        }
        else()
        {
            Console.WriteLine(passwordLength);
        }
        if(currentPassord !== userPassword1)
        {
            Response.Redirect(myAccount.html);
        }
        else()
        {
            Console.WriteLine(newPassword);
        }
    }
}