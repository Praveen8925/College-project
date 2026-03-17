# 🎓 College Management System — Implementation Plan

> **Institution**: Sree Saraswathi Thyagaraja College (Autonomous), Affiliated to Bharathiar University
> **Stack**: React 18 + Tailwind CSS 3 (Frontend) | PHP 8 REST API (Backend) | MySQL — `collegedetails` DB (WAMP Server)
> **Date**: March 2026

---

## 1. 🏗️ Tech Stack

| Layer | Technology | Purpose |
|---|---|---|
| **Frontend** | React 18 + Vite | SPA, Component-based UI |
| **Styling** | Tailwind CSS 3 | Utility-first responsive design |
| **Routing** | React Router v6 | Client-side routing |
| **HTTP Client** | Axios | REST API calls |
| **State** | React Context + useReducer | Auth state, global state |
| **Forms** | React Hook Form | Form validation |
| **Charts** | Recharts | Attendance, marks dashboards |
| **PDF Client** | Print-JS / jsPDF | Client-side print support |
| **Backend** | PHP 8 (REST API) | Business logic, DB queries |
| **Database** | MySQL (`collegedetails`) | Existing WAMP DB — no migration |
| **Auth** | PHP Sessions + JWT-like tokens | Role-based access |
| **Server** | WAMP (Apache + PHP + MySQL) | Local dev server |

---

## 2. 📁 Project Structure

```
c:\wamp64\www\camu dupli\
├── frontend/                    # React + Vite + Tailwind
│   ├── public/
│   │   └── logo.png
│   ├── src/
│   │   ├── api/                 # Axios API wrappers per module
│   │   │   ├── auth.js
│   │   │   ├── students.js
│   │   │   ├── staff.js
│   │   │   ├── attendance.js
│   │   │   ├── assignments.js
│   │   │   ├── marks.js
│   │   │   ├── events.js
│   │   │   ├── complaints.js
│   │   │   └── reports.js
│   │   ├── components/          # Reusable UI components
│   │   │   ├── common/
│   │   │   │   ├── Navbar.jsx
│   │   │   │   ├── Sidebar.jsx
│   │   │   │   ├── Table.jsx
│   │   │   │   ├── Modal.jsx
│   │   │   │   ├── Badge.jsx
│   │   │   │   └── StatCard.jsx
│   │   │   ├── forms/
│   │   │   │   ├── InputField.jsx
│   │   │   │   ├── SelectField.jsx
│   │   │   │   └── FileUpload.jsx
│   │   │   └── charts/
│   │   │       ├── AttendanceChart.jsx
│   │   │       └── MarksChart.jsx
│   │   ├── context/
│   │   │   └── AuthContext.jsx  # Global auth state & role
│   │   ├── hooks/
│   │   │   ├── useAuth.js
│   │   │   └── useFetch.js
│   │   ├── pages/
│   │   │   ├── Login.jsx
│   │   │   ├── admin/
│   │   │   │   ├── AdminDashboard.jsx
│   │   │   │   ├── Students/
│   │   │   │   │   ├── StudentList.jsx
│   │   │   │   │   ├── AddStudent.jsx
│   │   │   │   │   └── StudentDetail.jsx
│   │   │   │   ├── Staff/
│   │   │   │   │   ├── StaffList.jsx
│   │   │   │   │   ├── AddStaff.jsx
│   │   │   │   │   ├── StaffAllocation.jsx
│   │   │   │   │   └── StaffTransfer.jsx
│   │   │   │   ├── Subjects/
│   │   │   │   │   ├── AddSubject.jsx
│   │   │   │   │   └── FinalizeSubject.jsx
│   │   │   │   ├── Events/
│   │   │   │   │   ├── EventList.jsx
│   │   │   │   │   └── AddEvent.jsx
│   │   │   │   ├── Complaints/
│   │   │   │   │   └── ComplaintManager.jsx
│   │   │   │   └── Reports/
│   │   │   │       ├── StaffReport.jsx
│   │   │   │       └── StudentReport.jsx
│   │   │   ├── staff/
│   │   │   │   ├── StaffDashboard.jsx
│   │   │   │   ├── Attendance/
│   │   │   │   │   ├── MarkAttendance.jsx
│   │   │   │   │   └── AttendanceReport.jsx
│   │   │   │   ├── Assignments/
│   │   │   │   │   ├── AddAssignment.jsx
│   │   │   │   │   └── ViewAssignments.jsx
│   │   │   │   ├── Notes/
│   │   │   │   │   └── UploadNotes.jsx
│   │   │   │   ├── Marks/
│   │   │   │   │   ├── InternalMarks.jsx
│   │   │   │   │   └── COEMarks.jsx
│   │   │   │   ├── Timetable/
│   │   │   │   │   └── TimetableView.jsx
│   │   │   │   └── WorkDiary/
│   │   │   │       └── WorkDiary.jsx
│   │   │   └── student/
│   │   │       ├── StudentDashboard.jsx
│   │   │       ├── MyAttendance.jsx
│   │   │       ├── MyAssignments.jsx
│   │   │       ├── MyMarks.jsx
│   │   │       ├── MyNotes.jsx
│   │   │       ├── Timetable.jsx
│   │   │       ├── Syllabus.jsx
│   │   │       └── SubmitComplaint.jsx
│   │   ├── utils/
│   │   │   ├── axiosInstance.js  # Base URL + auth headers
│   │   │   └── roleGuard.jsx     # Protected route wrapper
│   │   ├── App.jsx
│   │   ├── main.jsx
│   │   └── index.css
│   ├── tailwind.config.js
│   ├── postcss.config.js
│   └── vite.config.js
│
└── backend/                     # PHP REST API
    ├── config/
    │   └── db.php               # PDO connection to collegedetails
    ├── middleware/
    │   └── auth.php             # Session/token validation
    ├── api/
    │   ├── auth/
    │   │   ├── login.php
    │   │   └── logout.php
    │   ├── students/
    │   │   ├── index.php        # GET list / POST add
    │   │   └── [id].php         # GET detail / PUT update / DELETE
    │   ├── staff/
    │   │   ├── index.php
    │   │   ├── allocation.php
    │   │   └── transfer.php
    │   ├── attendance/
    │   │   ├── index.php
    │   │   └── report.php
    │   ├── assignments/
    │   │   ├── index.php
    │   │   └── submit.php
    │   ├── notes/
    │   │   └── index.php
    │   ├── subjects/
    │   │   └── index.php
    │   ├── marks/
    │   │   ├── internal.php
    │   │   └── coe.php
    │   ├── events/
    │   │   └── index.php
    │   ├── complaints/
    │   │   ├── index.php
    │   │   └── resolve.php
    │   ├── reports/
    │   │   ├── staff.php
    │   │   └── student.php
    │   └── timetable/
    │       └── index.php
    └── .htaccess                # CORS + pretty URLs
```

