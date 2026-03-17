@echo off
echo ====================================================
echo College Management System - Database Export Script
echo ====================================================
echo.
echo This script will help you export your real database from your local WAMP server
echo and replace the dummy database in Docker.
echo.
echo STEPS TO FOLLOW:
echo ================
echo.
echo 1. Make sure your WAMP server is running
echo 2. Open: http://localhost/phpmyadmin/index.php?route=/database/structure^&db=collegedetails
echo 3. Click on "Export" tab in phpMyAdmin
echo 4. Select "Quick" export method
echo 5. Format: SQL
echo 6. Click "Export" button
echo 7. Save the file as "collegedetails_real.sql" in the database folder
echo.
echo OR use the command line method below:
echo =======================================
echo.
echo Run this command in Command Prompt (replace paths as needed):
echo.
echo mysqldump -u root -p collegedetails ^> "c:\wamp64\www\College-project\database\collegedetails_real.sql"
echo.
echo After exporting, run: docker-compose down
echo Then run: docker-compose up --build -d
echo.
pause
