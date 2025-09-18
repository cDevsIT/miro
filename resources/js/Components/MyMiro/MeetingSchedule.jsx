import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { FaRegCalendarAlt } from 'react-icons/fa';
import img1 from '../../../../public/images/MEETING BIG PICTURE.svg';

const MeetingSchedule = () => {
    const [appointments, setAppointments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        date: '',
        time: '',
        remarks: ''
    });

    useEffect(() => {
        fetchAppointments();
    }, []);

    const fetchAppointments = async () => {
        try {
            const response = await axios.get('/mymiro/appointments');
            setAppointments(response.data.appointments);
            setLoading(false);
        } catch (err) {
            setError('Failed to load appointments');
            setLoading(false);
        }
    };

    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
    };

    useEffect(() => {
        if (formData.date) {
            const now = new Date();
            const currentTime = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit'
            });
            setFormData(prev => ({ ...prev, time: currentTime }));
        }
    }, [formData.date]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');

        try {
            const response = await axios.post('/mymiro/appointments/store', formData);

            if (response.data.success) {
                // Refresh the appointments list so the schedule view is shown
                await fetchAppointments();
                // Reset form
                setFormData({ name: '', email: '', phone: '', date: '', time: '', remarks: '' });
            }
        } catch (err) {
            console.error('Appointment booking error:', err);
            setError(err.response?.data?.message || 'Failed to book appointment. Please try again.');
        } finally {
            setLoading(false);
        }
    };

    const generateTimeSlots = () => {
        const slots = [];
        for (let hour = 9; hour <= 17; hour++) { // 9 AM to 5 PM
            for (let minute of ['00', '30']) { // 30-minute intervals
                const time = `${hour.toString().padStart(2, '0')}:${minute}`;
                slots.push(time);
            }
        }
        return slots;
    };

    if (loading) return <div className="loading">Loading appointments...</div>;

    // Consider status: only treat schedules with status 'pending' or 'scheduled' as active
    const hasActiveSchedule = Array.isArray(appointments) && appointments.some(a => (a?.status === 'pending' || a?.status === 'scheduled'));

    return (
        <div className="meeting-schedule">

            {!hasActiveSchedule ? (
                <div className="book-appointment">
                    <h2>Book an appointment</h2>

                    {error && (
                        <div className="error-message">{error}</div>
                    )}

                    <form onSubmit={handleSubmit} className="dashboard-appointment-form">
                        <div className="form-grid">
                            <div className="form-group">
                                <input
                                    type="text"
                                    name="name"
                                    placeholder="Name"
                                    value={formData.name}
                                    onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                                    required
                                />
                                <input
                                    type="email"
                                    name="email"
                                    placeholder="Email"
                                    value={formData.email}
                                    onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                                    required
                                />
                            </div>

                            <div className="form-group">
                                <input
                                    type="tel"
                                    name="phone"
                                    placeholder="Phone"
                                    value={formData.phone}
                                    onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                                    required
                                />
                                <input
                                    type="date"
                                    name="date"
                                    placeholder="Pick a date"
                                    value={formData.date}
                                    onChange={(e) => setFormData({ ...formData, date: e.target.value })}
                                    min={new Date().toISOString().split('T')[0]}
                                    required
                                />
                            </div>

                            <div className="form-group">
                                <textarea
                                    name="remarks"
                                    placeholder="Remarks"
                                    value={formData.remarks}
                                    onChange={(e) => setFormData({ ...formData, remarks: e.target.value })}
                                    rows="6"
                                ></textarea>
                            </div>

                            <div className="form-group form-button">
                                <button
                                    type="submit"
                                    className="submit-btn"
                                    disabled={loading}
                                >
                                    {loading ? 'Submitting...' : 'SUBMIT'}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            ) : (
                <div className="appointments-list">
                    <div className="meeting-schedule-container">
                        <h2 className="meeting-schedule-title">Meeting Schedule</h2>
                        {appointments.filter(appt => appt.status !== 'complete').map((appt) => (
                            <div key={appt.id} className='meeting-box'>
                                {(() => {
                                    const s = (appt.status || 'pending').toLowerCase();
                                    appt._footerMsg = s === 'scheduled' ? 'Looking forward to seeing you there!'
                                        : s === 'complete' ? 'Thanks for meeting with us!'
                                        : 'We\'ll review your request and confirm soon.';
                                })()}
                                <div className="meeting-details-card">
                                    <div className="meeting-image">
                                        <img src={img1} alt='Meeting Scheduled Image For Miro' />
                                    </div>
                                    <div className="meeting-footer footer-vanish">
                                        <p>{appt._footerMsg}</p>
                                    </div>
                                    <div className="meeting-details">
                                        <h3>Meeting Details</h3>
                                        <div className="meeting-info">
                                            <p><strong>Date:</strong> {formatDate(appt.date)}</p>
                                            <p><strong>Time:</strong> {appt.time}</p>
                                            <p><strong>Status:</strong> {appt.status || 'pending'}</p>
                                            <p><strong>Name:</strong> {appt.name}</p>
                                            <p><strong>Email:</strong> {appt.email}</p>
                                            <p><strong>Contact no:</strong> {appt.phone}</p>
                                            {appt.remarks && (
                                                <p><strong>Remarks:</strong> {appt.remarks}</p>
                                            )}
                                        </div>
                                    </div>
                                </div>
                                <div className="meeting-footer footer-pc">
                                    <p>{appt._footerMsg}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
};

export default MeetingSchedule; 