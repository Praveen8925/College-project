# College Management System

A comprehensive college management system built with modern web technologies, featuring real-time data updates and comprehensive analytics.

## 🚀 Features

### Real-Time Dashboard System
- **Live Data Updates**: Auto-refresh every 30-45 seconds
- **Real-Time Connection Status**: Visual indicators for connection status
- **Enhanced Analytics**: Advanced charts with live database integration
- **Cross-Platform Compatibility**: Docker containerization for consistent deployment

### Role-Based Access Control
- **Admin Dashboard**: Complete system overview with advanced analytics
- **Staff Dashboard**: Teaching and administrative tools
- **Student Dashboard**: Academic progress and resources access

### Core Functionality
- **Student Management**: Enrollment, profiles, academic records
- **Staff Management**: Employee records, allocations, transfers
- **Attendance System**: Digital attendance tracking and reporting
- **Marks Management**: Internal assessments and grade management
- **Subject Management**: Course allocation and finalization
- **Event Management**: College events and announcements
- **Complaint System**: Digital complaint filing and resolution
- **Report Generation**: Comprehensive reporting system

## 🛠 Tech Stack

### Frontend
- **React 19** - Latest React with modern features
- **Material-UI v7** - Modern component library
- **Vite** - Fast build tool with Rolldown bundling
- **Recharts** - Advanced data visualization
- **Axios** - HTTP client with authentication
- **Date-fns** - Date manipulation library

### Backend
- **PHP 8.2** - Server-side scripting
- **MySQL 8.0** - Database management
- **Apache 2.4** - Web server

### DevOps & Deployment
- **Docker** - Multi-stage containerization
- **Docker Compose** - Service orchestration
- **phpMyAdmin** - Database administration interface

## 🏗 Architecture

### Real-Time System Architecture
```
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────┐
│   Frontend      │    │     Backend      │    │    Database     │
│                 │    │                  │    │                 │
│ • React 19      │◄──►│ • PHP 8.2        │◄──►│ • MySQL 8.0     │
│ • Real-time     │    │ • RESTful APIs   │    │ • Optimized     │
│   Hooks         │    │ • Authentication │    │   Queries       │
│ • Auto-refresh  │    │ • CORS Support   │    │ • Transactions  │
└─────────────────┘    └──────────────────┘    └─────────────────┘
```

### Docker Multi-Stage Build
```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│ Frontend Build  │    │  PHP Runtime    │    │     Services    │
│                 │    │                 │    │                 │
│ • Node 20       │───►│ • PHP 8.2       │◄──►│ • MySQL         │
│ • Vite Build    │    │ • Apache        │    │ • phpMyAdmin    │
│ • Asset Opt.    │    │ • Extensions    │    │ • Networking    │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## 📦 Installation & Setup

### Prerequisites
- Docker and Docker Compose
- Git

### Quick Start with Docker (Recommended)
1. **Clone the repository**
   ```bash
   git clone https://github.com/Praveen8925/College-project.git
   cd College-project
   ```

2. **Start with Docker Compose**
   ```bash
   docker-compose up --build -d
   ```

3. **Access the Application**
   - **Main Application**: http://localhost:9090
   - **phpMyAdmin**: http://localhost:9091
   - **Database**: localhost:3308

### Manual Installation (WAMP/XAMPP)
1. **Backend Setup**
   ```bash
   # Place backend files in your web server directory
   # Configure database connection in backend/config/db.php
   ```

2. **Frontend Setup**
   ```bash
   cd frontend
   npm install
   npm run dev
   ```

3. **Database Setup**
   - Import the database schema from `database/collegedetails.sql`
   - Update database credentials in `backend/config/db.php`

## 🔧 Configuration

### Environment Variables
```env
# Database Configuration (Docker)
MYSQL_DATABASE=collegedetails
MYSQL_USER=college_user
MYSQL_PASSWORD=college_password
MYSQL_ROOT_PASSWORD=root_password

