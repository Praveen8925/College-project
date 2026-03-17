@echo off
echo College Management System - Docker Setup
echo ==========================================
echo.

REM Check if Docker is running
docker --version >nul 2>&1
if errorlevel 1 (
    echo Error: Docker is not installed or not running
    echo Please install Docker Desktop and ensure it's running
    pause
    exit /b 1
)

echo Step 1: Exporting current database...
if not exist "database\collegedetails.sql" (
    echo Database export not found. Running export script...
    call export-database.bat
    if errorlevel 1 (
        echo Failed to export database. Please run export-database.bat manually.
        pause
        exit /b 1
    )
)

echo.
echo Step 2: Building and starting Docker containers...
docker-compose up --build -d

if errorlevel 1 (
    echo Error: Failed to start Docker containers
    pause
    exit /b 1
)

echo.
echo ✅ Success! College Management System is now running in Docker
echo.
echo 🌐 Access points:
echo   • Web Application: http://localhost:9090
echo   • phpMyAdmin:      http://localhost:9091
echo   • MySQL:           localhost:3308
echo.
echo 🔐 Login credentials:
echo   • Admin:    admin / stc
echo   • Staff:    BSCCS39 / 123456
echo   • Student:  N5BIT0001 / stc
echo.
echo Press any key to view container logs...
pause >nul
docker-compose logs -f
