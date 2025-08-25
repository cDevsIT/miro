import React, { useState, useEffect } from 'react';
import axios from 'axios';

const BookAppointment = ({ setActiveTab }) => {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        date: '',
        time: '',
        remarks: ''
    });

    const [loading, setLoading] = useState(false);
    const [error, setError] = useState('');

    // Set current time when component loads or date changes
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
                // Directly switch to meeting schedule tab on success
                setActiveTab('meetingSchedule');
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

    return (
        <div className="book-appointment">
            <h2>Book an appointment</h2>

            {error && (
                <div className="error-message">
                    {error}
                    {/* Show detailed error if available */}
                    {error.response?.data?.errors && (
                        <ul>
                            {Object.values(error.response.data.errors).map((err, index) => (
                                <li key={index}>{err[0]}</li>
                            ))}
                        </ul>
                    )}
                </div>
            )}

            <form onSubmit={handleSubmit} className="appointment-form">
                <div className="form-grid form-phone-book">
                    <div className="form-group">
                        <input
                            type="text"
                            name="name"
                            placeholder="Name"
                            value={formData.name}
                            onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                            required
                        />
                    </div>

                    <div className="form-group">
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
                    </div>

                    <div className="form-group">
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

                    <div className="form-group full-width">
                        <textarea
                            name="remarks"
                            placeholder="Remarks"
                            value={formData.remarks}
                            onChange={(e) => setFormData({ ...formData, remarks: e.target.value })}
                            rows="6"
                        ></textarea>
                    </div>

                    <div className="form-group full-width text-right form-button">
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
    );
};

export default BookAppointment; 