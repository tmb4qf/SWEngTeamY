<!doctype html>
<html>
    <head><title></title></head>
    <body>

        <h1>Login Page</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('LoginController/checkLogin'); ?>
        
            Username:<br/>
            <input type="text" name ="username"/><br/>
            Password: <br/>
            <input type="text" name="password"/>
            <input type="submit" value = "login" name="submit">
        </form>
    </body>
</html>