@echo off
echo Exporting College Management System Database...

REM Create database directory if it doesn't exist
if not exist "database" mkdir database

REM Export database using mysqldump
echo Please enter your MySQL root password when prompted:
C:\wamp64\bin\mysql\mysql8.0.31\bin\mysqldump.exe -u root -p --single-transaction --routines --triggers collegedetails > database\collegedetails.sql

if errorlevel 1 (
    echo Error: Failed to export database
    pause
    exit /b 1
)

echo Success! Database exported to database\collegedetails.sql
echo You can now use Docker with this database export.
echo.
echo To build and run with Docker:
echo   docker-compose up --build
echo.
pause
