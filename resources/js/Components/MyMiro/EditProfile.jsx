import React, { useState, useEffect } from 'react';
import axios from 'axios';

const EditProfile = ({ setActiveTab }) => {
    const [formData, setFormData] = useState({
        firstName: '',
        lastName: '',
        profession: '',
        phone: '',
        email: '',
        address: '',
        avatar: null,
    });
    const [avatarPreview, setAvatarPreview] = useState(null);
    const [saving, setSaving] = useState(false);
    const [error, setError] = useState('');
    const [showToast, setShowToast] = useState(false);
    const [toastMessage, setToastMessage] = useState('');

    useEffect(() => {
        const load = async () => {
            try {
                const { data } = await axios.get('/mymiro/customer-data');
                if (data && data.customer) {
                    const { name, email, phone, profession, address, avatar } = data.customer;
                    const [firstName = '', lastName = ''] = (name || '').split(' ');
                    setFormData(prev => ({
                        ...prev,
                        firstName,
                        lastName,
                        email: email || '',
                        phone: phone || '',
                        profession: profession || '',
                        address: address || '',
                    }));
                    setAvatarPreview(avatar || null);
                }
            } catch (e) {
                // ignore
            }
        };
        load();
    }, []);

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value,
        });
    };

    const handleAvatarChange = (e) => {
        const file = e.target.files && e.target.files[0];
        if (file) {
            setFormData({ ...formData, avatar: file });
            const url = URL.createObjectURL(file);
            setAvatarPreview(url);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSaving(true);
        setError('');
        try {
            const fd = new FormData();
            if (formData.firstName) fd.append('first_name', formData.firstName);
            if (formData.lastName) fd.append('last_name', formData.lastName);
            if (formData.profession) fd.append('profession', formData.profession);
            if (formData.phone) fd.append('phone', formData.phone);
            if (formData.email) fd.append('email', formData.email);
            if (formData.address) fd.append('address', formData.address);
            if (formData.avatar) fd.append('avatar', formData.avatar);

            const res = await axios.post('/mymiro/profile/update', fd, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            // Show success toast instead of navigating
            setToastMessage('Profile updated successfully');
            setShowToast(true);
            setTimeout(() => setShowToast(false), 3000);
        } catch (err) {
            setError(err.response?.data?.message || 'Failed to save');
        } finally {
            setSaving(false);
        }
    };

    return (
        <div className="edit-profile-container">
            <h2>Edit Profile</h2>
            <p>Protect your personal information. Details you share here will be visible <br /> to anyone with access to your profile.</p>

            {/* Profile Image and Change Button */}
            <div className="edit-profile-image-container">
                <div className="edit-profile-image">
                    {avatarPreview ? (
                        <img src={avatarPreview} alt="Avatar" style={{ width: '100%', height: '100%', objectFit: 'cover', borderRadius: '50%' }} />
                    ) : null}
                </div>
                <label className="edit-change-btn" htmlFor="avatar">Change</label>
                <input id="avatar" type="file" accept="image/*" style={{ display: 'none' }} onChange={handleAvatarChange} />
            </div>

            {/* Profile Form */}
            <form onSubmit={handleSubmit}>
                <div className="edit-form-flex">
                    <div className="edit-form-group">
                        <label htmlFor="firstName">First Name</label>
                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            value={formData.firstName}
                            onChange={handleInputChange}
                        />
                    </div>

                    <div className="edit-form-group">
                        <label htmlFor="lastName">Last Name</label>
                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            value={formData.lastName}
                            onChange={handleInputChange}
                        />
                    </div>
                </div>

                <div className="edit-form-flex">

                    <div className="edit-form-group">
                        <label htmlFor="profession">Profession</label>
                        <select
                            id="profession"
                            name="profession"
                            value={formData.profession}
                            onChange={handleInputChange}
                            className='profession-select'
                        >
                            <option value="">Select Profession</option>
                            <option value="developer">Developer</option>
                            <option value="designer">Designer</option>
                            <option value="architect">Architect</option>
                        </select>
                    </div>

                    <div className="edit-form-group">
                        <label htmlFor="phone">Phone Number</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value={formData.phone}
                            onChange={handleInputChange}
                        />
                    </div>

                </div>

                <div className="edit-form-flex">

                    <div className="edit-form-group">
                        <label htmlFor="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value={formData.email}
                            onChange={handleInputChange}
                        />
                    </div>

                    <div className="edit-form-group">
                        <label htmlFor="address">Address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value={formData.address}
                            onChange={handleInputChange}
                        />
                    </div>

                </div>


                {error && <div className="error-message">{error}</div>}
                <button type="submit" className="edit-submit-btn" disabled={saving}>{saving ? 'Saving...' : 'Save Changes'}</button>
            </form>

            {showToast && (
                <div className="toast-success" style={{ position: 'fixed', bottom: '24px', right: '24px', background: '#28a745', color: '#fff', padding: '10px 16px', borderRadius: '6px', boxShadow: '0 4px 10px rgba(0,0,0,0.15)', zIndex: 1000 }}>
                    {toastMessage}
                </div>
            )}
        </div>
    );
};

export default EditProfile;