---

## 3. 🗄️ Database Mapping (Existing `collegedetails` DB)

> **No schema changes** — all existing tables are used as-is.

| Module | Table(s) Used |
|---|---|
| Auth — Admin | `admin` (Username, Password) |
| Auth — Student | `student` (Regno, Password) |
| Auth — Staff | `addstaff` (SID, Password) |
| Student Management | `student`, `studentpersonal` |
| Staff Management | `addstaff`, `staffdetail`, `staffallocation`, `stafftransfer` |
| Subjects | `subjectdetails`, `coursedetails`, `sixthhour` |
| Attendance | `2015attendance`, `2016attendance`, `2017attendance`, `2015yearattendance`, etc. |
| Assignments | `2015assignment`, `2016assignment`, `2017assignment`, `2015studassignmentmark` |
| Notes | `notes` |
| Marks | `cycletest_1`, `cycletest_2`, `modelexam`, `semexam`, `coe` |
| Events | `events` |
| Complaints | `complaint` |
| Work Diary | `workdiarys` |
| Alumni | `student` (filtered) |
| Achievements | `achievement` |
| Publications | `staffpublication`, `staffpp`, `staffresearch` |
| Associations | `association`, `associationactivities`, `associationmember` |

---

## 4. 🔒 Authentication & Role System

### Roles
| Role | Login Identifier | Home Route |
|---|---|---|
| **Admin** | Username = `admin` | `/admin/dashboard` |
| **Staff** | SID (from `addstaff`) | `/staff/dashboard` |
| **Student** | Regno starting with `N` | `/student/dashboard` |

### Auth Flow
```
POST /backend/api/auth/login.php
  Body: { username, password, role }
  Response: { success, role, token, user: { id, name, dept } }
```
- Token stored in `localStorage`
- `AuthContext` wraps the entire app
- `<ProtectedRoute role="admin">` HOC guards routes
- PHP session + bearer token validation on every API call

---

## 5. 📡 API Endpoint Design

### Auth
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/auth/login.php` | Login for all roles |
| POST | `/api/auth/logout.php` | Logout & session destroy |

### Students
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/students/index.php` | List all students |
| POST | `/api/students/index.php` | Add new student |
| GET | `/api/students/[id].php` | Get student by Regno |
| PUT | `/api/students/[id].php` | Update student |
| DELETE | `/api/students/[id].php` | Discontinue student |

