# College Management System - Docker Setup

## 🐳 Docker Configuration

This Docker setup allows you to run the College Management System on any machine with Docker installed.

### 📋 Prerequisites

- Docker Desktop installed on your system
- Docker Compose (included with Docker Desktop)

### 🚀 Quick Start

1. **Clone the repository**:
```bash
git clone https://github.com/Praveen8925/College-project.git
cd College-project
```

2. **Export your current database**:
```bash
# On Windows with WAMP
mysqldump -u root -p collegedetails > database/collegedetails.sql

# Or use phpMyAdmin to export the collegedetails database as SQL
```

3. **Build and run with Docker**:
```bash
docker-compose up --build
```

4. **Access the application**:
- **Web Application**: http://localhost:9090
- **phpMyAdmin**: http://localhost:9091
- **MySQL**: localhost:3308

### 🔧 Services

#### 🌐 Web Server (Apache + PHP 8.2)
- **Port**: 9090
- **Features**: 
  - PHP 8.2 with all required extensions
  - Apache with mod_rewrite enabled
  - Frontend built with Vite
  - Backend API routing

#### 🗄️ MySQL Database
- **Port**: 3308
- **Database**: collegedetails
- **User**: college_user
- **Password**: college_pass
- **Root Password**: stc123

#### 🔍 phpMyAdmin
- **Port**: 9091
- **Access database management interface**

### 🔐 Login Credentials

#### Admin
- **Username**: admin
- **Password**: stc

#### Staff
- **ID**: BSCCS39 | **Password**: 123456
- **ID**: bscct19 | **Password**: 123
- **ID**: BSCIT002 | **Password**: 2

#### Students
- **RegNo**: N5BIT0001 | **Password**: stc
- **RegNo**: N5BIT0002 | **Password**: stc

### 📁 Directory Structure

```
College-project/
├── docker-compose.yml          # Docker services configuration
├── Dockerfile                  # Web server container build
├── docker/
│   └── apache.conf            # Apache virtual host configuration
├── backend/
│   ├── api/                   # Backend PHP APIs
│   └── config/
│       ├── db.php            # Development database config
│       └── db.docker.php     # Docker database config
├── frontend/                  # React frontend application
├── database/
│   └── collegedetails.sql    # Database export for initialization
└── README-DOCKER.md          # This file
```

### 🔄 Development Workflow

#### Making Changes

1. **Backend Changes**: 
   - Edit files in `backend/` directory
   - Changes are reflected immediately (volume mounted)

2. **Frontend Changes**:
   - Edit files in `frontend/` directory
   - Rebuild container: `docker-compose build web`
   - Restart: `docker-compose up web`

#### Database Changes

1. **Access phpMyAdmin**: http://localhost:8081
2. **Direct MySQL access**:
```bash
docker exec -it college_mysql mysql -u college_user -p collegedetails
```

### 📊 Data Persistence

- **Database**: Stored in Docker volume `mysql_data`
- **Uploads**: Mounted from `./upload` directory
- **Assignments**: Mounted from `./assignment` directory

### 🛠️ Troubleshooting

#### Container Issues
```bash
# View logs
docker-compose logs web
docker-compose logs mysql

# Restart services
docker-compose restart

# Rebuild containers
docker-compose down
docker-compose up --build
```

#### Database Issues
```bash
# Reset database
docker-compose down -v
docker-compose up --build
```

#### Port Conflicts
If ports are already in use, modify `docker-compose.yml`:
```yaml
services:
  web:
    ports:
      - "8082:80"  # Change from 8080 to 8082
  mysql:
    ports:
      - "3308:3306"  # Change from 3307 to 3308
```

### 🚀 Production Deployment

For production deployment:

1. **Update environment variables**
2. **Use proper SSL certificates**
3. **Configure proper database backups**
4. **Set up monitoring and logging**

### 📱 Features Included

✅ **Real-time Dashboard** with auto-refresh  
✅ **Student Management** with real database data  
✅ **Staff Management** with live notifications  
✅ **Attendance Tracking** with visual analytics  
✅ **Internal Marks** management  
✅ **Notes and Assignments** system  
✅ **Complaint Management** with status tracking  
✅ **Reports and Analytics** with interactive charts  

### 🎯 Benefits of Docker Setup

- ✅ **Platform Independent**: Run on Windows, Mac, or Linux
- ✅ **Consistent Environment**: Same setup across all machines
- ✅ **Easy Deployment**: Single command to start everything
- ✅ **Isolated Dependencies**: No conflicts with host system
- ✅ **Version Control**: Infrastructure as code
- ✅ **Scalable**: Easy to add more services

Your College Management System is now fully containerized and portable! 🎉
