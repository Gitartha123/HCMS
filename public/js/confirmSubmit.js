function ConfirmSave()
{
    var x = confirm("Are you sure you want to submit?");
    if (x)
        return true;
    else
        return false;
}