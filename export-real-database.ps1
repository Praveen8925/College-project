# College Management System - Database Export Script
# This script exports the real collegedetails database from WAMP to Docker

Write-Host "=====================================================" -ForegroundColor Green
Write-Host "College Management System - Database Export" -ForegroundColor Green  
Write-Host "=====================================================" -ForegroundColor Green
Write-Host ""

# Check if WAMP MySQL is running
Write-Host "Checking WAMP MySQL connection..." -ForegroundColor Yellow

$wampMysqlPath = "C:\wamp64\bin\mysql\mysql8.0.37\bin\mysqldump.exe"
$exportPath = "C:\wamp64\www\College-project\database\collegedetails_real.sql"

# Alternative paths for different WAMP versions
$possiblePaths = @(
    "C:\wamp64\bin\mysql\mysql8.0.37\bin\mysqldump.exe",
    "C:\wamp64\bin\mysql\mysql8.0.36\bin\mysqldump.exe", 
    "C:\wamp64\bin\mysql\mysql8.0.35\bin\mysqldump.exe",
    "C:\wamp\bin\mysql\mysql8.0.37\bin\mysqldump.exe",
    "C:\xampp\mysql\bin\mysqldump.exe"
)

$mysqldumpPath = $null
foreach ($path in $possiblePaths) {
    if (Test-Path $path) {
        $mysqldumpPath = $path
        Write-Host "Found mysqldump at: $path" -ForegroundColor Green
        break
    }
}

if (-not $mysqldumpPath) {
    Write-Host "Error: mysqldump not found in common WAMP/XAMPP locations" -ForegroundColor Red
    Write-Host "Please run manually:" -ForegroundColor Yellow
    Write-Host "mysqldump -u root -p collegedetails > `"$exportPath`"" -ForegroundColor White
    Write-Host ""
    Write-Host "Or export from phpMyAdmin:" -ForegroundColor Yellow
    Write-Host "1. Open: http://localhost/phpmyadmin/" -ForegroundColor White
    Write-Host "2. Select 'collegedetails' database" -ForegroundColor White
    Write-Host "3. Click 'Export' tab" -ForegroundColor White
    Write-Host "4. Click 'Export' button" -ForegroundColor White
    Write-Host "5. Save as 'collegedetails_real.sql' in database folder" -ForegroundColor White
    pause
    exit
}

# Prompt for MySQL password
$password = Read-Host "Enter MySQL root password (leave empty if no password)" -AsSecureString
$plainPassword = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto([System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($password))

try {
    Write-Host "Exporting database..." -ForegroundColor Yellow
    
    if ([string]::IsNullOrEmpty($plainPassword)) {
        # No password
        & $mysqldumpPath -u root --single-transaction --routines --triggers collegedetails | Out-File -FilePath $exportPath -Encoding UTF8
    } else {
        # With password
        & $mysqldumpPath -u root -p$plainPassword --single-transaction --routines --triggers collegedetails | Out-File -FilePath $exportPath -Encoding UTF8
    }
    
    if (Test-Path $exportPath) {
        Write-Host "Database exported successfully to: $exportPath" -ForegroundColor Green
        
        # Replace the dummy database file
        $dummyPath = "C:\wamp64\www\College-project\database\collegedetails.sql"
        if (Test-Path $dummyPath) {
            Copy-Item $exportPath $dummyPath -Force
            Write-Host "Dummy database replaced with real database!" -ForegroundColor Green
        }
        
        Write-Host ""
        Write-Host "Next steps:" -ForegroundColor Yellow
        Write-Host "1. Run: docker-compose down" -ForegroundColor White
        Write-Host "2. Run: docker-compose up --build -d" -ForegroundColor White
        Write-Host ""
    } else {
        Write-Host "Export failed! Please try manual export from phpMyAdmin." -ForegroundColor Red
    }
} catch {
    Write-Host "Error during export: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Please try manual export from phpMyAdmin." -ForegroundColor Yellow
}

pause