# Application URLs
VITE_API_URL=http://localhost:9090/backend/api
```

### Docker Services
- **Web Server**: Port 9090 (Apache + PHP)
- **Database**: Port 3308 (MySQL)
- **phpMyAdmin**: Port 9091 (Database Admin)

## 📊 Key Features Implemented

### Real-Time Data System
- **Auto-refresh Hooks**: Custom React hooks for live data updates
- **Connection Status**: Visual indicators for real-time connectivity
- **Performance Optimized**: Efficient polling with data caching

### Enhanced Analytics
- **Interactive Charts**: Recharts integration with live data
- **Attendance Analytics**: Visual attendance patterns and trends
- **Performance Metrics**: Student and staff performance dashboards
- **Report Generation**: Automated report creation with export options

### Security Features
- **JWT Authentication**: Secure token-based authentication
- **Role-based Access**: Granular permission system
- **CORS Configuration**: Secure cross-origin requests
- **Input Validation**: Comprehensive data validation

## 🚦 Usage

### Default Login Credentials
- **Admin**: username: `admin`, password: `stc`
- **Staff**: Contact admin for credentials
- **Student**: Use registration number and password

### Navigation
- **Dashboard**: Real-time overview of system status
- **Management**: Student, staff, and academic management
- **Reports**: Comprehensive reporting and analytics
- **Settings**: System configuration and user management

## 🔄 Real-Time Features

### Auto-Refresh System
- **Dashboard Updates**: Live statistics every 30 seconds
- **Attendance Tracking**: Real-time attendance updates
- **Notifications**: Instant alerts for new events/complaints
- **Performance Monitoring**: Live system performance metrics

### Interactive Components
- **Live Charts**: Dynamic data visualization
- **Status Indicators**: Real-time connection status
- **Progress Bars**: Live progress tracking
- **Data Tables**: Auto-updating data grids

## 🛠 Development

### Project Structure
```
College-project/
├── frontend/                 # React application
│   ├── src/
│   │   ├── components/      # Reusable components
│   │   ├── pages/          # Page components
│   │   ├── hooks/          # Custom hooks
│   │   ├── api/            # API integration
│   │   └── utils/          # Utility functions
│   └── public/             # Static assets
├── backend/                 # PHP backend
│   ├── api/                # REST API endpoints
│   └── config/             # Configuration files
├── database/               # Database schema
├── docker/                 # Docker configuration
└── docs/                   # Documentation
```

### Development Workflow
1. **Local Development**: Use Docker for consistent environment
2. **Code Changes**: Hot-reload enabled for frontend
3. **Database Changes**: Apply migrations via phpMyAdmin
4. **Testing**: Built-in testing utilities

## 📝 API Documentation

### Authentication Endpoints
```
POST /backend/api/auth/login.php     # User login
POST /backend/api/auth/logout.php    # User logout
```

### Dashboard Endpoints
```
GET  /backend/api/dashboard/stats.php    # Dashboard statistics
GET  /backend/api/student/dashboard.php  # Student dashboard
GET  /backend/api/staff/dashboard.php    # Staff dashboard
```

### Management Endpoints
```
GET  /backend/api/students/index.php     # Student list
POST /backend/api/students/index.php     # Add student
GET  /backend/api/attendance/index.php   # Attendance data
POST /backend/api/marks/internal.php     # Submit marks
```

## 🤝 Contributing

1. **Fork the Repository**
2. **Create Feature Branch** (`git checkout -b feature/AmazingFeature`)
3. **Commit Changes** (`git commit -m 'Add AmazingFeature'`)
4. **Push to Branch** (`git push origin feature/AmazingFeature`)
5. **Open Pull Request**

## 📋 TODO / Roadmap

- [ ] **Mobile App**: React Native mobile application
- [ ] **Advanced Analytics**: AI-powered insights
- [ ] **Cloud Integration**: AWS/Azure deployment
- [ ] **API Gateway**: Microservices architecture
- [ ] **WebSocket Support**: True real-time updates
- [ ] **Backup System**: Automated database backups

## 🐛 Known Issues

- **Docker Build Time**: Initial build may take 5-10 minutes
- **Database Import**: Large datasets may require manual import
- **Browser Compatibility**: Optimized for modern browsers

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **Praveen** - *Initial Development* - [@Praveen8925](https://github.com/Praveen8925)

## 🙏 Acknowledgments

- React Team for React 19
- Material-UI Team for the component library
- PHP Community for ongoing support
- Docker Team for containerization technology

## 📞 Support

For support and queries:
- **GitHub Issues**: [Create an Issue](https://github.com/Praveen8925/College-project/issues)
- **Documentation**: See `REAL-TIME_FEATURES_SUMMARY.md` for detailed features
- **Docker Setup**: See `README-DOCKER.md` for Docker-specific instructions

---

**Built with ❤️ using modern web technologies**
