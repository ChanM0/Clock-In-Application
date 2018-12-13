Michael Chan

Git: https://github.com/ChanM0/Clock-In-Application
WebLink : http://165.227.1.191/#/

1. Go to login

Login: comp586Test@email.com
Password : comp586Test@email.com

2. Go to Clock in
   Click the button
   I only allow one clock in a day so after the first clock in, there will be a bad request received. I have not shown an error message for that yet.

3. Go to Clock out
   Click the button
   I only allow one clock out a day so after the first clock out, there will be a bad request received. I have not shown an error message for that yet.

4. Go to all users
   Click Get All users.

5. Click any users name from within the list to get their logs. Has Many Relationship
   If they don't have logs my random factory didn't create logs for them.

6. Go to get Logs from this day. Select 12/12/2018 or 12/10/218

Api.php Contains all of my routes

app/http/controllers are where my controllers are located

app/DiServices <- hasmany found here
App/DiContracts
^^^
This and the corresponding controllers are used for dependency injection.

/resources
SPA is helad

Models
App/User.php
App/clockin.php <- hasmany found here
relationships located here
