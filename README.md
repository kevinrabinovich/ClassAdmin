ClassAdmin
-

A sample PHP &amp; MySQL application acting as class or course management application.

Installation
-
1. Install a local server and database
  - Download [WAMP](http://www.wampserver.com/en/), [MAMP](http://www.mamp.info/en/downloads/), [XAMPP](https://www.apachefriends.org/index.html), or pretty much anything that has the letters 'AMP' in the name.
2. Create the database
  - You can do this the easy way by copying the contents of [classAdminDB.txt](https://github.com/kevinrabinovich/ClassAdmin/blob/master/classAdminDB.txt) to a new SQL Query tab in MySQL Workbench
  - Make sure either:
    - your username and password for your database are 'root' and 'MyNewPass' (no quotes, silly!) 
    - or you change the [username and password constants defined in head.php](https://github.com/kevinrabinovich/ClassAdmin/blob/master/head.php#L4-L5)
3. Move this `ClassAdmin` folder into your local server's `www` folder
  - e.g. If you installed WAMP, for instance, to `C:\WAMP`, your `www` folder would be `C:\WAMP\www`
  - :warning: If you installed your server to a folder in administrator territory (like `C:\WAMP` on Windows, for instance), then you will probably need administrator permission to move the files to that folder. Similarly, your text editor or IDE will need to be run with admin permissions for it to be able to edit files.
4. Start your local server & database
  - See [Troubleshooting](https://github.com/kevinrabinovich/ClassAdmin/blob/master/README.md#troubleshooting).
5. Connect to your web page
  - Go to [localhost/ClassAdmin/index.php](http://localhost/ClassAdmin/index.php).
    - Not working? Maybe your server isn't running on the default HTTP port (80). If your local server is running on port 82, for instance, try [localhost:82/ClassAdmin/index.php](http://localhost:82/ClassAdmin/index.php).

Troubleshooting
-
Check out these pages if you need help:
 - [WAMP Forums](http://forum.wampserver.com/list.php?2)
 - [MAMP Help & Documentation](http://www.mamp.info/en/documentation/)
 - [XAMPP Community](https://www.apachefriends.org/community.html)

Issues
-
See a problem? [Create a new issue](https://github.com/kevinrabinovich/ClassAdmin/issues/new).
