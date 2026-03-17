import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { ThemeProvider, CssBaseline } from '@mui/material';
import theme from './theme';
import { AuthProvider } from './context/AuthContext';
import ProtectedRoute from './utils/ProtectedRoute';
import DashboardLayout from './layouts/DashboardLayout';

// Auth
import Login from './pages/Login';

// Admin Pages
import AdminDashboard   from './pages/admin/AdminDashboard';
import StudentList      from './pages/admin/Students/StudentList';
import StaffList        from './pages/admin/Staff/StaffList';
import EventList        from './pages/admin/Events/EventList';
import ComplaintManager from './pages/admin/Complaints/ComplaintManager';
import SubjectList      from './pages/admin/Subjects/SubjectList';
// Phase 5 — Reports
import ReportsHub        from './pages/admin/Reports/ReportsHub';
import AttendanceReport  from './pages/admin/Reports/AttendanceReport';
import MarksReport       from './pages/admin/Reports/MarksReport';

// Staff Pages (Phase 3)
import StaffDashboard    from './pages/staff/StaffDashboard';
import MarkAttendance    from './pages/staff/Attendance/MarkAttendance';
import ManageAssignments from './pages/staff/Assignments/ManageAssignments';
import UploadNotes       from './pages/staff/Notes/UploadNotes';
import InternalMarks     from './pages/staff/Marks/InternalMarks';
import WorkDiary         from './pages/staff/WorkDiary/WorkDiary';

// Student Pages (Phase 4)
import StudentDashboard from './pages/student/StudentDashboard';
import MyAttendance    from './pages/student/Attendance/MyAttendance';
import MyMarks         from './pages/student/Marks/MyMarks';
import ViewNotes       from './pages/student/Notes/ViewNotes';
import ViewEvents      from './pages/student/Events/ViewEvents';
import MyComplaints    from './pages/student/Complaints/MyComplaints';

// Helper: wraps a page in ProtectedRoute + DashboardLayout
const AdminPage = ({ children }) => (
  <ProtectedRoute role="admin">
    <DashboardLayout>{children}</DashboardLayout>
  </ProtectedRoute>
);
const StaffPage = ({ children }) => (
  <ProtectedRoute role="staff">
    <DashboardLayout>{children}</DashboardLayout>
  </ProtectedRoute>
);
const StudentPage = ({ children }) => (
  <ProtectedRoute role="student">
    <DashboardLayout>{children}</DashboardLayout>
  </ProtectedRoute>
);

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <AuthProvider>
        <BrowserRouter>
          <Routes>
            {/* Public */}
            <Route path="/login" element={<Login />} />
            <Route path="/"      element={<Navigate to="/login" replace />} />

            {/* ══ ADMIN ROUTES ════════════════════════════════════════ */}
            <Route path="/admin/dashboard"       element={<AdminPage><AdminDashboard /></AdminPage>} />
            <Route path="/admin/students"        element={<AdminPage><StudentList /></AdminPage>} />
            <Route path="/admin/staff"           element={<AdminPage><StaffList /></AdminPage>} />
            <Route path="/admin/events"          element={<AdminPage><EventList /></AdminPage>} />
            <Route path="/admin/complaints"      element={<AdminPage><ComplaintManager /></AdminPage>} />
            <Route path="/admin/subjects"        element={<AdminPage><SubjectList /></AdminPage>} />
            <Route path="/admin/reports"         element={<AdminPage><ReportsHub /></AdminPage>} />
            <Route path="/admin/reports/attendance" element={<AdminPage><AttendanceReport /></AdminPage>} />
            <Route path="/admin/reports/marks"   element={<AdminPage><MarksReport /></AdminPage>} />

            {/* ══ STAFF ROUTES ══════════════════════════════════════════ */}
            <Route path="/staff/dashboard"   element={<StaffPage><StaffDashboard /></StaffPage>} />
            <Route path="/staff/attendance"  element={<StaffPage><MarkAttendance /></StaffPage>} />
            <Route path="/staff/assignments" element={<StaffPage><ManageAssignments /></StaffPage>} />
            <Route path="/staff/notes"       element={<StaffPage><UploadNotes /></StaffPage>} />
            <Route path="/staff/marks"       element={<StaffPage><InternalMarks /></StaffPage>} />
            <Route path="/staff/workdiary"   element={<StaffPage><WorkDiary /></StaffPage>} />

            {/* ══ STUDENT ROUTES ════════════════════════════════════════ */}
            <Route path="/student/dashboard"  element={<StudentPage><StudentDashboard /></StudentPage>} />
            <Route path="/student/attendance" element={<StudentPage><MyAttendance /></StudentPage>} />
            <Route path="/student/marks"      element={<StudentPage><MyMarks /></StudentPage>} />
            <Route path="/student/notes"      element={<StudentPage><ViewNotes /></StudentPage>} />
            <Route path="/student/events"     element={<StudentPage><ViewEvents /></StudentPage>} />
            <Route path="/student/complaints" element={<StudentPage><MyComplaints /></StudentPage>} />

            {/* Catch-all */}
            <Route path="*" element={<Navigate to="/login" replace />} />
          </Routes>
        </BrowserRouter>
      </AuthProvider>
    </ThemeProvider>
  );
}

export default App;
