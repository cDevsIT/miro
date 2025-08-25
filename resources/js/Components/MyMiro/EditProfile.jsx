import React, { useState } from 'react';

const EditProfile = () => {
    const [formData, setFormData] = useState({
        firstName: 'Meem',
        lastName: 'Zaman',
        profession: '',
        phone: '',
        email: '',
        address: '',
    });

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        // Add form submission logic here
    };

    return (
        <div className="edit-profile-container">
            <h2>Edit Profile</h2>
            <p>Protect your personal information. Details you share here will be visible <br /> to anyone with access to your profile.</p>

            {/* Profile Image and Change Button */}
            <div className="edit-profile-image-container">
                <div className="edit-profile-image"></div>
                <button className="edit-change-btn">Change</button>
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


                <button type="submit" className="edit-submit-btn">Save Changes</button>
            </form>
        </div>
    );
};

export default EditProfile;