### Staff
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/staff/index.php` | List all staff |
| POST | `/api/staff/index.php` | Add staff |
| PUT | `/api/staff/[id].php` | Update staff |
| GET | `/api/staff/allocation.php` | Get allocations |
| POST | `/api/staff/allocation.php` | Allocate staff to class |
| POST | `/api/staff/transfer.php` | Transfer staff |

### Attendance
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/attendance/index.php?batch=&sem=` | Get attendance data |
| POST | `/api/attendance/index.php` | Mark attendance |
| GET | `/api/attendance/report.php?regno=` | Student-wise report |

### Assignments
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/assignments/index.php?batch=&sem=` | List assignments |
| POST | `/api/assignments/index.php` | Add assignment |
| POST | `/api/assignments/submit.php` | Student submission |

### Marks
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/marks/internal.php?batch=&sem=` | Get internal marks |
| POST | `/api/marks/internal.php` | Enter marks |
| GET | `/api/marks/coe.php?sem=` | COE consolidated marks |

### Events
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/events/index.php` | List events |
| POST | `/api/events/index.php` | Add event |
| DELETE | `/api/events/index.php?id=` | Delete event |

### Complaints
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/complaints/index.php` | List all complaints |
| POST | `/api/complaints/index.php` | Submit complaint |
| PUT | `/api/complaints/resolve.php` | Resolve complaint |

---

## 6. 🎨 UI Design System (Tailwind)

### Color Palette
```js
// tailwind.config.js
colors: {
  primary:  { DEFAULT: '#1E3A8A', light: '#3B82F6', dark: '#1E40AF' },
  accent:   { DEFAULT: '#F59E0B', light: '#FCD34D' },
  surface:  { DEFAULT: '#F8FAFC', card: '#FFFFFF' },
  danger:   '#EF4444',
  success:  '#10B981',
  text:     { primary: '#1E293B', muted: '#64748B' }
}
```

### Typography
- **Font**: `Inter` (Google Fonts)
- **Headings**: `font-bold tracking-tight`
- **Body**: `font-normal text-slate-700`

### Shared Components
| Component | Usage |
|---|---|
| `<StatCard>` | Dashboard KPI cards |
| `<DataTable>` | Sortable, searchable tables |
| `<Modal>` | Add/Edit forms |
| `<Badge>` | Status indicators (Active, Absent, Resolved) |
| `<Sidebar>` | Role-specific navigation |
| `<Breadcrumb>` | Page navigation trail |

---

## 7. 📋 Module Breakdown & Pages

### 7.1 — Admin Module Pages
| Page | Description |
|---|---|
| **Dashboard** | KPI cards: Total Students, Staff, Today's Attendance %, Pending Complaints |
| **Student List** | Search, filter by Dept/Batch, Add, Edit, Discontinue |
| **Add Student** | Form with photo upload → `student` table |
| **Staff List** | Search, filter by Dept, Add, Edit |
| **Add Staff** | Form → `addstaff` + `staffdetail` tables |
| **Staff Allocation** | Assign staff to semester/subject/class |
| **Staff Transfer** | Move staff between departments |
| **Subject Management** | Add/finalize subjects per batch/sem |
| **Class Incharge** | Assign class incharge |
| **Events** | Add, view, delete events (shown on login screen) |
| **Complaints** | View all complaints, mark resolved with description |
| **Reports** | Staff report, Student report, Dept-wise report |

### 7.2 — Staff Module Pages
| Page | Description |
|---|---|
| **Dashboard** | My classes, today's schedule, pending tasks |
| **Mark Attendance** | Select class → mark per student → save |
| **Attendance Report** | Student-wise, class-wise, date-wise |
| **Add Assignment** | Create assignment for batch/sem → mark submissions |
| **View Assignments** | List of assignments |
| **Upload Notes** | Upload PDF/doc for students' reference |
| **Internal Marks** | Enter CT1, CT2, Model exam marks |
| **COE Marks** | COE internal marks entry |
| **Work Diary** | Daily work entry form |
| **Timetable** | View personal timetable |
| **Submit Complaint** | Submit complaint about student/infrastructure |

### 7.3 — Student Module Pages
| Page | Description |
|---|---|
| **Dashboard** | Quick stats: Attendance %, Pending Assignments, Recent Marks |
| **My Attendance** | Subject-wise attendance with bar chart |
| **My Assignments** | List pending + submitted + marks |
| **Submit Assignment** | Upload file or text response |
| **My Marks** | CT1, CT2, Model marks per subject |
| **My Notes** | Download notes shared by staff |
| **Timetable** | Personal class timetable |
| **Syllabus** | View/download course syllabus |
| **Events** | View college events |
| **Submit Complaint** | Submit complaint to class incharge/admin |
| **Change Password** | Update password |

---

## 8. 🚀 Phased Delivery Plan

