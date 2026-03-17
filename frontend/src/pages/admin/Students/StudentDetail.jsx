import { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import {
  Box, Grid, Card, CardContent, Typography, Avatar, Chip,
  CircularProgress, Alert, Button, Divider, Tab, Tabs,
} from '@mui/material';
import { ArrowBack, Person, School, ContactPhone } from '@mui/icons-material';
import { getStudent } from '../../../api/students';
import PageWrapper from '../../../components/common/PageWrapper';

const Field = ({ label, value }) => (
  <Box sx={{ mb: 2 }}>
    <Typography variant="caption" color="text.secondary" fontWeight={600} sx={{ textTransform: 'uppercase', letterSpacing: 0.5 }}>
      {label}
    </Typography>
    <Typography variant="body1" color="text.primary" sx={{ mt: 0.25 }}>
      {value || <span style={{ color: '#9CA3AF' }}>—</span>}
    </Typography>
  </Box>
);

export default function StudentDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');
  const [tab,     setTab]     = useState(0);

  useEffect(() => {
    setLoading(true);
    getStudent(id)
      .then(r => { if (r.data.success) setData(r.data.data); else setError(r.data.message); })
      .catch(() => setError('Failed to load student.'))
      .finally(() => setLoading(false));
  }, [id]);

  if (loading) return <PageWrapper><Box display="flex" justifyContent="center" py={10}><CircularProgress /></Box></PageWrapper>;
  if (error)   return <PageWrapper><Alert severity="error">{error}</Alert></PageWrapper>;
  if (!data)   return null;

  const p = data.personal || {};
  const statusColor = data.status === 'Active' ? '#10B981' : data.status === 'Alumni' ? '#4F46E5' : '#F59E0B';

  return (
    <PageWrapper>
      <Box display="flex" alignItems="center" gap={2} mb={3}>
        <Button startIcon={<ArrowBack />} onClick={() => navigate('/admin/students')} variant="outlined" size="small">
          Back
        </Button>
        <Box flex={1}>
          <Typography variant="h4" fontWeight={700}>Student Detail</Typography>
          <Typography variant="body2" color="text.secondary">Full profile for {data.Name}</Typography>
        </Box>
      </Box>

      {/* Profile header card */}
      <Card sx={{ mb: 3, background: 'linear-gradient(135deg,#4F46E5,#818CF8)', color: 'white' }}>
        <CardContent sx={{ p: 3 }}>
          <Grid container spacing={3} alignItems="center">
            <Grid>
              <Avatar sx={{ width: 80, height: 80, bgcolor: 'rgba(255,255,255,0.2)', fontSize: 32, fontWeight: 700 }}>
                {data.Name?.charAt(0)}
              </Avatar>
            </Grid>
            <Grid size="grow">
              <Typography variant="h5" fontWeight={700}>{data.Name}</Typography>
              <Typography variant="body2" sx={{ opacity: 0.85 }}>{data.RegNo}</Typography>
              <Box display="flex" gap={1.5} mt={1.5} flexWrap="wrap">
                <Chip label={data.Department} size="small" sx={{ bgcolor: 'rgba(255,255,255,0.2)', color: 'white' }} />
                <Chip label={`Batch ${data.Batch}`} size="small" sx={{ bgcolor: 'rgba(255,255,255,0.2)', color: 'white' }} />
                <Chip label={`Sem ${data.sem}`} size="small" sx={{ bgcolor: 'rgba(255,255,255,0.2)', color: 'white' }} />
                <Chip label={data.status || 'Active'} size="small"
                  sx={{ bgcolor: 'rgba(255,255,255,0.25)', color: 'white', fontWeight: 600 }} />
              </Box>
            </Grid>
            {p.StudentPhoto && (
              <Grid>
                <Avatar src={`http://localhost/College-project/backend/${p.StudentPhoto}`}
                  sx={{ width: 72, height: 72, border: '3px solid rgba(255,255,255,0.4)' }} />
              </Grid>
            )}
          </Grid>
        </CardContent>
      </Card>

      {/* Tabs */}
      <Tabs value={tab} onChange={(_, v) => setTab(v)} sx={{ mb: 2, borderBottom: 1, borderColor: 'divider' }}>
        <Tab icon={<Person sx={{ fontSize: 18 }} />} iconPosition="start" label="Academic Info" />
        <Tab icon={<ContactPhone sx={{ fontSize: 18 }} />} iconPosition="start" label="Personal Details" />
      </Tabs>

      {tab === 0 && (
        <Grid container spacing={2}>
          <Grid size={{ xs: 12, md: 6 }}>
            <Card>
              <CardContent>
                <Typography variant="subtitle1" fontWeight={700} mb={2} display="flex" alignItems="center" gap={1}>
                  <School sx={{ color: '#4F46E5', fontSize: 20 }} /> Academic Information
                </Typography>
                <Divider sx={{ mb: 2 }} />
                <Field label="Register Number" value={data.RegNo} />
                <Field label="Full Name"        value={data.Name} />
                <Field label="Department"       value={data.Department} />
                <Field label="Batch"            value={data.Batch} />
                <Field label="Current Semester" value={data.sem} />
                <Field label="Status"           value={data.status} />
                <Field label="Email ID"         value={data.Emailid} />
              </CardContent>
            </Card>
          </Grid>
          <Grid size={{ xs: 12, md: 6 }}>
            <Card>
              <CardContent>
                <Typography variant="subtitle1" fontWeight={700} mb={2}>Contact & Basic Info</Typography>
                <Divider sx={{ mb: 2 }} />
                <Field label="Gender"      value={data.Gender || p.Gender} />
                <Field label="Date of Birth" value={data.DOB || p.Dob} />
                <Field label="Mobile No"   value={data.Mobileno || p.Mobileno} />
                <Field label="Address"     value={data.Address || p.Address} />
              </CardContent>
            </Card>
          </Grid>
        </Grid>
      )}

      {tab === 1 && (
        <Grid container spacing={2}>
          <Grid size={{ xs: 12, md: 6 }}>
            <Card>
              <CardContent>
                <Typography variant="subtitle1" fontWeight={700} mb={2}>Family & Background</Typography>
                <Divider sx={{ mb: 2 }} />
                <Field label="Parent Name"   value={p.Parentsname} />
                <Field label="Occupation"    value={p.Occupation} />
                <Field label="Parent Mobile" value={p.Pmobileno} />
                <Field label="Nationality"   value={p.Nationality} />
                <Field label="Community"     value={p.Community} />
                <Field label="Caste"         value={p.Caste} />
                <Field label="Blood Group"   value={p.Bgroup} />
              </CardContent>
            </Card>
          </Grid>
          <Grid size={{ xs: 12, md: 6 }}>
            <Card>
              <CardContent>
                <Typography variant="subtitle1" fontWeight={700} mb={2}>Academic History</Typography>
                <Divider sx={{ mb: 2 }} />
                <Field label="Admission Date"   value={p.AdmissionDate} />
                <Field label="Admission Number" value={p.AdmissionNo} />
                <Field label="Email"            value={p.Emailid} />
                <Field label="10th Mark"        value={p.TenthMark ? `${p.TenthMark} / 500` : null} />
                <Field label="12th Mark"        value={p.TwelvethMark ? `${p.TwelvethMark} / 1200` : null} />
                <Field label="Pincode"          value={p.Pincode} />
                <Field label="Aadhaar No"       value={p.aadharno} />
              </CardContent>
            </Card>
          </Grid>
        </Grid>
      )}
    </PageWrapper>
  );
}