### Phase 1 — Foundation (Week 1)
- [ ] Initialize Vite + React + Tailwind CSS project in `frontend/`
- [ ] Setup PHP backend folder structure in `backend/`
- [ ] Create `backend/config/db.php` (PDO connection to `collegedetails`)
- [ ] Create `.htaccess` for CORS and API routing
- [ ] Build `AuthContext`, `axiosInstance`, `ProtectedRoute`
- [ ] Build Login page (3 roles: Admin, Staff, Student)
- [ ] Build `POST /api/auth/login.php` backend endpoint
- [ ] Build shared: Sidebar, Navbar, StatCard, DataTable components

### Phase 2 — Admin Core (Week 2)
- [ ] Admin Dashboard (KPI cards)
- [ ] Student CRUD (List, Add, Edit, Discontinue)
- [ ] Staff CRUD (List, Add, Edit)
- [ ] Staff Allocation + Transfer
- [ ] Subject Management
- [ ] Events Management
- [ ] Complaints Manager

### Phase 3 — Staff Module (Week 3)
- [ ] Staff Dashboard
- [ ] Attendance marking + reports
- [ ] Assignment creation + view submissions
- [ ] Notes upload
- [ ] Internal + COE marks entry
- [ ] Work Diary
- [ ] Timetable view

### Phase 4 — Student Module (Week 4)
- [ ] Student Dashboard
- [ ] My Attendance (with chart)
- [ ] My Assignments + Submit
- [ ] My Marks (with chart)
- [ ] My Notes (download)
- [ ] Timetable, Syllabus, Events
- [ ] Complaints submission

### Phase 5 — Polish & Reports (Week 5)
- [ ] Admin reports (Excel-like table exports)
- [ ] PDF generation (print-friendly views)
- [ ] Consolidated marks report
- [ ] Staff department reports
- [ ] Responsive mobile design pass
- [ ] Final QA and bug fixes

---

## 9. ⚙️ Backend Configuration

### `backend/config/db.php`
```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'collegedetails');
define('DB_USER', 'root');
define('DB_PASS', '');  // WAMP default

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    return $pdo;
}
```

### `backend/.htaccess`
```apache
Header always set Access-Control-Allow-Origin "http://localhost:5173"
Header always set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
Header always set Access-Control-Allow-Headers "Content-Type, Authorization"
Header always set Access-Control-Allow-Credentials "true"
RewriteEngine On
RewriteCond %{REQUEST_METHOD} OPTIONS
RewriteRule ^(.*)$ $1 [R=200,L]
```

### `frontend/src/utils/axiosInstance.js`
```js
import axios from 'axios';
const api = axios.create({
  baseURL: 'http://localhost/camu dupli/backend/api',
  withCredentials: true,
});
api.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});
export default api;
```

---

## 10. 🔑 Key Design Decisions

| Decision | Rationale |
|---|---|
| **No DB migration** | The existing `collegedetails` DB is battle-tested; avoid data loss risk |
| **Year-based tables** (2015attendance, 2016attendance…) | PHP legacy pattern — backend API will dynamically pick the correct year table based on batch parameter |
| **SPA with React Router** | Single login page, role-based sidebar routing |
| **PHP REST API** | Keeps WAMP server compatibility; no Node.js needed |
| **Tailwind CSS** | Rapid, consistent styling without custom CSS bloat |
| **PDO with prepared statements** | Prevents SQL injection in all backend endpoints |
| **File uploads** | Assignment/notes files stored in `backend/uploads/` (mirrors legacy `upload/` folder) |

---

## 11. 🗂️ All 62 DB Tables — Quick Reference

```
2014, 2014assignment, 2014attendance, 2014lab
2015, 2015assignment, 2015assignmentquestion, 2015attendance, 2015lab,
2015onemarkquestion, 2015studassignmentmark, 2015studassignmentreport, 2015yearattendance
2016, 2016assignment, 2016attendance, 2016lab, 2016studassignmentmark, 2016yearattendance
2017, 2017assignment, 2017attendance, 2017lab, 2017studassignmentmark, 2017yearattendance
2018yearattendance, 2106attendance
achievement, addstaff, admin, association, associationactivities, associationmember
classincharge, coe, complaint, coursedetails, cycletest_1, cycletest_2
events, modelexam, notes, otherdept, semexam, sixthhour
staffallocation, staffdetail, staffpp, staffpublication, staffresearch, staffresult
stafftransfer, staffworkshop
student, studentconference, studenticm, studentpersonal, studentworkshop
subjectdetails, syllabus, upcompanies, workdiarys
```

---

> **Next Step**: Start with **Phase 1** — Initialize the frontend and backend folders, set up DB connection, and build the Login page with all three roles.
